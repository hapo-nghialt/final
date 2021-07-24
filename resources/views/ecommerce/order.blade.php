@extends('layouts.app')
@section('title', 'Quản lý đơn hàng')
@section('class-body', 'shopping-cart page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="{{ route('home') }}" class="link">fastBuy</a>
            <i class="fas fa-chevron-right"></i>
            <span>Quản lý đơn hàng</span>
        </div>
    </div>
    @php($orders = Auth::user()->manageOrders()->get()->groupBy('customer_id'))
    @foreach($orders as $order)
        <div class="main-content-area col-lg-12">
            <div class="col-lg-3 cart-page-shop create-product-form w-100">
                <div class="cart-page-shop-header d-flex align-items-center">
                    Mã đơn hàng: <span style="color: #ee4d2d; margin-left: 5px;">{{ $order->first()->order_id }}</span>
                </div>
            </div>
            <div class="col-lg-3 cart-page-shop create-product-form w-100">
                <div class="cart-page-shop-header d-flex align-items-center">
                    Tên khách hàng: <span style="color: #ee4d2d; margin-left: 5px;">{{ $order->first()->customer_name }}</span>
                </div>
            </div>
        </div>
        @php($total = 0)
        @foreach($order as $item)
            {{ $item->amount }}
            @php($total = $total + $item->amount)
        @endforeach
        <b>{{ $total }}</b>
    @endforeach
@endsection

