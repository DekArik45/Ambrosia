<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use Alert;
use App\Transaction;
use App\Admin;
use App\Notifications\Backend\AdminNotif;
use App\Product;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function index()
    {

        $this->data['transaction'] = Transaction::where('user_id',Auth::guard('customer')->user()->id)->get();
        $this->data['transaction_detail'] = Transaction::join("transaction_details",'transactions.id','transaction_details.transaction_id')
        ->join("products",'transaction_details.product_id','products.id')
        ->select("transaction_details.*","products.product_name",'products.price')
        ->where('transactions.user_id',Auth::guard('customer')->user()->id)
        ->orderBy('transactions.created_at','DESC')
        ->get();

        // return($this->data['transaction_detail']);

        $this->data['now'] = Carbon::now();

        // $duration = $end->diffInHours($start);

        return view('frontend.profile', $this->data);
    }

    public function uploadBukti($id, Request $request)
    {
        
        if($request->hasfile('bukti'))
        {
            $current_timestamp = Carbon::now()->timestamp;
            $file = $request->file('bukti');
            $name = $current_timestamp.$file->getClientOriginalName();
            $path = 'files/'. $name;
            // return $name;
            $file->move(public_path().'/files/', $name);

            Transaction::find($id)->update([
                'proof_of_payment' => $path
            ]);

            Alert::success('Success Message', 'Upload Success')->persistent("Close");
            $admin = Admin::find(1);
            $admin->notify(new AdminNotif("User ".Auth::guard('customer')->user()->name." telah meng-upload bukti pembayaran "));
            return redirect('/profile');
        }
        else {
            Alert::error('Error Message', 'make sure the file under 2mb')->persistent("Close");
            return redirect('/profile');
        }

    }

    public function updateStatus($id)
    {
        Transaction::find($id)->update([
            'status' => "success"
        ]);

        Alert::success('Success Message', 'Update Success')->persistent("Close");
        
        return redirect('/profile');
    }

    public function listReview($id)
    {
        $this->data['product'] = Product::join('transaction_details','transaction_details.product_id','products.id')
        ->join('transactions','transactions.id','transaction_details.transaction_id')
        ->join('product_images','products.id','product_images.product_id')
        ->select('products.*','product_images.image_name', 'transaction_details.status','transaction_details.id as id_detail')
        ->where('transactions.status','success')
        ->where('transactions.id',$id)
        ->where('transactions.user_id',Auth::guard('customer')->user()->id)
        ->groupBy('products.id')
        ->get();
        
        return view('frontend/list_review', $this->data);
    }
}
