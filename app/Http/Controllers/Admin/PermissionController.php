<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\PermissionRequest;
use Exception;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = $request->query('search_item');
        $permissions = Permission::with(['roles'])
            ->when($item, function (Builder $builder) use ($item) {
                $builder->where('title', 'LIKE', "%{$item}%")
                        ->orWhere('slug', 'LIKE', "%{$item}%")
                        ->orWhere('description', 'LIKE', "%{$item}%")
                        ->orWhereRelation('roles', 'title', 'LIKE', "%{$item}%");
            })
            ->paginate(10)->withQueryString(); // It shows an error but it works correctly

        return view('admin.permissions.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();

        return view('admin.permissions.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        try {
            $permission = Permission::create($request->all());
            $permission->roles()->attach($request->input('roles'));

            return redirect()->route('admin.permissions.index');
        }
        catch (Exception $e) {
            return redirect()->route('admin.permissions.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $roles = Role::get();

        return view('admin.permissions.edit', ['permission' => $permission, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        try {
            $permission->update($request->all());
            $permission->roles()->sync($request->input('roles'));

            return redirect()->route('admin.permissions.index');
        }
        catch (Exception $e) {
            return redirect()->route('admin.permissions.index')->withErrors(['warning' => "اشکالی ناشناخته به‌وجود آمده است."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Permission $permission)
    {
        try {
            $permission->delete();

            return response()->json(['success' => true], 200);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'errors' => $e], 400);
        }
    }
}
