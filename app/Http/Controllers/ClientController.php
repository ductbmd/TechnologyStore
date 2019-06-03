<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductDetail;
use App\Models\Product\ProductCategory;
use App\Models\Laptop\Laptop;
use App\Models\Laptop\LaptopCategory;
use App\Models\Discount;
use App\Models\Category;
use Session;
use Carbon\Carbon;
use App\Models\Comment;
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
        $product=$this->product->with('files.file')->with('company')->with('discount')->with('details')->with('category')->where('id',$id)->first();
        //lay list category_id de tim cac relative product
        $category_ids=$product->category->toArray();
        $func=function($value) {
            return $value['category_id'];
        };
        $category_ids=array_map($func,$category_ids);//lay list id category
        $product_ids=ProductCategory::whereIn('category_id',$category_ids)->where('product_id','!=',$product->id)->get('product_id')->toArray();
        $func_prdId=function($value) {
            return $value['product_id'];
        };
        $product_ids=array_map($func_prdId,$product_ids);//da lay duoc mang product ID lien quan 
        $product_relative=$this->product->whereIn('id',$product_ids)->with('discount')->with('files.file')->with('details')->take(4)->get();
        //end lấy list các sản phẩm liên quan
        //Lấy ra các comment và đánh giá
        //vì khi phân trang thống kê bị ảnh hưởng nên phải tách ra tính toán bằng comments_count còn kết quả ở comments
        $comments_count=Comment::where('product_id',$product->id)->where('type','mobile')->get();
        $comments=Comment::where('product_id',$product->id)->where('type','mobile')->paginate(3);
        $comments->count=['sum'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0];
        $comments->rate=5;
        if($comments->count()!=0){
            $count=['sum'=>$comments_count->count()];//tong so rate
            for($i=1;$i<=5;$i++){
                $count[$i]=$comments_count->where('rating',$i)->count();
            }
        //Dem so comment tu 1* den 5*
            $comments->count=$count;
            $comments->rate=round($comments_count->sum('rating')/$comments_count->count(),1);
        }
        // dd($comments->count['sum']);
        // dd($product);
        // dd($comments);
        // dd(Session::get('cart'));
        return view('client.product')->with('product',$product)->with('product_relatives',$product_relative)->with('comments',$comments);
    }
    public function laptop($id){
        $laptop=$this->laptop->with('files.file')->with('discount')->with('category')->where('id',$id)->first();
        //lay list category_id de tim cac relative product
        $category_ids=$laptop->category->toArray();
        $func=function($value) {
            return $value['category_id'];
        };
        $category_ids=array_map($func,$category_ids);//lay list id category
        $laptop_ids=LaptopCategory::whereIn('category_id',$category_ids)->where('laptop_id','!=',$laptop->id)->get('laptop_id')->toArray();
        $func_lapId=function($value) {
            return $value['laptop_id'];
        };
        $laptop_ids=array_map($func_lapId,$laptop_ids);//da lay duoc mang product ID lien quan 
        $product_relative=$this->laptop->whereIn('id',$laptop_ids)->with('discount')->with('files.file')->take(4)->get();
        //end lấy list các sản phẩm liên quan
        //Lấy ra các comment và đánh giá
        //vì khi phân trang thống kê bị ảnh hưởng nên phải tách ra tính toán bằng comments_count còn kết quả ở comments
        $comments_count=Comment::where('product_id',$laptop->id)->where('type','laptop')->get();
        $comments=Comment::where('product_id',$laptop->id)->where('type','laptop')->paginate(3);
        $comments->count=['sum'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0];
        $comments->rate=5;
        if($comments->count()!=0){
            $count=['sum'=>$comments_count->count()];//tong so rate
            for($i=1;$i<=5;$i++){
                $count[$i]=$comments_count->where('rating',$i)->count();
            }
        //Dem so comment tu 1* den 5*
            $comments->count=$count;
            $comments->rate=round($comments_count->sum('rating')/$comments_count->count(),1);
        }
         // dd($laptop);
        // dd(Session::get('cart'));
        return view('client.laptop')->with('laptop',$laptop)->with('product_relatives',$product_relative)->with('comments',$comments);
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
        // dd($cart);
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

    })->take(5);

    return view('client.store')->with('products',$products)->with('categories',$categories)->with('topsells',$topsell);
}
public function storeLaptop(Request $request)
{
    $products=$this->laptop->with('discount')->with('files.file');
    if($request->category_id){
        $product_ids=LaptopCategory::whereIn('category_id',$request->category_id)->get('laptop_id')->toArray();
            //get arr collection product ID
        $func=function($value) {
            return $value['laptop_id'];
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
     $categories=Category::where('type','laptop')->get();
     foreach ($categories as $category) {
        $category->count=LaptopCategory::where('category_id',$category->id)->count();
    }

    $topsell=$products->sortByDesc(function ($product, $key) {
        return $product['price']*$product->discount->discount/100;

    })->take(5);
        // dd($topsell);
    return view('client.storeLaptop')->with('products',$products)->with('categories',$categories)->with('topsells',$topsell);
}
public function Comment(Request $request)
{
    $input=$request->except("_token");
    Comment::Create($input);
    if($input['type']){
        return redirect()->route('client.laptop',$request->product_id);
    }
    return redirect()->route('client.product',$request->product_id);
}
}
