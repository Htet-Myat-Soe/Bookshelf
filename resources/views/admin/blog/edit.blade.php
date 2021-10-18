@extends('layouts.admin-base')
@section('title','Edit')
@section('content')

<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Update Blog Details</h3>
            <h5>Edit <span>{{$blog->title}}</span></h5>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus quasi, minima, doloremque quos hic sequi nisi voluptatem possimus harum a debitis nostrum nihil sint assumenda iure magnam deleniti! Quae ab fugit facilis laboriosam iusto corporis, labore unde modi natus, repudiandae molestiae? Ipsam totam deleniti vero dignissimos repellendus blanditiis fugiat cumque?</p>
            <div class="form_card">
                <form class="form-card" action="{{route('admin_blogs.update',['id' => $blog->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$blog->id}}">
                    <div class="row justify-content-between text-left my-3">
                        <div class="form-group col-sm-6 flex-column d-flex my-3">
                            <label class="form-control-label px-3">Title<span class="text-danger"> *</span></label>
                            <input type="text" id="title" name="title" placeholder="Enter Blog Title" value="{{$blog->title}}">
                            @error('title')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex my-3">
                            <label class="form-control-label px-3">Cover Image<span class="text-danger"> *</span>
                                <input type="file" id="name" name="image" placeholder="Choose Cover Image" value="{{$blog->image}}">
                                <br><br>
                                    <img src="{{asset('assets/admin/img/img_upload.png')}}" width="50px" height="50px" alt="">
                            </label>
                            @error('image')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 flex-column d-flex">
                            <label class="form-control-label px-3">Blog Description</label>
                            <textarea name="description" placeholder="Write Here Blog Descrition">{{$blog->description}}</textarea>
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
