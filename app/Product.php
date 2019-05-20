<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primary_key = 'id';
    protected $fillable = [
        'product_name','price','description','product_rate','stock','weight',
    ];

    public function product_discount()
    {
        return $this->hasMany(Discount::class);
    }

    public function transaction_detail()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_details');
    }
}
