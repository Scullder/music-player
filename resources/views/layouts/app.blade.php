<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{asset('js/pages_include.js')}}"></script>
    <script src="{{asset('js/player.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('css/design.css') }}">
    <link rel="stylesheet" href="{{ asset('css/player.css') }}">
    <title>@yield('title')</title>
  </head>
  <body>
    @yield('body')
  </body>
</html>
