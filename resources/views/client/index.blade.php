@extends('layouts.client')

@section('content')
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="{{asset('electro/img/shop01.png')}}" alt="">
					</div>
					<div class="shop-body">
						<h3>Bộ sưu tập<br>Laptop</h3>
						<a href="{{route('client.storelaptop')}}" class="cta-btn">Mua ngay <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->

			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="{{asset('electro/img/shoplap.png')}}" alt="">
					</div>
					<div class="shop-body">
						<h3>Bộ sưu tập<br>Laptop</h3>
						<a href="{{route('client.storelaptop')}}" class="cta-btn">Mua ngay <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->

			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="{{asset('electro/img/shopIP.png')}}" alt="">
					</div>
					<div class="shop-body">
						<h3>Bộ sưu tập<br>Điện thoại</h3>
						<a href="{{route('client.storelaptop')}}" class="cta-btn">Mua ngay <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Sản phẩm mới</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
							<li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab1" class="tab-pane active">
							<div class="products-slick" data-nav="#slick-nav-1">
								<!-- product -->
								<!-- product -->
								@foreach($newLaptops as $key=>$product)
								<div class="col-md-4 col-xs-6">
									<div class="product">
										<div class="product-img">

											@if($product->files[0]->file)
											<img src="{{env("SERVER_HOST").$product->files[0]->file->url}}" alt="">
											@else
											<img src="{{asset('electro/img/product01.png')}}" alt="">
											@endif
											<div class="product-label">
												@if(!empty($product->discount))
												<span class="sale">-{{$product->discount->discount}}%</span>
												@endif
												<span class="new">NEW</span>
											</div>
										</div>
										<div class="product-body">
											<p class="product-category">Category</p>
											<h3 class="product-name"><a href="{{route('client.laptop',$product->id)}}">{{$product->name}}</a></h3>
											@if(!empty($product->discount))
											<h4 class="product-price">${{$product->price*(1-$product->discount->discount/100)}} <del class="product-old-price">${{$product->price}}</del></h4>
											@else
											<h4 class="product-price">${{$product->price}} </h4>
											@endif
											<div class="product-rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div>
											<div class="product-btns">
												<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">thêm vào danh sách yêu thích</span></button>
												<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Thêm vào so sánh</span></button>
												<a class="quick-view" href="{{route('client.laptop',$product->id)}}" title="Click để xem thêm"><i class="fa fa-eye"></i></a>
											</div>
										</div>
										<div class="add-to-cart">
											<button onclick="addLaptopToCart({{$product->id}})" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
										</div>
									</div>
								</div>

								<!-- /product -->
								@endforeach
								<!-- /product -->
							</div>
							<div id="slick-nav-1" class="products-slick-nav"></div>
						</div>
						<div id="tab2" class="tab-pane active">
							<div class="products-slick" data-nav="#slick-nav-2">
								<!-- product -->
								<!-- product -->
								@foreach($newPhones as $key=>$product)
								<div class="col-md-4 col-xs-6">
									<div class="product">
										<div class="product-img">

											@if($product->files[0]->file)
											<img src="{{env("SERVER_HOST").$product->files[0]->file->url}}" alt="">
											@else
											<img src="{{asset('electro/img/product01.png')}}" alt="">
											@endif
											<div class="product-label">
												@if(!empty($product->discount))
												<span class="sale">-{{$product->discount->discount}}%</span>
												@endif
												<span class="new">NEW</span>
											</div>
										</div>
										<div class="product-body">
											<p class="product-category">Category</p>
											<h3 class="product-name"><a href="{{route('client.product',$product->id)}}">{{$product->name}}</a></h3>
											@if(!empty($product->discount))
											<h4 class="product-price">${{$product->price*(1-$product->discount->discount/100)}} <del class="product-old-price">${{$product->price}}</del></h4>
											@else
											<h4 class="product-price">${{$product->price}} </h4>
											@endif
											<div class="product-rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div>
											<div class="product-btns">
												<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">thêm vào danh sách yêu thích</span></button>
												<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Thêm vào so sánh</span></button>
												<a class="quick-view" href="{{route('client.product',$product->id)}}" title="Click để xem thêm"><i class="fa fa-eye"></i></a>
											</div>
										</div>
										<div class="add-to-cart">
											<button onclick="addToCart({{$product->id}},{{$product->details[0]->id}})" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
										</div>
									</div>
								</div>

								<!-- /product -->
								@endforeach
							</div>
							<div id="slick-nav-2" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="hot-deal">
					<ul class="hot-deal-countdown">
						<li>
							<div>
								<h3>02</h3>
								<span>Days</span>
							</div>
						</li>
						<li>
							<div>
								<h3>10</h3>
								<span>Hours</span>
							</div>
						</li>
						<li>
							<div>
								<h3>34</h3>
								<span>Mins</span>
							</div>
						</li>
						<li>
							<div>
								<h3>60</h3>
								<span>Secs</span>
							</div>
						</li>
					</ul>
					<h2 class="text-uppercase">Khuyễn mãi lớn trong tuần </h2>
					<p>Bộ sản phẩm mới sale 20-30%</p>
					<a class="primary-btn cta-btn" href="{{route('client.store')}}">Mua ngay</a>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Giảm giá mạnh</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li class="active"><a data-toggle="tab" href="#tab3">Laptops-SmartPhone</a></li>
							
							
						</ul>
					</div>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab3" class="tab-pane fade in active">
							<div class="products-slick" data-nav="#slick-nav-3">
								@foreach($newLaptops as $key=>$product)
								<div class="col-md-4 col-xs-6">
									<div class="product">
										<div class="product-img">

											@if($product->files[0]->file)
											<img src="{{env("SERVER_HOST").$product->files[0]->file->url}}" alt="">
											@else
											<img src="{{asset('electro/img/product01.png')}}" alt="">
											@endif
											<div class="product-label">
												@if(!empty($product->discount))
												<span class="sale">-{{$product->discount->discount}}%</span>
												@endif
												<span class="new">NEW</span>
											</div>
										</div>
										<div class="product-body">
											<p class="product-category">Category</p>
											<h3 class="product-name"><a href="{{route('client.laptop',$product->id)}}">{{$product->name}}</a></h3>
											@if(!empty($product->discount))
											<h4 class="product-price">${{$product->price*(1-$product->discount->discount/100)}} <del class="product-old-price">${{$product->price}}</del></h4>
											@else
											<h4 class="product-price">${{$product->price}} </h4>
											@endif
											<div class="product-rating">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div>
											<div class="product-btns">
												<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">thêm vào danh sách yêu thích</span></button>
												<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Thêm vào so sánh</span></button>
												<a class="quick-view" href="{{route('client.laptop',$product->id)}}" title="Click để xem thêm"><i class="fa fa-eye"></i></a>
											</div>
										</div>
										<div class="add-to-cart">
											<button onclick="addLaptopToCart({{$product->id}})" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
										</div>
									</div>
								</div>

								<!-- /product -->
								@endforeach
								
							</div>
							<div id="slick-nav-3" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-4 col-xs-6">
				<div class="section-title">
					<h4 class="title">SmartPhone bán chạy</h4>
					<div class="section-nav">
						<div id="slick-nav-6" class="products-slick-nav"></div>
					</div>
				</div>

				<div class="products-widget-slick" data-nav="#slick-nav-6">
					<div>
						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/iphone-xr-256gb-trang-1-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/product/17">Iphone XR</a></h3>
								<h4 class="product-price">$1120  <del class="product-old-price">$1600</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/iphone-8-plus-64gb-bac-6-2-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/product/16">Iphone 8 Plus</a></h3>
								<h4 class="product-price">$880  <del class="product-old-price">$1100</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/samsung-galaxy-note8-den-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/product/9">Samsung Galaxy Note 8</a></h3>
								<h4 class="product-price">$560  <del class="product-old-price">$700</del></h4>
							</div>
						</div>
						<!-- product widget -->
					</div>

					<div>
						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/iphone-7-plus-den-1-6-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/product/15">Iphone 7 Plus</a></h3>
								<h4 class="product-price">$520  <del class="product-old-price">$650</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/iphone-7-plus-den-1-6-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/product/15">Iphone 7 Plus</a></h3>
								<h4 class="product-price">$520  <del class="product-old-price">$650</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/iphone-6s-plus-32gb-vangdong1-1-4-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/product/14">Iphone 6 Plus</a></h3>
								<h4 class="product-price">$400  <del class="product-old-price">$500</del></h4>
							</div>
						</div>
						<!-- product widget -->
					</div>
				</div>
			</div>

			<div class="col-md-4 col-xs-6">
				<div class="section-title">
					<h4 class="title">Laptop Bán chạy</h4>
					<div class="section-nav">
						<div id="slick-nav-4" class="products-slick-nav"></div>
					</div>
				</div>

				<div class="products-widget-slick" data-nav="#slick-nav-4">
					<div>
						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/apple-macbook-air-mree2sa-a-i5-8gb-128gb-133-gold-0-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/laptop/3">Apple Macbook Air 2018 i5/8GB/128GB (MREE2SA/A)123</a></h3>
								<h4 class="product-price">$1200  <del class="product-old-price">$1500</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/dell-inspiron-3576-i5-8250u-70157552-den-2-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/laptop/6">Dell Vostro 3578 i5 8250U/4GB/1TB/2GB 520/Win10/(P63F002V78B)123</a></h3>
								<h4 class="product-price">$800  <del class="product-old-price">$1000</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/dell-inspiron-7373-i5-8250u-8gb-256gb-win10-office-xam-12-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/laptop/7">Dell Inspiron 7373 i5 8250U/8GB/256GB/Win10/Office365/(C3TI501OW)123</a></h3>
								<h4 class="product-price">$800  <del class="product-old-price">$1000</del></h4>
							</div>
						</div>
						<!-- product widget -->
					</div>

					<div>
						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/dell-inspiron-3576-i5-8250u-70157552-den-2-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/laptop/6">Dell Vostro 3578 i5 8250U/4GB/1TB/2GB 520/Win10/(P63F002V78B)123</a></h3>
								<h4 class="product-price">$800  <del class="product-old-price">$1000</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/dell-inspiron-3576-i5-8250u-70157552-den-3-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/laptop/2">Dell Inspiron 3576 i5 8250U/4GB/1TB/2GB AMD 520/Win10/(70157552)123</a></h3>
								<h4 class="product-price">$800  <del class="product-old-price">$1000</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/lenovo-ideapad-530s-14ikb-i7-8550u-8gb-256gb-win10-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/laptop/1">Lenovo Ideapad 530S 14IKB i7 8550U/8GB/256GB/Win10/(81EU00P5VN)123</a></h3>
								<h4 class="product-price">$800  <del class="product-old-price">$1000</del></h4>
							</div>
						</div>
						<!-- product widget -->
					</div>
				</div>
			</div>

			<div class="clearfix visible-sm visible-xs"></div>

			<div class="col-md-4 col-xs-6">
				<div class="section-title">
					<h4 class="title">Laptop bán chạy</h4>
					<div class="section-nav">
						<div id="slick-nav-5" class="products-slick-nav"></div>
					</div>
				</div>

				<div class="products-widget-slick" data-nav="#slick-nav-5">
					<div>
						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/lenovo-ideapad-530s-14ikb-i7-8550u-8gb-256gb-win10-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/laptop/1">Lenovo Ideapad 530S 14IKB i7 8550U/8GB/256GB/Win10/(81EU00P5VN)123</a></h3>
								<h4 class="product-price">$800  <del class="product-old-price">$1000</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/dell-inspiron-3576-i5-8250u-70157552-den-3-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/laptop/2">Dell Inspiron 3576 i5 8250U/4GB/1TB/2GB AMD 520/Win10/(70157552)123</a></h3>
								<h4 class="product-price">$800  <del class="product-old-price">$1000</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/dell-inspiron-3576-i5-8250u-70157552-den-2-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/laptop/6">Dell Vostro 3578 i5 8250U/4GB/1TB/2GB 520/Win10/(P63F002V78B)123</a></h3>
								<h4 class="product-price">$800  <del class="product-old-price">$1000</del></h4>
							</div>
						</div>
						<!-- product widget -->
					</div>

					<div>
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/iphone-xr-256gb-trang-1-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/product/17">Iphone XR</a></h3>
								<h4 class="product-price">$1120  <del class="product-old-price">$1600</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/iphone-8-plus-64gb-bac-6-2-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/product/16">Iphone 8 Plus</a></h3>
								<h4 class="product-price">$880  <del class="product-old-price">$1100</del></h4>
							</div>
						</div>
						<!-- /product widget -->

						<!-- product widget -->
						<div class="product-widget">
							<div class="product-img">
								<img src="http://localhost:8001/storage/photos/samsung-galaxy-note8-den-1-org.jpg" alt="">
							</div>
							<div class="product-body">

								<h3 class="product-name"><a href="http://localhost:8000/client/product/9">Samsung Galaxy Note 8</a></h3>
								<h4 class="product-price">$560  <del class="product-old-price">$700</del></h4>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->


@endsection