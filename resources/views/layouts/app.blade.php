<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500');

    body {
    overflow-x: hidden;
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    }

    /* Toggle Styles */
    #viewport {
        padding-left: 20%;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #sidebar {
        color: #fff;
        z-index: 1000;
        position: fixed;
        left: 250px;
        width: 245px;
        max-width: 20%;
        height: 100%;
        margin-left: -250px;
        overflow-y: auto;
        background: #98beff;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #sidebar header {
        padding: 10px 0px;
        background-color: #448ceb;
        font-size: 25px;
        line-height: 55px;
        text-align: center;
    }

    #content {
        padding-top: 2%;
        width: 100%;
        position: relative;
        margin-right: 0;
    }

    #sidebar header p {
        margin: 0;
        font-weight: bold;
        font-size: 25px;
    }

    #sidebar .nav li {
        border-bottom: 1px solid #268feb;
    }

    #sidebar .nav a {
        display: flex;
        align-items: center;
        color: #fff;
        font-size: 20px;
        padding: 16px 20px;
        text-decoration: none;
        transition: background 0.3s, color 0.3s;
        background: none;
    }

    #sidebar .nav a:hover {
        color: #9694ad;
    }

    #sidebar .nav a i {
        margin-right: 16px;
    }

    #settings-submenu li:last-child,
    #management-submenu li:last-child {
        border: none;
    }
    #settings-submenu a.link,
    #management-submenu a.projects-link,
    #management-submenu a.notes-link {
        padding: 16px 0px;
    }
</style>
</head>
<body>
    @php
        $routeName = Route::currentRouteName();
        $additionalClasses = '';
        if ($routeName === 'welcome' || $routeName === 'register') {
            $additionalClasses = 'navbar navbar-expand-md navbar-light bg-white shadow-sm';
        } else {
            $additionalClasses = '';
        }
    @endphp
    <div id="app">
        <nav class="{{ $additionalClasses }}">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="top">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>
</html>