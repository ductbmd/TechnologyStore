<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Electro - HTML Ecommerce Template</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="{{asset('electro/css/bootstrap.min.css')}}"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="{{asset('electro/css/slick.css')}}"/>
 		<link type="text/css" rel="stylesheet" href="{{asset('electro/css/slick-theme.css')}}"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="{{asset('electro/css/nouislider.min.css')}}"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="{{asset('electro/css/font-awesome.min.css')}}">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="{{asset('electro/css/style.css')}}"/>
 		
 		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
 		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 		<!--[if lt IE 9]>
 		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
 		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 		<![endif]-->
	 <script src="{{asset('electro/js/cart.js')}}"></script>
	 <script src="{{asset('electro/js/filter.js')}}"></script>
	 <script src="{{asset('electro/js/order.js')}}"></script>
	 <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +081-0333-798-800</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> duc.tbmd@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 17 Giai Phong Street</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
						<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="{{asset('electro/img/logo.png')}}" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown" id="cart">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ hàng</span>
										@if(!Session::get('cart'))
										<div class="qty">0</div>
										</a>
										@else
										<div class="qty">{{Session::get('cart')->totalQty}}</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											@if(Session::get('cart')->items)
											@foreach(Session::get('cart')->items as $key=> $item )
											<div class="product-widget">
												<div class="product-img">
													@if($item['item']->files[0]->file)
													<img src="{{env("SERVER_HOST").$item['item']->files[0]->file->url}}" alt="">
													@else
													<img src="{{asset('electro/img/product01.png')}}" alt="">
													@endif
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="/client/product/{{$item['item']->id}}">{{$item['item']->name}}</a></h3>
													<h4 class="product-price"><span class="qty">{{$item['qty']}}x</span>${{$item['item']->price*(1-$item['item']->discount->discount/100)}}</h4>
												</div>
												<button class="delete" onclick="subToCart({{$key}})"><i class="fa fa-close"></i></button>
											</div>
											@endforeach
											@endif
											@if(Session::get('cart')->laptops)
											@foreach(Session::get('cart')->laptops as $key=> $laptop )
											<div class="product-widget">
												<div class="product-img">
													@if($laptop['item']->files[0]->file)
													<img src="{{env("SERVER_HOST").$laptop['item']->files[0]->file->url}}" alt="">
													@else
													<img src="{{asset('electro/img/product01.png')}}" alt="">
													@endif
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="/client/laptop/{{$key}}">{{$laptop['item']->name}}</a></h3>
													<h4 class="product-price"><span class="qty">{{$laptop['qty']}}x</span>${{$laptop['item']->price}}</h4>
												</div>
												<button class="delete" onclick="subLaptopToCart({{$key}})"><i class="fa fa-close"></i></button>
											</div>
											@endforeach
											@endif
											<!-- <div class="product-widget">
												<div class="product-img">
													<img src="{{asset('electro/img/product02.png')}}" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div> -->
										</div>
										<div class="cart-summary">
											<small>{{Session::get('cart')->totalQty}} sản phẩm được chọn</small>
											<h5>TỔNG: ${{Session::get('cart')->totalPrice}}</h5>
										</div>
										
										<div class="cart-btns">
											<a href="{{route('client.viewcart')}}">Chi tiết</a>
											<a href="{{route('client.checkout')}}">Thanh toán  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
									@endif
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="{{route('client.index')}}">Home</a></li>
						<li><a href="{{route('client.storelaptop')}}">Máy tính xách tay</a></li>
						<li><a href="{{route('client.store')}}">Điện thoại</a></li>
						
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		
		@yield('content')
		<!-- SECTION
		<div class="section">
			container
			<div class="container">
				row
				<div class="row">
				</div>
				/row
			</div>
			/container
		</div>
		/SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Đăng ký để nhận thông báo <strong>KHUYẾN MÃI</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Me</h3>
								<p>Đây là đồ án 3 của Tô Bá Minh Đức. Đề tài :web thương mại điện tử.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i> Số 17 Giải Phóng</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+084-09x-xx-xxx</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>duc.tbmd@gmail.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>


						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="{{asset('electro/js/jquery.min.js')}}"></script>
		<script src="{{asset('electro/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('electro/js/slick.min.js')}}"></script>
		<script src="{{asset('electro/js/nouislider.min.js')}}"></script>
		<script src="{{asset('electro/js/jquery.zoom.min.js')}}"></script>
		<script src="{{asset('electro/js/main.js')}}"></script>

	</body>
</html>
