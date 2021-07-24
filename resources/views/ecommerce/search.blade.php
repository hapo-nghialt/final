@extends('layouts.app')
@section('title', 'Tìm kiếm: ' . $keyword)
@section('class-body', 'home-page home-01')
@section('class-main', 'main-site left-sidebar')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="#" class="link">fastBuy</a>
            <i class="fas fa-chevron-right"></i>
            <span>Tìm kiếm</span>
        </div>
    </div>
    <div class="row m-0">
        @if (sizeof($users) != 0)
            <div class="col-lg-12">
                <p>Shop liên quan đến '<span style="color: #ee4d2d">{{ $keyword }}</span>':</p>
            </div>
            <div class="col-lg-12 main-content-area row m-0">
                @foreach ($users as $user)
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
        <div class="col-lg-12 mt-3">
            <p>Kết quả tìm kiếm cho từ khóa '<span style="color: #ee4d2d">{{ $keyword }}</span>':</p>
        </div>
        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12 main-content-area">
            @if (sizeof($products) != 0)
            <div class="row w-100 m-0">
                <ul class="product-list grid-products equal-container row w-100">
                    @foreach ($products as $product)
                        <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <figure><img src="{{ asset('storage/products/' . $product->image) }}" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>{{ $product->name }}</span></a>
                                    <div class="wrap-price"><span>₫</span>{{ number_format($product->price, 0) }}</div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="pagination-custom d-flex justify-content-end pt-3">
                {{ $products->links('vendor.pagination.bootstrap-4') }}
            </div>
            @else
                <p style="margin: 10px">Chúng tôi không tìm thấy sản phẩm <b>{{ $keyword }}</b></p>
            @endif
        </div>
    </div>
@endsection
