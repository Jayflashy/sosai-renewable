<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{get_setting('description')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="Jadesdev" name="author" />
    <!-- Title -->
    <title>@yield('title') | {{get_setting('title')}}</title>
    <!-- Favicon -->
    <link rel="icon shortcut" href="{{my_asset(get_setting('favicon'))}}">

    <!-- Bootstrap Css -->
    <link href="{{static_asset('css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons CSS  -->
    <link rel="stylesheet" href="{{static_asset('css/icons.min.css')}}">
    <!-- Core Stylesheet -->
    <link rel="stylesheet"  id="app-style" href="{{static_asset('css/app.min.css')}}">
    <link rel="stylesheet" href="{{static_asset('css/vendors.css')}}">
    @yield('styles')

  </head>
  <body>
    <div id="layout-wrapper">
      {{-- HEader --}}
      @include('agent.layouts.header')
      {{-- left sidebar --}}
      @include('agent.layouts.sidebar')
      {{-- Page Content  --}}
      <div class="main-content">
        <div class="page-content">
          <div class="container-fluid">
            @yield('breadcrumb')
            {{-- Content --}}
              @yield('content')
          </div>
        </div>
      </div>
        <!-- End Page-content -->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © {{get_setting('title')}}.
              </div>
              <div class="col-sm-6">
                {{-- {!! main_scripts() !!} --}}
                  <div class="text-sm-end d-none d-sm-block">
                    <span class="float-end ms-3">V 1.0</span>
                     Developed by <a target="blank" href="https://jadesdev.com.ng">Jadesdev </a>
                  </div>
              </div>
            </div>
          </div>
      </footer>
    </div>

    <!-- Footer Nav -->
    <!-- All JavaScript Files -->
    <script src="{{static_asset('js/jquery.min.js')}}"></script>
    <script src="{{static_asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{static_asset('js/metisMenu.min.js')}}"></script>
    <script src="{{static_asset('js/simplebar.min.js')}}"></script>
    <script src="{{static_asset('js/waves.min.js')}}"></script>
    <script src="{{static_asset('js/vendors.js')}}"></script>
    <script src="{{static_asset('js/core.js')}}"></script>
    <script src="{{static_asset('js/app.js')}}"></script>

    <script src="{{static_asset('js/snackbar.min.js')}}"></script>
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
