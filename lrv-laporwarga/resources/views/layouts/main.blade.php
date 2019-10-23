<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield('title')</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ url('/assets/css/bootstrap.min.css') }}" rel="stylesheet" />  

    <!-- Animation library for notifications   -->
    <link href="{{ url('/assets/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ url('/assets/css/mydesign.css') }}" rel="stylesheet"/>


    
    <link href="{{ url('assets/css/mystyles.css') }}" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ url('/assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />

    @yield('custom')

    <!--   Core JS Files   -->
    <script src="{{ url('assets/js/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="{{url('assets/images/sidebar.jpg')}}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
            <a href="{{ url('/') }}" class="simple-text">
                    Aplikasi Lapor Warga
                </a>
            </div>

            <ul class="nav">
                @guest
                @if (Route::has('register'))
                <li class="">
                        <a href="{{ url('/announces') }}">
                            <i class="pe-7s-bell"></i>
                            <p>Pengumuman</p>
                        </a>
                </li>
                @endif
                @else
                <li class="">
                    <a href="{{ url('/') }}">
                        <i class="pe-7s-home"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="">
                    <a href="{{ url('/reports/create') }}">
                        <i class="pe-7s-note"></i>
                        <p>Lapor</p>
                    </a>
                </li>

                <li class="">
                    <a href="{{ url('/reports/log') }}">
                        <i class="pe-7s-note2"></i>
                        <p>Log Laporan</p>
                    </a>
                </li>

                <li class="">
                    <a href="{{ url('/announces') }}">
                        <i class="pe-7s-bell"></i>
                        <p>Pengumuman</p>
                    </a>
                </li>
                @endguest
            </ul>
            
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=""><i class="pe-7s-home"></i> @yield('page')</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="{{ url('/about') }}">
                            Tentang Aplikasi    
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    Copyright &copy; Abdul Aziz <script>document.write(new Date().getFullYear())</script>
                </p>
            </div>
        </footer>
</div>
</div>

@yield('modal')

</body>

    

	<!--  Charts Plugin -->
	<script src="{{ url('assets/js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ url('assets/js/bootstrap-notify.js') }}"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{ url('assets/js/light-bootstrap-dashboard.js?v=1.4.0') }}"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{{ url('assets/js/demo.js') }}"></script>

</html>
