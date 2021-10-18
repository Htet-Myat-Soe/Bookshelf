<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function profile(){
        return view('admin.profile');
    }

    public function profile_upload(Request $request){

        $user = User::find($request->id);
        $photo = $request->image;
        $imageName = rand(100,1000).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('assets/img/user'),$imageName);
        $user->image = $imageName;
        $user->save();
        $user->image = asset('assets/img/user/'.$user->image);

        return response()->json($user);


    }

    public function change_profile_detail(Request $request){
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json($user);
    }
}
