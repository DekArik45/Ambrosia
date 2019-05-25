<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Product;
use App\Transaction;
use App\Customer;
use DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['product'] = Product::select(DB::raw('count(*) as total_product'))->first();
        $this->data['bulanall'] = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        $this->data['transaction'] = Transaction::select(DB::raw('count(*) as jumlah_transaksi'), DB::raw('sum(total) as total_transaksi'))->first();

        $this->data['user'] = Customer::select(DB::raw('count(*) as jumlah_user'))->first();

        $this->data['chart'] = Transaction::select(DB::raw('sum(total) as total_transaksi'), DB::raw('MONTH(created_at) as bulan'), DB::raw('YEAR(created_at) as tahun'))
        ->where(DB::raw('YEAR(created_at)'), DB::raw('YEAR(NOW())'))
        ->where('status','success')
        ->groupBy('bulan')
        ->get();        

        $this->data['jumlah'] = Transaction::select(DB::raw('count(*) as jumlah'))->first();

         // return $this->data['chart'];

        return view('backend.dashboard',$this->data);
    }

    public function clearNotif(){
        
        Auth::guard('admin')->user()->unreadNotifications()->update(['read_at' => now()]);
    }
}
