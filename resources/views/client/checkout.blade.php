@extends('layouts.client')

@section('content')
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="http://localhost:8000/index">Home</a></li>
							<li class="active">Checkout</li>
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

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="name" placeholder="Họ tên " id="name">
							</div>
							<!-- <div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name" id="last-name">
							</div> -->
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email" id="email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Địa chỉ" id="address">
							</div>
							<!-- <div class="form-group">
								<input class="input" type="text" name="city" placeholder="City" id="city">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country" id="country">
							</div> -->
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="Mã bưu chính" id="zip-code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Sô điện thoại" id="telephone">
							</div>
							@if(!Auth::check())
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account" value="create">
									<label for="create-account">
										<span></span>
										Tạo tài khoản?<a href="#"> Hoặc đăng nhập</a>(nếu bạn mua hàng khi đã đăng nhập thông tin sẽ tự động được điền)
									</label>
									<div class="caption">
										<p>Nhập mật khẩu, tên đăng nhập sẽ là email của bạn!</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password" id="pass">
									</div>
								</div>
							</div>
							@else
							<input class="input" type="hidden" name="password" placeholder="Tạo mật khẩu mới" id="pass" >
							@endif
						</div>
						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<!-- <div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>
							<div class="input-checkbox">
								<input type="checkbox" id="shiping-address">
								<label for="shiping-address">
									<span></span>
									Ship to a diffrent address?
								</label>
								<div class="caption">
									<div class="form-group">
										<input class="input" type="text" name="first-name" placeholder="First Name">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="last-name" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input class="input" type="email" name="email" placeholder="Email">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="address" placeholder="Address">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="city" placeholder="City">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="country" placeholder="Country">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
									</div>
									<div class="form-group">
										<input class="input" type="tel" name="tel" placeholder="Telephone">
									</div>
								</div>
							</div>
						</div> -->
						<!-- /Shiping Details -->

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" placeholder="Order Notes" id='note'></textarea>
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Hóa đơn </h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>SẢN PHẨM</strong></div>
								<div><strong>TỔNG</strong></div>
							</div>

							<div class="order-products">
								@if(Session::get('cart')->items)
								@foreach(Session::get('cart')->items as $key =>$item )
								<div class="order-col">
									<div>{{$item['qty']}} x {{$item['item']->name}} </div>
									<div>{{$item['price']}}</div>
								</div>
								@endforeach
								@endif
								@if(Session::get('cart')->laptops)
								@foreach(Session::get('cart')->laptops as $key =>$item )
								<div class="order-col">
									<div>{{$item['qty']}}x{{$item['item']->name}} </div>
									<div>{{$item['price']}}</div>
								</div>
								@endforeach
								@endif
							</div>
							<div class="order-col">
								<div>Giao hàng</div>
								<div><strong>MIỄN PHÍ</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TỔNG </strong></div>
								<div><strong class="order-total">${{$total}}</strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1" value="THE">
								<label for="payment-1">
									<span></span>
									Chuyển Khoản Ngân Hàng
								</label>
								<div class="caption">
									<p>Khi bạn ấn thanh toán hóa đơn vui lòng gửi đúng số tiền theo số tài khoản 1903 4056 584466.Chúng tôi sẽ kiểm tra và đơn hàng của bạn sẽ được giao về đúng địa chỉ trong hóa đơn.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2" value="BUUDIEN">
								<label for="payment-2">
									<span></span>
									Thanh toán khi nhận hàng
								</label>
								<div class="caption">
									<p>Bạn sẽ thanh toán cho bưu điện khi nhận được sản phẩm.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3" value="TAIQUAY">
								<label for="payment-3">
									<span></span>
									Thánh toán tại quầy
								</label>
								<div class="caption">
									<p>Tới cửa hàng của chúng tôi và thanh toán trực tiếp tại quầy.Chúng tôi sẽ giữ sản phẩm cho bạn trong 24 giờ</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								Tôi đã đọc và đồng ý với  <a href="#">Điều khoản & điều kiện</a> của cửa hàng
							</label>
						</div>
						<a onclick="placeorder()"  class="primary-btn order-submit">Đặt hàng</a>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection