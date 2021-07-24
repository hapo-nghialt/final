<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href={{ asset('images/favicon.ico') }}>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href={{ asset('css/animate.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/font-awesome.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/bootstrap.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/owl.carousel.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/flexslider.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/chosen.min.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/app.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/style.css') }}>
    <link rel="stylesheet" type="text/css" href={{ asset('css/color-01.css') }}>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>
<body class="@yield('class-body')">
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>
    <header id="header" class="header header-style-1">
        <div class="container-fluid">
            <div class="row d-block">
                <div class="background-header">
                    <div class="topbar-menu-area">
                        <div class="container">
                            <div class="topbar-menu left-menu">
                                <ul>
                                    <li class="menu-item" >
                                        <a title="Hotline: 0968.193.632" href="#">
                                            <span class="icon label-before fa fa-mobile"></span>Hotline: 0968.193.632
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="topbar-menu right-menu">
                                <ul>
                                    <li class="menu-item menu-item-has-children parent btn-list-notification">
                                        <a href="#"><i class="far fa-bell"></i>&nbsp;Thông báo</a>
                                        <span class="caret-up"></span>
                                        @if (Auth::check())
                                            <div class="list-notification">
                                                <span class="caret-up"></span>
                                                @if (sizeof($notifications) != 0)
                                                <div class="new-item-text">Thông báo mới nhận</div>
                                                    @foreach ($notifications as $notification)
                                                    <a href="">
                                                        <div class="notification">
                                                            <div class="cart-item-image">
                                                                <img src="{{ asset('images/avatar-null.png') }}" alt="">
                                                            </div>
                                                            <div class="cart-item-information">
                                                                {{ $notification->content }}
                                                            </div>
                                                        </div>
                                                    </a>
                                                    @endforeach
                                                    <a class="see-all-notification" id="" href="{{ route('notifications.index') }}">Xem tất cả</a>
                                                @else
                                                    <div class="cart-empty">
                                                        <img src="{{ asset('images/notification-empty.png') }}" alt="">
                                                        <div>Chưa có thông báo</div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </li>
                                    @if (Auth::check())
                                        <li class="menu-item menu-item-has-children parent">
                                            <a href="{{ route('messages.index') }}"><i class="far fa-comments"></i>&nbsp;Chat</a>
                                        </li>
                                        <li class="menu-item menu-item-has-children parent">
                                            <a title="My Account" href="#">{{ Auth::user()->name }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <ul class="submenu curency">
                                                @if (Auth::user()->role_id == \App\Models\User::ROLE['admin'])
                                                    <li class="menu-item"><a href="{{ route('admin.users.index') }}" target="_blank">Trang Admin</a></li>
                                                @endif
                                                <li class="menu-item"><a href="{{ route('users.show', Auth::user()->id) }}">Trang Cá Nhân</a></li>
{{--                                                <li class="menu-item"><a href="{{ route('users.manage-orders', Auth::id()) }}">Quản lý đơn hàng</a></li>--}}
                                                <li class="menu-item" ><a href="javascript:$('#logout-form').submit()">Đăng Xuất</a></li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                    <button type="submit" hidden title="Logout">
                                                        Đăng Xuất
                                                    </button>
                                                </form>
                                            </ul>
                                        </li>
                                    @else
                                        <li class="menu-item" ><a title="Register or Login" href={{ route('login') }}>Đăng Nhập</a></li>
                                        <li class="menu-item" ><a title="Register or Login" href={{ route('register') }}>Đăng Ký</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="mid-section main-info-area">
                            <div class="wrap-logo-top left-section">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('images/logo-top-1.png') }}" alt="">
                                </a>
                            </div>
                            <div class="wrap-search center-section">
                                <div class="wrap-search-form">
                                    <form action="{{ route('search-product') }}" id="form-search-top" name="form-search-top" method="get">
                                        <input type="text" name="search" value="" placeholder="Tìm kiếm trên fastBuy">
                                        <button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="wrap-icon right-section">
                                <div class="wrap-icon-section minicart d-flex justify-content-center">
                                    <div class="link-direction link-cart d-flex align-items-center" id="linkCart">
                                        <a id="urlCart" href="{{ (Auth::check() && Auth::user()->number_order != 0) ? route('users.show-cart') : route('user.cart-empty') }}">
                                            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                        </a>
                                        @if (Auth::check() && ((Auth::user()->number_order != 0) && !($orders->isEmpty())))
                                            <span class="index" id="numberOrderToCart">{{ Auth::user()->number_order }}</span>
                                        @endif
                                        <input type="hidden" id="urlCart" value="{{ route('users.show-cart') }}">
                                        <div class="list-item" id="listItem">
                                            <span class="caret-up"></span>
                                            @if (Auth::check() && ((Auth::user()->number_order == 0) || $orders->isEmpty()))
                                                <div class="cart-empty" id="cartEmpty">
                                                    <img src="{{ asset('images/cart-empty.png') }}" alt="">
                                                    <div>Chưa có sản phẩm</div>
                                                </div>
                                            @elseif (Auth::check())
                                                <div class="new-item-text">Sản phẩm mới thêm</div>
                                                @foreach($orders as $order)
                                                    <a href="{{ route('products.show', $order->products()->first()->id) }}">
                                                        <div class="cart-item">
                                                            <input type="hidden" name="orderId[]" value="{{ $order->product_id }}">
                                                            <div class="cart-item-image">
                                                                <img src="{{ asset('storage/products/' . $order->products()->first()->image) }}" alt="">
                                                            </div>
                                                            <div class="cart-item-information">
                                                                <div class="cart-item-name">
                                                                    {{ $order->products()->first()->name }}
                                                                </div>
                                                                <div class="cart-item-price">
                                                                    ₫{{ number_format($order->products()->first()->price, 0) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                                <a class="see-cart-button" id="seeCartButton" href="{{ route('users.show-cart') }}">Xem giỏ hàng</a>
                                            @elseif (!Auth::check())
                                                <div class="cart-empty" id="cartEmpty">
                                                    <img src="{{ asset('images/cart-empty.png') }}" alt="">
                                                    <div>Chưa có sản phẩm</div>
                                                    <div class="cart-footer">
                                                        <div>
                                                            <a href="{{ route('login') }}">Đăng nhập</a>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('register') }}">Đăng ký</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::check())
                                    <div class="wrap-icon-section d-flex justify-content-center">
                                        <a class="link-direction link-new-post d-flex align-items-center"
                                           href={{ route('products.create') }}>
                                            <i class="fas fa-cart-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main id="main" class="@yield('class-main')">
        <div class="container">
            @yield('content')
        </div>
    </main>
    <footer id="footer">
        <div class="wrap-footer-content footer-style-1">
            <div class="main-footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="wrap-footer-item">
                                <h3 class="item-header">fastBuy</h3>
                                <div class="item-content">
                                    <div class="wrap-contact-detail">
                                        <ul>
                                            <li>
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <p class="contact-txt">Ngõ Giảng Võ, Cát Linh, Ba Đình, Hà Nội</p>
                                            </li>
                                            <li>
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                                <p class="contact-txt">0968.193.632</p>
                                            </li>
                                            <li>
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                <p class="contact-txt">trongnghia1998tn@gmail.com</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 box-twin-content ">
                            <div class="row">
                                <div class="wrap-footer-item twin-item">
                                    <h3 class="item-header">Chăm sóc khách hàng</h3>
                                    <div class="item-content">
                                        <div class="wrap-vertical-nav">
                                            <ul>
                                                <li class="menu-item"><a href="#" class="link-term">Trung tâm trợ giúp</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Hướng dẫn mua hàng</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Hướng dẫn bán hàng</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Thanh toán</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Vận chuyển</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Chăm sóc khách hàng</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-footer-item twin-item">
                                    <h3 class="item-header">Về fastBuy</h3>
                                    <div class="item-content">
                                        <div class="wrap-vertical-nav">
                                            <ul>
                                                <li class="menu-item"><a href="#" class="link-term">Giới thiệu</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Tuyển dụng</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Truyền thông</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Điều khoản</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Chính sách bảo mật</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="wrap-footer-item">
                                <h3 class="item-header">Liên kết</h3>
                                <div class="item-content">
                                    <div class="wrap-contact-detail">
                                        <ul>
                                            <li>
                                                <i class="fab fa-facebook"></i>
                                                <p class="contact-txt">Facebook</p>
                                            </li>
                                            <li>
                                                <i class="fab fa-youtube"></i>
                                                <p class="contact-txt">Youtube</p>
                                            </li>
                                            <li>
                                                <i class="fab fa-google"></i>
                                                <p class="contact-txt">Google</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src={{ asset('js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}></script>
    <script src={{ asset('js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}></script>
    <script src={{ asset('js/bootstrap.min.js') }}></script>
    <script src={{ asset('js/jquery.flexslider.js') }}></script>
    <script src={{ asset('js/chosen.jquery.min.js') }}></script>
    <script src={{ asset('js/owl.carousel.min.js') }}></script>
    <script src={{ asset('js/jquery.countdown.min.js') }}></script>
    <script src={{ asset('js/jquery.sticky.js') }}></script>
    <script src={{ asset('js/functions.js') }}></script>
    <script src={{ asset('js/app.js') }}></script>
</body>
</html>
<script>
    var receiver_id = '';
    var my_id = '{{ Auth::id() }}'
    $(document).ready(function() {
        Pusher.logToConsole = true;

        var pusher = new Pusher('bc3fd55ce2605f3cfa30', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            if (my_id == data.from) {
                $('#contact' + data.to).click();
            } else if (my_id == data.to) {
                if (receiver_id == data.from) {
                    $('#contact' + data.from).click();
                }
            }
        });
        $('.contact').click(function() {
            $('#messageInput').val('');
            $('#noMessage').remove();
            $('.message-input').removeClass('d-none');
            $('.contact').removeClass('active');
            $(this).addClass('active');
            receiver_id = $(this).data('id');
            url = $(this).data('url');
            $.ajax({
                type: "GET",
                url: url,
                data: "",
                cache: false,
                success: function (data) {
                    $('#messages').html(data);
                    scrollToBottomFunc();
                }
            });
        });

        $(document).on('keyup', '#messageInput', function (e) {
            var message = $(this).val();
            if ((e.keyCode == 13) && (message != '') && (receiver_id != '')) {
                $(this).val('');
                $('#contact' + receiver_id).find('.preview').html(message)
                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "POST",
                    url: "{{ route('send-message') }}",
                    data: datastr,
                    cache: false,
                    success: function (data) {
                        scrollToBottomFunc();
                    },
                    error: function (jqXHR, status, err) {

                    },
                });
            }
        });

        $('#sendMessage').click(function (e) {
            var message = $('#messageInput').val();
            if ((message != '') && (receiver_id != '')) {
                $('#messageInput').val('');
                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "POST",
                    url: "{{ route('send-message') }}",
                    data: datastr,
                    cache: false,
                    success: function (data) {
                        scrollToBottomFunc();
                    },
                    error: function (jqXHR, status, err) {

                    },
                });
            }
        });

        function scrollToBottomFunc() {
            $('.messages').animate({
                scrollTop: $('.messages').get(0).scrollHeight
            }, 20);
        }
    });
</script>
