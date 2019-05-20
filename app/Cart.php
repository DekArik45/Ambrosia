<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primary_key = 'id';
    protected $fillable = [
        'user_id','product_id','qty','status',
    ];
}
