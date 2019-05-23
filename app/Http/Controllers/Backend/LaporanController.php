<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function perTahun()
    {
        $this->data['report'] = Transaction::select(DB::raw('YEAR(created_at) as tahun'),DB::raw('count(*) as jumlah_transaksi'), DB::raw('sum(total) as total_transaksi'))
        ->where('status','success')
        ->groupBy(DB::raw('YEAR(created_at)'))
        ->get();

        return view('backend.report.transaksi_pertahun', $this->data);
    }

    public function perBulan()
    {
        $this->data['report'] = Transaction::select(DB::raw('YEAR(created_at) as tahun'), DB::raw('MONTH(created_at) as bulan'),DB::raw('count(*) as jumlah_transaksi'), DB::raw('sum(total) as total_transaksi'))
        ->where('status','success')
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->get();

        return view('backend.report.transaksi_perbulan', $this->data);
    }

}
