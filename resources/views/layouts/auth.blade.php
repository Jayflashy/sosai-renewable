<!doctype html>
<html lang="en"><head>
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
    <!-- Icons CSS  -->
    {{-- <link rel="stylesheet" href="{{static_asset('css/icons.min.css')}}"> --}}
    <link rel="stylesheet" href="{{static_asset('css/snackbar.min.css')}}">
    <link rel="stylesheet" href="{{static_asset('auth/css/style.css')}}">
    @yield('styles')
  </head>
<body>
    <div id="page-container">

        <!-- Main Container -->
        <main id="main-container">
          <!-- Page Content -->
          <div class="bg-image" style="background-image: url('{{static_asset('auth/photo19@2x.jpg')}}');">
            <div class="row g-0 justify-content-center bg-primary-dark-op">
              <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                <!-- Sign In Block -->
                <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                  <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                    <!-- Header -->
                    <div class="mb-2 text-center">
                      <a class="link-fx fw-bold fs-1" href="{{route('index')}}">
                        <span class="text-dark">SOSAI </span><span class="text-primary">Energy</span> 
                      </a>
                      <p class="text-uppercase fw-bold fs-sm text-muted">@yield('title')</p>
                    </div>
                    {{-- End HEader --}}
                    @yield('content')
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </main>
    </div>

    
    <!-- All JavaScript Files -->
    <script src="{{static_asset('auth/js/vendors.min.js')}}"></script>
    <script src="{{static_asset('auth/js/jquery.min.js')}}"></script>
    <script src="{{static_asset('auth/js/jquery.validate.min.js')}}"></script>
    <script src="{{static_asset('auth/js/app.min.js')}}"></script> 
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
