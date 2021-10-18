<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(){
        $users = User::orderBy('role','ASC')->paginate(10);

        return view('admin.users.index',compact('users'));
    }

    public function delete($id){
        $user = User::find($id);
        if($user->image){
            unlink(public_path('assets/img/user/'.$user->image));
        }
        $user->delete();
        session()->flush('user_deleted','User Deleted Successfully!');
        return redirect()->route('admin_users.index');
    }

    public function edit($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request){
        $user = User::find($request->id);
        $user->role = $request->role;
        $user->save();

        return response()->json($user);
    }
}
