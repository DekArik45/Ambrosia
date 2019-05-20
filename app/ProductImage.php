<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $primary_key = 'id';
    protected $fillable = [
        'product_id','image_name',
    ];
}
