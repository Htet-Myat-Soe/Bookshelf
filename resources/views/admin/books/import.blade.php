@extends('layouts.admin-base')
@section('title','Import')
@section('content')
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Upload Book Excel File</h3>
            <div class="form_card">
                <form class="form-card" action="{{route('admin_books.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 mx-auto">
                            <label class="form-control-label px-3">Import Excel File<span class="text-danger"> *</span>
                                <input type="file" id="name" name="excel" placeholder="Choose Cover Image">
                                <br><br>
                                    <img src="{{asset('assets/admin/img/excel.png')}}" width="50px" height="50px" alt="">
                            </label>
                            @error('excel')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
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

