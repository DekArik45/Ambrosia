@extends('backend.layouts.app')

@section('discount', 'active')
@section('master', 'active')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Discount</h3>
                    <button style="float:right;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-input">
                        <i class="fa fa-plus"></i> Add New Discount
                    </button>
                </div>
                <div class="box-body">
                    <table style="margin-top:10px;" id="discount" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product</th>
                                <th>Persentase</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discount as $item)
                                <tr class="data-row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="product_name">{{ $item->product_name }}</td>
                                    <td class="percentage">{{ $item->percentage }}</td>
                                    <td class="start">{{ $item->start }}</td>
                                    <td class="end">{{ $item->end }}</td>
                                    <td>
                                        <button type="button" id="edit-item" data-item-id="{{$item->id}}" class="btn btn-warning" title="Edit">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                        <form action="/admin/discount/{{$item->id}}" method="POST" id="form_delete" class="btn-group">
                                            @csrf
                                            @method("DELETE")
    
                                            <button type="button" id="delete" class="btn btn-danger" title="Delete">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
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

{{-- add modal --}}
<div id="modal-input" class="modal fade">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Discount</h4>
            </div>
            <form action="/admin/discount" method="POST">
                <div class="modal-body">
                    @csrf
                    
                    <div class="form-group">
                        <label >Product Name</label>
                        <select required class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="product_name[]">
                            @foreach ($product as $itemProduct)
                                <option value="{{$itemProduct->id}}">{{$itemProduct->product_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label >Percentage</label>
                        <input required type="number" name="percentage"  class="form-control" placeholder="Percentage" />
                    </div>
                    
                    <div class="form-group">
                        <label >Start</label>
                        <input required type="text" autocomplete="off" id="datepicker" name="start" class="form-control" placeholder="Start Date" />
                    </div>

                    <div class="form-group">
                        <label >End</label>
                        <input required type="text" autocomplete="off" id="datepicker1" name="end" class="form-control" placeholder="End Date" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

    {{-- edit modal --}}
<div class="modal fade" id="modal-default" >
    <div class="modal-dialog " >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Discount</h4>
            </div>
            <form id="edit-form"  method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label>Minimal</label>
                        <select class="form-control select2" style="width: 100%;">
                            @foreach ($product as $item)
                                <option value="{{$item->id}}" id="{{$item->id}}">{{$item->product_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Percentage</label>
                        <input type="number" name="percentage" class="form-control" id="modal-edit-percentage" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Start</label>
                        <input type="text" autocomplete="off" name="start" class="form-control edit-datepicker" id="modal-edit-start" required>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">End</label>
                        <input type="text" name="end" autocomplete="off" class="form-control edit-datepicker1" id="modal-edit-end" required>
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
        <!-- /Attachment Modal -->
@endsection

@section('script')
<script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset ("backend/bower_components/select2/dist/js/select2.full.min.js")}}"></script>
<script src="{{ asset ("backend/bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset ("backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
<script>
    $(function() {
        $("#discount").DataTable();
    });

</script>

<script>
$(document).ready(function() {
    $('.select2').select2()
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
    $('#datepicker1').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
    $('.edit-datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
    $('.edit-datepicker1').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
    /**
    * for showing edit item popup
    */

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
        var product_name = row.children(".product_name").text();
        var percentage = row.children(".percentage").text();
        var start = row.children(".start").text();
        var end = row.children(".end").text();

        $("#edit-form").attr('action', '/admin/discount/'+id);
        // fill the data in the input fields
        
        $("#modal-edit-name").val(product_name);
        $("#modal-edit-percentage").val(percentage);
        $("#modal-edit-start").val(start);
        $("#modal-edit-end").val(end);

    })

    // on modal hide
    $('#modal-default').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    })

    $(document).on('click', "#delete", function() {
        del = this;
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",            
            type: "warning",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            showCancelButton: true,
        }, function(value) {
            if (value) {
                $(del).closest("form").submit();
            }
        })
    });

    // $(document).on('click', "#edit", function() {
    //     var form = this;
    //     swal({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         type: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, Update it!'
    //     }, function(value) {
    //         if (value) {
    //             $(form).closest("form").submit();
    //         }
    //     })
    // });

})

</script>

@endsection