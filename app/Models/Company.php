<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table='company';
	public $timestamps = false;
    protected $fillable = [
       'name','description','file_id','country'
    ];
}
