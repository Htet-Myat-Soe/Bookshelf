@extends('layouts.admin-base')
@section('title','Dashboard')
@section('content')
    <div class="container my-5 py-5">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between">
                <h4 class="card-title"> Books Table</h4>
                <div>
                    {{-- <a href="{{route('admin_books.excel')}}" class="btn btn-dark">Import Excel</a> --}}
                    <a href="{{route('admin_books.create')}}" class="btn btn-dark">Add New</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card  card-plain">
                  <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                {{$books->links()}}
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <form action="{{route('admin_books.search')}}" method="POST" class="search_form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" name="search" placeholder="Search By Name Or Author">
                                        </div>
                                        <div class="col-6">
                                            <select name="category_id" class="search_form">
                                                <option value="0" selected>All</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                  </div>
                  <div class="card-body">
                    @if (Session::has('update_success'))
                    <div class="alert-success">
                        <p class="text-dark px-5 py-2">{{Session::get('update_success')}}</p>
                    </div>
                    @endif
                    @if (Session::has('delete_success'))
                    <div class="alert-success">
                        <p class="text-dark px-5 py-2">{{Session::get('delete_success')}}</p>
                    </div>
                    @endif
                    @if (Session::has('import'))
                    <div class="alert-success">
                        <p class="text-dark px-5 py-2">{{Session::get('import')}}</p>
                    </div>
                    @endif
                    <div class="table-responsive my-3">
                      <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                          <tr>
                            <th>ID</th>
                            <th>IMAGE</th>
                            <th>NAME</th>
                            <th>AUTHOR</th>
                            <th>CATEGORY</th>
                            <th>ACTION</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td>{{$book->id}}</td>
                                <td>
                                    <img src="{{asset('assets/img/book_images')}}/{{$book->image}}" alt="Books Cover Image" width="70px" height="90px">
                                </td>
                                <td>{{$book->name}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->category->name}}</td>
                                <td>
                                    <div class="d-flex justify-content-between py-auto">
                                        <a href="{{route('admin_books.edit',['slug' => $book->slug])}}" class="text-success"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('admin_books.show',['slug' => $book->slug])}}" class="text-info"><i class="fa fa-info"></i></a>
                                        <a href="{{route('admin_books.delete',['slug' => $book->slug])}}" class="text-danger"><i class="fa fa-trash-alt"></i></a>
                                    </div>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    {{$books->links()}}
                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection


