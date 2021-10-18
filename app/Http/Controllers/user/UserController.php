<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use App\Models\UserComment;
use App\Models\UserDownloaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $user_download_books = Auth::user()->books;
        return view('user.profile',compact('user_download_books'));
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

    public function download($ebook_id){
        $ebook = Book::find($ebook_id);

        $user_download = new UserDownloaded();

        $user_download->user_id = Auth::user()->id;
        $user_download->book_id = $ebook_id;
        $user_download->save();

        $path = public_path("assets/pdf/".$ebook->book);
        return response()->download($path);


    }

    public function add_comment(Request $request){

        $user_cmt = new Comment();

        $user_cmt->user_id = Auth::user()->id;
        $user_cmt->comment = $request->cmt;
        $user_cmt->book_id = $request->id;

        $user_cmt->save();

        $user_cmt->count = count($user_cmt->book->comments);
        $user_cmt->user_image = asset('assets/img/user').'/'.$user_cmt->user->image;
        return response()->json($user_cmt);
    }

    public function edit_comment($id){
        $user_cmt = Comment::find($id);

        return response()->json($user_cmt);
    }

    public function update_comment(Request $request){
        $user_cmt = Comment::find($request->id);
        $user_cmt->comment = $request->edit_cmt;
        $user_cmt->save();
        return response()->json($user_cmt);
    }

    public function delete_comment($id){
        $user_cmt = Comment::find($id);
        $user_cmt->delete();
        return response()->json(['delete' => 'Comment Deleted Successfully']);
    }

}
