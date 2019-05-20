<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryDetail extends Model
{
    protected $table = 'product_category_details';
    protected $primary_key = 'id';
    protected $fillable = [
        'product_id','category_id',
    ];
}
