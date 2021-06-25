@extends('layouts.app')
@section('title', 'Giỏ Hàng')
@section('class-body', 'shopping-cart page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="{{ route('home') }}" class="link">Shopee</a>
            <i class="fas fa-chevron-right"></i>
            <span>Giỏ Hàng</span>
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
    <div class="main-content-area col-lg-12">
        <h3 class="box-title">Giỏ Hàng</h3>
    </div>
    @foreach ($orders as $order)
        <div class="main-content-area col-lg-12">
        <div class="cart-page-shop create-product-form w-100">
            <div class="cart-page-shop-header d-flex align-items-center">
                <a href="{{ route('users.show', $order->shops()->id) }}" class="cart-page-shop-header__name">
                    <svg width="17" height="16" viewBox="0 0 17 16" class="_2zTpu5">
                        <path d="M1.95 6.6c.156.804.7 1.867 1.357 1.867.654 0 1.43 0 1.43-.933h.932s0 .933 1.155.933c1.176 0 1.15-.933 1.15-.933h.984s-.027.933 1.148.933c1.157 0 1.15-.933 1.15-.933h.94s0 .933 1.43.933c1.368 0 1.356-1.867 1.356-1.867H1.95zm11.49-4.666H3.493L2.248 5.667h12.437L13.44 1.934zM2.853 14.066h11.22l-.01-4.782c-.148.02-.295.042-.465.042-.7 0-1.436-.324-1.866-.86-.376.53-.88.86-1.622.86-.667 0-1.255-.417-1.64-.86-.39.443-.976.86-1.643.86-.74 0-1.246-.33-1.623-.86-.43.536-1.195.86-1.895.86-.152 0-.297-.02-.436-.05l-.018 4.79zM14.996 12.2v.933L14.984 15H1.94l-.002-1.867V8.84C1.355 8.306 1.003 7.456 1 6.6L2.87 1h11.193l1.866 5.6c0 .943-.225 1.876-.934 2.39v3.21z" stroke-width=".3" stroke="#333" fill="#333" fill-rule="evenodd"></path>
                    </svg>
                    {{ $order->shops()->name }}
                </a>
            </div>
            <div class="cart-item row m-0">
                <div class="cart-item-checkbox d-flex align-items-center justify-content-center">
                    <input type="checkbox" name="" id="">
                </div>
                <div class="cart-item-overview col-lg-4 p-0">
                    <div class="row m-0">
                        <div class="cart-item-overview__image">
                            <img src="{{ asset('storage/products/' . $order->products()->first()->image) }}" alt="">
                        </div>
                        <div class="cart-item-overview_product-name">
                            <a href="{{ route('products.show', $order->products()->first()->id) }}" class="cart-item-overview__name" title="{{ $order->products()->first()->name }}">
                                {{ $order->products()->first()->name }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="cart-item-unit-price col-lg-2 p-0 d-flex align-items-center justify-content-center">
                    <div>
                        <span>₫{{ number_format($order->products()->first()->price, 0) }}</span>
                    </div>
                </div>
                <div class="cart-item-quantity d-flex align-items-center justify-content-center">
                    <div class="quantity-input">
                        <div class="btn btn-reduce" data-id="{{ $order->id }}" href="#"></div>
                        <input type="hidden" id="unitPrice{{ $order->id }}" value="{{ $order->products()->first()->price }}">
                        <input type="text" name="product-quantity" data-id="{{ $order->id }}" id="productQuantity{{ $order->id }}"
                               value="{{ $order->quantity }}" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                        <div class="btn btn-increase" data-id="{{ $order->id }}" href="#"></div>
                    </div>
                </div>
                <div class="cart-item-total-price col-lg-3 d-flex align-items-center justify-content-center">
                    <span id="totalPrice{{ $order->id }}">₫{{ number_format($order->amount, 0) }}</span>
                </div>
                <div class="cart-item-action d-flex align-items-center justify-content-center">
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-delete-order">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
