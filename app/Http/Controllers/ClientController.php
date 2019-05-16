<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductDetail;
use App\Models\Discount;
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
    public function __construct(Product $product)
    {
        $this->product=$product;
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
        $product=$this->product->with('files.file')->with('company')->with('details')->where('id',$id)->first();
        // dd($product);
        return view('client.product')->with('product',$product);
    }
    public function checkout()
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
    public function viewCart()
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
        
        return view('client.viewCart')->with('prices',$prices)->with('total',$total);
    }
}
