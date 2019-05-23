<?php

namespace App\Models\Laptop;

use Illuminate\Database\Eloquent\Model;

class LaptopFile extends Model
{
	public $timestamps = false;
	protected $table='laptop_file';
    protected $fillable = [
       'laptop_id','file_id'
    ];
    public function file()
    {
    	return $this->hasOne(\App\Models\File::class,'id','file_id');
    }
}
