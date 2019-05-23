<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductDetail;
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
        $product=$this->product->with('files.file')->with('company')->with('details')->where('id',$id)->first();
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
                $price=$product_cart['price']*0.7*$product_cart['qty'];
                    $total+=$price;
            }
        }
        if($cart->laptops){
            foreach ($cart->laptops as $key => $product_cart) {
                $price=$product_cart['price']*0.7*$product_cart['qty'];
                    $total+=$price;
            }
        }
        
        return view('client.checkout')->with('prices',$prices)->with('total',$total);
    }
    public function viewCart()
    {
        $cart=Session::get('cart');
        // dd($cart);
        $total=0;
        $prices=array();//Gia cua cac san pham
        // if($cart->items){
        //     foreach ($cart->items as $key => $product_cart) {
            
        //     $discount=Discount::where('product_id',$key)
        //     ->whereDate('time_start','<=',Carbon::today())
        //     ->whereDate('time_expired','>=',Carbon::today())
        //     ->max('discount');
        //     if(!$discount) $discount=0;//Khong co khuyen mai

        //     $detail=ProductDetail::find($key);
        //     $price=($product_cart['price']+$detail->price-(float)$product_cart['price']*30/100)*$product_cart['qty'];
        //     $total+=$price;
        //     $prices[$key]=['discount'=>$discount,'price'=>$price,'more'=>$detail->price];//Thong tin gia cua san pham
        // }
        //}
        if($cart->items){
            foreach ($cart->items as $key => $product_cart) {
                $price=$product_cart['price']*0.7*$product_cart['qty'];
                    $total+=$price;
            }
        }
        if($cart->laptops){
            foreach ($cart->laptops as $key => $product_cart) {
                $price=$product_cart['price']*0.7*$product_cart['qty'];
                    $total+=$price;
            }
        }
        return view('client.viewCart')->with('prices',$prices)->with('total',$total);
    }
    public function storeProduct(Request $request)
    {
        $category=Category::where('type','mobile')->get();

        $products=$this->product->with('maxDiscount')->with('files.file')->with('details')->orderBy('id','desc')->paginate(9);
        return view('client.store')->with('products',$products)->with('categories',$category);
    }
}
