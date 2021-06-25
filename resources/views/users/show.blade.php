@extends('layouts.app')
@section('title', $user->name)
@section('class-body', 'checkout page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="#" class="link">Shopee</a>
            <i class="fas fa-chevron-right"></i>
            <span>{{ $user->name }}</span>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="message-success" id="messageSuccess">
            <div>
                <img src="{{ asset('images/add-to-card-successfully.png') }}" alt="">
                {{ session()->get('message') }}
            </div>
        </div>
    @endif
    <div class="main-content-area">
        <div class="personal-page">
            <div class="personal-card-info">
                <div class="summary-item">
                    <div class="personal-card-background">
                    </div>
                    <div class="personal-card row">
                        <div class="avatar-shop col-4">
                            <img src="{{ $user->avatar ? asset('storage/avatars/' . $user->avatar) : asset('images/avatar-null.png') }}" alt="">
                        </div>
                        <div class="col-8 summary-info">
                            <b class="index">{{ $user->name }}</b>
                            @if (Auth::check() && (Auth::user()->id == $user->id))
                            <div class="update-info" data-toggle="modal" data-target="#editUserModal">Chỉnh sửa thông tin</div>
                            @endif
                        </div>
                        @if (!Auth::check())
                            <div class="col-12 row btn-action-user">
                                <div class="col-6">
                                    <button class="btn" onclick="window.location.href='{{ route('login') }}'"><i class="fas fa-plus"></i> THEO DÕI</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn" onclick="window.location.href='{{ route('login') }}'"><i class="fas fa-comments"></i> CHAT</button>
                                </div>
                            </div>
                        @elseif (Auth::user()->id !== $user->id)
                            <div class="col-12 row btn-action-user">
                                <div class="col-6">
                                    <input type="hidden" id="followUrl" value="{{ route('follow') }}">
                                    <input type="hidden" id="unfollowUrl" value="{{ route('unfollow') }}">
                                    <input type="hidden" id="followerId" value="{{ Auth::user()->id }}">
                                    <input type="hidden" id="followingId" value="{{ $user->id }}">
                                    @if ($user->isFollowing($user->id))
                                    <button class="btn btn-unfollow" id="buttonUnfollow">ĐANG THEO DÕI</button>
                                    <button class="btn d-none" id="buttonFollow"><i class="fas fa-plus"></i> THEO DÕI</button>
                                    @else
                                    <button class="btn btn-unfollow d-none" id="buttonUnfollow">ĐANG THEO DÕI</button>
                                    <button class="btn" id="buttonFollow"><i class="fas fa-plus"></i> THEO DÕI</button>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <button class="btn"><i class="fas fa-comments"></i> CHAT</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="summary-item personal-items">
                    <h4 class="box-title f-title">thông tin</h4>
                    <div class="row">
                        <p class="summary-info col-6">
                            <span class="title">Sản phẩm: </span>
                            <b class="index">{{ $user->number_item }}</b>
                        </p>
                        <p class="summary-info col-6">
                            <span class="title">Người theo dõi: </span>
                            <b class="index" id="followerNumber">{{ $user->follower }}</b>
                        </p>
                        <p class="summary-info col-6">
                            <span class="title">Địa chỉ: </span>
                            <b class="index">{{ $user->address }}</b>
                        </p>
                        <p class="summary-info col-6">
                            <span class="title">Email: </span>
                            <b class="index">{{ $user->email }}</b>
                        </p>
                        <p class="summary-info col-6">
                            <span class="title">Số điện thoại: </span>
                            <b class="index">{{ $user->phone_number }}</b>
                        </p>
                        <p class="summary-info col-6">
                            <span class="title">Tham gia: </span>
                            <b class="index">{{ $user->getCreatedDateFormat() }}</b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="personal-information summary">
                <div class="summary-item payment-method product-content-area">
                    <h4 class="title">danh sách sản phẩm</h4>
                </div>
                <div class="post-list mx-0">
                    <ul class="product-list grid-products equal-container row m-0">
                        @foreach($products as $product)
                            <li class="col-lg-2 col-md-6 col-sm-6 col-xs-6 m-0">
                                <a href="{{ route('products.show', $product->id) }}">
                                    <div class="product product-style-3">
                                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>{{ $product->name }}</span></a>
                                            <div class="wrap-price"><span class="item-price"><span class="currency">₫</span>{{ number_format($product->price, 0) }}</span></div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="wrap-show-advance-info-box style-1 box-in-site">
            <h3 class="title-box">Most Viewed Products</h3>
            <div class="wrap-products">
                <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item new-label">new</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_17.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item sale-label">sale</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_15.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item new-label">new</span>
                                <span class="flash-item sale-label">sale</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_01.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item bestseller-label">Bestseller</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_21.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_03.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item sale-label">sale</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item new-label">new</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_05.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item bestseller-label">Bestseller</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('modal.edit_user_modal')
