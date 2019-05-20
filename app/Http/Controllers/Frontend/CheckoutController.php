<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use App\Courier;
use RajaOngkir;
use Auth;
use Alert;
use Carbon\Carbon;
use App\Transaction;
use App\TransactionDetail;
use App\Cart;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function checkout()
    {
        $this->data['data_cookie'] = json_decode(Cookie::get('cart'));
        $this->data['total_price'] = 0;
        $this->data['total_weight'] = 0;
        foreach ($this->data['data_cookie'] as $key) {
            $this->data['total_price'] +=  $key->selling * $key->qty;
            $this->data['total_weight'] += $key->weight * $key->qty;
        }

        $this->data['data_courier'] = Courier::get();

        $this->data['data_kota'] = RajaOngkir::Kota()->all();
        
        return view('frontend.checkout', $this->data);
    }

    public function checkedout(Request $request)
    {
        $i = 0;
        
        $destination = RajaOngkir::Kota()->search('city_name', $name = $request->kota)->get();
        
        foreach ($destination as $data) {
            if ($i == 0) {
                $data_destination = $data['city_id'];
                $province = $data['province'];
                $city = $data['city_name'];
            }
            $i++;
        }
        // return $request;

        $user_id = Auth::guard('customer')->user()->id;

        $data_courier = Courier::where('courier',$request->courier)->first();
        $id_courier = $data_courier->id;

        $courier = strtolower($request->courier);

        $data = RajaOngkir::Cost([
            'origin' 		=> 114, // id kota asal denpasar
            'destination' 	=> $data_destination, // id kota tujuan
            'weight' 		=> $request->weight, // berat satuan gram
            'courier' 		=> $courier, // kode kurir pengantar ( jne / tiki / pos )
        ])->get();

        $shipping_cost = $data[0]['costs'][0]['cost'][0]['value'];

        $total = $shipping_cost + $request->sub_total;
        $now = Carbon::now();
        $dateTimeOut = $now->addDays(1);
        $transaksi = new Transaction;
        $transaksi->timeout = $dateTimeOut;
        $transaksi->address = $request->alamat;
        $transaksi->regency = $city;
        $transaksi->province = $province;
        $transaksi->total = $total;
        $transaksi->shipping_cost = $shipping_cost;
        $transaksi->sub_total = $request->sub_total;
        $transaksi->user_id = $user_id;
        $transaksi->courier_id = $id_courier;
        $transaksi->status = 'unverified';
        $transaksi->save();

        //delete the cookie and save to detail
        $cookie = json_decode(Cookie::get('cart'));
        $carts = array();
        foreach ($cookie as $value) {
            $detail = new TransactionDetail;
            $detail->transaction_id = $transaksi->id;
            $detail->product_id = $value->product_id;
            $detail->qty = $value->qty;
            $detail->discount = $value->discount;
            $detail->selling_price = $value->selling;
            $detail->save();

            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $value->product_id;
            $cart->qty = $value->qty;
            $cart->status = "checkedout";
            $cart->save();

            unset($carts[$value->product_id]);
        }

        $minutes = 60*60*24*30;
        Cookie::queue(Cookie::make('cart', json_encode($carts), $minutes));

        Alert::success('Success Message',"Transaction success");
        return redirect('/profile');
    }

    public function shipping(Request $request)
    {
        $i = 0;
        $destination = RajaOngkir::Kota()->search('city_name', $name = $request->destination)->get();
        foreach ($destination as $data) {
            if ($i == 0) {
                $data_destination = $data['city_id'];
            }
            $i++;
        }
        $courier = strtolower($request->courier);
        $data = RajaOngkir::Cost([
            'origin' 		=> 114, // id kota asal denpasar
            'destination' 	=> $data_destination, // id kota tujuan
            'weight' 		=> $request->weight, // berat satuan gram
            'courier' 		=> $courier, // kode kurir pengantar ( jne / tiki / pos )
        ])->get();
        
        $response = array(
            'status' => 'success',
            'cost' => $data[0]['costs'][0]['cost'][0]['value']
        );

        return response()->json($response);;
    }
}
