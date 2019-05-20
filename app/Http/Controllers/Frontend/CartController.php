<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Cart;
use Cookie;
use App\Product;
use App\ProductImage;

class CartController extends Controller
{

    public function cart()
    {
        return view('frontend.cart');
    }

    public function deleteItem($id)
    {
        $data_cookie = json_decode(Cookie::get('cart'));
        $carts = array();
        foreach ($data_cookie as $value) {
            if ($id == $value->product_id) {
                unset($carts[$value->product_id]);
            }
            else{
                $carts[$value->product_id] = array(
                    'product_id'=>$value->product_id,
                    'product_name' => $value->product_name,
                    'image_name' => $value->image_name,
                    'price' =>$value->price,
                    'discount' => $value->discount,
                    'selling' => $value->selling,
                    'weight' =>$value->weight,
                    'qty' => $value->qty,
                );
            }
        }

        $minutes = 60*60*24*30;
        Cookie::queue(Cookie::make('cart', json_encode($carts), $minutes));
        return redirect()->back();
        // $get_cookie = json_decode(Cookie::get('cart'));

        // if ($get_cookie != null) {
            // return response()->json($get_cookie);
        // }

        // $response = array(
        //     'product_id'=>"",
        //     'product_name' => "",
        //     'image_name' => "",
        //     'price' =>"",
        //     'qty' => "",
        // );

        // return response()->json($response);
    }

    public function getItem()
    {
        $data_cookie = json_decode(Cookie::get('cart'));
        if ($data_cookie != null) {

            return response()->json($data_cookie);
        }

        $response = array(
            'product_id'=>"",
            'product_name' => "",
            'image_name' => "",
            'price' =>"",
            'discount' => "",
            'selling' => "",
            'weight' =>"",
            'qty' => "",
        );

        return response()->json($response);
    }

    public function addItem(Request $request)
    {
        // dd($request->product_id);
        if($request->ajax())
        {
            
            $data_cookie = json_decode($request->cookie('cart'));
            
            $carts = array();
            $data = Product::where('products.id',$request->product_id)
            ->join('product_images','product_images.product_id','products.id')
            ->select('products.*','product_images.image_name')
            ->groupBy('products.id')
            ->first();
            
            if ($data_cookie == null) {
                $carts[$request->product_id] = array(
                    'product_id'=>$data->id,
                    'product_name' => $data->product_name,
                    'image_name' => $data->image_name,
                    'price' =>$data->price,
                    'discount' => $request->discount,
                    'selling' => $request->selling,
                    'weight' =>$data->weight,
                    'qty' => $request->qty,
                );
            }
            else{
                
                foreach ($data_cookie as $key) {
                    $carts[$key->product_id] = array(
                        'product_id'=>$key->product_id,
                        'product_name' => $key->product_name,
                        'image_name' => $key->image_name,
                        'price' =>$key->price,
                        'discount' => $key->discount,
                        'selling' => $key->selling,
                        'weight' =>$key->weight,
                        'qty' => $key->qty,
                    );

                    if ($request->qty == 0) {
                        unset($carts[$request->product_id]);
                    }
                    else{
                        $carts[$request->product_id] = array(
                            'product_id'=>$data->id,
                            'product_name' => $data->product_name,
                            'image_name' => $data->image_name,
                            'price' =>$data->price,
                            'discount' => $request->discount,
                            'selling' => $request->selling,
                            'weight' =>$data->weight,
                            'qty' => $request->qty,
                        );
                    }
                    // }
                }
            }

            

            // Cookie::queue(Cookie::forever('cart', "asd"));
            // Cookie::queue(Cookie::forever('region2', $region2));

            $minutes = 60*60*24*30;
            Cookie::queue(Cookie::make('cart', json_encode($carts), $minutes));
            $gg = json_decode($request->cookie('cart'));

            $response = array(
                'status' => "success",
                'cook' => $gg,
            );
            return response()->json($response); 
        }
    }
}
