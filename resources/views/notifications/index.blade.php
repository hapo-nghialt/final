@extends('layouts.app')
@section('title', 'Thông báo')
@section('class-body', 'checkout page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="#" class="link">fastBuy</a>
            <i class="fas fa-chevron-right"></i>
            <span>Thông báo</span>
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
    <div class="notifications chat-content row m-0">
        @foreach($notifications as $noti)
        <div class="notifications-content d-flex align-items-center w-100">
            <div>
                <img src="{{ asset('images/avatar-null.png') }}" alt="">
            </div>
            <div class="content">{{ $noti->content }}</div>
            <div>
                <form action="{{ route('notifications.destroy', $noti->id) }}" method="POST">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endsection
