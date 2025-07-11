<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleInPermissionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleInPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role-in-permission.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_group_names = Permission::distinct()->pluck('group_name');
        $getPermissionByGroupNames = Permission::whereIn('group_name', $permission_group_names)->get();
        return view('admin.role-in-permission.create', compact('roles', 'permissions', 'permission_group_names', 'getPermissionByGroupNames'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $role = Role::findOrFail($request->role_id);
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);

        notyf()->success('Role Permissions Updated Successfully!');
        return to_route('admin.role-in-permission.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roleInPermission = Role::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_group_names = Permission::distinct()->pluck('group_name');
        $getPermissionByGroupNames = Permission::whereIn('group_name', $permission_group_names)->get();
        return view('admin.role-in-permission.edit', compact('roles', 'permissions', 'permission_group_names', 'getPermissionByGroupNames', 'roleInPermission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $roleInPermission = Role::findOrFail($id);
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $roleInPermission->syncPermissions($permissions);

        notyf()->success('Role Permissions Updated Successfully!');
        return to_route('admin.role-in-permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roleInPermission = Role::findOrFail($id);
        $permissions = $roleInPermission->permissions;
        foreach ($permissions as $permission) {
            $roleInPermission->revokePermissionTo($permission);
        }
        notyf()->success('Role Permissions Deleted Successfully!');
        return response(['status' => 'success']);
       
    }
}
