@extends('backend.layouts.app')

@section('transaksi_pertahun', 'active')
@section('laporan', 'active')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Report PerTahun</h3>
                </div>
                <div class="box-body">
                    <table style="margin-top:10px;" id="courier" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tahun</th>
                                <th>Jumlah Transaksi</th>
                                <th>Total Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report as $item)
                                <tr class="data-row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="courier">{{ $item->tahun }}</td>
                                    <td class="courier">{{ $item->jumlah_transaksi }}</td>
                                    <td class="courier">{{ number_format($item->total_transaksi,0,',','.') }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection