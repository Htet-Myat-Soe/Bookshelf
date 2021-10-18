<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::orderBy('created_at','DESC')->get();
        return view('user_blog.blog',compact('blogs'));
    }

    public function get_by_id($id){
        $blog = Blog::find($id);
        return view('user_blog.show',compact('blog'));

    }

    public function search(Request $request){
        $blogs = Blog::where('title','LIKE','%'.$request->search.'%')->orderBy('created_at','DESC')->get();
        return view('user_blog.search',compact('blogs'));

    }
}
