<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="theme-color" content="#DF0021">
<link rel="icon" type="image/ico" sizes="32x32" href="{{ asset(config('settings.favicon')) }}">
<title>{{ config('settings.appname') }} :: @yield('title')</title>

@stack('top')