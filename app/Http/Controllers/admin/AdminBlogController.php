<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index(){
        $blogs = Blog::orderBy('id','DESC')->paginate(12);

        return view('admin.blog.index',compact('blogs'));
    }

    public function create(){
        return view('admin.blog.create');
    }

    public function store(Request $request){
        $image = $request->file('image');
        $blog = new Blog();

        $valid = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->user_id = $request->user_id;

        $imageName = time().'.'.$image->extension();
        $image->move(public_path('assets/img/blog_images'),$imageName);

        $blog->image = $imageName;

        $blog->save();


        session()->flash('success','Blog Uploaded Successfully');
        return back();
    }

    public function show($id){
        $blog = Blog::find($id);
        return view('admin.blog.show',compact('blog'));
    }

    public function edit($id){
        $blog = Blog::find($id);
        return view('admin.blog.edit',compact(['blog']));
    }

    public function update(Request $request,$id){

        $image = $request->file('image');
        $blog = Blog::find($id);

        $valid = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $blog->title = $request->title;
        $blog->description = $request->description;

        $imageName = time().'.'.$image->extension();
        $image->move(public_path('assets/img/blog_images'),$imageName);

        $blog->image = $imageName;

        $blog->save();


        session()->flash('success','Blog Updated Successfully');
        return redirect()->route('admin_blogs.index');
    }

    public function delete($id){
        $blog = Blog::find($id);
        if($blog->image){
            unlink(public_path('assets/img/blog_images').'/'.$blog->image);
        }
        $blog->delete();
        session()->flash('delete_success','Blog Deleted Successfully');
        return redirect()->route('admin_blogs.index');

    }

    public function search(Request $request){

        $search = $request->search;
        if(isset($search)){
            $blogs = Blog::where('title','LIKE','%'.$search.'%')->orWhere('author','LIKE','%'.$search.'%')->orderBy('id','DESC')->paginate(12);
        }
        else{
            $blogs = Blog::orderBy('id','DESC')->paginate(12);
        }
        return view('admin.blog.search',compact(['blogs']));
    }

}
