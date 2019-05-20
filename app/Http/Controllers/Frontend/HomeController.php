<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;

class HomeController extends Controller
{
    public function index()
    {
        $this->data['product'] = Product::join('product_category_details','products.id','product_category_details.product_id')
        ->join('product_categories','product_category_details.category_id','product_categories.id')
        ->join('product_images','products.id','product_images.product_id')
        ->join('discounts','products.id','discounts.id_product')
        ->select('products.*','product_categories.*','product_images.*')
        ->get();

        $this->data['image'] = ProductImage::join('products','products.id','product_images.product_id')
        ->orderBy('product_id','DESC')
        ->groupBy('product_id')
        ->take('2')
        ->get();

        return view('frontend.index', $this->data);
    }
}
