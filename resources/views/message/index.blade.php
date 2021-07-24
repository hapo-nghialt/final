@extends('layouts.app')
@section('title', 'Chat')
@section('class-body', 'checkout page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="#" class="link">fastBuy</a>
            <i class="fas fa-chevron-right"></i>
            <span>Chat</span>
        </div>
    </div>
    <div class="chat-content row m-0">
        <div class="contacts">
            <ul>
                @foreach ($users as $user)
                <li class="contact" id="contact{{ $user->id }}" data-url="{{ route('messages.show', $user->id) }}" data-id="{{ $user->id }}">
                    <div class="wrap" style="display: flex; align-items: center;">
                        <img src="{{ asset('images/avatar-null.png') }}" alt="" />
                        <div class="meta" style="width: 62%;">
                            <p class="name">{{ $user->username }}</p>
                            <p class="preview">{{ $user->getLastMessage($user->id) }}</p>
                        </div>
                        <a href="{{ route('users.show', $user->id) }}"><i class="fas fa-user"></i></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="content">
            <div class="messages">
                <div id="noMessage">
                    <img src="{{ asset('images/message.png') }}" alt="">
                    <p>Xin chào!</p>
                </div>
                <ul id="messages">
                </ul>
            </div>
            <div class="message-input d-none">
                <div class="wrap">
                    <input type="text" placeholder="Write your message..." id="messageInput"/>
                    <button id="sendMessage"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection
