@extends('layouts.admin-base')
@section('title','Details')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between px-2">
                <img src="{{asset('assets/img/user')}}/{{$blog->user->image}}" alt="" width="40px" height="40px" style="border-radius:50%;">
                <h5 class="mt-2 ml-3">{{$blog->user->name}}</h5>
                <p class="text-muted ms-auto mt-2">{{$blog->created_at->format('d/m/Y')}}</p>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12">
                <img src="{{asset('assets/img/blog_images')}}/{{$blog->image}}" alt="" width="100%" height="400px">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>
                    <h2 class="my-2 text-bold">{{$blog->title}}</h2>
                    {!! $blog->description !!}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <a href="{{route('admin_blogs.edit',['id' => $blog->id])}}" class="btn btn-success">Edit</a>
                <a href="{{route('admin_blogs.delete',['id' => $blog->id])}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
@endsection
