<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $primary_key = 'id';
    protected $fillable = [
        'category_name',
    ];
}
