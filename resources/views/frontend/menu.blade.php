@extends('frontend.layouts.app')
@section('menu','current-menu-item')
@section('content')
    <!-- SUB BANNER -->
<section class="sub-banner text-center section">
        <div class="awe-parallax bg-4"></div>
        <div class="awe-title awe-title-3">
            <h3 class="lg text-uppercase">Menu</h3>
        </div>
    </section>
    <!-- END / SUB BANNER -->
    
    <!-- THE MENU -->
    <section id="the-menu" class="the-menu section">
        <div class="tabs-menu tabs-page">
            <div class="container">
                <ul class="nav-tabs text-center" role="tablist">
                    @foreach ($category as $item)
                        @if ($loop->iteration == 1)
                            <li class="active"><a href="#{{$item->category_name}}" role="tab" data-toggle="tab">{{$item->category_name}}</a></li>
                        @else
                            <li ><a href="#{{$item->category_name}}" role="tab" data-toggle="tab">{{$item->category_name}}</a></li>
                        @endif    
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="section-content">
            <div class="container">
                <div class="tab-menu-content tab-content">
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($category as $item)
                        @if ($count == 1)
                            <!-- Category -->
                            <div class="tab-pane fade in active" id="{{$item->category_name}}">
                        @else
                            <div class="tab-pane fade in" id="{{$item->category_name}}">
                                
                        @endif
                                <div class="row">
                                    @foreach ($product_category as $data)
                                        <!-- THE MENU ITEM -->
                                        @if ($item->category_name == $data->category_name)
                                            @foreach ($product_image as $image)
                                                @if ($data->id == $image->product_id)
                                                
                                                    <div class="col-lg-6">
                                                        <a href="/product/{{$data->id}}">
                                                            <div class="the-menu-item" style="    padding-bottom: 25px;">
                                                                <div class="image-wrap">
                                                                    <img style="width: 90px; height: 90px;" src="/{{$image->image_name}}" alt="">
                                                                </div>
                                                                <div class="the-menu-body" style="padding-top: 0px;padding-left: 10px;">
                                                                    <h4 class="xsm">{{$data->product_name}}</h4>
                                                                    <p style="margin-bottom: 0px;">{{$data->description}}</p>
                                                                    
                                                                    @if ($count == 1)
                                                                        <a href="javascript:void(0)" id="min_item" data-another="{{$loop->iteration}}" data-item="{{$loop->iteration}}" data-id="{{$data->id}}" style="padding: 6px 13px;font-size: 11px;" class="awe-btn awe-btn-3 awe-btn-default text-uppercase"><i class="fa fa-minus"></i></a>
                                                                    @else
                                                                        <a href="javascript:void(0)" id="min_item" data-another="{{$loop->iteration}}" data-item="{{$loop->iteration.$count}}" data-id="{{$data->id}}" style="padding: 6px 13px;font-size: 11px;" class="awe-btn awe-btn-3 awe-btn-default text-uppercase"><i class="fa fa-minus"></i></a>
                                                                    @endif

                                                                    @php
                                                                        $data_cookie = json_decode(Cookie::get('cart'),true);
                                                                        $qty = 0;
                                                                    @endphp
                                                                    @if ($data_cookie != null)
                                                                        @foreach ($data_cookie as $cookie)
                                                                            @if ($cookie['product_id'] == $data->id)
                                                                                @php
                                                                                    if ($cookie['qty'] == '' || $cookie['qty'] == null || $cookie['qty'] == 'NaN') {
                                                                                        $qty = 0;
                                                                                    }
                                                                                    else {
                                                                                        $qty = $cookie['qty'];
                                                                                    }
                                                                                    break;
                                                                                @endphp
                                                                            @else
                                                                                @php
                                                                                    $qty = 0;
                                                                                @endphp
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                    @if ($count == 1)
                                                                        <input type="number" id="{{$loop->iteration}}" min="0" max="100" name="qty" 
                                                                        value="{{$qty}}" 
                                                                        style="    width: 40px;
                                                                        height: 32px;
                                                                        padding: 7px;
                                                                        text-align: center;">
                                                                    @else
                                                                        <input type="number" id="{{$loop->iteration.$count}}" min="0" max="100" name="qty" 
                                                                        value="{{$qty}}" 
                                                                        style="    width: 40px;
                                                                        height: 32px;
                                                                        padding: 7px;
                                                                        text-align: center;">
                                                                    @endif
                                                                    

                                                                    @if ($count == 1)
                                                                        <a href="javascript:void(0)" id="add_item" data-item="{{$loop->iteration}}" data-another="{{$loop->iteration}}" data-id="{{$data->id}}" style="padding: 6px 13px;font-size: 11px;" class="awe-btn awe-btn-3 awe-btn-default text-uppercase"><i class="fa fa-plus"></i></a>
                                                                    @else
                                                                        <a href="javascript:void(0)" id="add_item"  data-item="{{$loop->iteration.$count}}" data-another="{{$loop->iteration}}" data-id="{{$data->id}}" style="padding: 6px 13px;font-size: 11px;" class="awe-btn awe-btn-3 awe-btn-default text-uppercase"><i class="fa fa-plus"></i></a>
                                                                    @endif
                                                                    
                                                                </div>
                                                                <div class="prices">
                                                                    @php
                                                                        $check = 0;
                                                                    @endphp
                                                                    @foreach ($product_discount as $discount)
                                                                        @if ($discount->id_product == $data->id)
                                                                            @php
                                                                                $check = $discount->selling;
                                                                                $diskon_produk = $discount->diskon;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach

                                                                    @if ($check != 0)
                                                                        <input type="hidden" id="discount-{{$loop->iteration}}" value="{{$diskon_produk}}">
                                                                        <input type="hidden" id="selling-{{$loop->iteration}}" value="{{$check}}">
                                                                        <span class="price xsm" style="text-align: right;
                                                                        float: right;
                                                                        text-decoration: line-through red;">Rp. {{number_format($data->price, 0,',','.')}}</span><br/>
                                                                        <span class="price xsm"  style="font-size:18px; float: right;">Rp. {{number_format($check,0,',','.')}}</span><br/>
                                                                    @else
                                                                        <input type="hidden" id="discount-{{$loop->iteration}}" value="0">
                                                                        <input type="hidden" id="selling-{{$loop->iteration}}" value="{{$data->price}}">
                                                                        <span class="price xsm" style="text-align: right; font-size:18px;
                                                                        float: right;">Rp. {{number_format($data->price,0,',','.')}}</span><br/>
                                                                    @endif
                                                                    <a href="/review/{{$data->id}}" style="padding: 6px 13px;font-size: 11px;" class="awe-btn awe-btn-3 awe-btn-default text-uppercase right">Review</a>
                                                                </div>
                                                                @if ($data->product_rate == '')
                                                                    <div class="highlight">Not Rated Yet</div>
                                                                @else
                                                                    <div class="highlight">Rate: {{$data->product_rate}} <i class="fa fa-star"></i></div>
                                                                @endif
                                                            </div>
                                                        </a>
                                                        
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        <!-- END / THE MENU ITEM -->
                                    @endforeach
                                </div>
                                
                            </div>
                            <!-- END / Category --> 
                            @php
                                $count++;
                            @endphp
                    @endforeach
    
                </div>
            </div>
        </div>
    </section>
    <!-- END / THE MENU -->
@endsection

@section('script')
<script>
$(document).ready(function() {

    $(document).on('click', "#add_item", function() {
        $(this).addClass('item_clicked');
        var id = $('.item_clicked').data('id');
        var item = $('.item_clicked').data('item');
        var another = $('.item_clicked').data('another');

        var qty = $('#'+item).val();
        var diskon = $('#discount-'+item).val();
        var selling = $('#selling-'+item).val();

        var jumlah = parseInt(qty) + 1;
        $('#'+item).val(jumlah);
        $('#'+another).val(jumlah);
        for (let index = 1; index < 6; index++) {
            $('#'+another+index).val(jumlah);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/add_item',
            data: { 
                'product_id': id, 
                'qty': jumlah,
                'selling': selling,
                'discount': diskon
            },
            success: function(data){
                console.log("Success "+data);
                $('.toggle-minicart').addClass('active');
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        }); 

        $('.item_clicked').removeClass('item_clicked');

    });

    $(document).on('click', "#min_item", function() {
        $(this).addClass('item_clicked');
        var id = $('.item_clicked').data('id');
        var item = $('.item_clicked').data('item');
        var another = $('.item_clicked').data('another');

        var qty = $('#'+item).val();
        var diskon = $('#discount-'+item).val();
        var selling = $('#selling-'+item).val();
    
        var jumlah = parseInt(qty) - 1;

        if (jumlah < 0) {
            jumlah = 0;
        }

        $('#'+item).val(jumlah);
        $('#'+another).val(jumlah);
        for (let index = 1; index < 6; index++) {
            $('#'+another+index).val(jumlah);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/add_item',
            data: { 
                'product_id': id, 
                'qty': jumlah,
                'selling': selling,
                'discount': diskon
            },
            success: function(data){
                console.log("Success "+data);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);

            },
        }); 

        $('.item_clicked').removeClass('item_clicked');
    });

});
</script>
@endsection