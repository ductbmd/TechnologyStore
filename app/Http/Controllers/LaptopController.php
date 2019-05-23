<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop\Laptop;
use App\Models\Cart\Cart;
use Session;
class LaptopController extends Controller
{
	private $model;

	public function __construct(Laptop $model)
    {
        // $this->middleware('auth', ['except'=>[]]);
        $this->model = $model;
        
    }

    public function index()
    {
    	return view('laptop.index');
    }
    public function store(Request $request)
    {
    	
    }
    public function getAddToCart(Request $request,$id)
    {
        // dd(Session::get('cart')->items);
        $laptop=$this->model->with('files.file')->find($id);
        $oldCart=Session::has('cart')?Session::get('cart'): null;
        $cart=new Cart($oldCart);
        $cart->addLaptop($laptop,$request->qty);
        $request->session()->put('cart',$cart);
        return redirect()->back();

    }
    public function getSubToCart(Request $request,$id)
    {
        $oldCart=Session::has('cart')?Session::get('cart'): null;
        $cart=new Cart($oldCart);
        $cart->subLaptop($id);
        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
   
}
