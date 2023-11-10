<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','show']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    public function index(){
        return view('backend.permissions.index',[
            'title' => 'Permission List',
            'page_name' => 'Permission',
            'page_title' => 'List',
            'datas' => Permission::all(),
        ]);
    }

    public function create(){
        return view('backend.permissions.create',[
            'title' => 'Permission Create',
            'page_name' => 'Permission',
            'page_title' => 'Create',
        ]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
        ]);
        $data = new Permission();
        $data->name = $request->get('name');
        $data->guard_name = 'web';

        if($data->save()){
            return redirect()->back()->with("success","Data Added Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }

    }

    public function edit($id){

        return view('backend.permissions.edit',[
            'title' => 'Permission Update',
            'page_title' => 'Permission Update',
            'page_name' => 'News Update',
            'data' => Permission::find($id),
        ]);
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            'name' => 'required',
        ]);

        $data = Permission::find($id);
        $data->name = $request->get('name');
        $data->guard_name = 'web';

        if($data->save()){
            return redirect()->back()->with("success","Data Updated Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }
    }

    public function destroy($id){

        $data = Permission::find($id);
        if($data->delete()){
            return redirect()->back()->with("success","Data Delete Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }

    }
}
