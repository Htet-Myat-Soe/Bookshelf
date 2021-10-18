@extends('layouts.admin-base')
@section('title','Categories')
@section('content')
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Update {{$category->name}} Details</h3>
            <p>Please, If you'll upload a book, check it present or not in our bookshelf.</p>
            @if (Session::has('success'))
            <div class="alert-success">
                <p class="text-dark px-5 py-2">{{Session::get('success')}}</p>
            </div>
            @endif
            <div class="form_card">
                <form class="form-card" action="{{route('admin_categories.update',['slug' => $category->slug])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-between text-left my-3">
                        <div class="form-group col-sm-6 flex-column d-flex my-3">
                            <label class="form-control-label px-3">Category name<span class="text-danger"> *</span></label>
                            <input type="text" id="name" name="name" placeholder="Enter Book Name" value="{{$category->name}}">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex my-3">
                            <label class="form-control-label px-3">Cover Image<span class="text-danger"> *</span>
                                <input type="file" id="name" name="image" placeholder="Choose Cover Image">
                                <br><br>
                                    <img src="{{asset('assets/admin/img/img_upload.png')}}" width="50px" height="50px" alt="">
                            </label>
                            @error('image')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-end my-3">
                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-info">Update</button> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
