@extends('layouts.admin-base')
@section('title','Categories')
@section('content')
<div class="container my-5 py-5">
    <div class="row">
        <div class="col-12">
            <h4 class="card-title"> Category Table</h4>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab tenetur praesentium corrupti unde. Sapiente, natus veniam nulla fugit excepturi consectetur error officia earum esse nisi repudiandae quaerat atque consequuntur nostrum, omnis architecto consequatur vel quasi? Dolorem eaque earum eos aut laboriosam. Aliquam iusto dicta possimus odio corporis ipsa nulla cum!
            </p>
        </div>
        <div class="col-md-12">
            <div class="card  card-plain">
              <div class="card-header">
                   <div class="row">
                    <div class="col-md-9 col-sm-12">
                        {{$categories->links()}}
                       </div>
                       <div class="col-md-3 col-sm-12">
                        <a href="{{route('admin_categories.create')}}" class="btn btn-dark">Add New</a>
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
                        <th>Slug</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>
                                <img src="{{asset('assets/img/categories_images')}}/{{$category->image}}" alt="categories Cover Image" width="90px" height="60px">
                            </td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>
                                <div class="d-flex justify-content-between py-auto">
                                    <a href="{{route('admin_categories.edit',['slug' => $category->slug])}}" class="text-success"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('admin_categories.delete',['slug' => $category->slug])}}" class="text-danger"><i class="fa fa-trash-alt"></i></a>
                                </div>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                {{$categories->links()}}
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
