@extends('layouts.app')
@section('title', $user->name)
@section('class-body', 'checkout page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="#" class="link">fastBuy</a>
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
    <input type="hidden" id="urlFollowProduct" value="{{ route('user.follow-product') }}">
    <input type="hidden" id="userId" value="{{ Auth::id() }}">
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
                                    <button class="btn" onclick="window.location.href='{{ route('messages.index') }}'"><i class="fas fa-comments"></i> CHAT</button>
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
                @if ($user->number_item != 0)
                <div class="summary-item payment-method product-content-area">
                    <h4 class="title">danh sách sản phẩm</h4>
                </div>
                <div class="post-list mx-0">
                    <ul class="product-list grid-products equal-container row m-0">
                        @foreach($products as $product)
                            @include('modal.confirm_delete_product_modal')
                            <li class="col-lg-2 col-md-6 col-sm-6 col-xs-6 m-0">
                                <a href="{{ route('products.show', $product->id) }}">
                                    <div class="product product-style-3">
                                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                        <div class="product-info">
                                            <a href="{{ route('products.show', $product->id) }}" class="product-name"><span>{{ $product->name }}</span></a>
                                            <div class="wrap-price"><span class="item-price"><span class="currency">₫</span>{{ number_format($product->price, 0) }}</span></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center action-product">
                                            <a href="{{ route('products.show', $product->id) }}" class="m-2"><button class="btn btn-success">Xem</button></a>
                                            @if ($user->id != Auth::id())
                                            <i class="fas fa-heart m-2 follow-product {{ $product->checkIfUserFollowProduct() ? 'followed' : '' }}" data-id="{{ $product->id }}"></i>
                                            @else
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteProductModal{{ $product->id }}">Xóa</button>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="pagination-custom d-flex justify-content-end pt-3 mr-3">
                        {{ $products->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
                @endif
                @if ($productsFollow != [])
                    <div class="summary-item payment-method product-content-area">
                        <h4 class="title">Sản phẩm đang theo dõi</h4>
                    </div>
                    <div class="post-list mx-0">
                        <ul class="product-list grid-products equal-container row m-0">
                            @foreach($productsFollow as $product)
                                <li class="col-lg-2 col-md-6 col-sm-6 col-xs-6 m-0">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <div class="product product-style-3">
                                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                            <div class="product-info">
                                                <a href="{{ route('products.show', $product->id) }}" class="product-name"><span>{{ $product->name }}</span></a>
                                                <div class="wrap-price"><span class="item-price"><span class="currency">₫</span>{{ number_format($product->price, 0) }}</span></div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center action-product">
                                                <a href="{{ route('products.show', $product->id) }}" class="m-2"><button class="btn btn-success">Xem</button></a>
                                                <i class="fas fa-heart m-2 follow-product {{ $product->checkIfUserFollowProduct() ? 'followed' : '' }}" data-id="{{ $product->id }}"></i>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($followings != [])
                    <div class="summary-item payment-method product-content-area">
                        <h4 class="title">Shop đang theo dõi</h4>
                    </div>
                        <div class="col-lg-12 main-content-area row m-0">
                            @foreach ($followings as $user)
                                <div class="col-lg-6 search-user row m-0">
                                    <div class="avatar-user">
                                        <a href="{{ route('users.show', $user->id) }}">
                                            @if (isset($user->avatar))
                                                <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="">
                                            @else
                                                <img src="{{ asset('images/avatar-null.png') }}" alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="information-user">
                                        <a href="{{ route('users.show', $user->id) }}">
                                            <p class="name">{{ $user->name }}</p>
                                            <p>{{ $user->username }}</p>
                                            <p class="stat">
                                                <span style="color: #ee4d2d">{{ $user->follower }}</span> người theo dõi
                                                | <span style="color: #ee4d2d"><i class="fas fa-tshirt"></i> {{ $user->number_item }}</span> sản phẩm
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@include('modal.edit_user_modal')

