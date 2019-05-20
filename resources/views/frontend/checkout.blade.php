@extends('frontend.layouts.app')
@section('checkout','current-menu-item')
@section('content')
    <!-- SUB BANNER -->
    <section class="sub-banner text-center section">
        <div class="awe-parallax bg-4"></div>
        <div class="awe-title awe-title-3">
            <h3 class="lg text-uppercase">Checkout</h3>
        </div>
    </section>
        <!-- END / SUB BANNER -->
    
        <!-- SHOP PAGE -->
        <section id="shop-page" class="shop-page section">
            <div class="container">
                <div class="row">
                    <div class="checkout">
                        <!-- YOUR ORDER -->
                        <div class="col-md-3">
                            <div class="your-order">
                                <h4 class="xmd text-capitalize">Your order</h4>
                                <ul class="list-product">
                                    @if ($data_cookie != null)
                                        @foreach ($data_cookie as $item)
                                            <li>
                                                <div class="product-image" style="width:80px;">
                                                    <img  src="{{$item->image_name}}" alt="">
                                                </div>
                                                <div class="product-name">
                                                    <a href="/product/{{$item->product_id}}">{{$item->product_name}}</a>
                                                </div>
                                                <div class="qty-wrap">
                                                    <span class="product-quantity">
                                                        <span class="quantity">{{$item->qty}}</span> serves.
                                                    </span><br/>
                                                    <span class="amount">Rp. {{number_format($item->selling,0,',','.')}}</span>
                                                </div>
                                                <div class="product-remove">
                                                    <a href="/delete_item/{{$item->product_id}}" id="remove-item" data-id-item="{{$item->product_id}}"><i class="icon awe_close"></i></a>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <a href="/menu" class="awe-btn awe-btn-3 awe-btn-ar text-uppercase">Order Some Menu</a>
                                        </li>
                                    @endif
                                    
                                </ul>
                                <ul class="list-price">
                                    <li class="total">
                                        Total
                                        <span class="amount pull-right">Rp. {{number_format($total_price,0,',','.')}}</span>
                                    </li>
                                    {{-- <li class="coupon">
                                        Discount
                                        <span class="amount pull-right">-$20</span>
                                    </li> --}}
                                    <li class="shipping">
                                        Shipping
                                        <span class="amount pull-right" id="shipping"></span>
                                    </li>
                                </ul>
                                <div class="payment">
                                    Payment
                                    <span class="amount pull-right" id="payment">Rp. {{number_format($total_price,0,',','.')}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- END / YOUR ORDER -->
    
    
                        <!-- CHECKOUT CONTENT -->
                        <div class="col-md-9">
                            <div class="checkout-content">
                                
                                <h4 class="xmd text-capitalize">Your Info</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="billing_name">
                                            Name <abbr class="required">*</abbr>
                                        </label>
                                        <input type="text" readonly value="{{Auth::guard('customer')->user()->name}}" id="billing_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="billing_email">
                                            Email Address <abbr class="required">*</abbr>
                                        </label>
                                        <input type="email" readonly value="{{Auth::guard('customer')->user()->email}}" id="billing_email">
                                    </div>
                                </div>
                                <form action="/checkedout" method="POST">
                                    @csrf
                                    <input type="hidden" name="sub_total" value="{{$total_price}}">
                                    <input type="hidden" name="weight" value="{{$total_weight}}">
                                    <h4 class="xmd text-capitalize">Delivery Info</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="billing_city">
                                                Town / City <abbr class="required">*</abbr>
                                            </label>
                                            <input type="text" autocomplete="off" list="city" name="kota" id="billing_city">
                                            <datalist id="city">
                                                @foreach ($data_kota as $item)
                                                    <option value="{{$item['city_name']}}">
                                                @endforeach
                                            </datalist>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="billing_address_1" class="">
                                                Address <abbr class="required">*</abbr>
                                            </label>
                                            <input type="text" name="alamat" required id="billing_address_1">
                                        </div>
                                    </div>

                                    <h4 class="xmd text-capitalize">Courier Info</h4>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="billing_courier">
                                                Courier <abbr class="required">*</abbr>
                                            </label>
                                            <input type="text" autocomplete="off" list="courier" name="courier" required id="billing_courier">
                                            <datalist id="courier">
                                                @foreach ($data_courier as $item)
                                                    <option value="{{$item->courier}}">
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <input type="button" value="Cek Shipping" id="cek_shipping" class="awe-btn awe-btn-3 awe-btn-default text-uppercase">

                                    <input type="submit" value="confirm &amp; checkout" class="awe-btn awe-btn-3 awe-btn-default text-uppercase">
                                </form>
                            </div>
                        </div>
                        <!-- END / CHECKOUT CONTENT -->
                    </div>
                </div>
            </div>
        </section>
        <!-- END / SHOP PAGE -->
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#cek_shipping').click(function(){
        $('#cek_shipping').attr("disabled", true);

        var courier = $('#billing_courier').val();
        var destination = $('#billing_city').val();
        var weight = {{$total_weight}};
        var price = {{$total_price}};
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/shipping',
            data: { 
                'destination': destination, 
                'courier': courier,
                'weight' : weight
            },
            success: function(data){
                console.log("Success "+data);
                $('#cek_shipping').attr("disabled", false);
                $('#cek_shipping').addClass("disabled");
                $('#shipping').html(formatRupiah(data['cost'].toFixed(0), "Rp. "));
                  
                var total = data['cost'] + price;
                
                $('#payment').html(formatRupiah(total.toFixed(0), "Rp. "));
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
                $('#cek_shipping').attr("disabled", false);
                $('#cek_shipping').removeClass("disabled");
            },
        }); 
    });
});
</script>
@endsection