<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminRoleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminRoleDataTable $dataTable)
    {
          return $dataTable->render('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        Role::create(['name' => $request->name]);
         notyf()->success('Role Created Successfully!');
        return to_route('admin.role.index');
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
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $request->validate([
            'name' => ['required', 'string']
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
         notyf()->success('Role Created Successfully!');
        return to_route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $role = Role::findOrFail($id);
          $role->delete();
         notyf()->success('Role Deleted Successfully!');
        return response(['status' => 'success']);
    }
}
