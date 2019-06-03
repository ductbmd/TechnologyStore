<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use App\User;
use App\Models\UserInfo;
use Session;
use Carbon\Carbon;
use App\Models\Product\ProductDetail;
use App\Models\Laptop\Laptop;
use Illuminate\Support\Facades\Hash;
class OrderController extends Controller
{
	private $model;

	public function __construct(Order $model)
	{
        // $this->middleware('auth', ['except'=>[]]);
		$this->model = $model;

	}
	public function order(Request $request)
	{
		// return response()->json(['success' => true,'message'=>$request->name], 200);
		DB::beginTransaction();
		try {
			//Tao user
			$user_id=0;
			if($request->create=="yes"){
				$user_id=User::create([
					'name' => $request->name,
					'email' => $request->email,
					'password' => Hash::make($request->pass),
				])->id;
			}
			if(Auth::id()){
				$user_id=Auth::id();
			}
			//Tao info
			$userinfo_id=UserInfo::create([
				'user_id'=>$user_id,
				'name'=>$request->name,
				'address'=>$request->address,
				'zip_code'=>$request->zip_code,
				'phone'=>$request->telephone
			])->id;
			//tao don hang
			$cart=Session::get('cart');
			$order_id=Order::create([
				'user_id'=>$userinfo_id,
				'status'=>'DatDon',
				'total_amount'=>$cart->totalPrice,
				'note'=>$request->note,
				'payment'=>$request->payment,
			])->id;
			if($cart->items){
				foreach ($cart->items as $key => $item) {
					$product=ProductDetail::find($key);
					
					if($product->qty-$item['qty']<0){
						return response()->json(['success' => true,'message'=>'Sản phẩm điện thoại này đã hết'], 200);
					}
					$product->qty-=$item['qty'];
					$product->save();
					OrderDetail::create([
						'order_id'=>$order_id,
						'product_id'=>$key,
						'qty'=>$item['qty'],
						'price'=>$item['price'],
						'type'=>'PHONE'
					]);

				}
			}
			if($cart->laptops){
				foreach ($cart->laptops as $key => $item) {
					$laptop=Laptop::find($key);
					if($laptop->qty-$item['qty']<0){
						return response()->json(['success' => true,'message'=>'Sản phẩm'.$item['item']->name.' này đã hết'], 200);
					}
					$laptop->qty-=$item['qty'];
					$laptop->save();
					OrderDetail::create([
						'order_id'=>$order_id,
						'product_id'=>$key,
						'qty'=>$item['qty'],
						'price'=>$item['price'],
						'type'=>'LAPTOP'
					]);

				}
			}

		} catch (Exception $e) {
			DB::rollBack();
		}
		DB::commit();
		$request->session()->put('cart',null);
		return response()->json(['success' => true,'message'=>'Đặt hàng thành công'], 200);
	}
}
