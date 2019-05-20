@extends('frontend.layouts.app')
@section('profile','current-menu-item')

@section('content')
    <!-- SUB BANNER -->
    <section class="sub-banner text-center section">
        <div class="awe-parallax bg-3"></div>
        <div class="awe-title awe-title-3">
            <h3 class="lg text-uppercase">Profile</h3>
        </div>
    </section>
    <!-- END / SUB BANNER -->

    <!-- CONTACT US -->
    <section id="contact" class="contact section">

        <div class="contact-form contact-form-2">
            <div class="divider divider-2"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <address class="find-us">
                            <span class="md">My Profile Data</span>
                            <div class="location-1" style="padding-left: 0px;
                            /* text-align: center; */
                            margin-top: 8px;
                            float: left;">
                                <img style="width: 130px;
                                /* height: auto; */
                                border-radius: 13%;
                                margin-right: 20px;" src="/{{Auth::guard('customer')->user()->profile_image}}" alt="">
                            </div>

                            <div class="location-1" style="    margin-top: 20px;
                            margin-bottom: 10px;">
                                <strong>{{Auth::guard('customer')->user()->name}}</strong>
                            </div>

                            <div class="location-1" style="margin:0px;">
                                <strong>{{Auth::guard('customer')->user()->email}}</strong>
                            </div>
                        </address>
                    </div>
                    <div class="col-md-8">
                        <div class="form-row">
                            <table id="profile" style="font-size:14px;" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Time Out</th>
                                        <th>Product</th>
                                        <th>Sub Total</th>
                                        <th>Shipping</th>
                                        <th>Total</th>
                                        <th>Bukti Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($transaction as $data)
                                    <tr>
                                        @if ($data->status == 'success')
                                            <td style="width:50px;">Transaction Success</td>
                                        @elseif ($data->status == 'expired')
                                            <td style="width:50px;">Transaction Has Been Expired</td>
                                        @elseif ($data->status == 'delivered')
                                            <td style="width:50px;">Transaction Has Been Delivered</td>
                                        @elseif ($data->status == 'verified')
                                            <td style="width:50px;">Transaction Has Been Verified</td>
                                        @elseif ($data->status == 'unverified')
                                            @if ($data->proof_of_payment != null)
                                            <td style="width:50px;">Transaction UnVerified</td>
                                            @else
                                                <td style="width:50px;" id="timeout{{$data->id}}"></td>
                                            @endif
                                        @endif        
                                        <td>
                                            <table>
                                                @foreach ($transaction_detail as $item)
                                                    @if ($data->id === $item->transaction_id)
                                                        <tr>
                                                            <td style="width:93%;">
                                                                {{$item->product_name}}
                                                            </td>
                                                            <td style="width:10%;">
                                                                x{{$item->qty}} 
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                
                                            </table>
                                        </td>
                                        <td>Rp. {{number_format($data->sub_total,0,',','.')}}</td>
                                        <td>Rp. {{number_format($data->shipping_cost,0,',','.')}}</td>
                                        <td>Rp. {{number_format($data->total,0,',','.')}}</td>
                                        @if ($data->proof_of_payment != null)
                                            <td style="text-align:center; width:90px;"><img style="width:75px;" src="{{$data->proof_of_payment}}" alt=""></td>
                                        @else
                                            <td style="text-align:center;"><button id="upload-bukti" data-item-id="{{$data->id}}" data-toggle="modal" data-target="#modal-input-image" class="btn btn-primary" alt="upload bukti"><i style="font-size:20px;" class="fa fa-upload"></i></button>    </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- END / CONTACT US -->
@endsection

@section('script')
<div id="modal-input-image" class="modal fade">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Upload Bukti Pembayaran</h4>
                </div>
                <form action="" method="POST" id="uploadForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method("PUT")
                        
                        <div class="form-group">
                            <label for="single-bukti-label" id="single-bukti-click-label">Bukti Pembayaran</label>
                            <label for="single-bukti" id="single-bukti-label" class="form-control"  style="font-weight: normal">Click to select the image</label>
                            <input type="file" required name="bukti" id="single-bukti" required accept="image/*" style="display:none;" />
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

<script src="{{ asset ("backend/bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset ("backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
<script>
    $(function() {
        $("#profile").DataTable();
    });

        //input image
    $(document).on('click', "#upload-bukti", function() {
        $(this).addClass('upload-bukti-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
        var options = {
        'backdrop': 'static'
        };
        $('#modal-input-image').modal(options)
    })
    // on modal show
    $('#modal-input-image').on('show.bs.modal', function() {
        var el = $(".upload-bukti-clicked"); // See how its usefull right here? 
        // get the data
        var id = el.data('item-id');
        $("#uploadForm").attr('action', '/upload_bukti/'+id);
        // fill the data in the input fields
    })
    // on modal hide
    $('#modal-input-image').on('hide.bs.modal', function() {
        $('.upload-bukti-clicked').removeClass('upload-bukti-clicked')
        $("#uploadForm").trigger("reset");
    })

    $("#single-bukti").change(function(){
        const fileName = $(this).val().split("\\");
        var inp = document.getElementById('single-bukti');
        var name = "";
        for (var i = 0; i < inp.files.length; ++i) {
            if (i == inp.files.length - 1) {
                name += inp.files.item(i).name;
            }
            else{
                name += inp.files.item(i).name+", ";
            }
        }

        if(fileName.length > 1){
            $("#single-bukti-label").html(name);
        } else {
            $("#single-bukti-label").html("Click to select the image");
        }
    });

</script>
@foreach ($transaction as $item)
@if ($item->status == 'unverified')
    @php
        // echo $now;
        $t1 = Carbon\Carbon::parse($item->timeout);
        $t2 = Carbon\Carbon::parse($now);
        $second = $t2->diffInSeconds($t1);
    @endphp
    <script>
        // window.onload = function clock{{$item->id}}() {
            var timer{{$item->id}};
    
            timer{{$item->id}} = setInterval(myclock{{$item->id}}, 1000);
            var c{{$item->id}} = {{$second}};
            var id{{$item->id}} = {{$item->id}};

            function myclock{{$item->id}}() {
                --c{{$item->id}};

                var seconds{{$item->id}} = c{{$item->id}} % 60;
                var minutes{{$item->id}} = (c{{$item->id}} - seconds{{$item->id}}) / 60;
                var minutesLeft{{$item->id}} = minutes{{$item->id}} % 60;
                var hours{{$item->id}} = (minutes{{$item->id}} - minutesLeft{{$item->id}}) / 60;

                if (seconds{{$item->id}}.toString().length > 1 && minutesLeft{{$item->id}}.toString().length>1) {
                    document.getElementById('timeout'+id{{$item->id}}).innerHTML = hours{{$item->id}} + ":" + minutesLeft{{$item->id}} + ":" + seconds{{$item->id}};
                }
                else if (seconds{{$item->id}}.toString().length < 2 && minutesLeft{{$item->id}}.toString().length>1) {
                    document.getElementById('timeout'+id{{$item->id}}).innerHTML = hours{{$item->id}} + ":" + minutesLeft{{$item->id}} + ":0" + seconds{{$item->id}};
                }
                else if (seconds{{$item->id}}.toString().length > 1 && minutesLeft{{$item->id}}.toString().length<2) {
                    document.getElementById('timeout'+id{{$item->id}}).innerHTML = hours{{$item->id}} + ":0" + minutesLeft{{$item->id}} + ":" + seconds{{$item->id}};
                }
                else if (seconds{{$item->id}}.toString().length < 2 && minutesLeft{{$item->id}}.toString().length < 2) {
                    document.getElementById('timeout'+id{{$item->id}}).innerHTML = hours{{$item->id}} + ":0" + minutesLeft{{$item->id}} + ":0" + seconds{{$item->id}};
                }
            }
        // }
        
    </script> 
@endif   
@endforeach

@endsection