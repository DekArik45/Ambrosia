@extends('frontend.layouts.app')

@section('content')
    <!-- SUB BANNER -->
    <section class="sub-banner text-center section">
            <div class="awe-parallax bg-3"></div>
            <div class="awe-title awe-title-3">
                <h3 class="lg text-uppercase">List Review Product</h3>
            </div>
        </section>
        <!-- END / SUB BANNER -->
    
        <!-- CONTACT US -->
        <section id="contact" class="contact section">
    
            <div class="contact-form contact-form-2">
                <div class="divider divider-2"></div>
                <div class="container">
                    <div class="row">
                        @foreach ($product as $data)
                            <!-- THE MENU ITEM -->
                                    
                                        <div class="col-lg-6">
                                            <a href="/product/{{$data->id}}">
                                                <div class="the-menu-item" style="    padding-bottom: 25px;">
                                                    <div class="image-wrap">
                                                        <img style="width: 90px; height: 90px;" src="/{{$data->image_name}}" alt="">
                                                    </div>
                                                    <div class="the-menu-body" style="padding-top: 0px;padding-left: 10px;">
                                                        <h4 class="xsm">{{$data->product_name}}</h4>
                                                        <p style="margin-bottom: 0px;">{{$data->description}}</p>
                                                    </div>
                                                    <div class="prices">
                                                        @if ($data->status == '1')
                                                            <a href="javascript:void(0)" style="padding: 6px 13px;font-size: 11px;" class="awe-btn awe-btn-3 awe-btn-default text-uppercase right">Already Review</a>
                                                        @else
                                                            <a href="/review/{{$data->id_detail}}" style="padding: 6px 13px;font-size: 11px;" class="awe-btn awe-btn-3 awe-btn-default text-uppercase right">Review</a>
                                                        @endif
                                                        
                                                    </div>
                                                    @if ($data->product_rate == '')
                                                        <div class="highlight">Not Rated Yet</div>
                                                    @else
                                                        <div class="highlight">Rate: {{$data->product_rate}} <i class="fa fa-star"></i></div>
                                                    @endif
                                                </div>
                                            </a>
                                            
                                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
    
            
    
        </section>
    
        <!-- END / CONTACT US -->
@endsection