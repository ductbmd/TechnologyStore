<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class ProductDiscount extends Model
{
	public $timestamps = false;
	protected $table='product_discount';
    protected $fillable = [
       'product_id','discount_id'
    ];
    public function product()
    {
    	return $this->hasOne(\App\Models\Product\Product::class,'id','product_id');
    }
    public function discount()
    {
    	return $this->hasOne(\App\Models\Discount::class,'id','discount_id');
    }
    
}
