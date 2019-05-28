<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
	protected $table='order_detail';
	
    protected $fillable = [
       'user_id','sex','birth','address','avatar','first_name','last_name','city','country','zip_code','phone'
    ];
}
