<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductDetail;
use App\Models\Product\ProductCategory;
use App\Models\Laptop\Laptop;
use App\Models\Discount;
use App\Models\Category;
use Session;
use Carbon\Carbon;
class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $product;
    private $laptop;
    public function __construct(Product $product,Laptop $laptop)
    {
        $this->product=$product;
        $this->laptop=$laptop;
        /*$this->middleware('auth');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('client.index');
    }
    public function product($id){
        $product=$this->product->with('files.file')->with('company')->with('discount')->with('details')->where('id',$id)->first();
        // dd($product);
        // dd(Session::get('cart'));
        return view('client.product')->with('product',$product);
    }
    public function laptop($id){
        $laptop=$this->laptop->with('files.file')->where('id',$id)->first();
         // dd($laptop);
        // dd(Session::get('cart'));
        return view('client.laptop')->with('laptop',$laptop);
    }
    public function checkoutmy()
    {
        
        $cart=Session::get('cart');
        // dd($cart);
        $total=0;
        $prices=array();//Gia cua cac san pham
        foreach ($cart->items as $key => $product_cart) {
            
            $discount=Discount::where('product_id',$key)
            ->whereDate('time_start','<=',Carbon::today())
            ->whereDate('time_expired','>=',Carbon::today())
            ->max('discount');
            if(!$discount) $discount=0;//Khong co khuyen mai

            $detail=ProductDetail::find($key);
            $price=($product_cart['price']+$detail->price-(float)$product_cart['price']*$discount/100)*$product_cart['qty'];
            $total+=$price;
            $prices[$key]=['discount'=>$discount,'price'=>$price,'more'=>$detail->price];//Thong tin gia cua san pham
        }
        
        return view('client.checkout')->with('prices',$prices)->with('total',$total);
    }
    public function checkout()
    {
        
        $cart=Session::get('cart');
        // dd($cart);
        $total=0;
        $prices=array();//Gia cua cac san pham
        if($cart->items){
            foreach ($cart->items as $key => $product_cart) {
                $price=$product_cart['price'];
                $total+=$price;
            }
        }
        if($cart->laptops){
            foreach ($cart->laptops as $key => $product_cart) {
                    $total+=$product_cart['price'];
            }
        }
        
        return view('client.checkout')->with('prices',$prices)->with('total',$total);
    }
    public function viewCart()
    {
        $cart=Session::get('cart');
        $total=0;
        if($cart->items){
            foreach ($cart->items as $key => $product_cart) {
                $price=$product_cart['price'];
                $total+=$price;
            }
        }
        if($cart->laptops){
            foreach ($cart->laptops as $key => $product_cart) {
                    $total+=$product_cart['price'];
            }
        }
        return view('client.viewCart')->with('total',$total);
    }
    public function storeProduct(Request $request)
    {
        
        $products=$this->product->with('discount')->with('files.file')->with('details');
        if($request->category_id){
            $product_ids=ProductCategory::whereIn('category_id',$request->category_id)->get('product_id')->toArray();
            //get arr collection product ID
            $func=function($value) {
                return $value['product_id'];
            };
            $product_ids=array_map($func,$product_ids);//da lay duoc mang product ID
            $products=$products->whereIn('id',$product_ids);
        }
        if($request->price_min){
            $products=$products->whereBetween('price',[$request->price_min,$request->price_max]);
        }
        if($request->product_sortBy){
            $products=$products->orderBy('price',$request->product_sortBy);
        }else{
            $products=$products->orderBy('id','desc');
        }
        if($request->product_paginate){
            $products=$products->paginate($request->product_paginate);
        }
        else{
           $products=$products->paginate(9); 
        }
        $products->appends([
            'category_id'=>$request->category_id,
            'price_min'=>$request->price_min,
            'price_max'=>$request->price_max,
            'product_sortBy'=>$request->product_sortBy,
            'product_paginate'=>$request->product_paginate
        ]);
        $categories=Category::where('type','mobile')->get();
        foreach ($categories as $category) {
            $category->count=ProductCategory::where('category_id',$category->id)->count();
        }
        $topsell=$products->sortByDesc(function ($product, $key) {
                return $product['price']*$product->discount->discount/100;
            
        });
        
        return view('client.store')->with('products',$products)->with('categories',$categories)->with('topsells',$topsell);
    }
}
