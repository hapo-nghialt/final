@extends('admin.layouts.app')
@section('title', 'Quản lý danh mục')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý danh mục</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý danh mục</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    @if (session()->has('message'))
        <div class="message-success" id="messageSuccess">
            <div>
                <img src="{{ asset('images/add-to-card-successfully.png') }}" alt="">
                {{ session()->get('message') }}
            </div>
        </div>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title m-0">
                                <button class="btn btn-success" data-toggle="modal" data-target="#createCategoryModal"><i class="fas fa-plus-square"></i> Thêm mới</button>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Số sản phẩm</th>
{{--                                    <th>Hành động</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $key => $value)
                                    <tr>
                                        <td style="padding-top: 45px;">{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset('storage/categories/' . $value->image) }}" alt="" style="width: 90px;">
                                            {{ $value->name }}
                                        </td>
                                        <td style="padding-top: 45px; text-align: center">{{ number_format($value->number_products, 0) }}</td>
{{--                                        <td style="padding-top: 38px;">--}}
{{--                                            <button class="btn btn-danger">Xóa</button>--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include ('modal.create_category_modal')
@endsection
