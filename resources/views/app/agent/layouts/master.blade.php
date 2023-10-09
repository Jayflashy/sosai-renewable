<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{get_setting('description')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="robots" content="index, follow">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="Website" >
    <meta property="og:title" content="@yield('title') - {{get_setting('title')}}" >
    <meta property="og:image" content="{{my_asset(get_setting('logo'))}}" >
    <meta property="og:description" content="{{get_setting('description')}} " >
    <meta property="og:site_name" content="{{get_setting('title') }}" >

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title') - {{get_setting('title')}}">
    <meta name="twitter:description" content="{{get_setting('description')}} ">
    <meta name="twitter:image" content="{{ my_asset(get_setting('logo')) }}">
    <!-- Title -->
    <title>@yield('title') | {{get_setting('title')}}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{my_asset(get_setting('favicon'))}}">
    <link rel="apple-touch-icon" href="{{my_asset(get_setting('touch_icon'))}}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{static_asset('app/css/vendors.css')}}">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{static_asset('app/css/style.css')}}">
    <link rel="stylesheet" href="{{static_asset('app/css/snackbar.min.css')}}">
    @yield('styles')
  </head>
  <body>
    <div id="preloader">
        <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Dark mode switching -->
    <div class="dark-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
          <div class="dark-mode-text text-center">
            <svg class="bi bi-moon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M14.53 10.53a7 7 0 0 1-9.058-9.058A7.003 7.003 0 0 0 8 15a7.002 7.002 0 0 0 6.53-4.47z"></path>
            </svg>
            <p class="mb-0">Switching to dark mode</p>
          </div>
          <div class="light-mode-text text-center">
            <svg class="bi bi-brightness-high" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
            </svg>
            <p class="mb-0">Switching to light mode</p>
          </div>
        </div>
    </div>

    <!-- Header Area -->
    @include('app.agent.layouts.header')
    <!-- # Sidenav Left -->
    @include('app.agent.layouts.sidebar')

    {{-- content --}}
    <div class="page-content-wrapper py-3">
        <div class="container">
            @yield('content')
        </div>
    </div>

     <!-- Footer Nav -->
    @include('app.agent.layouts.footer')

    <!-- All JavaScript Files -->
    <script src="{{static_asset('app/js/vendors1.js')}}"></script>
    {{-- <script src="{{static_asset('js/jquery.min.js')}}"></script> --}}
    <script src="{{static_asset('app/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{static_asset('app/js/active.js')}}"></script>
    <!-- PWA -->
    <!-- <script src="asset/js/pwa.js"></script> -->
    <script src="{{static_asset('app/js/loadingoverlay.min.js')}}"></script>
    <script src="{{static_asset('app/js/snackbar.min.js')}}"></script>
    <script src="{{static_asset('app/js/sweetalert.min.js')}}"></script>

    @yield('scripts')
    <script>
        @if(Session::get('success'))
        Snackbar.show({
          text: '{{Session::get('success')}}',
          pos: 'top-right',
          backgroundColor: '#38c172'
        });
        @endif
        @if(Session::get('error'))
        Snackbar.show({
          text: '{{Session::get('error')}}',
          pos: 'top-right',
          backgroundColor: '#e3342f'
        });
        @endif
        @if(count($errors) > 0)
        Snackbar.show({
          @foreach($errors->all() as $error)
          text: '{{$error}}',
          @endforeach
          pos: 'top-right',
          backgroundColor: '#e3342f'
        });
        @endif
    </script>
  </body>
</html>
