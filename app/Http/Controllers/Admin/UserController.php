<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::select('id', 'title')->get();

        if ($item = $request->query('item_roles') and $item != 'all')
        {
            $users = Role::find($item)->users;
        } else
        {
            $users = User::with(['roles', 'city.province'])->orderBy('last_name')->orderBy('first_name')->get();
        }
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
            $user                = User::create($request->except(['birthday_date']));
            $user->birthday_date = Jalalian::fromFormat('Y/m/d', $request->input('birthday_date'))->toCarbon();
            $user->creator       = Auth::id();
            $user->save();
            $user->roles()->attach($request->input('roles'));
            return redirect()->route('admin.users.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');
        }
        catch (\Exception $e) {
            return redirect()->route('admin.users.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    public function edit(User $user)
    {
        $roles     = Role::get();
        $provinces = Province::get();
        $cities    = City::where('province_id', $user->city->province->id)->get();

        return view('admin.users.edit', ['user' => $user, 'roles' => $roles, 'provinces' => $provinces, 'cities' => $cities]);
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $user->update($request->except(['birthday_date']));
            $user->birthday_date = Jalalian::fromFormat('Y/m/d', $request->input('birthday_date'))->toCarbon();
            $user->creator       = Auth::id();
            $user->roles()->sync($request->input('roles'));
            return redirect()->route('admin.users.index')->with('success', 'ویرایش اطلاعات  با‌موفقیت انجام شد.');

        }
        catch (\Exception $e) {
            return redirect()->route('admin.users.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    public function delete(User $user)
    {
        try {
            $user->delete();
            return response()->json(['success' => true], 200);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }

    // public function export()
    // {
    //     $exportDataArray = [
    //         new ExportData(
    //             ['Name', 'Email', 'Phone'],
    //             [
    //                 ['John Doe', 'john@example.com', '123456789'],
    //                 ['Jane Smith', 'jane@example.com', '987654321']
    //             ]
    //         )
    //     ];
    //     Excel::create('export', function ($excel) use ($exportDataArray) {
    //         foreach ($exportDataArray as $index => $exportData) {
    //             $excel->sheet('Section ' . ($index + 1), function ($sheet) use ($exportData) {
    //                 $sheet->fromArray($exportData->data, null, 'A1', false, false);
    //                 $sheet->prependRow($exportData->columns);
    //             });
    //         }
    //     })->download('xlsx');
    // }

}
