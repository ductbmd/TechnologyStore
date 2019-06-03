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
							<li><a href="#">Headphones</a></li>
							<li class="active">Product name goes here</li>
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
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							@foreach($product->files as $image)
							<div class="product-preview">
								<img src="{{env("SERVER_HOST").$image->file->url}}" alt="">
							</div>
							@endforeach

						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							@foreach($product->files as $image)
							<div class="product-preview">
								<img src="{{env("SERVER_HOST").$image->file->url}}" alt="">
							</div>
							@endforeach
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name">{{$product->name}}</h2>
							<div>
								<div class="product-rating">
									@for($i=1;$i<=round($comments->rate,0);$i++)
									<i class="fa fa-star"></i>
									@endfor
									<!-- So sao -->
									@for($i=1;$i<=(5-round($comments->rate,0));$i++)
									<i class="fa fa-star-o"></i>
									@endfor
								</div>
								<a class="review-link" href="#product-tab">{{$comments->count['sum']}} nhận xét | Thêm nhận xét của bạn</a>
							</div>
							<div>
								<h3 class="product-price">${{$product->price*(1-$product->discount->discount/100)}} <del class="product-old-price">${{$product->price}}</del></h3>
								<span class="product-available">In Stock</span>
							</div>
							<p>{{$product->name}} là một sản phẩm chất lượng trong tầm giá, máy chạy ổn định cấu hình tốt phục vụ đầy đủ các nhu cầu như lướt web facebook zalo, chụp ảnh selfie với chất lượng ảnh cao mang lại sự hài lòng cho người sử dụng.</p>

							<div class="product-options">
								<label>
									Hệ điều hành
									<select class="input-select" name="OS">
										<option value="{{$product->OS}}">{{$product->OS}}</option>
									</select>
								</label>
								<label>
									Màu sắc
									<select class="input-select" name="color" id="detail">
										@foreach($product->details as $detail)
										<option value="{{$detail->id}}">{{$detail->color}}</option>
										@endforeach
									</select>
								</label>
							</div>

							<div class="add-to-cart">
								<div class="qty-label">
									Số lượng
									<div class="input-number" name="quantity">
										<input type="number" value="1" id='qty'>
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<!-- <a href="{{route('product.addtocart',['id'=>$product->id])}}" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</a> -->
								<button onclick="addToCart({{$product->id}})" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
							</div>

							<ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
							</ul>

							<ul class="product-links">
								<li>Category:</li>
								@if($product->category)
								@foreach($product->category as $category)
								<li><a href="#">{{$category->name}}</a></li>
								@endforeach
								@endif
								<li><a href="#">Accessories</a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Nhận xét({{$comments->count['sum']}})</li>
								<li><a data-toggle="tab" href="#tab2">Thông số chi tiết</a></li>
								<li><a data-toggle="tab" href="#tab3">Mô tả</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>{{$comments->rate}}</span>
													<div class="rating-stars">
														@for($i=1;$i<=round($comments->rate,0);$i++)
														<i class="fa fa-star"></i>
														@endfor
														<!-- So sao -->
														@for($i=1;$i<=(5-round($comments->rate,0));$i++)
														<i class="fa fa-star-o"></i>
														@endfor
														<!-- <i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i> -->
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: @if($comments->count['sum']){{$comments->count[5]/$comments->count['sum']*100}}@endif%;"></div>
														</div>
														<span class="sum">{{$comments->count[5]}}</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: @if($comments->count['sum']){{$comments->count[4]/$comments->count['sum']*100}}@endif%;"></div>
														</div>
														<span class="sum">{{$comments->count[4]}}</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: @if($comments->count['sum']){{$comments->count[3]/$comments->count['sum']*100}}@endif%;"></div>
														</div>
														<span class="sum">{{$comments->count[3]}}</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: @if($comments->count['sum']){{$comments->count[2]/$comments->count['sum']*100}}@endif%;"></div>
														</div>
														<span class="sum">{{$comments->count[2]}}</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: @if($comments->count['sum']){{$comments->count[1]/$comments->count['sum']*100}}@endif%;"></div>
														</div>
														<span class="sum">{{$comments->count[1]}}</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
													@foreach($comments as $comment)
													<li>
														<div class="review-heading">
															<h5 class="name">{{$comment->created_by}}</h5>
															<p class="date">{{$comment->created_at}}</p>
															<div class="review-rating">
																@for($i=1;$i<=$comment->rating;$i++)
																<i class="fa fa-star"></i>
																@endfor
																<!-- So sao -->
																@for($i=1;$i<=5-$comment->rating;$i++)
																<i class="fa fa-star-o"></i>
																@endfor
															</div>
														</div>
														<div class="review-body">
															<p>{{$comment->message}}</p>
														</div>
													</li>
													@endforeach
													
												</ul>
												<!-- {{ $comments->links() }} -->
												 @include('layouts.pagination', ['result'=>$comments,'location_onsite'=>'product-tab'])

												<!-- <ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul> -->
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form" action="{{route('comment.product')}}" method="POST">
													@csrf
													<input type="hidden" id="custId" name="product_id" value="{{$product->id}}">
													<input class="input" type="text" name="created_by" placeholder="Your Name">
													<input class="input" type="email" name="email" placeholder="Your Email">
													<textarea class="input" name="message" placeholder="Your Review"></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<button class="primary-btn">Submit</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
									
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-2"></div>
										<div class="col-md-8">
											<table class="table table-striped">
												<tbody>
													<tr>
														<td>Màn hình:</td>
														<td>{{$product->size}}</td>
														<td>Chip CPU:</td>
														<td>{{$product->CPU}}</td>
													</tr>
													<tr>
														<td>Camera sau:</td>
														<td>{{$product->camera_back}}</td>
														<td>Camera trước:</td>
														<td>{{$product->camera_front}}</td>
													</tr>
													<tr>
														<td>Ram:</td>
														<td>{{$product->RAM}}</td>
														<td>Bộ nhớ trong:</td>
														<td>{{$product->ROM}}</td>
													</tr>
													<tr>
														<td>Thẻ nhớ :</td>
														<td>{{$product->memory_card}}</td>
														<td>Thẻ SIM:</td>
														<td>{{$product->SIM_card}}</td>
													</tr>
													<tr>
														<td>PIN :</td>
														<td>{{$product->Pin}}</td>
														<td>Jack Tai nghe:</td>
														<td>{{$product->headphone_jack}}</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>{{$product->description}}</p>
										</div>
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Sản phẩm liên quan</h3>
						</div>
					</div>
					@foreach($product_relatives as $key=>$product_relative)
					<!-- product -->
					<div class="col-md-3 col-xs-6">
					
						<div class="product">
									<div class="product-img">

										@if($product_relative->files[0]->file)
										<img src="{{env("SERVER_HOST").$product_relative->files[0]->file->url}}" alt="">
										@else
										<img src="{{asset('electro/img/product01.png')}}" alt="">
										@endif
										<div class="product-label">
											@if(!empty($product_relative->discount))
											<span class="sale">-{{$product_relative->discount->discount}}%</span>
											@endif
											<span class="new">NEW</span>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">{{$product_relative->name}}</a></h3>
										@if(!empty($product_relative->discount))
										<h4 class="product-price">${{$product_relative->price*(1-$product_relative->discount->discount/100)}} <del class="product-old-price">${{$product_relative->price}}</del></h4>
										@else
										<h4 class="product-price">${{$product_relative->price}} </h4>
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
											<a class="quick-view" href="{{route('client.product',$product_relative->id)}}" title="Click để xem thêm"><i class="fa fa-eye"></i></a>
										</div>
									</div>
									<div class="add-to-cart">
										<button onclick="addToCart({{$product_relative->id}},{{$product_relative->details[0]->id}})" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
									</div>
								</div>
					</div>
					<!-- /product -->
					@endforeach
					

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->
@endsection