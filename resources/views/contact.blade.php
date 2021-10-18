@extends('layouts.base')
@section('title','Contact')
@section('content')
<section id="search_header" class="mt-5">
    <img src="{{asset('assets/img/bg-contact.jpg')}}" alt="">
</section>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h2 class="heading text-primary text-uppercase text-center my-3">Contact Me</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <img src="{{asset('assets/img/contact.svg')}}" class="about_img" alt="" width="100%" height="100%">
        </div>
        <div class="col-md-6 col-sm-12">
            <p class="text-justify p-3 about_text">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque officia expedita architecto dolorum consectetur, rerum nesciunt, iure pariatur, modi voluptate doloribus in quo aliquam maiores nam atque corrupti? Dicta alias illum modi, repellendus distinctio repudiandae quibusdam nulla impedit rerum perferendis molestiae pariatur, sequi dolores ipsam cumque eos tempora? Natus nemo nisi possimus. Soluta, est amet quod enim excepturi odio ipsam aperiam temporibus deleniti quo cupiditate veniam dicta similique doloribus perferendis earum animi eum. Corporis ipsam odit tenetur optio dicta quia quod nostrum illo labore magnam, obcaecati, repudiandae porro a quas perspiciatis, temporibus qui incidunt soluta cupiditate voluptate ipsum quae aut?
            </p>

        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <h4 class="heading text-primary text-center my-3">Contact Form</h4>
            @if (Session::has('message_sent'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('message_sent')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="{{route('contact.mail')}}" method="POST" class="contact_form">
                @csrf
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="message" placeholder="Message...." rows="5" required></textarea>
                <input type="submit" value="Send">
            </form>

        </div>
        <div class="col-md-6 col-sm-12">
            <h4 class="heading text-primary text-center my-3">Address</h4>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1886.8317904269072!2d96.45262180389516!3d18.94627942284019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c5d91d49a4b10f%3A0x4bec2f1d20fb63b7!2zU3QuIFBhdWwgQ2F0aGVkcmFsICjhgJvhgL7hgIThgLrhgJXhgLHhgKvhgJzhgK_hgIDhgJ7hgK7hgJLhgLzhgJrhgLog4YCY4YCv4YCb4YCs4YC44YCb4YC-4YCt4YCB4YCt4YCv4YC44YCA4YC74YCx4YCs4YCE4YC64YC4KQ!5e0!3m2!1sen!2sid!4v1631885073725!5m2!1sen!2sid" width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <ul class="list-unstyled input_animate">
                <li class="py-2"><i class="bx bx-mobile-alt"></i>&nbsp;&nbsp;&nbsp; <a href="tel:+959793148428"> +959  793 148 428</a></li>
                <li class="py-2"><i class="bx bx-mail-send"></i>&nbsp;&nbsp;&nbsp; <a href="mailto:htetmyatsoe492@gmail.com">htetmyatsoe492@gmail.com</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
