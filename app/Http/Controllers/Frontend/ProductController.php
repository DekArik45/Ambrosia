<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\ProductCategoryDetail;
use App\Discount;
use DB;
use App\ProductReview;

class ProductController extends Controller
{
    public function product($id_product)
    {
        $this->data['product_id'] = $id_product;
        $this->data['product'] = Product::where('id',$id_product)->first();
        $this->data['category'] = ProductCategoryDetail::join('product_categories','product_category_details.category_id','product_categories.id')
        ->where('product_id',$id_product)->get();
        
        $this->data['image'] = ProductImage::where('product_id',$id_product)->get();
        $this->data['discount'] = Discount::where('id_product',$id_product)->orderBy('id', 'DESC')->first();

        $this->data['review'] = ProductReview::where('product_id',$id_product)
        ->get();

        // return $this->data['review'];

        $this->data['count'] = ProductReview::where('product_id',$id_product)
        ->join('users','users.id','product_reviews.user_id')
        ->count();
        
        return view('frontend.product',$this->data);
    }

    
}
