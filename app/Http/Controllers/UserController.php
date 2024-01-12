<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Tạo quyền
        // Role::create(['name'=>'admin']);
        //Tạo vai trò
        // Permission::create(['name' => 'edit book']);
        //Tìm role và permission
        // $role = Role::find(4);
        // $permission = Permission::find(4);
        
        // $role->givePermissionTo($permission);
        // $role->revokePermissionTo($permission);
        //user()->givePermissionTo('edit articles');
        // auth()->user()->assignRole('writer');
        // return auth()->user()->permissions;
        //return auth()->user()->getDirectPermissions();
        // return auth()->user()->getAllPermissions();
        // return auth()->user()->getPermissionsViaRoles();
        // return User::role('writer')->get();
       // auth()->user()->removeRole('writer');
        // $user = User::with('roles','permissions')->orderBy('id','DESC')->get();
        $user = User::with('roles')->get();
        return view('admincp.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $user=new User();
        $user->password = Hash::make($data['password']);
        $user->email= $data['email'];
        $user->name=$data['name'];
        $user->save();
        return redirect()->back()->with('status','Thêm user thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //
    }
    public function impersonate($id){
        $user = User::find($id);
        if($user) {
            Session::put('impersonate',$user->id);
        }
        return redirect('/home');
    }
    public function phanvaitro($id){
        $user = User::find($id);

        $role = Role::orderBy('id','DESC')->get();
        $permission = Permission::orderBy('id','DESC')->get();
        $all_column_roles = $user->roles->first();
        return view('admincp.user.phanvaitro',compact('user','role','all_column_roles','permission'));
    }
    public function phanquyen($id){
        $user = User::find($id);

        
        $permission = Permission::orderBy('id','DESC')->get();
        $name_roles = $user->roles->first()->name;
        return view('admincp.user.phanquyen',compact('user','permission','name_roles'));
    }
    public function insert_roles(Request $request,$id){
        $data = $request->all();
        $user = User::find($id);
        $user->syncRoles($data['role']);
        $role_id=$user->roles->first()->id;
        // $user->removeRole($data['role']);
        // $user->assignRole($data['role']);
        return redirect()->back()->with('status','Thêm vai trò cho user thành công');
    }
}
