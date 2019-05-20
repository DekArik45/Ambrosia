<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use Alert;

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

        Transaction::find($id)->update([
            'status' => $request->status
        ]);

        Alert::success('Success Message', 'Update Success')->persistent("Close");
        return redirect('/admin/transaksi');
    }
}
