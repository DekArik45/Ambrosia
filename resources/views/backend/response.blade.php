@extends('backend.layouts.app')

@section('response', 'active')
@section('master', 'active')

@section('content')
    
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            
            
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Review</h3>
                </div>
                
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Not Response Yet</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Already Response</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box-body">
                                <table style="margin-top:10px;" id="review" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product</th>
                                            <th>Customer</th>
                                            <th>rate</th>
                                            <th>Content</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($review_notResponseYet as $item)
                                            <tr class="data-row">
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="product_name">{{ $item->product_name }}</td>
                                                <td class="user_name">{{ $item->name }}</td>
                                                <td class="rate">{{ $item->rate }}</td>
                                                <td class="content">{{ $item->content }}</td>
                                                <td style="text-align:center;">
                                                    <form action="/admin/detail-response/{{$item->id}}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary" title="Edit">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="box-body">
                                <table style="margin-top:10px;" id="review1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product</th>
                                            <th>Customer</th>
                                            <th>rate</th>
                                            <th>Content</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($review_response as $item)
                                            <tr class="data-row">
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="product_name">{{ $item->product_name }}</td>
                                                <td class="user_name">{{ $item->name }}</td>
                                                <td class="rate">{{ $item->rate }}</td>
                                                <td class="content">{{ $item->content }}</td>
                                                <td style="text-align:center;">
                                                    <form action="/admin/detail-already-response/{{$item->id}}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary" title="Edit">
                                                            <i class="fa fa-eye"></i>
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
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->

                
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script src="{{ asset ("backend/bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset ("backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>

<script>
    $(function() {
        $("#review").DataTable();
        $("#review1").DataTable();
    });
    
</script>
@endsection