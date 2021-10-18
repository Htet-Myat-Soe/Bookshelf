@extends('layouts.base')
@section('title','Details')
@section('content')
<section id="search_header">
    <img src="{{asset('assets/img/book_detail_bg.jpg')}}" alt="">
    <h2>{{$book->name}}</h2>
    <p>Following are the details of this book.</p>
</section>
<section id="book_detail">
<div class="container-fluid">
            <div class="row ">
                <div class="col-auto col-md-10 ">
                    <div class="bc-icons-2 ">
                        <nav aria-label="breadcrumb " class="first">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="black-text  " href="/"><span class="mr-md-3 mr-2">HOME</span></a><i class="fa fa-caret-right " aria-hidden="true"></i></li>
                                <li class="breadcrumb-item"><a class="black-text  " href="{{route('ebooks')}}"><span class="mr-md-3 mr-2">ALL OF BOOKS</span></a><i class="fa fa-caret-right " aria-hidden="true"></i></li>
                                <li class="breadcrumb-item "><a class="black-text text-uppercase active-1" href="#"><span class="text-primary">{{$book->name}}</span></a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    @auth

    @else
    <div class="container">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            You need an account to download books. Please <a href="{{route('login')}}">Login Here</a> !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endauth
    <div class="container">
        <div class="row" class="my-5">
            <div class="col-md-3 col-sm-12 text-center my-4">
                <img src="{{asset('assets/img/book_images')}}/{{$book->image}}" alt="{{$book->name}}" width="200px" height="350px">
            </div>
            <div class="col-md-9 col-sm-12 mt-4">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Book Name : </strong>{{$book->name}}</li>
                    <li class="list-group-item"><strong>Author Name : </strong><a href="{{route('author',['name' => $book->author])}}">{{$book->author}}</a></li>
                    <li class="list-group-item"><strong>Page Amount : </strong>{{$book->page}}</li>
                    <li class="list-group-item"><strong>Downloaded : </strong> {{count($book->user)}}</li>
                    <li class="list-group-item"><strong>Category : </strong> {{$book->category->name}}</li>
                    <li class="list-group-item"><strong>Description : </strong>  <p>{{$book->description}}</p></li>
                </ul>
                <div class="my-3">
                    @auth
                    <a href="{{route('user.download',['id' => $book->id])}}" title="download" class="btn btn-primary">Download</a>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#add_comment" role="button" aria-expanded="false" aria-controls="add_comment">Add Comment</a>
                    @else
                    <a href="{{route('login')}}" class="btn btn-primary">Download</a>
                    <a href="{{route('login')}}" class="btn btn-primary">Add Comment</a>
                    @endauth
                </div>
            </div>
            <hr>
        </div>
        <div class="comment_section">
            <div class="collapse my-4" id="add_comment">
                <div class="card card-body">
                    <form id="comment">
                        @csrf
                        <input type="hidden" name="id" value="{{$book->id}}">
                        <div class="mb-3">
                            <label for="cmt" class="form-label">Comment About This Book</label>
                            <textarea class="form-control" id="cmt" name="cmt" rows="5"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Upload">
                    </form>
              </div>
            </div>
            <div class="collapse my-4" id="edit_comment">
                <div class="card card-body">
                    <form id="update_comment">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <div class="mb-3">
                            <label for="edit_cmt" class="form-label">Edit Comment</label>
                            <textarea class="form-control" id="edit_cmt" name="edit_cmt" rows="5"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Upload">
                    </form>
              </div>
            </div>
            <div class="container" id="cmt_container">
                @if (count($book->comments) > 0)
                <h4 class="text-center book_cmt_count">This book have {{count($book->comments)}} comments.</h4>
                @else
                <h5 class="text-center book_cmt_count">There is no comment yet.</h5>
                @endif
                <div class="row">
                    <div class="col-12 cmt_list">
                        @foreach ($book->comments as $comment)
                        <div class="card my-3" id="cmt_card_{{$comment->id}}">
                            <div class="card-body">
                                <div class="card-title d-flex">
                                    @if ($comment->user->image)
                                    <img src="{{asset('assets/img/user')}}/{{$comment->user->image}}" width="30px" height="30px" style="border-radius: 50%;" alt="Image">
                                    @else
                                    <img src="{{asset('assets/img/user/profile.png')}}" width="30px" height="30px" style="border-radius: 50%;" alt="Image">
                                    @endif
                                    <h6 class="px-3 mt-2">{{$comment->user->name}}</h6>
                                    <small class="ms-auto">{{$comment->created_at->format('d/m/Y')}}</small>
                                </div>
                                <div class="card-content">
                                    <p class="text-justify"  id="comment_card_{{$comment->id}}">
                                        {{$comment->comment}}
                                    </p>
                                </div>
                                @auth
                                @if (Auth::user()->id === $comment->user->id)
                                    <div class="d-flex my-3 justify-content-end">
                                        <a href="javascript:void(0)" class="mx-3" onclick="commentEdit({{$comment->id}})">Edit</a>
                                        <a href="javascript:void(0)" class="text-danger" onclick="commentDelete({{$comment->id}})">Delete</a>
                                    </div>
                                @endif
                                @endauth
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="container">
</section>

<section id="ebook">
    <h2 class="text-center">Related Books</h2>
    <div class="ebook_container">
        @foreach ($rbooks as $book)
            <div class="ebook">
                <a href="{{route('details',['slug' => $book->slug])}}">
                    <img src="{{asset('assets/img/book_images')}}/{{$book->image}}" alt="{{$book->name}}" class="ebook_img">
                </a>
                <div class="card-block">
                    <h5>{{$book->name}}</h5>
                    <a href="{{route('author',['name' => $book->author])}}">{{$book->author}}</a>
                    <br>
                    <div class="d-flex justify-content-around mt-3">
                      <a href="{{route('details',['slug' => $book->slug])}}#cmt_container" title="comment" class="btn-sm float-right"><img width="20px" height="20px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDUxMiA1MTIuMDAwMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgY2xhc3M9IiI+PGc+PHBhdGggeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBkPSJtMjU2IDBjLTE0MS40ODQzNzUgMC0yNTYgMTE0LjQ5NjA5NC0yNTYgMjU2IDAgNDQuOTAyMzQ0IDExLjcxMDkzOCA4OC43NTc4MTIgMzMuOTQ5MjE5IDEyNy40Mzc1bC0zMi45ODQzNzUgMTAyLjQyOTY4OGMtMi4zMDA3ODIgNy4xNDA2MjQtLjQxMDE1NiAxNC45Njg3NSA0Ljg5NDUzMSAyMC4yNzM0MzcgNS4yNTM5MDYgNS4yNTM5MDYgMTMuMDYyNSA3LjIxNDg0NCAyMC4yNzM0MzcgNC44OTQ1MzFsMTAyLjQyOTY4OC0zMi45ODQzNzVjMzguNjc5Njg4IDIyLjIzODI4MSA4Mi41MzUxNTYgMzMuOTQ5MjE5IDEyNy40Mzc1IDMzLjk0OTIxOSAxNDEuNDg0Mzc1IDAgMjU2LTExNC40OTYwOTQgMjU2LTI1NiAwLTE0MS40ODQzNzUtMTE0LjQ5NjA5NC0yNTYtMjU2LTI1NnptMCA0NzJjLTQwLjU1ODU5NCAwLTgwLjA5Mzc1LTExLjMxNjQwNi0xMTQuMzMyMDMxLTMyLjcyNjU2Mi00LjkyNTc4MS0zLjA3ODEyNi0xMS4wNDI5NjktMy45MTAxNTctMTYuNzM0Mzc1LTIuMDc4MTI2bC03My45NDE0MDYgMjMuODEyNSAyMy44MTI1LTczLjk0MTQwNmMxLjgwNDY4Ny01LjYwOTM3NSAxLjA0Mjk2OC0xMS43MzQzNzUtMi4wODIwMzItMTYuNzM0Mzc1LTIxLjQwNjI1LTM0LjIzODI4MS0zMi43MjI2NTYtNzMuNzczNDM3LTMyLjcyMjY1Ni0xMTQuMzMyMDMxIDAtMTE5LjEwMTU2MiA5Ni44OTg0MzgtMjE2IDIxNi0yMTZzMjE2IDk2Ljg5ODQzOCAyMTYgMjE2LTk2Ljg5ODQzOCAyMTYtMjE2IDIxNnptMjUtMjE2YzAgMTMuODA0Njg4LTExLjE5MTQwNiAyNS0yNSAyNXMtMjUtMTEuMTk1MzEyLTI1LTI1YzAtMTMuODA4NTk0IDExLjE5MTQwNi0yNSAyNS0yNXMyNSAxMS4xOTE0MDYgMjUgMjV6bTEwMCAwYzAgMTMuODA0Njg4LTExLjE5MTQwNiAyNS0yNSAyNXMtMjUtMTEuMTk1MzEyLTI1LTI1YzAtMTMuODA4NTk0IDExLjE5MTQwNi0yNSAyNS0yNXMyNSAxMS4xOTE0MDYgMjUgMjV6bS0yMDAgMGMwIDEzLjgwNDY4OC0xMS4xOTE0MDYgMjUtMjUgMjUtMTMuODA0Njg4IDAtMjUtMTEuMTk1MzEyLTI1LTI1IDAtMTMuODA4NTk0IDExLjE5NTMxMi0yNSAyNS0yNSAxMy44MDg1OTQgMCAyNSAxMS4xOTE0MDYgMjUgMjV6bTAgMCIgZmlsbD0iIzEyNTBkNCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgc3R5bGU9IiIgY2xhc3M9IiI+PC9wYXRoPjwvZz48L3N2Zz4=" /></a>
                      <a href="{{route('details',['slug' => $book->slug])}}" title="details" class="btn-sm float-right"><img width="20px" height="20px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDQyMi42ODYgNDIyLjY4NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgY2xhc3M9IiI+PGc+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgk8Zz4KCQk8cGF0aCBzdHlsZT0iIiBkPSJNMjExLjM0Myw0MjIuNjg2Qzk0LjgwNCw0MjIuNjg2LDAsMzI3Ljg4MiwwLDIxMS4zNDNDMCw5NC44MTIsOTQuODEyLDAsMjExLjM0MywwICAgIHMyMTEuMzQzLDk0LjgxMiwyMTEuMzQzLDIxMS4zNDNDNDIyLjY4NiwzMjcuODgyLDMyNy44ODIsNDIyLjY4NiwyMTEuMzQzLDQyMi42ODZ6IE0yMTEuMzQzLDE2LjI1NyAgICBjLTEwNy41NzQsMC0xOTUuMDg2LDg3LjUyLTE5NS4wODYsMTk1LjA4NnM4Ny41MiwxOTUuMDg2LDE5NS4wODYsMTk1LjA4NnMxOTUuMDg2LTg3LjUyLDE5NS4wODYtMTk1LjA4NiAgICBTMzE4LjkwOCwxNi4yNTcsMjExLjM0MywxNi4yNTd6IiBmaWxsPSIjMTI1MGQ0IiBkYXRhLW9yaWdpbmFsPSIjMDEwMDAyIiBjbGFzcz0iIj48L3BhdGg+Cgk8L2c+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggc3R5bGU9IiIgZD0iTTIzMS45LDEwNC42NDdjMC4zNjYsMTEuMzIzLTcuOTM0LDIwLjM3LTIxLjEzNCwyMC4zN2MtMTEuNjg5LDAtMTkuOTk2LTkuMDU1LTE5Ljk5Ni0yMC4zNyAgICAgYzAtMTEuNjg5LDguNjgxLTIwLjc0NCwyMC43NDQtMjAuNzQ0QzIyMy45NzUsODMuOTAzLDIzMS45LDkyLjk1OCwyMzEuOSwxMDQuNjQ3eiBNMTk0LjkzMSwzMzguNTMxVjE1NS45NTVoMzMuMTg5djE4Mi41NzYgICAgIEMyMjguMTIsMzM4LjUzMSwxOTQuOTMxLDMzOC41MzEsMTk0LjkzMSwzMzguNTMxeiIgZmlsbD0iIzEyNTBkNCIgZGF0YS1vcmlnaW5hbD0iIzAxMDAwMiIgY2xhc3M9IiI+PC9wYXRoPgoJCTwvZz4KCTwvZz4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8L2c+PC9zdmc+" /></a>
                      @auth
                      <a href="{{asset('assets/pdf')}}/{{$book->book}}" title="download" download="download" class="btn-sm float-right"><img width="20px" height="20px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDUxMSA1MTEuOTk5MDYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTIiIHhtbDpzcGFjZT0icHJlc2VydmUiIGNsYXNzPSIiPjxnPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGlkPSJzdXJmYWNlMSI+CjxwYXRoIGQ9Ik0gMjc2LjQxMDE1NiAzLjk1NzAzMSBDIDI3NC4wNjI1IDEuNDg0Mzc1IDI3MC44NDM3NSAwIDI2Ny41MDc4MTIgMCBMIDY3Ljc3NzM0NCAwIEMgMzAuOTIxODc1IDAgMC41IDMwLjMwMDc4MSAwLjUgNjcuMTUyMzQ0IEwgMC41IDQ0NC44NDM3NSBDIDAuNSA0ODEuNjk5MjE5IDMwLjkyMTg3NSA1MTIgNjcuNzc3MzQ0IDUxMiBMIDMzOC44NjMyODEgNTEyIEMgMzc1LjcxODc1IDUxMiA0MDYuMTQwNjI1IDQ4MS42OTkyMTkgNDA2LjE0MDYyNSA0NDQuODQzNzUgTCA0MDYuMTQwNjI1IDE0NC45NDE0MDYgQyA0MDYuMTQwNjI1IDE0MS43MjY1NjIgNDA0LjY1NjI1IDEzOC42MzY3MTkgNDAyLjU1NDY4OCAxMzYuMjg1MTU2IFogTSAyNzkuOTk2MDk0IDQzLjY1NjI1IEwgMzY0LjQ2NDg0NCAxMzIuMzI4MTI1IEwgMzA5LjU1NDY4OCAxMzIuMzI4MTI1IEMgMjkzLjIzMDQ2OSAxMzIuMzI4MTI1IDI3OS45OTYwOTQgMTE5LjIxODc1IDI3OS45OTYwOTQgMTAyLjg5NDUzMSBaIE0gMzM4Ljg2MzI4MSA0ODcuMjY1NjI1IEwgNjcuNzc3MzQ0IDQ4Ny4yNjU2MjUgQyA0NC42NTIzNDQgNDg3LjI2NTYyNSAyNS4yMzQzNzUgNDY4LjA5NzY1NiAyNS4yMzQzNzUgNDQ0Ljg0Mzc1IEwgMjUuMjM0Mzc1IDY3LjE1MjM0NCBDIDI1LjIzNDM3NSA0NC4wMjczNDQgNDQuNTI3MzQ0IDI0LjczNDM3NSA2Ny43NzczNDQgMjQuNzM0Mzc1IEwgMjU1LjI2MTcxOSAyNC43MzQzNzUgTCAyNTUuMjYxNzE5IDEwMi44OTQ1MzEgQyAyNTUuMjYxNzE5IDEzMi45NDUzMTIgMjc5LjUwMzkwNiAxNTcuMDYyNSAzMDkuNTU0Njg4IDE1Ny4wNjI1IEwgMzgxLjQwNjI1IDE1Ny4wNjI1IEwgMzgxLjQwNjI1IDQ0NC44NDM3NSBDIDM4MS40MDYyNSA0NjguMDk3NjU2IDM2Mi4xMTMyODEgNDg3LjI2NTYyNSAzMzguODYzMjgxIDQ4Ny4yNjU2MjUgWiBNIDMzOC44NjMyODEgNDg3LjI2NTYyNSAiIHN0eWxlPSIiIGZpbGw9IiMxMjUwZDQiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSIiPjwvcGF0aD4KPHBhdGggZD0iTSAzMDUuMTAxNTYyIDQwMS45MzM1OTQgTCAxMDEuNTM5MDYyIDQwMS45MzM1OTQgQyA5NC43MzgyODEgNDAxLjkzMzU5NCA4OS4xNzE4NzUgNDA3LjQ5NjA5NCA4OS4xNzE4NzUgNDE0LjMwMDc4MSBDIDg5LjE3MTg3NSA0MjEuMTAxNTYyIDk0LjczODI4MSA0MjYuNjY3OTY5IDEwMS41MzkwNjIgNDI2LjY2Nzk2OSBMIDMwNS4yMjY1NjIgNDI2LjY2Nzk2OSBDIDMxMi4wMjczNDQgNDI2LjY2Nzk2OSAzMTcuNTkzNzUgNDIxLjEwMTU2MiAzMTcuNTkzNzUgNDE0LjMwMDc4MSBDIDMxNy41OTM3NSA0MDcuNDk2MDk0IDMxMi4wMjczNDQgNDAxLjkzMzU5NCAzMDUuMTAxNTYyIDQwMS45MzM1OTQgWiBNIDMwNS4xMDE1NjIgNDAxLjkzMzU5NCAiIHN0eWxlPSIiIGZpbGw9IiMxMjUwZDQiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSIiPjwvcGF0aD4KPHBhdGggZD0iTSAxOTQuMjkyOTY5IDM1Ny41MzUxNTYgQyAxOTYuNjQ0NTMxIDM2MC4wMDc4MTIgMTk5Ljg1OTM3NSAzNjEuNDkyMTg4IDIwMy4zMjAzMTIgMzYxLjQ5MjE4OCBDIDIwNi43ODUxNTYgMzYxLjQ5MjE4OCAyMTAgMzYwLjAwNzgxMiAyMTIuMzQ3NjU2IDM1Ny41MzUxNTYgTCAyODQuODIwMzEyIDI3OS43NDYwOTQgQyAyODkuNTE5NTMxIDI3NC43OTY4NzUgMjg5LjE0ODQzOCAyNjYuODgyODEyIDI4NC4yMDMxMjUgMjYyLjMwODU5NCBDIDI3OS4yNTM5MDYgMjU3LjYwOTM3NSAyNzEuMzM5ODQ0IDI1Ny45NzY1NjIgMjY2Ljc2NTYyNSAyNjIuOTI1NzgxIEwgMjE1LjY4NzUgMzE3LjcxMDkzOCBMIDIxNS42ODc1IDE4Mi42NjQwNjIgQyAyMTUuNjg3NSAxNzUuODU5Mzc1IDIxMC4xMjEwOTQgMTcwLjI5Njg3NSAyMDMuMzIwMzEyIDE3MC4yOTY4NzUgQyAxOTYuNTE5NTMxIDE3MC4yOTY4NzUgMTkwLjk1MzEyNSAxNzUuODU5Mzc1IDE5MC45NTMxMjUgMTgyLjY2NDA2MiBMIDE5MC45NTMxMjUgMzE3LjcxMDkzOCBMIDE0MCAyNjIuOTI1NzgxIEMgMTM1LjMwMDc4MSAyNTcuOTgwNDY5IDEyNy41MDc4MTIgMjU3LjYwOTM3NSAxMjIuNTYyNSAyNjIuMzA4NTk0IEMgMTE3LjYxNzE4OCAyNjcuMDA3ODEyIDExNy4yNDYwOTQgMjc0LjgwMDc4MSAxMjEuOTQ1MzEyIDI3OS43NDYwOTQgWiBNIDE5NC4yOTI5NjkgMzU3LjUzNTE1NiAiIHN0eWxlPSIiIGZpbGw9IiMxMjUwZDQiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSIiPjwvcGF0aD4KPC9nPgo8L2c+PC9zdmc+" /></a>
                      @else
                      <a href="{{route('login')}}" title="download" class="btn-sm float-right"><img width="20px" height="20px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDUxMSA1MTEuOTk5MDYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTIiIHhtbDpzcGFjZT0icHJlc2VydmUiIGNsYXNzPSIiPjxnPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGlkPSJzdXJmYWNlMSI+CjxwYXRoIGQ9Ik0gMjc2LjQxMDE1NiAzLjk1NzAzMSBDIDI3NC4wNjI1IDEuNDg0Mzc1IDI3MC44NDM3NSAwIDI2Ny41MDc4MTIgMCBMIDY3Ljc3NzM0NCAwIEMgMzAuOTIxODc1IDAgMC41IDMwLjMwMDc4MSAwLjUgNjcuMTUyMzQ0IEwgMC41IDQ0NC44NDM3NSBDIDAuNSA0ODEuNjk5MjE5IDMwLjkyMTg3NSA1MTIgNjcuNzc3MzQ0IDUxMiBMIDMzOC44NjMyODEgNTEyIEMgMzc1LjcxODc1IDUxMiA0MDYuMTQwNjI1IDQ4MS42OTkyMTkgNDA2LjE0MDYyNSA0NDQuODQzNzUgTCA0MDYuMTQwNjI1IDE0NC45NDE0MDYgQyA0MDYuMTQwNjI1IDE0MS43MjY1NjIgNDA0LjY1NjI1IDEzOC42MzY3MTkgNDAyLjU1NDY4OCAxMzYuMjg1MTU2IFogTSAyNzkuOTk2MDk0IDQzLjY1NjI1IEwgMzY0LjQ2NDg0NCAxMzIuMzI4MTI1IEwgMzA5LjU1NDY4OCAxMzIuMzI4MTI1IEMgMjkzLjIzMDQ2OSAxMzIuMzI4MTI1IDI3OS45OTYwOTQgMTE5LjIxODc1IDI3OS45OTYwOTQgMTAyLjg5NDUzMSBaIE0gMzM4Ljg2MzI4MSA0ODcuMjY1NjI1IEwgNjcuNzc3MzQ0IDQ4Ny4yNjU2MjUgQyA0NC42NTIzNDQgNDg3LjI2NTYyNSAyNS4yMzQzNzUgNDY4LjA5NzY1NiAyNS4yMzQzNzUgNDQ0Ljg0Mzc1IEwgMjUuMjM0Mzc1IDY3LjE1MjM0NCBDIDI1LjIzNDM3NSA0NC4wMjczNDQgNDQuNTI3MzQ0IDI0LjczNDM3NSA2Ny43NzczNDQgMjQuNzM0Mzc1IEwgMjU1LjI2MTcxOSAyNC43MzQzNzUgTCAyNTUuMjYxNzE5IDEwMi44OTQ1MzEgQyAyNTUuMjYxNzE5IDEzMi45NDUzMTIgMjc5LjUwMzkwNiAxNTcuMDYyNSAzMDkuNTU0Njg4IDE1Ny4wNjI1IEwgMzgxLjQwNjI1IDE1Ny4wNjI1IEwgMzgxLjQwNjI1IDQ0NC44NDM3NSBDIDM4MS40MDYyNSA0NjguMDk3NjU2IDM2Mi4xMTMyODEgNDg3LjI2NTYyNSAzMzguODYzMjgxIDQ4Ny4yNjU2MjUgWiBNIDMzOC44NjMyODEgNDg3LjI2NTYyNSAiIHN0eWxlPSIiIGZpbGw9IiMxMjUwZDQiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSIiPjwvcGF0aD4KPHBhdGggZD0iTSAzMDUuMTAxNTYyIDQwMS45MzM1OTQgTCAxMDEuNTM5MDYyIDQwMS45MzM1OTQgQyA5NC43MzgyODEgNDAxLjkzMzU5NCA4OS4xNzE4NzUgNDA3LjQ5NjA5NCA4OS4xNzE4NzUgNDE0LjMwMDc4MSBDIDg5LjE3MTg3NSA0MjEuMTAxNTYyIDk0LjczODI4MSA0MjYuNjY3OTY5IDEwMS41MzkwNjIgNDI2LjY2Nzk2OSBMIDMwNS4yMjY1NjIgNDI2LjY2Nzk2OSBDIDMxMi4wMjczNDQgNDI2LjY2Nzk2OSAzMTcuNTkzNzUgNDIxLjEwMTU2MiAzMTcuNTkzNzUgNDE0LjMwMDc4MSBDIDMxNy41OTM3NSA0MDcuNDk2MDk0IDMxMi4wMjczNDQgNDAxLjkzMzU5NCAzMDUuMTAxNTYyIDQwMS45MzM1OTQgWiBNIDMwNS4xMDE1NjIgNDAxLjkzMzU5NCAiIHN0eWxlPSIiIGZpbGw9IiMxMjUwZDQiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSIiPjwvcGF0aD4KPHBhdGggZD0iTSAxOTQuMjkyOTY5IDM1Ny41MzUxNTYgQyAxOTYuNjQ0NTMxIDM2MC4wMDc4MTIgMTk5Ljg1OTM3NSAzNjEuNDkyMTg4IDIwMy4zMjAzMTIgMzYxLjQ5MjE4OCBDIDIwNi43ODUxNTYgMzYxLjQ5MjE4OCAyMTAgMzYwLjAwNzgxMiAyMTIuMzQ3NjU2IDM1Ny41MzUxNTYgTCAyODQuODIwMzEyIDI3OS43NDYwOTQgQyAyODkuNTE5NTMxIDI3NC43OTY4NzUgMjg5LjE0ODQzOCAyNjYuODgyODEyIDI4NC4yMDMxMjUgMjYyLjMwODU5NCBDIDI3OS4yNTM5MDYgMjU3LjYwOTM3NSAyNzEuMzM5ODQ0IDI1Ny45NzY1NjIgMjY2Ljc2NTYyNSAyNjIuOTI1NzgxIEwgMjE1LjY4NzUgMzE3LjcxMDkzOCBMIDIxNS42ODc1IDE4Mi42NjQwNjIgQyAyMTUuNjg3NSAxNzUuODU5Mzc1IDIxMC4xMjEwOTQgMTcwLjI5Njg3NSAyMDMuMzIwMzEyIDE3MC4yOTY4NzUgQyAxOTYuNTE5NTMxIDE3MC4yOTY4NzUgMTkwLjk1MzEyNSAxNzUuODU5Mzc1IDE5MC45NTMxMjUgMTgyLjY2NDA2MiBMIDE5MC45NTMxMjUgMzE3LjcxMDkzOCBMIDE0MCAyNjIuOTI1NzgxIEMgMTM1LjMwMDc4MSAyNTcuOTgwNDY5IDEyNy41MDc4MTIgMjU3LjYwOTM3NSAxMjIuNTYyNSAyNjIuMzA4NTk0IEMgMTE3LjYxNzE4OCAyNjcuMDA3ODEyIDExNy4yNDYwOTQgMjc0LjgwMDc4MSAxMjEuOTQ1MzEyIDI3OS43NDYwOTQgWiBNIDE5NC4yOTI5NjkgMzU3LjUzNTE1NiAiIHN0eWxlPSIiIGZpbGw9IiMxMjUwZDQiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSIiPjwvcGF0aD4KPC9nPgo8L2c+PC9zdmc+" /></a>
                      @endauth
                    </div>
                  </div>
            </div>
        @endforeach
    </div>
</section>
@endsection

