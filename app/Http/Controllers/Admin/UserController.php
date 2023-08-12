<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\Province;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rap2hpoutre\FastExcel\FastExcel;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['roles', 'city.province']);

        if ($request->query('search_item'))
        {
            $search_item = $request->query('search_item');
            $query->when($search_item, function (Builder $builder) use ($search_item) {
                $builder->where('first_name', 'LIKE', "%{$search_item}%")
                        ->orWhere('last_name', 'LIKE', "%{$search_item}%")
                        ->orWhere('phone', 'LIKE', "%{$search_item}%")
                        ->orWhere('national_code', 'LIKE', "%{$search_item}%")
                        ->orWhereRelation('city', 'title', 'LIKE', "%{$search_item}%");
            });
        }

        if($request->has('status_item') && $request->query('status_item') != 'all')
        {
            $status_item = $request->query('status_item');
            $query->where('is_active', $status_item);
        }

        if($request->has('gender_item') && $request->query('gender_item') != 'all')
        {
            $gender_item = $request->query('gender_item');
            $query->where('gender', $gender_item);
        }

        if($request->has('roles_item') && $request->query('roles_item') != 'all')
        {
            $roles_item  = $request->query('roles_item');
            $query->whereHas('roles', function ($q) use ($roles_item ) {
                $q->where('role_id', $roles_item);
            });
        }

        $users = $query->orderBy('last_name')->orderBy('first_name')->paginate(10)->withQueryString();
        $roles = Role::select('id', 'title')->get();

        return view('admin.users.index', ['users' => $users, 'roles' => $roles]);
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

            if($request->hasFile('avatar'))
            {
                $avatar      = $request->file('avatar');
                $storage_dir = '/user';

                uploadFile($storage_dir, ['avatar' => $avatar], ['fileable_id' => $user->id, 'fileable_type' => User::class]);
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

            if($request->hasFile('avatar'))
            {
                $file = $user->files->where('related_field','avatar')->first();

                if($file)
                {
                    purge($file->path);
                    $file->delete();
                }

                $avatar      = $request->file('avatar');
                $storage_dir = '/user';

                uploadFile($storage_dir, ['avatar' => $avatar], ['fileable_id' => $user->id, 'fileable_type' => User::class]);
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
       //

    }

}
