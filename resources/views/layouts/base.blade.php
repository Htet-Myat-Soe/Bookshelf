<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!--     Fonts and icons     -->
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

        <!-- Bootstrap CSS Files -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

        {{-- Splide Slider --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">


        <title>@yield('title')</title>
    </head>
    <body>

        <!--========== SCROLL TOP ==========-->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

        <!--========== HEADER ==========-->
        <header class="l-header" id="header">
            <nav class="nav bd-container">
                <a href="#" class="nav__logo">Knowledge World</a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="/" class="nav__link">Home</a></li>
                        <li class="nav__item"><a href="/ebooks" class="nav__link">E Books</a></li>
                        <li class="nav__item"><a href="/blog" class="nav__link">Blog</a></li>
                        <li class="nav__item"><a href="/about" class="nav__link">About us</a></li>
                        <li class="nav__item"><a href="/contact" class="nav__link">Contact us</a></li>

                    </ul>
                </div>

                <ul class="nav_btn">
                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                    <li>
                        <div class="dropdown">
                            <a href="#" class="nav__link dropdown-toggle" role="button" id="user_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                @auth
                                    @if (Auth::user()->image)
                                        <img src="{{asset('assets/img/user')}}/{{Auth::user()->image}}" alt="User" id="user_profile">
                                    @else
                                        <p>{{Auth::user()->name}}</p>
                                    @endif
                                @else
                                <img src="{{asset('assets/img/user/profile.png')}}" alt="Login" id="user_profile">
                                @endauth
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user_dropdown">
                                @if (Route::has('login'))
                                    @auth
                                        @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'EDITOR')
                                            <li><a class="dropdown-item d-flex justify-content-between" href="{{route('admin.dashboard')}}"><ion-icon name="analytics"></ion-icon> Dashboard</a></li>
                                            <li><a class="dropdown-item d-flex justify-content-between" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><ion-icon name="log-out"></ion-icon> Logout</a></li>
                                        @else
                                            <li><a class="dropdown-item d-flex justify-content-between" href="{{route('user.profile')}}"><ion-icon name="person"></ion-icon> Profile</a></li>
                                            <li><a class="dropdown-item d-flex justify-content-between" href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><ion-icon name="log-out"></ion-icon> Logout</a></li>
                                        @endif

                                        <form action="{{route('logout')}}" id="logout-form" method="POST">@csrf</form>
                                    @else
                                        <li><a class="dropdown-item d-flex justify-content-between" href="{{route('login')}}"><ion-icon name="log-in"></ion-icon> Login</a></li>
                                        <li><a class="dropdown-item d-flex justify-content-between" href="{{route('register')}}"><ion-icon name="person-add"></ion-icon> Register</a></li>
                                    @endauth
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>

        <main class="l-main">
            @yield('content')
        </main>

        <!--========== FOOTER ==========-->
        <footer class="footer section bd-container">
            <div class="footer__container bd-grid">
                <div class="footer__content">
                    <a href="#" class="footer__logo">Knowledge World</a>
                    <span class="footer__description">This library is very helpful for everyone who love book.</span>
                    <div>
                        <a href="https://www.facebook.com/htetmyat.soe.5621" class="footer__social"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.instagram.com/htetmyatsoe927/" class="footer__social"><i class='bx bxl-instagram'></i></a>
                        <a href="https://twitter.com/HtetMya88933722" class="footer__social"><i class='bx bxl-twitter'></i></a>
                    </div>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Services</h3>
                    <ul>
                        <li><a href="{{route('ebooks')}}" class="footer__link">Free Ebooks</a></li>
                        <li><a href="#" class="footer__link">Blog</a></li>
                        <li><a href="{{route('category',['id' => 6])}}" class="footer__link">Technology</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Information</h3>
                    <ul>
                        <li><a href="/about" class="footer__link">About Us</a></li>
                        <li><a href="/contact" class="footer__link">Contact Us</a></li>
                        <li><a href="/blog" class="footer__link">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Address</h3>
                    <ul>
                        <li>Taungoo</li>
                        <li>Bago Region</li>
                        <li>09793148428</li>
                        <li>htetmyatsoe492@gmail.com</li>
                    </ul>
                </div>
            </div>

            <p class="footer__copy">Copyright &#169; 2021 Knowledge World Library</p>
        </footer>

        <!--   Jquery JS Files   -->
        <script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>

        <!--   Bootstrap JS Files   -->
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>

        <!--========== SCROLL REVEAL ==========-->
        <script src="https://unpkg.com/scrollreveal"></script>

        {{-- Splide Slider js --}}
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>

        <!--========== MAIN JS ==========-->
        <script src="{{asset('assets/js/main.js')}}"></script>

        {{-- Ionicons file --}}
        <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>




    </body>
</html>
