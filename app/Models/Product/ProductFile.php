<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductFile extends Model
{
	public $timestamps = false;
	protected $table='product_file';
    protected $fillable = [
       'product_id','file_id'
    ];
    public function file()
    {
    	return $this->hasOne(\App\Models\File::class,'id','file_id');
    }
}
