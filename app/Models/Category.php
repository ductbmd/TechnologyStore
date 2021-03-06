<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public $timestamps = false;
    protected $table='category';
    protected $fillable = [
        'name','type'
    ];
    public function product()
    {
    	return $this->hasMany(\App\Models\Product\ProductCategory::class,'category_id','id');
    }
    public function laptop()
    {
    	return $this->hasMany(\App\Models\Laptop\LaptopCategory::class,'category_id','id');
    }
    
}