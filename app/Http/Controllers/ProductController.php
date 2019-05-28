<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Cart\Cart;
use Session;
class ProductController extends Controller
{
	private $model;

	public function __construct(Product $model)
    {
        // $this->middleware('auth', ['except'=>[]]);
        $this->model = $model;
        
    }

    public function index()
    {
    	return view('product.index');
    }
    public function store(Request $request)
    {
    	
    }
    public function getAddToCart(Request $request,$id)
    {
        // dd(Session::get('cart')->items);
        $product=$this->model->with('files.file')->with('discount')->find($id);
        $oldCart=Session::has('cart')?Session::get('cart'): null;
        $cart=new Cart($oldCart);
        $cart->addProduct($product,$request->detail_id,$request->qty);
        $request->session()->put('cart',$cart);
        
        return redirect()->back();
    }
    public function getSubToCart(Request $request,$id)
    {
        $oldCart=Session::has('cart')?Session::get('cart'): null;
        $cart=new Cart($oldCart);
        $cart->subProduct($id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
   
}
