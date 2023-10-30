<!DOCTYPE html>
<html lang="en">
<head>
	@include('partial.head')
</head>
<body>
@include('partial.header')

@yield('content')	 

@include('partial.footer')

@include('partial.scripts')

@stack('bottom')

</body>
</html>