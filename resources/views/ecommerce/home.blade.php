@extends('layouts.app')

@section('title', 'Trang chủ')
@section('class-body', 'home-page home-01')

@section('content')
    <div class="wrap-main-slide mb-4">
        <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
            <div class="item-slide">
                <img src="{{ asset('images/banner-1.png') }}" alt="" class="img-slide">
            </div>
        </div>
    </div>
    <div class="wrap-show-advance-info-box style-1 container">
        <h3 class="title-box">DANH MỤC</h3>
        <div class="container">
            <div class="list-categories row m-0 pb-3">
                @foreach ($categories as $category)
                    <div>
                        <a href="{{ route('show-products', $category->id) }}">
                            <img src="{{ asset('storage/categories/' . $category->image) }}" alt="">
                            <br>
                            {{ $category->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="wrap-show-advance-info-box style-1 container mt-3">
        <h3 class="title-box">Sản phẩm mới</h3>
        <div class="post-list mx-0">
            <ul class="product-list grid-products equal-container row m-0 p-0">
                @foreach($newProducts as $product)
                    <li class="col-lg-2 col-md-6 col-sm-6 col-xs-6 m-0">
                        <a href="{{ route('products.show', $product->id) }}">
                            <div class="product product-style-3">
                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="product-info">
                                    <a href="{{ route('products.show', $product->id) }}" class="product-name"><span>{{ $product->name }}</span></a>
                                    <div class="wrap-price"><span class="item-price"><span class="currency">₫</span>{{ number_format($product->price, 0) }}</span></div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="m-4 d-flex align-items-center justify-content-center"><a href="{{ route('see-all-products') }}" class="see-all-product">Xem tất cả</a></div>
@endsection()
