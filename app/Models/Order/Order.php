<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='order';
    protected $fillable = [
       'user_id','status','total_amount','note'
    ];
    public function user()
    {
    	return $this->hasOne(\App\Models\UserInfo::class,'id','user_id');
    }
    public function detail()
    {
    	return $this->hasMany(\App\Models\Order\OrderDetail::class,'order_id','id');
    
    }
}