@extends('layouts.app')
@section('title', 'Login')
@section('class-body', 'home-page home-01')
@section('class-main', 'main-site left-sidebar')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="#" class="link">Shopee</a>
            <i class="fas fa-chevron-right"></i>
            <span>Đăng Nhập</span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
            <div class=" main-content-area">
                <div class="wrap-login-item ">
                    <div class="login-form form-item form-stl">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <fieldset class="wrap-title">
                                <h3 class="form-title">đăng nhập</h3>
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="text" id="frm-login-uname" name="username" placeholder="Tên đăng nhập" value="{{ old('username') }}">
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="password" id="frm-login-pass" name="password" placeholder="Mật khẩu">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input">
                                <label class="remember-field">
                                    <input class="frm-input " name="rememberme" id="rememberme" value="forever" type="checkbox"><span>Ghi nhớ đăng nhập</span>
                                </label>
                                <a class="link-function left-position" href="#" title="Forgotten password?">Quên mật khẩu?</a>
                            </fieldset>
                            <input type="submit" class="btn btn-submit" value="Đăng nhập" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
