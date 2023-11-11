<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(){

        return view('backend.users.index',[
            'title' => 'User List',
            'page_name' => 'User',
            'page_title' => 'List',
            'datas' => User::orderBy('id','desc')->get(),
        ]);
    }

    public function create(){
        return view('backend.users.create',[
            'title' => 'User Create',
            'page_name' => 'User',
            'page_title' => 'Create',
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'role' => 'required',
        ]);

        $data = new User();
        $data->name = $request->get('name');
        $data->email = $request->get('email');
        $data->password = bcrypt($request->get('password'));

        if($data->save()){
            $data->assignRole($request->get('role'));
            return redirect()->back()->with("success","Data Added Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }
    }

    public function edit($id){

        return view('backend.users.edit',[
            'title' => 'User Update',
            'page_title' => 'User Update',
            'page_name' => ' Update',
            'data' => User::with('roles')->where('id',$id)->first(),
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'address' => 'required',
            'role' => 'required',
        ]);

        $data = User::findOrFail($id);
        $data->name = $request->get('name');
        $data->email = $request->get('email');

        if($data->save()){

            DB::table('model_has_roles')->where('model_id',$id)->delete();

            $data->assignRole($request->get('role'));

            return redirect()->back()->with("success","Data Updated Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }
    }

    public function destroy($id){
        if($id == Auth::user()->id){
            return redirect()->back()->with("success","You can not delete Your Account.");
        }
        $data = User::find($id);

        if($data->delete()){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            return redirect()->back()->with("success","Data Delete Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }

    }
}
