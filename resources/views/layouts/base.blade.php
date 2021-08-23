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
                <a href="#" class="nav__logo">Tasty</a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="#home" class="nav__link active-link">Home</a></li>
                        <li class="nav__item"><a href="#about" class="nav__link">About</a></li>
                        <li class="nav__item"><a href="#services" class="nav__link">Services</a></li>
                        <li class="nav__item"><a href="#menu" class="nav__link">Menu</a></li>
                        <li class="nav__item"><a href="#contact" class="nav__link">Contact us</a></li>

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
                                <img src="{{asset('assets/img/login_black.png')}}" alt="Login" id="user_profile">
                                @endauth
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user_dropdown">
                                @if (Route::has('login'))
                                    @auth
                                        @if(Auth::user()->role === 'ADMIN')
                                            <li><a class="dropdown-item d-flex justify-content-between" href="{{route('admin.dashboard')}}"><i class="fa fa-user"></i> Dashboard</a></li>
                                            <li><a class="dropdown-item d-flex justify-content-between" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-user"></i> Logout</a></li>
                                        @elseif(Auth::user()->role === 'EDITOR')
                                            <li><a class="dropdown-item d-flex justify-content-between" href="{{route('user.profile')}}"><i class="fa fa-user"></i> Profile</a></li>
                                            <li><a class="dropdown-item d-flex justify-content-between" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-user"></i> Logout</a></li>
                                        @else
                                            <li><a class="dropdown-item d-flex justify-content-between" href="{{route('user.profile')}}"><i class="fa fa-user"></i> Profile</a></li>
                                            <li><a class="dropdown-item d-flex justify-content-between" href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-user"></i> Logout</a></li>
                                        @endif

                                        <form action="{{route('logout')}}" id="logout-form" method="POST">@csrf</form>
                                    @else
                                        <li><a class="dropdown-item d-flex justify-content-between" href="{{route('login')}}"><i class="fa fa-user"></i> Login</a></li>
                                        <li><a class="dropdown-item d-flex justify-content-between" href="{{route('register')}}"><i class="fa fa-user"></i> Register</a></li>
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
                    <a href="#" class="footer__logo">Tasty Food</a>
                    <span class="footer__description">Restaurant</span>
                    <div>
                        <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
                    </div>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Services</h3>
                    <ul>
                        <li><a href="#" class="footer__link">Delivery</a></li>
                        <li><a href="#" class="footer__link">Pricing</a></li>
                        <li><a href="#" class="footer__link">Fast food</a></li>
                        <li><a href="#" class="footer__link">Reserve your spot</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Information</h3>
                    <ul>
                        <li><a href="#" class="footer__link">Event</a></li>
                        <li><a href="#" class="footer__link">Contact us</a></li>
                        <li><a href="#" class="footer__link">Privacy policy</a></li>
                        <li><a href="#" class="footer__link">Terms of services</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Adress</h3>
                    <ul>
                        <li>Lima - Peru</li>
                        <li>Jr Union #999</li>
                        <li>999 - 888 - 777</li>
                        <li>tastyfood@email.com</li>
                    </ul>
                </div>
            </div>

            <p class="footer__copy">&#169; 2020 Bedimcode. All right reserved</p>
        </footer>

        <!--   Jquery JS Files   -->
        <script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>

        <!--   Bootstrap JS Files   -->
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>

        <!--========== SCROLL REVEAL ==========-->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!--========== MAIN JS ==========-->
        <script src="{{asset('assets/js/main.js')}}"></script>

    </body>
</html>
