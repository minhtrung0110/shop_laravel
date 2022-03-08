
<!DOCTYPE html>
<html lang="en">
<head>
	@include('head')
</head>
<body class="animsition">
	
	<!-- Header -->
@include('header')

	<!-- Cart  sẽ include cart vào nếu tìm dc cách hiện popup tất cả trang-->

@include('cart')
	<!-- Product -->
@yield('content')
	

	<!-- Footer -->
@include('footer')

</body>
</html>