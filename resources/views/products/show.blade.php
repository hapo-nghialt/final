@extends('layouts.app')
@section('title', 'Chi tiết sản phẩm')
@section('class-body', 'detloail page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="{{ route('home') }}" class="link">fastBuy</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('show-products', $product->categories()->first()->id) }}" class="link">{{ $product->name_category }}</a>
            <i class="fas fa-chevron-right"></i>
            <span>{{ $product->name }}</span>
        </div>
    </div>
    <div class="row">
        <div class="message-success"></div>
        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12 main-content-area">
            <div class="wrap-product-detail">
                <div class="detail-media">
                    <div class="product-gallery">
                        <ul class="slides">
                            <li data-thumb="{{ asset('storage/products/' . $product->image) }}" class="d-flex justify-content-center">
                                <img src="{{ asset('storage/products/' . $product->image)}}" alt="product-thumbnail" />
                            </li>
                            @foreach ($subImageName as $subImage)
                                @if ($subImage !== null)
                                    <li data-thumb="{{ asset('storage/products/' . $subImage) }}" class="d-flex justify-content-center">
                                        <img src="{{ asset('storage/products/' . $subImage)}}" alt="product-thumbnail" />
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="detail-info">
                    <input type="hidden" id="productId" value="{{ $product->id }}">
                    @if (Auth::check())
                        <input type="hidden" id="customerId" value="{{ Auth::user()->id }}">
                    @endif
                    <input type="hidden" id="urlAddToCart" value="{{ route('orders.store') }}">
                    <input type="hidden" id="unitPrice" value="{{ $product->price }}">
                    <input type="hidden" id="numberOrder" value="{{ $numberOrder }}">
                    <input type="hidden" id="imageSuccess" value="{{ asset('images/add-to-card-successfully.png') }}">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <div class="wrap-price"><span class="product-price"><span>₫</span>{{ number_format($product->price, 0) }}</span></div>
                    <div class="quantity row m-0">
                        <span class="col-md-3 d-flex align-items-center">Số lượng:</span>
                        <div class="quantity-input">
                            <div class="btn btn-reduce" href="#"></div>
                            <input type="text" name="product-quantity" id="productQuantity" value="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            <div class="btn btn-increase" href="#"></div>
                        </div>
                        <span class="d-flex align-items-center ml-4">{{ $product->amount }} sản phẩm có sẵn</span>
                    </div>
                    <div class="wrap-buttons d-flex action-product">
                        @if (Auth::check())
                            <button class="btn add-to-cart" style="outline: none;" id="cartBtn"><i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng</button>
                            <input type="hidden" id="urlFollowProduct" value="{{ route('user.follow-product') }}">
                            <input type="hidden" id="userId" value="{{ Auth::id() }}">
                            <i class="fas fa-heart m-3 follow-product {{ $product->checkIfUserFollowProduct() ? 'followed' : '' }}" data-id="{{ $product->id }}"></i>
                        @else
                            <button class="btn add-to-cart" style="outline: none;"><a href="{{ route('login') }}" style="color: #ee4d2d"><i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng</a></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12 product-content-area mb-3">
            <div class="col-lg-3 information-user">
                <div class="avatar d-flex">
                    <img src="{{ $user->avatar ? asset('storage/avatars/' . $user->avatar) : asset('images/avatar-null.png') }}" alt="">
                    <div class="d-flex flex-column m-auto">
                        {{ $user->name }}
                        <div class="d-flex flex-row action-user mt-2">
                            <button class="btn mr-3" onclick="window.location.href='{{ route('messages.index') }}'"><i class="fas fa-comments"></i> Nhắn tin</button>
                            <button class="btn" onclick="window.location.href='{{ route('users.show', $user->id) }}'"><i class="fas fa-store"></i> Xem shop</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12 product-content-area">
            <div class="product-description">
                <div class="title">chi tiết sản phẩm</div>
                <div class="row">
                    <div class="col-md-2 title-description">Danh mục:</div>
                    <div class="col-md-8 d-flex flex-row align-items-center wrap-breadcrumb m-0">
                        <a href="{{ route('home') }}" class="link">fastBuy</a>
                        <i class="fas fa-chevron-right"></i>
                        <a href="#" class="link">{{ $product->name_category }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 title-description">Kho hàng:</div>
                    <div class="col-md-8 d-flex flex-row align-items-center wrap-breadcrumb m-0">
                        <span>{{ $product->amount }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 title-description">Gửi từ:</div>
                    <div class="col-md-8 d-flex flex-row align-items-center wrap-breadcrumb m-0">
                        <span>{{ $product->address }}</span>
                    </div>
                </div>
                <div class="title">mô tả sản phẩm</div>
                <div class="description">
                    {{ $product->description }}
                </div>
            </div>
        </div>
    </div>
@endsection
