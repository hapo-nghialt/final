@extends('admin.layouts.app')
@section('title', 'Quản lý sản phẩm')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý sản phẩm</li>
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
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 20px;">ID</th>
                                    <th style="width: 400px;">Tên sản phẩm</th>
                                    <th style="width: 60px;">Số lượng</th>
                                    <th style="width: 60px;">Shop</th>
                                    <th style="width: 100px;">Danh mục</th>
                                    <th style="width: 120px;">Trạng thái</th>
                                    <th style="width: 200px;">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td style="text-align: end">{{ number_format($value->amount, 0) }}</td>
                                        <td>{{ $value->name_shop }}</td>
                                        <td>{{ $value->name_category }}</td>
                                        <td style="text-align: center">
                                            @if ($value->status == \App\Models\Product::STATUS['show'])
                                            Hiện
                                            @else
                                            Ẩn
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            <form action="{{ route('admin.products.update-status', $value->id) }}" method="POST" style="display: inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary">Thay đổi</button>
                                            </form>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#detailProduct{{ $key }}">Chi tiết</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $key }}">Xóa</button>
                                        </td>
                                    </tr>
                                    @include ('modal.detail_product_modal')
                                    @include ('modal.confirm_delete_modal')
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
