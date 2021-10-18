@extends('layouts.admin-base')
@section('title','Dashboard')
@section('content')
<section id="profile">
    <div class="container">
        <div class="profile_grid">
            <div class="image_container">
                    @if (Auth::user()->image)
                    <img src="{{asset('assets/img/user')}}/{{Auth::user()->image}}" class="user_pf" alt="Profile">
                    @else
                    <img src="{{asset('assets/img/user/profile.png')}}" alt="Profile">
                    @endif

               <!-- Modal -->
               <div class="modal fade" id="profile_image" tabindex="-1" aria-labelledby="profile" aria-hidden="true">
                   <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                       <h5 class="modal-title">Upload Your Profile</h5>
                       <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                       </div>
                       <div class="modal-body">
                           <div class="profile_upload_error"></div>
                           <form id="profile_upload" enctype="multipart/form-data">
                           @csrf
                               <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                 <div class="box">
                                   <div class="js--image-preview"></div>
                                   <div class="upload-options">
                                     <label>
                                       <input type="file" name="image" class="image-upload" accept="image/*" />
                                     </label>
                                   </div>
                                 </div>
                               <br>
                               <button type="submit" class="btn btn-primary">Upload</button>
                           </form>
                       </div>
                   </div>
                   </div>
               </div>
            </div>
            <div class="profile_detail">
               <h4>{{Auth::user()->name}}</h4>
               <p>{{Auth::user()->email}}</p>
            </div>
            <div class="profile_btn">
               <!-- Button trigger modal -->
               <a href="javascript:void(0)" type="button" data-toggle="modal" data-target="#profile_image">
                   Change Profile
               </a>

                <a href="javascript:void(0)" type="button" data-toggle="modal" data-target="#edit_user_detail">Edit Details</a>

                 <!-- Modal -->
               <div class="modal fade" id="edit_user_detail" tabindex="-1" aria-labelledby="profile" aria-hidden="true">
                   <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                       <h5 class="modal-title">Change Your Details</h5>
                       <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                       </div>
                       <div class="modal-body">
                           <div class="profile_detail_error"></div>
                           <form id="change_profile_detail">
                           @csrf
                               <input type="hidden" name="id" value="{{Auth::user()->id}}">
                               <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1">@</span>
                                   <input type="text" class="form-control" name="name" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                 </div>

                                 <div class="input-group mb-3">
                                   <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                   <span class="input-group-text" id="basic-addon2">@example.com</span>
                                 </div>
                               <br>
                               <button type="submit" class="btn btn-primary">Upload</button>
                           </form>
                       </div>
                   </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</section>
@endsection
