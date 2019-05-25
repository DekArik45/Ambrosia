<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use Alert;
use App\Customer;
use Auth;
use App\Notifications\Frontend\UserNotif;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $this->data['transaksi'] = Transaction::get();

        return view('/backend/transaksi', $this->data);
    }

    public function updateStatus($id, Request $request)
    {
        $data = Transaction::find($id);
        $user = Customer::find($data->user_id);
        
        Transaction::find($id)->update([
            'status' => $request->status
        ]);
        
        $user->notify(new UserNotif("<a href='/profile'>Admin Already ".$request->status." your transaction</a>"));
        Alert::success('Success Message', 'Update Success')->persistent("Close");
        return redirect('/admin/transaksi');
    }
}
