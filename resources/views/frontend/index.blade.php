@extends('frontend.layouts.app')
@section('home','current-menu-item')
@section('content')
    
    <!-- HOME MEDIA -->
    <section id="home-media" class="home-media section">
        <div class="home-fixheight tb">
            <ul class="home-slider" data-background="awe-static">
                <li>
                    <div class="image-wrap">
                        <img src="{{asset('frontend/images/background/img-1.jpg')}}" alt="">
                    </div>
                    <div class="slider-content text-center">
                        <div class="home-content">
                            <div class="ribbon ribbon-1">
                                <h2 class="sm">WELCOME TO</h2>
                            </div>
                            <h1 class="sbig text-uppercase">Ambrosia</h1>
                            <div class="awe-hr">
                                <i class="icon awe_certificate"></i>
                            </div>
                            <p class="xmd">Modern Restaurant &amp; Fast Food House</p>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="image-wrap">
                        <img src="{{asset('frontend/images/slider/img-2.jpg')}}" alt="">
                    </div>
                    <div class="slider-content text-center">
                        <div class="home-content">
                            <div class="ribbon ribbon-1">
                                <h2 class="sm">WELCOME TO</h2>
                            </div>
                            <h1 class="sbig text-uppercase">Ambrosia</h1>
                            <div class="awe-hr">
                                <i class="icon awe_certificate"></i>
                            </div>
                            <p class="xmd">Modern Restaurant &amp; Fast Food House</p>
                        </div>
                    </div>

                </li>

                <li>
                    <div class="image-wrap">
                        <img src="{{asset('frontend/images/slider/img-3.jpg')}}" alt="">
                    </div>
                    <div class="slider-content text-center">
                        <div class="home-content">
                            <div class="ribbon ribbon-1">
                                <h2 class="sm">WELCOME TO</h2>
                            </div>
                            <h1 class="sbig text-uppercase">Ambrosia</h1>
                            <div class="awe-hr">
                                <i class="icon awe_certificate"></i>
                            </div>	
                            <p class="xmd">Modern Restaurant &amp; Fast Food House</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- END / HOME MEDIA -->


    <!-- GOOD FOOD -->
    <section id="good-food" class="good-food section pd">
        <div class="container">
            <div class="good-food-heading text-center">
                <div class="good-food-title style-2">
                    <h6 class="xmd text-uppercase">We believe</h6>
                    <i class="icon awe_quote_left"></i>
                    <h2 class="lg text-capitalize">good food is sin</h2>
                    <i class="icon awe_quote_right"></i>
                </div>
                <p>Doner filet mignon bacon corned beef rump, frankfurter sirloin brisket drumstick kielbasa ribeye boudin pancetta prosciutto. Ball tip jowl porchetta tongue strip steak pig. Turkey shankle bacon, swine doner biltong ball tip pork kielbasa tenderloin ham. </p>
                <a href="/about" class="awe-btn awe-btn-2 awe-btn-default text-uppercase">About us</a>
            </div>
        </div>

        <div class="divider divider-2"></div>
    </section>
    <!-- END / GOOD FOOD -->

    
    <!-- FASTFOOD -->
    <section id="fastfood" class="fastfood section pd">
        <div class="awe-color"></div>
        <div class="awe-pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="fastfood-description">
                        <div class="content-heading">
                            <h4 class="lg text-uppercase">FASTFOOD OR HEALTH? WE GIVE YOU BOTH!</h4>
                        </div>
                        <div class="text-wrap">
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto</p>
                        </div>
                        <a href="/menu" class="awe-btn awe-btn-2 awe-btn-ar text-uppercase">See the menu</a>
                    </div>  
                </div>
                <div class="col-md-6 col-md-offset-1">
                    <div class="fastfood-items">
                        <div class="row">
                            <!-- FASTFOOD ITEM -->

                            @foreach ($image as $item)
                                {{-- @if ($loop->iteration <= 2) --}}
                                    <div class="col-xs-6">
                                        <div class="fastfood-item">
                                            <a href="/product/{{$item->product_id}}">
                                                <img style="width:245px; height:240px;" src="{{$item->image_name}}" alt="{{$item->product_name}}">
                                                <h4>{{$item->product_name}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                {{-- @endif --}}
                            @endforeach
                            <!-- END / FASTFOOD ITEM -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / FASTFOOD -->

    <!-- SECTION HIGHLIGHT -->
    <section class="section-highlight section">
        <div class="divider divider-2"></div>
        <div class="container">
            <div class="highlight-content tb">
                <div class="tb-cell">
                    <p>Why don’t find a table and save it now? Find a table and We have discount for you!</p>
                </div>
                <div class="links tb-cell">
                    <div class="reservation-link link">
                        <a href="reservation.html" class="awe-btn awe-btn-2 awe-btn-default text-uppercase">RESERVATION</a>
                    </div>
                    <div class="shop-delivery-link link">
                        <a href="shop.html" class="awe-btn awe-btn-2 awe-btn-default text-uppercase">SHOP DELIVERY</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / SECTION HIGHLIGHT -->


    <!-- CONTACT US -->
    <section id="contact" class="contact section">

        <div class="contact-first">

            <!-- OVERLAY -->
            <div class="awe-overlay overlay-default"></div>
            <!-- END / OVERLAY -->
            
            <div class="section-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="contact-body text-center">
                                <h3 class="lg text-uppercase">CONTACT US</h3>
                                <hr class="_hr">
                                <address class="address-wrap">
                                    <span class="address">Eddy Street & Gough Street, San Francisco, CA 94109</span>
                                    <span class="phone">3792 - 7384 - 8459</span>
                                </address>
                            </div>

                            <div class="see-map text-center">
                                <a href="#" data-see-contact="See contact info" data-see-map="See location on map" class="awe-btn awe-btn-5 awe-btn-default text-uppercase"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- END / CONTACT US -->
@endsection