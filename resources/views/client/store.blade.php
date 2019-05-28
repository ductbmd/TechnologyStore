@extends('layouts.client')

@section('content')

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">All Categories</a></li>
							<li><a href="#">Accessories</a></li>
							<li class="active">Headphones (227,490 Results)</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<form action="{{route('client.store')}}">
						<div class="aside">
								@csrf
							<h3 class="aside-title">Categories <button type="submit" class="badge badge-pill badge-success" style="background-color: #b92d74">Lọc</button></h3>
							
							<div class="checkbox-filter">
								@foreach($categories as $category)
								<div class="input-checkbox">
									<input class="duc" name="category_id[]" value="{{$category->id}}" type="checkbox" id="{{$category->id}}" @if(Request::get('category_id')!=null && in_array($category->id, Request::get('category_id'))) checked @endif>
									<label for="{{$category->id}}">
										<span></span>
										{{$category->name}}
										<small>({{$category->count}})</small>
									</label>
								</div>
								@endforeach
								
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number" name="price_min">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number" name="price_max">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
					</form>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<!-- <div class="aside">
							<h3 class="aside-title">Brand</h3>
							<div class="checkbox-filter">
								<div class="input-checkbox">
									<input type="checkbox" id="brand-1">
									<label for="brand-1">
										<span></span>
										SAMSUNG
										<small>(578)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-2">
									<label for="brand-2">
										<span></span>
										LG
										<small>(125)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-3">
									<label for="brand-3">
										<span></span>
										SONY
										<small>(755)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-4">
									<label for="brand-4">
										<span></span>
										SAMSUNG
										<small>(578)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-5">
									<label for="brand-5">
										<span></span>
										LG
										<small>(125)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-6">
									<label for="brand-6">
										<span></span>
										SONY
										<small>(755)</small>
									</label>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->
 
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Khuyễn mãi lớn</h3>
							@foreach($topsells as $key=>$product)
							<div class="product-widget">
								<div class="product-img">
									@if($product->files[0]->file)
										<img src="{{env("SERVER_HOST").$product->files[0]->file->url}}" alt="">
										@else
										<img src="{{asset('electro/img/product01.png')}}" alt="">
										@endif
								</div>
								<div class="product-body">
									
									<h3 class="product-name"><a href="{{route('client.product',$product->id)}}">{{$product->name}}</a></h3>
									<h4 class="product-price">${{$product->price*(1-$product->discount->discount/100)}}  <del class="product-old-price">${{$product->price}}</del></h4>
								</div>
							</div>
							@if($key==4) @break @endif
							@endforeach
							
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sắp xếp:
									<select class="input-select" id="product_sortBy" onchange="filterProduct()">
										<!-- <option value="popular">Thông dụng</option> -->
										<option value="asc" @if(Request::get('product_sortBy')=='asc') selected @endif>Giá tăng</option>
										<option value="desc" @if(Request::get('product_sortBy')=='desc') selected @endif>Giá giảm</option>
									</select>
								</label>

								<label>
									Hiển thị:
									<select class="input-select" id="product_paginate" onchange="filterProduct()">
										<option value="9" @if(Request::get('product_paginate')==9) selected @endif>9</option>
										<option value="12" @if(Request::get('product_paginate')==12) selected @endif>12</option>
										<option value="30" @if(Request::get('product_paginate')==30) selected @endif>30</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
							<!-- product -->
							@foreach($products as $key=>$product)
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
										<h3 class="product-name"><a href="#">{{$product->name}}</a></h3>
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
							@if($key%3==2 && $key>0)
							<div class="clearfix visible-lg visible-md visible-sm visible-xs"></div>
							@endif
							<!-- /product -->
							@endforeach
							
							
							<!-- product -->
							

							<div class="clearfix visible-sm visible-xs"></div>

							<!-- product -->
							
							<!-- /product -->
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						{{ $products->links() }}
						<!-- <div class="store-filter clearfix">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div> -->
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

	@endsection	