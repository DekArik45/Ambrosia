<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';
    protected $primary_key = 'id';
    protected $fillable = [
        'transaction_id','product_id','qty','discount','selling_price',
    ];
}
