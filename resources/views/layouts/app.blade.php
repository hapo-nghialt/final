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
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('bc3fd55ce2605f3cfa30', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('laravel-chat');
        channel.bind('App\\Events\\Chat', function(data) {
            $(".messages").animate({scrollTop: $(document).height()}, "fast");
            $('<li class="replies"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + data.message + '</p></li>').appendTo($('.messages ul'));
        });
    </script>
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
                                                    <a class="see-all-notification" id="" href="{{ route('users.show-cart') }}">Xem tất cả</a>
                                                    @endforeach
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
                                            <a title="My Account" href="#">{{ Auth::user()->name }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <ul class="submenu curency">
                                                @if (Auth::user()->role_id == \App\Models\User::ROLE['admin'])
                                                    <li class="menu-item"><a href="{{ route('admin.home') }}" target="_blank">Trang Admin</a></li>
                                                @endif
                                                <li class="menu-item"><a href="{{ route('users.show', Auth::user()->id) }}">Trang Cá Nhân</a></li>
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
                                    <svg viewBox="0 0 192 65" style="fill: white;" class="shopee-svg-icon header-with-search__shopee-logo icon-shopee-logo"><g fill-rule="evenodd"><path d="M35.6717403 44.953764c-.3333497 2.7510509-2.0003116 4.9543414-4.5823845 6.0575984-1.4379707.6145919-3.36871.9463856-4.896954.8421628-2.3840266-.0911143-4.6237865-.6708937-6.6883352-1.7307424-.7375522-.3788551-1.8370513-1.1352759-2.6813095-1.8437757-.213839-.1790053-.239235-.2937577-.0977428-.4944671.0764015-.1151823.2172535-.3229831.5286218-.7791994.45158-.6616533.5079208-.7446018.5587128-.8221779.14448-.2217688.3792333-.2411091.6107855-.0588804.0243289.0189105.0243289.0189105.0426824.0333083.0379873.0294402.0379873.0294402.1276204.0990653.0907002.0706996.14448.1123887.166248.1287205 2.2265285 1.7438508 4.8196989 2.7495466 7.4376251 2.8501162 3.6423042-.0496401 6.2615109-1.6873341 6.7308041-4.2020035.5160305-2.7675977-1.6565047-5.1582742-5.9070334-6.4908212-1.329344-.4166762-4.6895175-1.7616869-5.3090528-2.1250697-2.9094471-1.7071043-4.2697358-3.9430584-4.0763845-6.7048539.296216-3.8283059 3.8501677-6.6835796 8.340785-6.702705 2.0082079-.004083 4.0121475.4132378 5.937338 1.2244562.6816382.2873109 1.8987274.9496089 2.3189359 1.2633517.2420093.1777159.2898136.384872.1510957.60836-.0774686.12958-.2055158.3350171-.4754821.7632974l-.0029878.0047276c-.3553311.5640922-.3664286.5817134-.447952.7136572-.140852.2144625-.3064598.2344475-.5604202.0732783-2.0600669-1.3839063-4.3437898-2.0801572-6.8554368-2.130442-3.126914.061889-5.4706057 1.9228561-5.6246892 4.4579402-.0409751 2.2896772 1.676352 3.9613243 5.3858811 5.2358503 7.529819 2.4196871 10.4113092 5.25648 9.869029 9.7292478M26.3725216 5.42669372c4.9022893 0 8.8982174 4.65220288 9.0851664 10.47578358H17.2875686c.186949-5.8235807 4.1828771-10.47578358 9.084953-10.47578358m25.370857 11.57065968c0-.6047069-.4870064-1.0948761-1.0875481-1.0948761h-11.77736c-.28896-7.68927544-5.7774923-13.82058185-12.5059489-13.82058185-6.7282432 0-12.2167755 6.13130641-12.5057355 13.82058185l-11.79421958.0002149c-.59136492.0107446-1.06748731.4968309-1.06748731 1.0946612 0 .0285807.00106706.0569465.00320118.0848825H.99995732l1.6812605 37.0613963c.00021341.1031483.00405483.2071562.01173767.3118087.00170729.0236381.003628.0470614.00554871.0704847l.00362801.0782207.00405483.004083c.25545428 2.5789222 2.12707837 4.6560709 4.67201764 4.7519129l.00576212.0055872h37.4122078c.0177132.0002149.0354264.0004298.0531396.0004298.0177132 0 .0354264-.0002149.0531396-.0004298h.0796027l.0017073-.0015043c2.589329-.0706995 4.6867431-2.1768587 4.9082648-4.787585l.0012805-.0012893.0017073-.0350275c.0021341-.0275062.0040548-.0547975.0057621-.0823037.0040548-.065757.0068292-.1312992.0078963-.1964115l1.8344904-37.207738h-.0012805c.001067-.0186956.0014939-.0376062.0014939-.0565167M176.465457 41.1518926c.720839-2.3512494 2.900423-3.9186779 5.443734-3.9186779 2.427686 0 4.739107 1.6486899 5.537598 3.9141989l.054826.1556978h-11.082664l.046506-.1512188zm13.50267 3.4063683c.014933.0006399.014933.0006399.036906.0008531.021973-.0002132.021973-.0002132.044372-.0008531.53055-.0243144.950595-.4766911.950595-1.0271786 0-.0266606-.000853-.0496953-.00256-.0865936.000427-.0068251.000427-.020262.000427-.0635588 0-5.1926268-4.070748-9.4007319-9.09145-9.4007319-5.020488 0-9.091235 4.2081051-9.091235 9.4007319 0 .3871116.022399.7731567.067838 1.1568557l.00256.0204753.01408.1013102c.250022 1.8683731 1.047233 3.5831812 2.306302 4.9708108-.00064-.0006399.00064.0006399.007253.0078915 1.396026 1.536289 3.291455 2.5833031 5.393601 2.9748936l.02752.0053321v-.0027727l.13653.0228215c.070186.0119439.144211.0236746.243409.039031 2.766879.332724 5.221231-.0661182 7.299484-1.1127057.511777-.2578611.971928-.5423827 1.37064-.8429007.128211-.0968312.243622-.1904632.34346-.2781231.051412-.0452164.092372-.083181.114131-.1051493.468898-.4830897.498124-.6543572.215249-1.0954297-.31146-.4956734-.586228-.9179769-.821744-1.2675504-.082345-.1224254-.154023-.2267215-.214396-.3133151-.033279-.0475624-.033279-.0475624-.054399-.0776356-.008319-.0117306-.008319-.0117306-.013866-.0191956l-.00256-.0038391c-.256208-.3188605-.431565-.3480805-.715933-.0970445-.030292.0268739-.131624.1051493-.14997.1245582-1.999321 1.775381-4.729508 2.3465571-7.455854 1.7760208-.507724-.1362888-.982595-.3094759-1.419919-.5184948-1.708127-.8565509-2.918343-2.3826022-3.267563-4.1490253l-.02752-.1394881h13.754612zM154.831964 41.1518926c.720831-2.3512494 2.900389-3.9186779 5.44367-3.9186779 2.427657 0 4.739052 1.6486899 5.537747 3.9141989l.054612.1556978h-11.082534l.046505-.1512188zm13.502512 3.4063683c.015146.0006399.015146.0006399.037118.0008531.02176-.0002132.02176-.0002132.044159-.0008531.530543-.0243144.950584-.4766911.950584-1.0271786 0-.0266606-.000854-.0496953-.00256-.0865936.000426-.0068251.000426-.020262.000426-.0635588 0-5.1926268-4.070699-9.4007319-9.091342-9.4007319-5.020217 0-9.091343 4.2081051-9.091343 9.4007319 0 .3871116.022826.7731567.068051 1.1568557l.00256.0204753.01408.1013102c.250019 1.8683731 1.04722 3.5831812 2.306274 4.9708108-.00064-.0006399.00064.0006399.007254.0078915 1.396009 1.536289 3.291417 2.5833031 5.393538 2.9748936l.027519.0053321v-.0027727l.136529.0228215c.070184.0119439.144209.0236746.243619.039031 2.766847.332724 5.22117-.0661182 7.299185-1.1127057.511771-.2578611.971917-.5423827 1.370624-.8429007.128209-.0968312.243619-.1904632.343456-.2781231.051412-.0452164.09237-.083181.11413-.1051493.468892-.4830897.498118-.6543572.215246-1.0954297-.311457-.4956734-.586221-.9179769-.821734-1.2675504-.082344-.1224254-.154022-.2267215-.21418-.3133151-.033492-.0475624-.033492-.0475624-.054612-.0776356-.008319-.0117306-.008319-.0117306-.013866-.0191956l-.002346-.0038391c-.256419-.3188605-.431774-.3480805-.716138-.0970445-.030292.0268739-.131623.1051493-.149969.1245582-1.999084 1.775381-4.729452 2.3465571-7.455767 1.7760208-.507717-.1362888-.982582-.3094759-1.419902-.5184948-1.708107-.8565509-2.918095-2.3826022-3.267311-4.1490253l-.027733-.1394881h13.754451zM138.32144123 49.7357905c-3.38129629 0-6.14681004-2.6808521-6.23169343-6.04042014v-.31621743c.08401943-3.35418649 2.85039714-6.03546919 6.23169343-6.03546919 3.44242097 0 6.23320537 2.7740599 6.23320537 6.1960534 0 3.42199346-2.7907844 6.19605336-6.23320537 6.19605336m.00172791-15.67913203c-2.21776751 0-4.33682838.7553485-6.03989586 2.140764l-.19352548.1573553V34.6208558c0-.4623792-.0993546-.56419733-.56740117-.56419733h-2.17651376c-.47409424 0-.56761716.09428403-.56761716.56419733v27.6400724c0 .4539841.10583425.5641973.56761716.5641973h2.17651376c.46351081 0 .56740117-.1078454.56740117-.5641973V50.734168l.19352548.1573553c1.70328347 1.3856307 3.82234434 2.1409792 6.03989586 2.1409792 5.27140956 0 9.54473746-4.2479474 9.54473746-9.48802964 0-5.239867-4.2733279-9.48781439-9.54473746-9.48781439M115.907646 49.5240292c-3.449458 0-6.245805-2.7496948-6.245805-6.1425854 0-3.3928907 2.79656-6.1427988 6.245805-6.1427988 3.448821 0 6.24538 2.7499081 6.24538 6.1427988 0 3.3926772-2.796346 6.1425854-6.24538 6.1425854m.001914-15.5438312c-5.28187 0-9.563025 4.2112903-9.563025 9.4059406 0 5.1944369 4.281155 9.4059406 9.563025 9.4059406 5.281657 0 9.562387-4.2115037 9.562387-9.4059406 0-5.1946503-4.280517-9.4059406-9.562387-9.4059406M94.5919049 34.1890939c-1.9281307 0-3.7938902.6198995-5.3417715 1.7656047l-.188189.1393105V23.2574169c0-.4254677-.1395825-.5643476-.5649971-.5643476h-2.2782698c-.4600414 0-.5652122.1100273-.5652122.5643476v29.2834155c0 .443339.1135587.5647782.5652122.5647782h2.2782698c.4226187 0 .5649971-.1457701.5649971-.5647782v-9.5648406c.023658-3.011002 2.4931278-5.4412923 5.5299605-5.4412923 3.0445753 0 5.516841 2.4421328 5.5297454 5.4630394v9.5430935c0 .4844647.0806524.5645628.5652122.5645628h2.2726775c.481764 0 .565212-.0824666.565212-.5645628v-9.5710848c-.018066-4.8280677-4.0440197-8.7806537-8.9328471-8.7806537M62.8459442 47.7938061l-.0053397.0081519c-.3248668.4921188-.4609221.6991347-.5369593.8179812-.2560916.3812097-.224267.551113.1668119.8816949.91266.7358184 2.0858968 1.508535 2.8774525 1.8955369 2.2023021 1.076912 4.5810275 1.646045 7.1017886 1.6975309 1.6283921.0821628 3.6734936-.3050536 5.1963734-.9842376 2.7569891-1.2298679 4.5131066-3.6269626 4.8208863-6.5794607.4985136-4.7841067-2.6143125-7.7747902-10.6321784-10.1849709l-.0021359-.0006435c-3.7356476-1.2047686-5.4904836-2.8064071-5.4911243-5.0426086.1099976-2.4715346 2.4015793-4.3179454 5.4932602-4.4331449 2.4904317.0062212 4.6923065.6675996 6.8557356 2.0598624.4562232.2767364.666607.2256796.9733188-.172263.035242-.0587797.1332787-.2012238.543367-.790093l.0012815-.0019308c.3829626-.5500403.5089793-.7336731.5403767-.7879478.258441-.4863266.2214903-.6738208-.244985-1.0046173-.459427-.3290803-1.7535544-1.0024722-2.4936356-1.2978721-2.0583439-.8211991-4.1863175-1.2199998-6.3042524-1.1788111-4.8198184.1046878-8.578747 3.2393171-8.8265087 7.3515337-.1572005 2.9703036 1.350301 5.3588174 4.5000778 7.124567.8829712.4661613 4.1115618 1.6865902 5.6184225 2.1278667 4.2847814 1.2547527 6.5186944 3.5630343 6.0571315 6.2864205-.4192725 2.4743234-3.0117991 4.1199394-6.6498372 4.2325647-2.6382344-.0549182-5.2963324-1.0217793-7.6043603-2.7562084-.0115337-.0083664-.0700567-.0519149-.1779185-.1323615-.1516472-.1130543-.1516472-.1130543-.1742875-.1300017-.4705335-.3247898-.7473431-.2977598-1.0346184.1302162-.0346012.0529875-.3919333.5963776-.5681431.8632459"></path></g></svg>
                                </a>
                            </div>
                            <div class="wrap-search center-section">
                                <div class="wrap-search-form">
                                    <form action="#" id="form-search-top" name="form-search-top">
                                        <input type="text" name="search" value="" placeholder="Search here...">
                                        <button form="form-search-top" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="wrap-icon right-section">
                                <div class="wrap-icon-section minicart d-flex justify-content-center">
                                    <div class="link-direction link-cart d-flex align-items-center" id="linkCart">
                                        <a href="{{ route('users.show-cart') }}">
                                            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                        </a>
                                        @if (Auth::check() && (Auth::user()->number_order != 0))
                                            <span class="index" id="numberOrderToCart">{{ Auth::user()->number_order }}</span>
                                        @endif
                                        <input type="hidden" id="urlCart" value="{{ route('users.show-cart') }}">
                                        <div class="list-item" id="listItem">
                                            <span class="caret-up"></span>
                                            @if (Auth::check() && (Auth::user()->number_order == 0))
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
            <div class="wrap-function-info">
                <div class="container">
                    <ul>
                        <li class="fc-info-item">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                            <div class="wrap-left-info">
                                <h4 class="fc-name">Free Shipping</h4>
                                <p class="fc-desc">Free On Oder Over $99</p>
                            </div>

                        </li>
                        <li class="fc-info-item">
                            <i class="fa fa-recycle" aria-hidden="true"></i>
                            <div class="wrap-left-info">
                                <h4 class="fc-name">Guarantee</h4>
                                <p class="fc-desc">30 Days Money Back</p>
                            </div>

                        </li>
                        <li class="fc-info-item">
                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                            <div class="wrap-left-info">
                                <h4 class="fc-name">Safe Payment</h4>
                                <p class="fc-desc">Safe your online payment</p>
                            </div>

                        </li>
                        <li class="fc-info-item">
                            <i class="fa fa-life-ring" aria-hidden="true"></i>
                            <div class="wrap-left-info">
                                <h4 class="fc-name">Online Suport</h4>
                                <p class="fc-desc">We Have Support 24/7</p>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="wrap-footer-item">
                                <h3 class="item-header">Contact Details</h3>
                                <div class="item-content">
                                    <div class="wrap-contact-detail">
                                        <ul>
                                            <li>
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <p class="contact-txt">45 Grand Central Terminal New York,NY 1017 United State USA</p>
                                            </li>
                                            <li>
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                                <p class="contact-txt">(+123) 456 789 - (+123) 666 888</p>
                                            </li>
                                            <li>
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                <p class="contact-txt">Contact@yourcompany.com</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="wrap-footer-item">
                                <h3 class="item-header">Hot Line</h3>
                                <div class="item-content">
                                    <div class="wrap-hotline-footer">
                                        <span class="desc">Call Us toll Free</span>
                                        <b class="phone-number">(+123) 456 789 - (+123) 666 888</b>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-footer-item footer-item-second">
                                <h3 class="item-header">Sign up for newsletter</h3>
                                <div class="item-content">
                                    <div class="wrap-newletter-footer">
                                        <form action="#" class="frm-newletter" id="frm-newletter">
                                            <input type="email" class="input-email" name="email" value="" placeholder="Enter your email address">
                                            <button class="btn-submit">Subscribe</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 box-twin-content ">
                            <div class="row">
                                <div class="wrap-footer-item twin-item">
                                    <h3 class="item-header">My Account</h3>
                                    <div class="item-content">
                                        <div class="wrap-vertical-nav">
                                            <ul>
                                                <li class="menu-item"><a href="#" class="link-term">My Account</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Brands</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Gift Certificates</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Affiliates</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Wish list</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap-footer-item twin-item">
                                    <h3 class="item-header">Infomation</h3>
                                    <div class="item-content">
                                        <div class="wrap-vertical-nav">
                                            <ul>
                                                <li class="menu-item"><a href="#" class="link-term">Contact Us</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Returns</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Site Map</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Specials</a></li>
                                                <li class="menu-item"><a href="#" class="link-term">Order History</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="wrap-footer-item">
                                <h3 class="item-header">We Using Safe Payments:</h3>
                                <div class="item-content">
                                    <div class="wrap-list-item wrap-gallery">
                                        <img src={{ asset('images/payment.png') }} style="max-width:260px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="wrap-footer-item">
                                <h3 class="item-header">Social network</h3>
                                <div class="item-content">
                                    <div class="wrap-list-item social-network">
                                        <ul>
                                            <li><a href="#" class="link-to-item" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <li><a href="#" class="link-to-item" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li><a href="#" class="link-to-item" title="pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                            <li><a href="#" class="link-to-item" title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                            <li><a href="#" class="link-to-item" title="vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                            <div class="wrap-footer-item">
                                <h3 class="item-header">Dowload App</h3>
                                <div class="item-content">
                                    <div class="wrap-list-item apps-list">
                                        <ul>
                                            <li><a href="#" class="link-to-item" title="our application on apple store"><figure><img src={{ asset('images/brands/apple-store.png') }} alt="apple-store" width="128" height="36"></figure></a></li>
                                            <li><a href="#" class="link-to-item" title="our application on google play store"><figure><img src={{ asset('images/brands/google-play-store.png') }} alt="google-play-store" width="128" height="36"></figure></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="coppy-right-box">
                <div class="container">
                    <div class="coppy-right-item item-left">
                        <p class="coppy-right-text">Copyright © 2020 Surfside Media. All rights reserved</p>
                    </div>
                    <div class="coppy-right-item item-right">
                        <div class="wrap-nav horizontal-nav">
                            <ul>
                                <li class="menu-item"><a href={{ route('user.about-us') }} class="link-term">About us</a></li>
                                <li class="menu-item"><a href="privacy-policy.html" class="link-term">Privacy Policy</a></li>
                                <li class="menu-item"><a href="terms-conditions.html" class="link-term">Terms & Conditions</a></li>
                                <li class="menu-item"><a href="return-policy.html" class="link-term">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </footer>
    <div class="chat-button row m-0" id="buttonChat">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="chat-icon">
            <path d="M18 6.07a1 1 0 01.993.883L19 7.07v10.365a1 1 0 01-1.64.768l-1.6-1.333H6.42a1 1 0 01-.98-.8l-.016-.117-.149-1.783h9.292a1.8 1.8 0 001.776-1.508l.018-.154.494-6.438H18zm-2.78-4.5a1 1 0 011 1l-.003.077-.746 9.7a1 1 0 01-.997.923H4.24l-1.6 1.333a1 1 0 01-.5.222l-.14.01a1 1 0 01-.993-.883L1 13.835V2.57a1 1 0 011-1h13.22zm-4.638 5.082c-.223.222-.53.397-.903.526A4.61 4.61 0 018.2 7.42a4.61 4.61 0 01-1.48-.242c-.372-.129-.68-.304-.902-.526a.45.45 0 00-.636.636c.329.33.753.571 1.246.74A5.448 5.448 0 008.2 8.32c.51 0 1.126-.068 1.772-.291.493-.17.917-.412 1.246-.74a.45.45 0 00-.636-.637z"></path>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 22" class="chat-icon">
            <path d="M9.286 6.001c1.161 0 2.276.365 3.164 1.033.092.064.137.107.252.194.09.085.158.064.203 0 .046-.043.182-.194.251-.26.182-.17.433-.43.752-.752a.445.445 0 00.159-.323c0-.172-.092-.3-.227-.365A7.517 7.517 0 009.286 4C5.278 4 2 7.077 2 10.885s3.256 6.885 7.286 6.885a7.49 7.49 0 004.508-1.484l.022-.043a.411.411 0 00.046-.71v-.022a25.083 25.083 0 00-.957-.946.156.156 0 00-.227 0c-.933.796-2.117 1.205-3.392 1.205-2.846 0-5.169-2.196-5.169-4.885C4.117 8.195 6.417 6 9.286 6zm32.27 9.998h-.736c-.69 0-1.247-.54-1.247-1.209v-3.715h1.96a.44.44 0 00.445-.433V9.347h-2.45V7.035c-.021-.043-.066-.065-.111-.043l-1.603.583a.423.423 0 00-.29.41v1.362h-1.781v1.295c0 .238.2.433.445.433h1.337v4.19c0 1.382 1.158 2.505 2.583 2.505H42v-1.339a.44.44 0 00-.445-.432zm-21.901-6.62c-.739 0-1.41.172-2.013.496V4.43a.44.44 0 00-.446-.43h-1.788v13.77h2.234v-4.303c0-1.076.895-1.936 2.013-1.936 1.117 0 2.01.86 2.01 1.936v4.239h2.234v-4.561l-.021-.043c-.202-2.088-2.012-3.723-4.223-3.723zm10.054 6.785c-1.475 0-2.681-1.12-2.681-2.525 0-1.383 1.206-2.524 2.681-2.524 1.476 0 2.682 1.12 2.682 2.524 0 1.405-1.206 2.525-2.682 2.525zm2.884-6.224v.603a4.786 4.786 0 00-2.985-1.035c-2.533 0-4.591 1.897-4.591 4.246 0 2.35 2.058 4.246 4.59 4.246 1.131 0 2.194-.388 2.986-1.035v.604c0 .237.203.431.453.431h1.356V9.508h-1.356c-.25 0-.453.173-.453.432z"></path>
        </svg>
    </div>
    <div class="chat-content">
        <div class="chat-header">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 22" class="chat-icon">
                <path d="M9.286 6.001c1.161 0 2.276.365 3.164 1.033.092.064.137.107.252.194.09.085.158.064.203 0 .046-.043.182-.194.251-.26.182-.17.433-.43.752-.752a.445.445 0 00.159-.323c0-.172-.092-.3-.227-.365A7.517 7.517 0 009.286 4C5.278 4 2 7.077 2 10.885s3.256 6.885 7.286 6.885a7.49 7.49 0 004.508-1.484l.022-.043a.411.411 0 00.046-.71v-.022a25.083 25.083 0 00-.957-.946.156.156 0 00-.227 0c-.933.796-2.117 1.205-3.392 1.205-2.846 0-5.169-2.196-5.169-4.885C4.117 8.195 6.417 6 9.286 6zm32.27 9.998h-.736c-.69 0-1.247-.54-1.247-1.209v-3.715h1.96a.44.44 0 00.445-.433V9.347h-2.45V7.035c-.021-.043-.066-.065-.111-.043l-1.603.583a.423.423 0 00-.29.41v1.362h-1.781v1.295c0 .238.2.433.445.433h1.337v4.19c0 1.382 1.158 2.505 2.583 2.505H42v-1.339a.44.44 0 00-.445-.432zm-21.901-6.62c-.739 0-1.41.172-2.013.496V4.43a.44.44 0 00-.446-.43h-1.788v13.77h2.234v-4.303c0-1.076.895-1.936 2.013-1.936 1.117 0 2.01.86 2.01 1.936v4.239h2.234v-4.561l-.021-.043c-.202-2.088-2.012-3.723-4.223-3.723zm10.054 6.785c-1.475 0-2.681-1.12-2.681-2.525 0-1.383 1.206-2.524 2.681-2.524 1.476 0 2.682 1.12 2.682 2.524 0 1.405-1.206 2.525-2.682 2.525zm2.884-6.224v.603a4.786 4.786 0 00-2.985-1.035c-2.533 0-4.591 1.897-4.591 4.246 0 2.35 2.058 4.246 4.59 4.246 1.131 0 2.194-.388 2.986-1.035v.604c0 .237.203.431.453.431h1.356V9.508h-1.356c-.25 0-.453.173-.453.432z"></path>
            </svg>
        </div>
        <div class="chat-body row m-0">
            <div class="content">
                <div class="contact-profile">
                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                    <p>Harvey Specter</p>
                </div>
                <div class="messages">
                    <ul>
                        <li class="sent">
                            <p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
                        </li>
{{--                        <li class="replies">--}}
{{--                            <p>When you're backed against the wall, break the god damn thing down.</p>--}}
{{--                        </li>--}}
{{--                        <li class="replies">--}}
{{--                            <p>Excuses don't win championships.</p>--}}
{{--                        </li>--}}
{{--                        <li class="sent">--}}
{{--                            <p>Oh yeah, did Michael Jordan tell you that?</p>--}}
{{--                        </li>--}}
{{--                        <li class="replies">--}}
{{--                            <p>No, I told him that.</p>--}}
{{--                        </li>--}}
{{--                        <li class="replies">--}}
{{--                            <p>What are your choices when someone puts a gun to your head?</p>--}}
{{--                        </li>--}}
{{--                        <li class="sent">--}}
{{--                            <p>What are you talking about? You do what they say or they shoot you.</p>--}}
{{--                        </li>--}}
{{--                        <li class="replies">--}}
{{--                            <p>Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>--}}
{{--                        </li>--}}
                    </ul>
                </div>
                <div class="message-input">
                    <div class="wrap">
                        <input type="text" placeholder="Write your message..." id="message"/>
                        <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                        <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            <div class="contacts">
                <ul>
                    <li class="contact">
                        <div class="wrap">
                            <img src="http://emilcarlsson.se/assets/louislitt.png" alt="" />
                            <div class="meta">
                                <p class="name">Louis Litt</p>
                                <p class="preview">You just got LITT up, Mike.</p>
                            </div>
                        </div>
                    </li>
                    <li class="contact active">
                        <div class="wrap">
                            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                            <div class="meta">
                                <p class="name">Harvey Specter</p>
                                <p class="preview">Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>
                            </div>
                        </div>
                    </li>
                    <li class="contact">
                        <div class="wrap">
                            <img src="http://emilcarlsson.se/assets/rachelzane.png" alt="" />
                            <div class="meta">
                                <p class="name">Rachel Zane</p>
                                <p class="preview">I was thinking that we could have chicken tonight, sounds good?</p>
                            </div>
                        </div>
                    </li>
                    <li class="contact">
                        <div class="wrap">
                            <img src="http://emilcarlsson.se/assets/donnapaulsen.png" alt="" />
                            <div class="meta">
                                <p class="name">Donna Paulsen</p>
                                <p class="preview">Mike, I know everything! I'm Donna..</p>
                            </div>
                        </div>
                    </li>
                    <li class="contact">
                        <div class="wrap">
                            <img src="http://emilcarlsson.se/assets/jessicapearson.png" alt="" />
                            <div class="meta">
                                <p class="name">Jessica Pearson</p>
                                <p class="preview">Have you finished the draft on the Hinsenburg deal?</p>
                            </div>
                        </div>
                    </li>
                    <li class="contact">
                        <div class="wrap">
                            <img src="http://emilcarlsson.se/assets/haroldgunderson.png" alt="" />
                            <div class="meta">
                                <p class="name">Harold Gunderson</p>
                                <p class="preview">Thanks Mike! :)</p>
                            </div>
                        </div>
                    </li>
                    <li class="contact">
                        <div class="wrap">
                            <img src="http://emilcarlsson.se/assets/danielhardman.png" alt="" />
                            <div class="meta">
                                <p class="name">Daniel Hardman</p>
                                <p class="preview">We'll meet again, Mike. Tell Jessica I said 'Hi'.</p>
                            </div>
                        </div>
                    </li>
                    <li class="contact">
                        <div class="wrap">
                            <img src="http://emilcarlsson.se/assets/katrinabennett.png" alt="" />
                            <div class="meta">
                                <p class="name">Katrina Bennett</p>
                                <p class="preview">I've sent you the files for the Garrett trial.</p>
                            </div>
                        </div>
                    </li>
                    <li class="contact">
                        <div class="wrap">
                            <img src="http://emilcarlsson.se/assets/charlesforstman.png" alt="" />
                            <div class="meta">
                                <p class="name">Charles Forstman</p>
                                <p class="preview">Mike, this isn't over.</p>
                            </div>
                        </div>
                    </li>
                    <li class="contact">
                        <div class="wrap">
                            <img src="http://emilcarlsson.se/assets/jonathansidwell.png" alt="" />
                            <div class="meta">
                                <p class="name">Jonathan Sidwell</p>
                                <p class="preview">That's bullshit. This deal is solid.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
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
    $('.submit').click(function (e) {
        e.preventDefault();
        var formComment = new FormData();
        var message = $('#message').val();
        var boxChat = $('.messages');
        boxChat[0].scrollTop = boxChat[0].scrollHeight;
        formComment.append('message', message);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            contentType: false,
            processData: false,
            url: '{{ route('chat.submit') }}',
            type: 'POST',
            dataType: 'json',
            data: formComment,
            success: function (response) {
                $('<li class="replies"><p>' + response.message + '</p></li>').appendTo($('.messages ul'));
                $('.message-input input').val(null);
            }, error: function () {
                alert("Có lỗi xảy ra");
            },
        });
    });
</script>
