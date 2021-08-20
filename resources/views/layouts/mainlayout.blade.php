<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('layouts.partials.head')
  </head>

  <body>

    <div class="page-wrapper">
      @include('layouts.partials.nav')
      @yield('content')
    </div>

    @include('layouts.partials.footer')
    @yield('script')
  </body>
</html>
