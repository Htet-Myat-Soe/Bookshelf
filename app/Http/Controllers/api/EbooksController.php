<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EbooksResource;
use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EbooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ebooks = Book::all();
        return EbooksResource::collection($ebooks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'pdf' => 'required|mimes:pdf,doc,docx,epub',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'page' => 'nullable',
            'category_id' => 'required',
        ]);

        $book = new Book();
        $slug = Str::of($request->name)->slug('-');
        $image = $request->file('image');
        $pdf = $request->file('pdf');

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

       if($book->save()){
           return new EbooksResource($book);
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return new EbooksResource($book);
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
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'pdf' => 'required|mimes:pdf,doc,docx,epub',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'page' => 'nullable',
            'category_id' => 'required',
        ]);
        
        $book = Book::findOrFail($id);
        $slug = Str::of($request->name)->slug('-');
        $image = $request->file('image');
        $pdf = $request->file('pdf');

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

       if($book->save()){
           return new EbooksResource($book);
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if($book->delete()){
            return new EbooksResource($book);
        }
    }
}
