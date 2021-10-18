@extends('layouts.admin-base')
@section('title','Details')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <h2>{{$book->name}}</h2>
                <img src="{{asset('assets/img/book_images')}}/{{$book->image}}" alt="" width="70px" height="90px">
            </div>
            <div class="col-md-7 col-sm-12 pt-5">
                <ul class="list-unstyled">
                    <li><strong>Author</strong>   - <span class="text-primary">{{$book->author}}</span></li><br><br>
                    <li><strong>Page Amount</strong>   - <span class="text-primary">{{$book->page}}</span></li><br><br>
                    <li><strong>Category</strong>  - <span class="text-primary">{{$book->category->name}}</span></li>

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>
                    {{$book->description}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <a href="{{route('admin_books.edit',['slug' => $book->slug])}}" class="btn btn-success">Edit</a>
                <a href="{{route('admin_books.delete',['slug' => $book->slug])}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
@endsection
