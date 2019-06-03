<?php

namespace App\Models\Laptop;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */	
    public $timestamps = false;
    protected $table='laptop';
    protected $fillable = [
        'name','CPU','RAM','ROM','monitor','connection_port','GPU','specical','design','size','OS','price','description','qty','discount_id'
    ];
    public function files()
    {
    	return $this->hasMany(\App\Models\Laptop\LaptopFile::class,'laptop_id','id');
    }
    public function category()
    {
        return $this->hasMany(\App\Models\Laptop\LaptopCategory::class,'laptop_id','id');
    }
    public function discount()
    {
        return $this->hasOne(\App\Models\Discount::class,'id','discount_id');
    }
    
}
