<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','show']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('backend.roles.index',[
            'title' => 'Role List',
            'page_name' => 'Role',
            'page_title' => 'List',
            'datas' => Role::orderBy('id','DESC')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.roles.create',[
            'title' => 'Role Create',
            'page_name' => 'Role',
            'page_title' => 'List',
            'datas' => Permission::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        if($role->save()){
            return redirect()->back()->with("success","Data Added Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('backend.roles.edit',[
            'title' => 'Role Update',
            'page_title' => 'Role Update',
            'page_name' => 'Role Update',
            'data' => Role::find($id),
            'permissions' => Permission::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,id,'.$id,
            'permission' => 'required'
        ]);

        $data = Role::find($id);
        $data->name = $request->get('name');
        if($data->save()){
            $data->syncPermissions($request->permission);
            return redirect()->back()->with("success","Data Updated Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Role::find($id);
        if($data->delete()){
            return redirect()->back()->with("success","Data Delete Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }
    }
}
