<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- CSS LIBRARY -->
    
    <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/lib/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/lib/magnific-popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/lib/font-awesome.min.css')}}">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- AWE FONT -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/awe-fonts.css')}}">

    <!-- PAGE STYLE -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
    
    <title>frontend</title>
</head>
<body class="home">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @include('sweet::alert')
<!-- PRELOADER -->
<div class="preloader">
    <div class="inner">
        <div class="item item1"></div>
        <div class="item item2"></div>
        <div class="item item3"></div>
    </div>
</div>
<!-- END / PRELOADER -->

<!-- PAGE WRAP -->
<div id="page-wrap">
    
    <!-- HEADER -->
    <header id="header" class="header header-2">
        <div class="container">
            <!-- LOGO -->
            <div class="logo"><a href="/"><img src="{{asset('frontend/images/logo2.png')}}" alt=""></a></div>
            <!-- END / LOGO -->

            <!-- OPEN MENU MOBILE -->
            <div class="open-menu-mobile">
                <span>Toggle menu mobile</span>
            </div>
            <!-- END / OPEN MENU MOBILE -->

            <!-- NAVIGATION -->
            <nav class="navigation text-right" data-menu-type="1200">
                <!-- NAV -->
                <ul class="nav text-uppercase">
                    <li class="@yield('home')">
                        <a href="/home">Home</a>
                    </li>
                    <li class="@yield('menu')"><a href="/menu">Menu</a></li>
                    <li class="@yield('checkout')"><a href="/checkout">Checkout</a></li>
                    
                    <li class="@yield('about')"><a href="/about">About Us</a></li>
                    @if (Auth::guard('customer')->check())
                        <li class="@yield('profile')"><a href="/profile">My Profile</a></li>
                        <li class="@yield('logout')"><a href="/customer/logout">Logout</a></li>
                    @else
                        <li class="@yield('profile')"><a href="/profile">Login</a></li>
                    @endif
                </ul>
                <!-- END / NAV -->
                <!-- MINICART -->
                <div class="minicart-wrap">
                    <div  class="toggle-minicart">
                        <span><a href="javascript:void(0)" style="color:black;    background: transparent;border: 0;" id="cart_top" class="text-uppercase"><i  style="font-size:18px;" class="fa fa-shopping-cart"></i></a></span>
                    </div>
                    <div class="minicart-body">
                        <h4 class="xsm text-uppercase text-center">Your Cart</h4>
                        <ul class="minicart-list">
                            
                        </ul>
                        <div class="minicart-total">
                            Total
                                <span class="amount pull-right" id="total-price"></span>
                        </div>

                        <div class="minicart-footer">
                            <a href="/checkout" class="awe-btn awe-btn-1 awe-btn-default text-uppercase">Check out</a>
                        </div>

                    </div>
                </div>
                <!-- END / MINICART -->
            </nav>
            <!-- END / NAVIGATION -->
        </div>

    </header>
    <!-- END / HEADER -->

    @yield('content')


    <!-- FOOTER -->
    <footer id="footer" class="footer">
        <div class="divider divider-1 divider-color"></div>
        <div class="awe-color"></div>
        <div class="container">
            <div class="copyright text-center">
                © 2019 Kelompok 
            </div>
        </div>
    </footer>
    <!-- END / FOOTER -->
    

</div>
<!-- END / PAGE WRAP -->

<!-- LOAD JQUERY -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>

<script type="text/javascript" src="{{asset('frontend/js/lib/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/lib/jquery.bxslider.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/lib/jquery.easing.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/lib/jquery.owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/lib/masonry.pkgd.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/lib/perfect-scrollbar.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/lib/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/lib/jquery.parallax-1.1.3.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/lib/retina.min.js')}}"></script>

<script>

function formatRupiah(angka, prefix){
    var number_string = angka.toString().replace(/[^,\d]/g, ''),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

$(document).ready(function() {
    // var jsonData = "";
    $('#cart_top').click(function(){
        // alert("adf");
        $.ajax({
            url:"/get_item",
            type:'GET',
            success: function(data){
                console.log(data);
                var html = "";
                var jumlah = 0;
                $.each(data, function(index) {
                    if (data[index].product_id == undefined) {
                        html = '<li>Theres no Product in the Cart</li>';
                        $('.toggle-minicart').removeClass('active');
                    }
                    else{
                        var selling = parseFloat(data[index].selling).toFixed(0);
                        html += '<li> <div class="product-thumb"> <img style="width: 45px;height: 45px;" src="/'+data[index].image_name+'" alt=""> </div> <div class="product-name"> <a href=/product/"'+data[index].product_id+'">'+data[index].product_name+'</a> </div> <div class="qty-wrap"> <span class="product-quantity"> <span class="quantity">'+data[index].qty+'</span> serves. </span> <span class="amount">Rp. '+formatRupiah(selling, "Rp. ")+'</span> </div> <div class="product-remove"> <a href="/delete_item/'+data[index].product_id+'" id="remove-item" data-id-item="'+data[index].product_id+'"><i class="icon awe_close"></i></a> </div> </li>';
                        $('.toggle-minicart').addClass('active');
                        jumlah += data[index].selling * data[index].qty;
                    }
                });
                
                $('.minicart-list').html(html);
                $('#total-price').html(formatRupiah(jumlah.toFixed(0), "Rp. "));
            },
            error: function(data){
                console.log(data);
            }
        });
    });

    // $(document).on('click', "#remove-item", function() {
    //     $(this).addClass('item_clicked');
    //     var id = $('.item_clicked').data('id-item');

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type: 'GET',
    //         url: '/delete_item/'+id,
    //         success: function(data){
    //             console.log("Success "+data);
    //         },
    //         error: function (data, textStatus, errorThrown) {
    //             console.log(data);
    //         },
    //     }); 

    //     $('.item_clicked').removeClass('item_clicked');
        
    // });
});

</script>

<script type="text/javascript" src="{{asset('frontend/js/scripts.js')}}"></script>

@yield('script')

</body>

</html>