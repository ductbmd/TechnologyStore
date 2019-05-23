<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
	public $timestamps = false;
	protected $table='product_discount';
    protected $fillable = [
       'product_id','discount_id'
    ];
    public function product()
    {
    	return $this->hasMany(\App\Models\Product\Product::class,'id','product_id');
    }
    public function discount()
    {
    	return $this->hasMany(\App\Models\Discount::class,'id','discount_id');
    }
}
