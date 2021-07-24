@extends('layouts.app')
@section('title', 'Giỏ Hàng')
@section('class-body', 'shopping-cart page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="{{ route('home') }}" class="link">fastBuy</a>
            <i class="fas fa-chevron-right"></i>
            <span>Giỏ Hàng</span>
        </div>
    </div>
    @if (isset($message))
        <div class="message-success" id="messageSuccess">
            <div>
                <img src="{{ asset('images/add-to-card-successfully.png') }}" alt="">
                {{ $message }}
            </div>
        </div>
    @endif
        <div class="main-content-area col-lg-12 empty-cart">
            <div>Bạn chưa có món đồ nào trong giỏ hàng</div>
            <a href="{{ route('home') }}">Trang chủ</a>
        </div>
@endsection
