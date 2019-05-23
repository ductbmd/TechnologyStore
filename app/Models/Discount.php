<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
	protected $table='discount';
    protected $fillable = [
       'time_start','time_expired','discount','created_by','created_at','updated_at','type','description'
    ];
    public function product()
    {
    	return $this->hasMany(\App\Models\Product\ProductDiscount::class,'discount_id','id');
    }
    public function laptop()
    {
    	return $this->hasMany(\App\Models\Laptop\LaptopDiscount::class,'discount_id','id');
    }
}
