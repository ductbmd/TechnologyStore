<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
	public $timestamps = false;
	protected $table='product_detail';
    protected $fillable = [
       'product_id','color','price','configuration','qty'
    ];
}
