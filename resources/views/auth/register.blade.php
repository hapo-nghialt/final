@extends('layouts.app')
@section('title', 'Đăng ký')
@section('class-body', 'home-page home-01')
@section('class-main', 'main-site left-sidebar')

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="#" class="link">home</a></li>
            <li class="item-link"><span>Register</span></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
            <div class=" main-content-area">
                <div class="wrap-login-item ">
                    <div class="register-form form-item ">
                        <form class="form-stl" action={{ route('register') }} method="POST" >
                            @csrf
                            <fieldset class="wrap-title">
                                <h3 class="form-title">Đăng ký</h3>
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="text" id="frm-reg-lname" name="name" placeholder="Tên đăng ký">
                            </fieldset>
                            <fieldset class="wrap-input login-input">
                                <input type="email" id="frm-reg-email" name="email" placeholder="Email">
                            </fieldset>
                            <fieldset class="wrap-input item-width-in-half left-item login-input">
                                <input type="password" id="frm-reg-pass" name="password" placeholder="Mật khẩu">
                            </fieldset>
                            <fieldset class="wrap-input item-width-in-half login-input">
                                <input type="password" id="frm-reg-cfpass" name="reg-cfpass" placeholder="Nhập lại mật khẩu">
                            </fieldset>
                            <input type="submit" class="btn btn-sign" value="Register" name="register">
                        </form>
                    </div>
                </div>
            </div><!--end main products area-->
        </div>
    </div><!--end row-->
@endsection
