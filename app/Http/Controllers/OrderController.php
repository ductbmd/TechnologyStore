<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use App\User;
use App\Models\UserInfo;

use Illuminate\Support\Facades\DB;
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
    	
    	return response()->json(['success' => true,'message'=>$request->name], 200);
    	// DB::beginTransaction();
    	// try {
    		
    	// } catch (Exception $e) {
    	// 	DB::rollBack();
    	// }
    	// DB::commit();
    }
}
