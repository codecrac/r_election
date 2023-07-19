<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>R-ELECTION</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="/assets/css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/assets/css/responsive.css">
</head>
<body>
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->
<!-- Wrapper Start -->
<div class="wrapper">
    <!-- Sidebar  -->
    <div class="iq-sidebar">
        <div class="iq-navbar-logo d-flex justify-content-between">
            <a href="/assets/index.html" class="header-logo">
                <img src="images/logo.png" class="img-fluid rounded" alt="">
                <span>R-ELECTION</span>
            </a>
           {{-- <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-menu-line"></i></div>
                    <div class="hover-circle"><i class="ri-close-fill"></i></div>
                </div>
            </div>--}}
        </div>
        <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li class="active">
                        <a href="{{route('dashboard')}}" ><span
                                class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Tableau de bord</span>
                        </a>
                    </li>

                    @if(auth()->user()->user_type == "su_admin")

                        {{--<li>
                            <a href="{{route('zone.liste')}}" ><span
                                    class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Zones de vote</span>
                            </a>
                        </li>--}}
                        <li>
                            <a href="{{route('election.liste')}}" ><span
                                    class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Election</span>
                            </a>
                        </li>
                    @elseif(auth()->user()->user_type == "agent")
{{--                        <li>--}}
{{--                            <a href="{{route('centre.definir_taux_de_participation')}}" >--}}
{{--                                <span class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Taux de participation</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li>
                            <a href="{{route('centre.definir_resultat_candidat')}}" >
                                <span class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Resultats du jour</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('centre.definir_nombre_inscrits')}}" >
                                <span class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Electeurs</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <div class="p-3"></div>
        </div>
    </div>
    <!-- TOP Nav Bar -->
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="iq-menu-bt d-flex align-items-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-menu-line"></i></div>
                        <div class="hover-circle"><i class="ri-close-fill"></i></div>
                    </div>
                    <div class="iq-navbar-logo d-flex justify-content-between ml-3">
                        <a href="#" class="header-logo">
                            {{-- <img src="/custom_assets/x_cheque_ico.svg" class="img-fluid rounded" alt=""> --}}
                            <span>R-ELECTION</span>
                        </a>
                    </div>
                </div>
                <div class="iq-search-bar">
                    {{-- <form action="#" class="searchbox">
                       <input type="text" class="text search-input" placeholder="Type here to search...">
                       <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                    </form> --}}
                </div>
                {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
                </button> --}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                </div>
                <ul class="navbar-list">

                    <li class="line-height">
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                            <img src="https://static.vecteezy.com/system/resources/previews/002/318/271/original/user-profile-icon-free-vector.jpg" class="img-fluid rounded mr-3" alt="user">
                            <div class="caption">
                                <h6 class="mb-0 line-height">{{ auth()->user()->name }}</h6>
                                <p class="mb-0 text-uppercase">{{ auth()->user()->user_type != "su_admin" ? auth()->user()->user_type : "Super Administrateur" }}</p>
                            </div>
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white line-height">Bonjour {{ auth()->user()->name }}</h5>
                                        <span class="text-white font-size-12">{{ auth()->user()->status }}</span>
                                    </div>
                                    <a href="#" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-file-user-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Mon Profil</h6>
                                                <p class="mb-0 font-size-12">Voir les details de mon compte.</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="d-inline-block w-100 text-center p-3">
                                        <form method="post" action="{{route('logout')}}" >
                                            @csrf
                                            <button class="bg-primary iq-sign-btn"
                                                    type="submit"
                                                    role="button"
                                            >
                                                Deconnexion
                                                <i class="ri-login-box-line ml-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- TOP Nav Bar END -->

    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">


            @yield('content')

        </div>
    </div>
</div>
<!-- Wrapper END -->
<!-- Footer -->
<footer class="iq-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="/assets/privacy-policy.html">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="/assets/terms-of-service.html">Terms of Use</a></li>
                </ul>
            </div>
            <div class="col-lg-6 text-right">
                Copyright 2020 <a href="/assets/#">FinDash</a> All Rights Reserved.
            </div>
        </div>
    </div>
</footer>
<!-- Footer END -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<!-- Appear JavaScript -->
<script src="/assets/js/jquery.appear.js"></script>
<!-- Countdown JavaScript -->
<script src="/assets/js/countdown.min.js"></script>
<!-- Counterup JavaScript -->
{{--<script src="/assets/js/waypoints.min.js"></script>--}}
<script src="/assets/js/jquery.counterup.min.js"></script>
<!-- Wow JavaScript -->
{{--<script src="/assets/js/wow.min.js"></script>--}}
<!-- Apexcharts JavaScript -->
{{--<script src="/assets/js/apexcharts.js"></script>--}}
<!-- Slick JavaScript -->
{{--<script src="/assets/js/slick.min.js"></script>--}}
<!-- Select2 JavaScript -->
<script src="/assets/js/select2.min.js"></script>
<!-- Owl Carousel JavaScript -->
{{--<script src="/assets/js/owl.carousel.min.js"></script>--}}
<!-- Magnific Popup JavaScript -->
<script src="/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="/assets/js/smooth-scrollbar.js"></script>
<!-- lottie JavaScript -->
<script src="/assets/js/lottie.js"></script>
<!-- am core JavaScript -->
<script src="/assets/js/core.js"></script>
<!-- am charts JavaScript -->
<script src="/assets/js/charts.js"></script>
<!-- am animated JavaScript -->
<script src="/assets/js/animated.js"></script>
<!-- am kelly JavaScript -->
{{--<script src="/assets/js/kelly.js"></script>--}}
<!-- am maps JavaScript -->
{{--<script src="/assets/js/maps.js"></script>--}}
<!-- am worldLow JavaScript -->
{{--<script src="/assets/js/worldLow.js"></script>--}}
<!-- Style Customizer -->
<script src="/assets/js/style-customizer.js"></script>
<!-- Chart Custom JavaScript -->
{{--<script src="/assets/js/chart-custom.js"></script>--}}
<!-- Custom JavaScript -->
<script src="/assets/js/custom.js"></script>
@yield('script_complemeantaire')
</body>

</html>
