@extends('frontend.layouts.app')

@section('content')
        <!-- SUB BANNER -->
        <section class="sub-banner text-center section">
                <div class="awe-parallax bg-4"></div>
                <div class="awe-title awe-title-3">
                    <h3 class="lg text-uppercase">{{$product->product_name}}</h3>
                </div>
            </section>
            <!-- END / SUB BANNER -->
        
            <!-- EVENTS -->
            <section id="events" class="events section">
                <div class="divider divider-2"></div>
                <div class="section-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <ul class="event-slider">
    
                                    <!-- ITEM EVENT -->
                                    <li>
                                        <div class="item-event" >
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="image-wrap">
                                                        @foreach ($image as $item)
                                                            @if ($loop->iteration == 1)
                                                                <img style="height:210px" src="/{{$item->image_name}}" alt=""> 
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="item-event-body" style="margin-top:0px;">
                                                        <div class="item-event-title" >
                                                            <h4 style="margin-top:0px;">{{$product->product_name}}</h4>
                                                        </div>
                                                        <div class="item-event-content">
                                                            <p>{{$product->description}}</p>
                                                        </div>
                                                        <div class="item-event-meta">
                                                            <div class="date">
                                                                <i class="icon awe_calendar"></i>
                                                                {{$product->price}}
                                                            </div>
                                                            <div class="time">
                                                                <i class="icon awe_clock_1"></i>
                                                                {{$product->stock}}
                                                            </div>
                                                            <div class="website">
                                                                <i class="icon awe_link"></i>
                                                                {{$product->weight}}
                                                            </div>
                                                        </div>
                                                        <div class="item-event-meta" style="margin-bottom:30px;">
                                                            @foreach ($category as $item)
                                                                <div class="website">
                                                                    <i class="icon awe_link"></i>
                                                                    {{$item->category_name}}
                                                                </div>
                                                            @endforeach
                                                        </div>
        
                                                        <a href="javascript:void(0)" id="min_item" data-item="1" data-id="{{$product->id}}" style="padding: 6px 13px;font-size: 11px;" class="awe-btn awe-btn-3 awe-btn-default text-uppercase"><i class="fa fa-minus"></i></a>
                                                        
        
                                                        @php
                                                            $data_cookie = json_decode(Cookie::get('cart'),true);
                                                            $qty = 0;
                                                        @endphp
                                                        @if ($data_cookie != null)
                                                            @foreach ($data_cookie as $cookie)
                                                                @if ($cookie['product_id'] == $product->id)
                                                                    @php
                                                                        if ($cookie['qty'] == '' || $cookie['qty'] == null || $cookie['qty'] == 'NaN') {
                                                                            $qty = 0;
                                                                        }
                                                                        else {
                                                                            $qty = $cookie['qty'];
                                                                        }
                                                                        break;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                            <input type="number" id="1" min="0" max="100" name="qty" 
                                                            value="{{$qty}}" 
                                                            style="    width: 40px;
                                                            height: 32px;
                                                            padding: 7px;
                                                            text-align: center;">
                                                        
        
                                                        
                                                            <a href="javascript:void(0)" id="add_item" data-item="1" data-id="{{$product->id}}" style="padding: 6px 13px;font-size: 11px;" class="awe-btn awe-btn-3 awe-btn-default text-uppercase"><i class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- ITEM EVENT -->
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            <!-- END / EVENTS -->
        
            <!-- EVENTS GALLERY -->
            <section id="events-gallery" class="events-gallery section">
                <div class="gallery-slider">
                    @foreach ($image as $item)
                        <!-- GALLERY ITEM -->
                        <div class="gallery-item">
                            <a href="/{{$item->image_name}}">
                                <img style="width:285px;height:250px;" src="/{{$item->image_name}}" alt="">
                            </a>
                        </div>
                        <!-- END / GALLERY ITEM -->    
                    @endforeach
                </div>
            </section>
            <!-- END / EVENTS GALLERY -->

            <!-- COMMENTS -->
            <section class="section-blog section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <!-- BLOG LIST -->
                        <div class="col-md-8">
                            <div class="blog-single">
                                <div class="post post-single">
                                    <div id="comments">
                                        <div class="comments-inner-wrap">
                                            <h3 id="comments-title" class="xmd text-capitalize">{{$count}} Comments</h3>
                                            <ul class="commentlist">
                                                @foreach ($review as $item)
                                                    <li class="comment">
                                                        <div class="comment-box">
                                                            <div class="comment-author">
                                                                <a href="#"><img src="/{{$item->user->profile_image}}" alt=""></a>
                                                            </div>
                                                            <div class="comment-body">
                                                                <cite class="fn"><a href="#">{{$item->user->name}}
                                                                <div class="comment-meta">
                                                                        ({{$item->rate}} <i class="fa fa-star"></i>)
                                                                </div></a>
                                                                </cite>
                                                                <p>{{$item->content}}</p>
                                                                <div class="comment-meta">
                                                                    <span>{{\Carbon\Carbon::parse($item->created_at)->format('M d,Y')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach ($item->response as $data)
                                                            <ul class="children">
                                                                <li class="comment">
                                                                    <div class="comment-box">
                                                                        <div class="comment-author">
                                                                            <a href="#"><img src="/{{$data->admin->profile_image}}" alt=""></a>
                                                                        </div>
                                                                        <div class="comment-body">
                                                                            <cite class="fn"><a href="#">{{$data->admin->name}}</a></cite>
                                                                            <p>{{$data->content}}</p>
                                                                            <div class="comment-meta">
                                                                                <span>{{\Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        @endforeach
                                                        
                                                        
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- END / COMMENTS -->

                                    <!-- LEAVER YOUR COMMENT -->
                                    @if (Auth::guard('customer')->check())
                                        <div id="respond">
                                            <div class="reply-title">
                                                <h3 class="xmd text-capitalize">Leaver your comment</h3>
                                            </div>
                                            <!-- COMMENT FORM -->
                                            <form method="POST" action="/review">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$product_id}}">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-item form-textarea">
                                                            <textarea placeholder="Your Content" name="content"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-item form-name">
                                                            <input type="text" name="name" readonly value="{{Auth::guard('customer')->user()->name}}" placeholder="Your Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-item form-email">
                                                            <input type="text" name="email" readonly value="{{Auth::guard('customer')->user()->email}}" placeholder="Your Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-item form-email">
                                                            <input type="number" max="5" min="0" name="rate" placeholder="Your Rate 0 - 5">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-actions">
                                                            <input type="submit" value="Post this review" class="awe-btn awe-btn-2 awe-btn-default text-uppercase">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- END / COMMENT FORM -->
                                            
                                        </div>    
                                    @endif
                                    
                                    <!-- END / LEAVER YOUR COMMENT -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('frontend/js/lib/jquery.owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/lib/retina.min.js')}}"></script>

<script>
    $(document).ready(function() {

        $(document).on('click', "#add_item", function() {
            $(this).addClass('item_clicked');
            var id = $('.item_clicked').data('id');
            var item = $('.item_clicked').data('item');
            var another = $('.item_clicked').data('another');

            var qty = $('#'+item).val();
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
                    'qty': jumlah
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
                    'qty': jumlah
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