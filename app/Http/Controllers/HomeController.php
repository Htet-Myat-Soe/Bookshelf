<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $book_count = count(Book::all());
        $categories = Category::all();

        $books = Book::orderBy('created_at','DESC')->take(6)->get();
        $blogs = Blog::orderBy('created_at','DESC')->take(6)->get();

        return view('index',compact(['book_count','categories','books','blogs']));
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }
}
