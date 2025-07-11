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
    public function index(RoleInPermissionDataTable $dataTable)
    {
          return $dataTable->render('admin.role-in-permission.index');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
