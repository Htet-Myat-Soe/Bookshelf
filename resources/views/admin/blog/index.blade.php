@extends('layouts.admin-base')
@section('title','Blog')
@section('content')
    <div class="container my-5 py-5">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between">
                <h4 class="card-title"> Blog Table</h4>
                <div>
                    <a href="{{route('admin_blogs.create')}}" class="btn btn-dark">Add New</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card  card-plain">
                  <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                {{$blogs->links()}}
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <form action="{{route('admin_blogs.search')}}" method="POST" class="search_form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" name="search" placeholder="Search By Title Or Author">
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
                    <div class="table-responsive my-3">
                      <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                          <tr>
                            <th>ID</th>
                            <th>IMAGE</th>
                            <th>NAME</th>
                            <th>AUTHOR</th>
                            <th>CREATED AT</th>
                            <th>ACTION</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                            <tr>
                                <td>{{$blog->id}}</td>
                                <td>
                                    <img src="{{asset('assets/img/blog_images')}}/{{$blog->image}}" alt="blogs Cover Image" width="90px" height="70px">
                                </td>
                                <td>{{$blog->title}}</td>
                                <td>{{$blog->user->name}}</td>
                                <td>{{$blog->created_at->format('d/m/Y')}}</td>
                                <td>
                                    <div class="d-flex justify-content-between py-auto">
                                        <a href="{{route('admin_blogs.edit',['id' => $blog->id])}}" class="text-success"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('admin_blogs.show',['id' => $blog->id])}}" class="text-info"><i class="fa fa-info"></i></a>
                                        <a href="{{route('admin_blogs.delete',['id' => $blog->id])}}" class="text-danger"><i class="fa fa-trash-alt"></i></a>
                                    </div>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    {{$blogs->links()}}
                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection


