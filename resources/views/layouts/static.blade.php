<!DOCTYPE html>
<html lang="en">
<head>
	@include('partial.head')
	<link href="{{ asset('assets/frontend/css/custom.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
@include('partial.header')

@yield('content')	 

@include('partial.footer')

@include('partial.scripts')

@stack('bottom')

</body>
</html>