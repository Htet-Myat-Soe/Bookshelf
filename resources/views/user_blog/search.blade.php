@extends('layouts.base')
@section('title','Blog')

@section('content')
<section id="search_header">
    <img src="{{asset('assets/img/search_bg.webp')}}" alt="">
    <h2>Our Blog</h2>
    <p>Here you can find and read many blog post.</p>
    <form action="{{route('blog.search')}}" method="POST" class="search_form">
        @csrf
        <input type="text" name="search" placeholder="Search By Title ">
        <input type="submit" value="Search">
    </form>
</section>
<div class="container-fluid">
    <div class="row ">
        <div class="col-auto col-md-10 ">
            <div class="bc-icons-2 ">
                <nav aria-label="breadcrumb " class="first">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="black-text  " href="/"><span class="mr-md-3 mr-2">HOME</span></a><i class="fa fa-caret-right " aria-hidden="true"></i></li>
                        <li class="breadcrumb-item "><a class="black-text active-1" href="#"><span class="text-primary">ALL OF BLOG POSTS</span></a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        @foreach ($blogs as $blog)
        <div class="col-md-8 col-sm-12 mx-auto my-2">
            <div class="blog card">
                <div class="card-body">
                    <div class="col-12 d-flex px-2 my-2">
                        <img src="{{asset('assets/img/user')}}/{{$blog->user->image}}" alt="" class="mx-2" width="40px" height="40px" style="border-radius:50%;">
                        <h6 class="mt-2 flex-shrink-1">{{$blog->user->name}}</h6>
                        <p class="text-muted ms-auto mt-2">{{$blog->created_at->format('d/m/Y')}}</p>
                    </div>
                    <a href="{{route('blog.show',['id' => $blog->id ])}}" class="my-2"><img src="{{asset('assets/img/blog_images')}}/{{$blog->image}}" alt="" width="100%" style="max-height: 400px" class="card-img-top"></a>
                    <a href="{{route('blog.show',['id' => $blog->id ])}}" class="my-2"><h4 class="my-2 text-primary">{{$blog->title}}</h4></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
