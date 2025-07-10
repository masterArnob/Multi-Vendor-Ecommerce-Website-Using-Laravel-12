<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminPermissionDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminPermissionDataTable $dataTable)
    {
          return $dataTable->render('admin.permission.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => ['required', 'string'],
            'group_name' => ['required']
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->guard_name = 'admin';
        $permission->group_name = $request->group_name;
        $permission->save();
        notyf()->success('Permission created successfully');
        return to_route('admin.permission.index');
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
        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
            'name' => ['required', 'string'],
            'group_name' => ['required']
        ]);
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->group_name = $request->group_name;
        $permission->save();
        notyf()->success('Permission updated successfully');
        return to_route('admin.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
         $permission->delete();
         notyf()->success('Permission Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
