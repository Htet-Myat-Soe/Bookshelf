<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(12);
        return view('admin.categories.index',compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $slug = Str::of($request->name)->slug('-');
        $image = $request->file('image');

        $category = new Category();

        $valid = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        $category->name = $request->name;
        $category->slug = $slug;


        $imageName = time().'.'.$image->extension();
        $image->move(public_path('assets/img/categories_images'),$imageName);

        $category->image = $imageName;

        $category->save();


        session()->flash('success','Category Uploaded Successfully');
        return back();
    }

    public function edit($slug){
        $category = Category::where('slug',$slug)->first();
        return view('admin.categories.edit',compact('category'));
    }

    public function update(Request $request,$slug){
        $newSlug = Str::of($request->name)->slug('-');
        $image = $request->file('image');

        $category = Category::where('slug',$slug)->first();

        $valid = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        $category->name = $request->name;
        $category->slug = $newSlug;


        $imageName = time().'.'.$image->extension();
        $image->move(public_path('assets/img/categories_images'),$imageName);

        $category->image = $imageName;

        $category->save();

        session()->flash('update_success','Category Updated Successfully');
        return redirect()->route('admin_categories.index');
    }

    public function delete($slug){
        $category = Category::where('slug',$slug)->first();
        if($category->image){
            unlink(public_path('assets/img/categories_images').'/'.$category->image);
        }
        $category->delete();
        session()->flash('delete_success','Category Deleted Successfully');
        return redirect()->route('admin_categories.index');

    }

}
