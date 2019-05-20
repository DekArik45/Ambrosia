<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductReview;
use DB;
use Auth;
use App\Discount;

class ProductReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function productReview($id)
    {
        $this->data['product'] = Product::join('product_images','products.id','product_images.product_id')
        ->where('products.id',$id)
        ->select('products.*','product_images.image_name')
        ->first();
        
        $discount = Discount::join('products','products.id','discounts.id_product')
        ->where('products.id',$id)
        ->where('discounts.status','1')
        ->select(DB::raw('(products.price - (products.price * discounts.percentage / 100)) as selling_price'))
        ->get();

        if (count($discount) > 0) {
            foreach ($discount as $key) {
                $this->data['selling_price'] = $discount->selling_price;
            }
        }
        else{
            $this->data['selling_price'] = 0;
        }
        return view('frontend.product_review',$this->data);
        
    }

    public function store(Request $request)
    {
        $review = new ProductReview;
        $review->product_id = $request->product_id;
        $review->user_id = Auth::guard('customer')->user()->id;
        $review->content = $request->content;
        $review->rate = $request->rate;
        $review->save();

        $data = ProductReview::where('product_id',$request->product_id)
        ->select(DB::raw('avg(rate) as product_rate'))
        ->first();

        Product::find($request->product_id)->update([
            'product_rate' => $data->product_rate,
        ]);

        return redirect()->back();
    }
}
