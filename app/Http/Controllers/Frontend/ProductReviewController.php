<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductReview;
use App\Notifications\Frontend\UserNotif;
use Notification;
use App\Admin;
use App\Notifications\Backend\AdminNotif;
use DB;
use Alert;
use Auth;
use App\Discount;
use App\TransactionDetail;

class ProductReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function productReview($id)
    {
        $id_product = TransactionDetail::join('products','products.id','transaction_details.product_id')
        ->where('transaction_details.id',$id)
        ->select('products.*','transaction_details.status')
        ->first();
        

        $this->data['product'] = Product::join('product_images','products.id','product_images.product_id')
        ->where('products.id',$id_product->id)
        ->select('products.*','product_images.image_name')
        ->first();

        $this->data['id_detail'] = $id;

        // $this->data['selling_price'] = 0;
        
        $discount = Discount::join('products','products.id','discounts.id_product')
        ->where('products.id',$id_product->id)
        ->where('discounts.status','1')
        ->select(DB::raw('(products.price - (products.price * discounts.percentage / 100)) as selling_price'))
        ->get();
        
        if (count($discount) > 0) {
            foreach ($discount as $key) {
                $this->data['selling_price'] = $key->selling_price;
            }
        }
        else{
            $this->data['selling_price'] = 0;
        }
        

        return view('frontend.product_review',$this->data);
        
    }

    public function store(Request $request)
    {
        return $request;
        
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

        TransactionDetail::find($request->transaction_detail_id)->update([
            'status' => '1'
        ]);

        $admin = Admin::find(1);
        $product_name = Product::find($request->product_id)->select('product_name')->first();
        $admin->notify(new AdminNotif("Terdapat Review Pada Product ".$product_name->product_name." oleh ".$request->name));

        Alert::success('Success Message', 'Review Success')->persistent("Close");

        return redirect('/profile');
    }
}
