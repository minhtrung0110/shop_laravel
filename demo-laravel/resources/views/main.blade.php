
<!DOCTYPE html>
<html lang="en">
<head>
	@include('head')
</head>
<body class="animsition">
	
	<!-- Header -->
@include('header')

	<!-- Cart -->
@include('cart')
	
	<!-- Content -->
@yield('content')
	

	<!-- Footer -->
@include('footer')

</body>
</html>