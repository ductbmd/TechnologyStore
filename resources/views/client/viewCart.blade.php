@extends('layouts.client')

@section('content')
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Xem Giỏ Hàng</h3>
						<ul class="breadcrumb-tree">
							<li><a href="http://localhost:8000/index">Home</a></li>
							<li class="active">Giỏ hàng</li>
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
								<h3 class="title">Giỏ Hàng</h3>
							</div>

							<table class="table table-dark" border="0">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Sản phẩm</th>
										<th scope="col">Số lượng</th>
										<th scope="col">Giá gốc</th>
										<th scope="col">Khuyễn mãi</th>
										<th scope="col">Thành tiền</th>
									</tr>
								</thead>
								<tbody>
									@if(Session::get('cart')->items)
									@foreach(Session::get('cart')->items as $key=>$item )
								    <tr>
								      <th scope="row">{{$loop->index+1}}</th>
								      <td>{{$item['item']->name}}</td>
								      <td>{{$item['qty']}}</td>
								      <td>${{$item['item']->price}}</td>
								      <td>{{$item['item']->discount->discount}}%</td>
								      <td>{{$item['price']}}</td>
								    </tr>
								    @endforeach
								    @endif

								    @if(Session::get('cart')->laptops)
									@foreach(Session::get('cart')->laptops as $key=>$item )
								    <tr>
								      <th scope="row">{{$loop->index+1}}</th>
								      <td>{{$item['item']->name}}</td>
								      <td>{{$item['qty']}}</td>
								      <td>${{$item['item']->price}}</td>
								      <td>{{$item['item']->discount->discount}}%</td>
								      <td>{{$item['price']}}</td>
								    </tr>
								    @endforeach
								    @endif
								    <tr>
								    	<td colspan="4"></td>
								    	<td >TỔNG CỘNG:</td>
								    	<td>${{$total}}</td>
								    </tr>
								  </tbody>
							</table>
							
						</div>
						<!-- /Billing Details -->

						

						
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Hóa Đơn</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>SẢN PHẨM</strong></div>
								<div><strong>TỔNG CỘNG</strong></div>
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
								<div><strong>TỔNG</strong></div>
								<div><strong class="order-total">${{$total}}</strong></div>
							</div>
						</div>
						
						
						<a href="{{route('client.checkout')}}" class="primary-btn order-submit">Order>>></a>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection