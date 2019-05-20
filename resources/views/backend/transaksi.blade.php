@extends('backend.layouts.app')

@section('response', 'active')
@section('master', 'active')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transaction</h3>
                    </div>
                    
                    <div class="box-body">
                        <table style="margin-top:10px;" id="review1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Sub Total</th>
                                    <th>Shipping</th>
                                    <th>Total</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $data)
                                    <tr class="data-row">
                                        <td class="user_name">{{ $data->user->name }}</td>
                                        <td class="product_name">
                                            <ul>
                                            @foreach ($data->product_detail as $item)
                                                <li>{{ $item->product_name }}</li>
                                            @endforeach                  
                                            </ul>
                                        </td>                      
                                        <td class="rate">Rp. {{ number_format($data->sub_total,0,',','.') }}</td>
                                        <td class="content">Rp. {{ number_format($data->shipping_cost,0,',','.') }}</td>
                                        <td class="content">Rp. {{ number_format($data->total,0,',','.') }}</td>
                                        <td style="text-align:center;"><img style="width:100px;" src="/{{$data->proof_of_payment}}" alt=""></td>
                                        <td class="status">{{$data->status}}</td>
                                        <td style="text-align:center;">
                                            <button type="button" id="edit-item" data-item-id="{{$data->id}}" class="btn btn-warning" title="Edit">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-default" >
        <div class="modal-dialog " >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Status Transaction</h4>
                </div>
                <form id="edit-form"  method="POST">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <div class="form-group">

                            <label class="col-form-label">Status</label>
                            <select required class="form-control select2" id="modal-edit-status" data-placeholder="Select a State" style="width: 100%;" name="status">
                                <option value="delivered">Delivered</option>
                                <option value="expired">Expired</option>
                                <option value="success">Success</option>
                                <option value="unverified">UnVerified</option>
                                <option value="verified">Verified</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="edit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@section('script')
<script src="{{ asset ("backend/bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset ("backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>

<script>
    $(function() {
        $("#review1").DataTable();
        $('.select2').select2()
    });

    $(document).on('click', "#edit-item", function() {
        $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
        'backdrop': 'static'
        };
        $('#modal-default').modal(options)
    })

    // on modal show
    $('#modal-default').on('show.bs.modal', function() {
        
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
        var row = el.closest(".data-row");

        // get the data
        var id = el.data('item-id');
        var courier = row.children(".status").text();
        $("#edit-form").attr('action', '/admin/transaksi/'+id);
        // fill the data in the input fields
        
        $("#modal-edit-status").val(courier);

    })

    // on modal hide
    $('#modal-default').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    })
    
</script>
@endsection