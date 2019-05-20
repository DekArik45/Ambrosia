<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use Alert;
use App\Transaction;

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
            return redirect('/profile');
        }
        else {
            Alert::error('Error Message', 'make sure the file under 2mb')->persistent("Close");
            return redirect('/profile');
        }

    }
}
