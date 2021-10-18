<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\BookImport;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{

    public function index(){
        $books = Book::orderBy('id','DESC')->paginate(12);
        $categories = Category::all();

        return view('admin.books.index',compact(['books','categories']));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.books.create',compact('categories'));
    }

    public function store(Request $request){
        $slug = Str::of($request->name)->slug('-');
        $image = $request->file('image');
        $pdf = $request->file('pdf');

        $book = new Book();

        $valid = $request->validate([
            'name' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'pdf' => 'required|mimes:pdf,doc,docx,epub',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'page' => 'nullable',
            'category_id' => 'required',
        ]);

        $book->name = $request->name;
        $book->slug = $slug;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->page = $request->page;

        $pdfName = time().'.'.$pdf->extension();
        $pdf->move(public_path('assets/pdf'),$pdfName);

        $imageName = time().'.'.$image->extension();
        $image->move(public_path('assets/img/book_images'),$imageName);

        $book->image = $imageName;
        $book->book = $pdfName;
        $book->category_id = $request->category_id;

        $book->save();


        session()->flash('success','Book Uploaded Successfully');
        return back();
    }

    public function show($slug){
        $book = Book::where('slug',$slug)->first();
        return view('admin.books.show',compact('book'));
    }

    public function edit($slug){
        $categories = Category::all();
        $book = Book::where('slug',$slug)->first();
        return view('admin.books.edit',compact(['book','categories']));
    }

    public function update(Request $request,$slug){
        $newSlug = Str::of($request->name)->slug('-');
        $image = $request->file('image');
        $pdf = $request->file('pdf');

        $book = Book::where('slug',$slug)->first();

        $valid = $request->validate([
            'name' => 'required',
            'author' => 'required',
            'description' => 'max:10000|nullable',
            'pdf' => 'required|mimes:pdf,doc,docx,epub',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'page' => 'nullable',
            'category_id' => 'required',
        ]);

        $book->name = $request->name;
        $book->slug = $newSlug;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->page = $request->page;

        $pdfName = time().'.'.$pdf->extension();
        $pdf->move(public_path('assets/pdf'),$pdfName);

        $imageName = time().'.'.$image->extension();
        $image->move(public_path('assets/img/book_images'),$imageName);

        $book->image = $imageName;
        $book->book = $pdfName;
        $book->category_id = $request->category_id;

        $book->save();

        session()->flash('update_success','Book Updated Successfully');
        return redirect()->route('admin_books.index');
    }

    public function delete($slug){
        $book = Book::where('slug',$slug)->first();
        if($book->image){
            unlink(public_path('assets/img/book_images').'/'.$book->image);
        }
        if($book->book){
            unlink(public_path('assets/pdf').'/'.$book->book);
        }
        $book->delete();
        session()->flash('delete_success','Book Deleted Successfully');
        return redirect()->route('admin_books.index');

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
        return view('admin.books.search',compact(['books','categories']));
    }

    //public function excel(){
//         return view('admin.books.import');
//     }

//     public function excelImport(Request $request){

//         Excel::import(new BookImport,$request->file('excel'));
//         return redirect()->route('admin_books.index')->with('import','Import Excel file successfully');
//     }

 }

