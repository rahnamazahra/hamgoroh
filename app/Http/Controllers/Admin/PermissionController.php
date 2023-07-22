<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\PermissionRequest;

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
            ->paginate(10);

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
        $permission = Permission::create($request->all());
        $permission->roles()->attach($request->input('roles'));

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
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
        $permission->update($request->all());
        $permission->roles()->sync($request->input('roles'));

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('admin.permissions.index');
    }
}
