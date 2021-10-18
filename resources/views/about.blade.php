@extends('layouts.base')
@section('title','About')
@section('content')
<section id="search_header" class="mt-5">
    <img src="{{asset('assets/img/about_bg.jpg')}}" alt="">
</section>
<div class="container my-5">
    <div class="row">
        <h2 class="heading text-uppercase text-primary text-center my-3">About Us</h2>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <img src="{{asset('assets/img/aboutus.svg')}}" width="100%" height="100%" alt="" class="about_img">
        </div>
        <div class="col-md-6 col-sm-12">
            <p class="text-justify p-3 about_text">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque officia expedita architecto dolorum consectetur, rerum nesciunt, iure pariatur, modi voluptate doloribus in quo aliquam maiores nam atque corrupti? Dicta alias illum modi, repellendus distinctio repudiandae quibusdam nulla impedit rerum perferendis molestiae pariatur, sequi dolores ipsam cumque eos tempora? Natus nemo nisi possimus. Soluta, est amet quod enim excepturi odio ipsam aperiam temporibus deleniti quo cupiditate veniam dicta similique doloribus perferendis earum animi eum. Corporis ipsam odit tenetur optio dicta quia quod nostrum illo labore magnam, obcaecati, repudiandae porro a quas perspiciatis, temporibus qui incidunt soluta cupiditate voluptate ipsum quae aut?

            </p>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row my-3">
        <h2 class="heading text-uppercase text-primary text-center my-3">Team member</h2>
    </div>
    <div class="row team_container">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="our-team">
            <div class="picture">
            <img class="img-fluid" src="https://picsum.photos/130/130?image=1027">
            </div>
            <div class="team-content">
            <h3 class="name">Michele Miller</h3>
            <h4 class="title">Web Developer</h4>
            </div>
            <ul class="social">
            <li><a href="#" class="fab fa-facebook" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-twitter" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-google-plus" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-linkedin" aria-hidden="true"></a></li>
            </ul>
        </div>
        </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="our-team">
            <div class="picture">
            <img class="img-fluid" src="https://picsum.photos/130/130?image=839">
            </div>
            <div class="team-content">
            <h3 class="name">Patricia Knott</h3>
            <h4 class="title">Web Developer</h4>
            </div>
            <ul class="social">
            <li><a href="#" class="fab fa-facebook" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-twitter" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-google-plus" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-linkedin" aria-hidden="true"></a></li>
            </ul>
        </div>
        </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="our-team">
            <div class="picture">
            <img class="img-fluid" src="https://picsum.photos/130/130?image=856">
            </div>
            <div class="team-content">
            <h3 class="name">Justin Ramos</h3>
            <h4 class="title">Web Developer</h4>
            </div>
            <ul class="social">
            <li><a href="#" class="fab fa-facebook" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-twitter" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-google-plus" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-linkedin" aria-hidden="true"></a></li>
            </ul>
        </div>
        </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="our-team">
            <div class="picture">
            <img class="img-fluid" src="https://picsum.photos/130/130?image=836">
            </div>
            <div class="team-content">
            <h3 class="name">Mary Huntley</h3>
            <h4 class="title">Web Developer</h4>
            </div>
            <ul class="social">
            <li><a href="#" class="fab fa-facebook" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-twitter" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-google-plus" aria-hidden="true"></a></li>
            <li><a href="#" class="fab fa-linkedin" aria-hidden="true"></a></li>
            </ul>
        </div>
        </div>
    </div>
</div>
@endsection
