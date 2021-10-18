@extends('layouts.admin-base')
@section('title','Create')
@section('content')
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Upload Blog Details</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum quisquam nemo perferendis placeat ut, atque corporis delectus aut sequi, sunt beatae sed explicabo rem soluta. Qui veritatis a nemo deserunt nulla pariatur repudiandae maxime deleniti iure veniam unde ratione, quis culpa totam dolor blanditiis ipsum soluta quidem tenetur aliquid? Rerum.</p>
            @if (Session::has('success'))
            <div class="alert-success">
                <p class="text-dark px-5 py-2">{{Session::get('success')}}</p>
            </div>
            @endif
            <div class="form_card">
                <form class="form-card" action="{{route('admin_books.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-between text-left my-3">
                        <div class="form-group col-sm-6 flex-column d-flex my-3">
                            <label class="form-control-label px-3">Book name<span class="text-danger"> *</span></label>
                            <input type="text" id="name" name="name" placeholder="Enter Book Name">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex my-3">
                            <label class="form-control-label px-3">Author name<span class="text-danger"> *</span></label>
                            <input type="text" id="name" name="author" placeholder="Enter Author Name">
                            @error('author')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-between text-left my-3">
                        <div class="form-group col-sm-6 flex-column d-flex my-3">
                            <label class="form-control-label px-3">Choose Category<span class="text-danger"> *</span></label>
                            <select name="category_id" id="">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex my-3">
                            <label class="form-control-label px-3">Page Amount</label>
                            <input type="text" id="page" name="page" placeholder="Page Amount">
                        </div>
                    </div>
                    <div class="row justify-content-between text-left my-3">
                        <div class="form-group col-sm-6 flex-column d-flex my-3">
                            <label class="form-control-label px-3">PDF file<span class="text-danger"> *</span>
                                <input type="file" id="name" name="pdf" class="form-control" placeholder="Choose Pdf File">
                                <br><br>
                                <img src="{{asset('assets/admin/img/file_upload.png')}}" width="50px" height="50px" alt="">
                            </label>
                            @error('pdf')
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
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 flex-column d-flex">
                            <label class="form-control-label px-3">Book Reviews or Description</label>
                            <textarea name="description" placeholder="Write Here Book Descrition" name="description"></textarea>
                         </div>
                    </div>
                    <div class="row justify-content-end my-3">
                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-info">Upload</button> </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

