<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('layouts.partials.head')
  </head>

  <body>

    <div class="page-wrapper">
      @yield('content')
    </div>

  </body>
</html>
