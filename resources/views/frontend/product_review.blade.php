@extends('frontend.layouts.app')

@section('content')
    <!-- SUB BANNER -->
    <section class="sub-banner text-center section">
            <div class="awe-parallax bg-3"></div>
            <div class="awe-title awe-title-3">
                <h3 class="lg text-uppercase">Review Product</h3>
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
                                <span class="md">Data Product</span>
                                    <div class="location-1" style="padding-left: 0px;
                                    /* text-align: center; */
                                    margin-top: 8px;
                                    margin-bottom:0px;
                                    float: left;">
                                    
                                        <img style="width: 130px;
                                        /* height: auto; */
                                        border-radius: 13%;
                                        margin-right: 20px;" src="/{{$product->image_name}}" alt="">
                                    </div>
        
                                    <div class="location-1" style="    margin-top: 20px;
                                    margin-bottom: 10px;">
                                        <strong>{{$product->product_name}}</strong>
                                    </div>
        
                                    <div class="location-1" style="margin:0px;">
                                        @if ($selling_price != 0)
                                            <strong>{{$selling_price}}</strong>
                                        @else
                                            <strong>Rp. {{number_format($product->price,0,',','.')}}</strong>
                                        @endif
                                        
                                    </div>

                                    <div class="location-1" style="margin:0px;">
                                        <strong>
                                            @if ($product->product_rate != null)
                                                Rate : {{$product->product_rate}} <i class="fa fa-star"></i>
                                            @else
                                                No Rate Yet
                                            @endif
                                        </strong>
                                    </div>
    
                                    <div class="location-1" style="margin-top:36px;padding: 0px;
                                    text-indent: 10px;">
                                        <strong>{{$product->description}}</strong>
                                    </div>
                                </span>
                            </address>
                            
                        </div>
                        <div class="col-md-8">
                            <div class="form-row">
                                <form id="send-message-form" action="/review" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="form-item form-type-name">
                                        <input type="text" readonly placeholder="Your Name" value="{{Auth::guard('customer')->user()->name}}" name="name">
                                    </div>
                                    <div class="form-item form-type-email">
                                        <input type="email" readonly placeholder="Your Email" value="{{Auth::guard('customer')->user()->email}}" name="email">
                                    </div>
                                    <div class="form-item form-type-name">
                                        <input type="number" max="10" min="0" placeholder="Your Rate" name="rate">
                                    </div>
                                    <div class="form-item form-textarea">
                                        <textarea placeholder="Your Message" name="content"></textarea>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" value="Send Review" class="awe-btn awe-btn-2 awe-btn-default text-uppercase">
                                    </div>
                                    <div id="contact-content"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            
    
        </section>
    
        <!-- END / CONTACT US -->
@endsection