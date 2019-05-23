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
							<li class="active">ViewCart</li>
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
								<h3 class="title">View Cart</h3>
							</div>

							<table class="table table-dark" border="0">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Product</th>
										<th scope="col">Qty</th>
										<th scope="col">Price</th>
										<th scope="col">additional fee</th>
										<th scope="col">Discout</th>
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
								      <td>$0</td>
								      <td>30%</td>

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
								      <td>$0</td>
								      <td>30%</td>

								    </tr>
								    @endforeach
								    @endif
								  </tbody>
							</table>
							
						</div>
						<!-- /Billing Details -->

						

						
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>

							<div class="order-products">
								@if(Session::get('cart')->items)
								@foreach(Session::get('cart')->items as $key =>$item )
								<div class="order-col">
									<div>{{$item['qty']}}x{{$item['item']->name}} </div>
									<div>{{$item['item']->price*0.7}}</div>
								</div>
								@endforeach
								@endif
								@if(Session::get('cart')->laptops)
								@foreach(Session::get('cart')->laptops as $key =>$item )
								<div class="order-col">
									<div>{{$item['qty']}}x{{$item['item']->name}} </div>
									<div>{{$item['item']->price*0.7}}</div>
								</div>
								@endforeach
								@endif
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
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