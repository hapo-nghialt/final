@extends('layouts.app')
@section('title', 'Login')
@section('class-body', 'home-page home-01')
@section('class-main', 'main-site left-sidebar')

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="#" class="link">home</a></li>
            <li class="item-link"><span>login</span></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
            <div class=" main-content-area">
                <div class="wrap-login-item ">
                    <div class="login-form form-item form-stl">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <fieldset class="wrap-title">
                                <h3 class="form-title">login</h3>
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="text" id="frm-login-uname" name="username" placeholder="Username" value="{{ old('username') }}">
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="password" id="frm-login-pass" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input">
                                <label class="remember-field">
                                    <input class="frm-input " name="rememberme" id="rememberme" value="forever" type="checkbox"><span>Remember me</span>
                                </label>
                                <a class="link-function left-position" href="#" title="Forgotten password?">Forgotten password?</a>
                            </fieldset>
                            <input type="submit" class="btn btn-submit" value="Login" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
