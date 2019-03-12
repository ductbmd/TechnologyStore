<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id','name','description','size','OS','camera_front','camera_back','CPU','RAM','ROM','memory_card','SIM_card','Pin','GPU','headphone_jack'
    ];
}
