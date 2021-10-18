<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\UserComment;
use Illuminate\Http\Request;

class EBookController extends Controller
{
    public function index(){
        $categories = Category::all();
        $books = Book::orderBy('created_at','DESC')->paginate(15);

        return view('home.ebooks',compact(['categories','books']));
    }

    public function details($slug){
        $book = Book::where('slug',$slug)->first();
        $rbooks = Book::where('category_id',$book->category_id)->orderBy('created_at','DESC')->take(6)->get();
        return view('home.detail',compact('book','rbooks'));
    }

    public function get_by_caegory($id){
        $books = Book::where('category_id',$id)->orderBy('created_at','DESC')->paginate(12);
        $category = Category::where('id',$id)->first();
        $cat_name = $category->name;
        $categories = Category::all();
        return view('home.category-books',compact(['books','category','cat_name','categories']));
    }

    public function get_by_author($author){
        $books = Book::where('author',$author)->orderBy('created_at','DESC')->paginate(12);
        $author_name = $author;
        return view('home.author',compact(['books','author_name']));
    }

    public function search(Request $request){
        $categories = Category::all();
        $category_id = $request->category_id;
        $search = $request->search;
        if(!isset($search) && $category_id > 0){
            $books = Book::orderBy('id','DESC')->where('category_id',$category_id)
            ->paginate(12);
        }
        elseif($category_id == 0){
            $books = Book::orderBy('id','DESC')->where('name','LIKE','%'.$search.'%')
            ->orWhere('author','LIKE','%'.$search.'%')
            ->paginate(12);
        }
        else{
            $books = Book::orderBy('id','DESC')->where('category_id',$category_id)
            ->orWhere('name','LIKE','%'.$search.'%')->orWhere('author','LIKE','%'.$search.'%')
            ->paginate(12);
        }
        $search_book_count = count($books);
        return view('home.search',compact(['books','categories','search_book_count']));
    }
}

