@extends('layouts.app')
@section('title', 'Đăng Ký')
@section('class-body', 'home-page home-01')
@section('class-main', 'main-site left-sidebar')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="#" class="link">Shopee</a>
            <i class="fas fa-chevron-right"></i>
            <span>Đăng Ký</span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
            <div class=" main-content-area">
                <div class="wrap-login-item ">
                    <div class="register-form form-item form-stl">
                        <form method="POST" class="form-stl" action={{ route('register') }}>
                            @csrf
                            <fieldset class="wrap-title">
                                <h3 class="form-title">đăng ký</h3>
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="text" id="frm-reg-lname" name="name" placeholder="Tên đầy đủ (bắt buộc)">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="text" id="frm-reg-lname" name="username" placeholder="Tên đăng nhập (bắt buộc)">
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="email" id="frm-reg-email" name="email" placeholder="Email (bắt buộc)">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input item-width-in-half left-item login-input">
                                <input type="password" id="frm-reg-pass" name="password" placeholder="Mật khẩu">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input item-width-in-half login-input">
                                <input type="password" id="frm-reg-confirm-password" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="text" id="frm-reg-phone-number" name="phone_number" placeholder="Số điện thoại">
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="text" id="frm-reg-address" name="address" placeholder="Địa chỉ">
                            </fieldset>
                            <fieldset class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-sign" value="Đăng ký" name="register">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
