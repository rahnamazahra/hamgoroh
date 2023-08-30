<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\Province;
use Morilog\Jalali\Jalalian;
use Illuminate\Http\Request;
use App\Exports\ExportUsers;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::with(['roles', 'city.province', 'files']);

        if ($request->query('search_item'))
        {
            $search_item = $request->query('search_item');
            $user->when($search_item, function (Builder $builder) use ($search_item) {
                $builder->where('first_name', 'LIKE', "%{$search_item}%")
                        ->orWhere('last_name', 'LIKE', "%{$search_item}%")
                        ->orWhere('phone', 'LIKE', "%{$search_item}%")
                        ->orWhere('national_code', 'LIKE', "%{$search_item}%")
                        ->orWhereRelation('province', 'title', 'LIKE', "%{$search_item}%");
            });
        }

        if ($request->has('status_item') && $request->query('status_item') != 'all')
        {
            $status_item = $request->query('status_item');
            $user->where('is_active', $status_item);
        }

        if ($request->has('gender_item') && $request->query('gender_item') != 'all')
        {
            $gender_item = $request->query('gender_item');

            $user->where('gender', $gender_item);
        }

        if ($request->has('roles_item') && $request->query('roles_item') != 'all')
        {
            $roles_item  = $request->query('roles_item');

            $user->whereRelation('roles', 'role_id', $roles_item);
        }

        if ($request->has('evidence_item') && $request->query('evidence_item') != 'all')
        {
            $evidence_item = $request->query('evidence_item');

            if ($evidence_item)
            {
                $user->whereRelation('files', 'related_field', 'evidence');
            }
            else
            {
                $user->doesntHave('files');
            }
        }

        if ($request->has('province_item') && $request->query('province_item') != 'all')
        {
            $province_item = $request->query('province_item');

            $user->whereRelation('province', 'province_id', $province_item);
        }

        $users = $user->orderBy('last_name')->orderBy('first_name')->paginate(10)->withQueryString();
        $roles = Role::select('id', 'title')->get();
        $provinces = Province::all();

        return view('admin.users.index', ['users' => $users, 'roles' => $roles, 'provinces' => $provinces]);
    }

    public function create()
    {
        $roles     = Role::get();
        $provinces = Province::get();

        return view('admin.users.create', ['roles' => $roles, 'provinces'=>$provinces]);
    }

    public function store(UserRequest $request)
    {
        try {

            $user                = User::create($request->except(['birthday_date', 'avatar']));
            $user->birthday_date = Jalalian::fromFormat('Y/m/d', $request->input('birthday_date'))->toCarbon();
            $user->creator       = Auth::id();
            $user->save();

            $user->roles()->attach($request->input('roles'));

            if ($request->hasFile('avatar'))
            {
                $avatar      = $request->file('avatar');
                $storage_dir = '/user/avatar';

                uploadFile($storage_dir, ['avatar' => $avatar], ['fileable_id' => $user->id, 'fileable_type' => User::class]);
            }

            if ($request->hasFile('evidence'))
            {
                $evidence    = $request->file('evidence');
                $storage_dir = '/user/evidence';

                uploadFile($storage_dir, ['evidence' => $evidence], ['fileable_id' => $user->id, 'fileable_type' => User::class]);
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');

            return redirect()->route('admin.users.index');
        }
        catch (Exception $e)
        {

            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');

            return redirect()->route('admin.users.index');
        }
    }

    public function edit(User $user)
    {
        $roles     = Role::get();
        $provinces = Province::get();
        $cities    = City::where('province_id', $user->city->province->id)->get();
        $avatar    = $user->files->where('related_field','avatar')->pluck('path')->first();

        return view('admin.users.edit', ['user' => $user, 'avatar' => $avatar, 'roles' => $roles, 'provinces' => $provinces, 'cities' => $cities]);
    }

    public function update(UserRequest $request, User $user)
    {

        $user->is_active = 0;

        try {

            $user->update($request->except(['birthday_date', 'avatar']));

            $user->birthday_date = Jalalian::fromFormat('Y/m/d', $request->input('birthday_date'))->toCarbon();

            $user->creator       = Auth::id();

            $user->roles()->sync($request->input('roles'));

            if ($request->hasFile('avatar'))
            {
                $file = $user->files->where('related_field','avatar')->first();

                if ($file)
                {
                    purge($file->path);
                    $file->delete();
                }

                $avatar      = $request->file('avatar');
                $storage_dir = '/user';

                uploadFile($storage_dir, ['avatar' => $avatar], ['fileable_id' => $user->id, 'fileable_type' => User::class]);
            }

            if ($request->hasFile('evidence'))
            {
                $evidence = $user->files->where('related_field','evidence')->first();

                if ($evidence)
                {
                    purge($evidence->path);
                    $evidence->delete();
                }

                $evidence    = $request->file('evidence');
                $storage_dir = '/user/evidence';

                uploadFile($storage_dir, ['evidence' => $evidence], ['fileable_id' => $user->id, 'fileable_type' => User::class]);
            }

            Alert('success', 'اطلاعات باموفقیت ثبت شد.');

            return redirect()->route('admin.users.index');

        }
        catch (Exception $e)
        {

            Alert('error', 'اشکالی ناشناخته به وجود آمده است.');

            return redirect()->route('admin.users.index');

        }
    }

    public function delete(User $user)
    {
        try {

            $user->delete();

            return response()->json(['success' => true], 200);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }

    public function exportUsers()
    {
       $previousUrl = URL::previous();

       $queryString = parse_url($previousUrl, PHP_URL_QUERY);

       parse_str($queryString, $queryParams);

       $users = User::select('first_name', 'last_name', 'is_active', 'phone', 'province_id', 'national_code', 'gender', 'birthday_date')->with(['roles', 'city.province', 'files']);

        if (array_key_exists('search_item', $queryParams))
        {
            $search_item = $queryParams['search_item'];
            $users->when($search_item, function (Builder $builder) use ($search_item) {
                $builder->where('first_name', 'LIKE', "%{$search_item}%")
                        ->orWhere('last_name', 'LIKE', "%{$search_item}%")
                        ->orWhere('phone', 'LIKE', "%{$search_item}%")
                        ->orWhere('national_code', 'LIKE', "%{$search_item}%")
                        ->orWhereRelation('province', 'title', 'LIKE', "%{$search_item}%");
            });
        }

        if (array_key_exists('status_item', $queryParams) AND $queryParams['status_item'] != 'all')
        {
            $status_item = $queryParams['status_item'];
            $users->where('is_active', $status_item);
        }

        if (array_key_exists('gender_item', $queryParams) AND $queryParams['gender_item'] != 'all')
        {
            $gender_item = $queryParams['gender_item'];

            $users->where('gender', $gender_item);
        }

        if (array_key_exists('roles_item', $queryParams) AND $queryParams['roles_item'] != 'all')
        {
            $roles_item  = $queryParams['roles_item'];

            $users->whereHas('roles', function ($q) use ($roles_item) {
                $q->where('role_id', $roles_item);
            });
        }

        if (array_key_exists('evidence_item', $queryParams) AND $queryParams['evidence_item'] != 'all')
        {
            $evidence_item = $queryParams['evidence_item'];

            if ($evidence_item)
            {
                $users->whereRelation('files', 'related_field', 'evidence');
            }
            else
            {
                $users->doesntHave('files');
            }
        }

        if (array_key_exists('province_item', $queryParams) AND $queryParams['province_item'] != 'all')
        {
            $province_item = $queryParams['province_item'];

            $users->where('province_id', $province_item);

        }

        $users = $users->get();

        $response = Excel::download(new ExportUsers($users), 'users.xlsx', \Maatwebsite\Excel\Excel::XLSX);

        ob_end_clean();

        return $response;
    }

}
