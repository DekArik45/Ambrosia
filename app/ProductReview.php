<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $table = 'product_reviews';
    protected $primary_key = 'id';
    protected $fillable = [
        'product_id','user_id','rate','content',
    ];

    public function response()
    {
        return $this->hasMany(Response::class, 'review_id');
    }

    public function user()
    {
        return $this->belongsTo(Customer::class);
    }
}
