<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

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
            $users = User::with(['roles'])->orderBy('last_name')->orderBy('first_name')->get();
        }
        return view('admin.users.index', ['users' => $users, 'roles' => $roles]);
    }
    public function store(UserRequest $request)
    {
        try {
            $user = User::create($request->all());
            $user->roles()->attach($request->input('roles'));
            return redirect()->route('admin.users.index')->with('success', 'ثبت اطلاعات  باموفقیت انجام شد.');
        }
        catch (Throwable $th) {
            return redirect()->route('admin.users.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }
    public function update(UserRequest $request, User $user)
    {
        try {
            $user->update($request->all());
            $user->roles()->sync($request->input('roles'));
            return redirect()->route('admin.users.index')->with('success', 'ویرایش اطلاعات  با‌موفقیت انجام شد.');

        }
        catch (Throwable $th) {
            return redirect()->route('admin.users.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }
    public function delete(User $user)
    {
        try
        {
            $user->delete();
            return redirect()->route('adin.users.index');
        }
        catch (Throwable $th) {
            return redirect()->route('admin.users.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }
}
