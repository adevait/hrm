<!DOCTYPE html>
<html lang="en">
<head>
  @include('includes.head')
</head>
<body style="z-index:-1;background-color: #f6f6f6">
    @include('includes.header')

    <div class="container">
        {!! Breadcrumbs::render(Route::currentRouteName(), @$breadcrumb) !!}
        
        @if(session('success'))
        <div class="alert alert-success" role="alert">
          <span class="sr-only">Success:</span>
          {{session('success')}}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger" role="alert">
          <span class="sr-only">Error:</span>
          {{session('error')}}
        </div>
        @endif

        @yield('content')    
    </div>

    @include('includes.footer')

    @yield('additionalCSS')
    @yield('additionalJS')
</body>
</html>
