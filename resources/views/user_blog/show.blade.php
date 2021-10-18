@extends('layouts.base')
@section('title','Details')
@section('content')

    <div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <img src="{{asset('assets/img/blog_images')}}/{{$blog->image}}" alt="">
                <div class="col-12 d-flex px-2 my-2">
                    <img src="{{asset('assets/img/user')}}/{{$blog->user->image}}" alt="" class="mx-2" width="40px" height="40px" style="border-radius:50%;">
                    <h6 class="mt-2 flex-shrink-1">{{$blog->user->name}}</h6>
                    <p class="text-muted ms-auto mt-2">{{$blog->created_at->format('d/m/Y')}}</p>
                </div>
            <h4 class="text-primary my-4">{{$blog->title}}</h4>
                <p class="p-3 mt-3">
                    {!! $blog->description !!}
                </p>
            </div>
        </div>
    </div>


@endsection
