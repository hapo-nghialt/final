@extends('layouts.app')
@section('title', 'Bài viết mới')
@section('class-body', 'checkout page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="{{ route('home') }}" class="link">fastBuy</a>
            <i class="fas fa-chevron-right"></i>
            <span>Bài viết mới</span>
        </div>
    </div>
    <div class=" main-content-area col-lg-12">
        <div class="cart-page-shop create-product-form">
            <h3 class="box-title">bài viết mới</h3>
            <form action="{{ route('products.store') }}" method="POST" name="frm-billing" enctype="multipart/form-data">
                @csrf
                <div class="row-in-form">
                    <label for="title">tên sản phẩm <span>(*)</span></label>
                    <input id="title" type="text" name="name" value="" placeholder="Nhập tên sản phẩm" required>
                </div>
                <div class="row-in-form">
                    <label for="categories[]">thể loại <span>(*)</span></label>
                    <select id="categories[]" name="category" class="d-none">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row-in-form">
                    <label for="price">giá (VNĐ) <span>(*)</span></label>
                    <input id="price" type="number" name="price" value="" placeholder="Nhập giá sản phẩm" required>
                </div>
                <div class="row-in-form">
                    <label for="status">số lượng <span>(*)</span></label>
                    <input id="status" type="number" name="amount" value="" placeholder="Nhập số lượng hàng trong kho" required>
                </div>
                <div class="row-in-form">
                    <label for="address">địa chỉ <span>(*)</span></label>
                    <input id="address" type="text" name="address" value="" placeholder="Nhập địa chỉ bán sản phẩm" required>
                </div>
                <div class="row-in-form" style="display: grid;">
                    <label>ảnh chính <span>*</span></label>
                    <label for="imageProduct" class="label-image image-product">
                        <span class="fas fa-images"></span>
                        <img src="#" alt="" class="preview-image" id="previewProductImage">
                    </label>
                    <input type="file" name="image" id="imageProduct" class="input-image">
                </div>
                <div class="row-in-form">
                    <label for="description">mô tả <span>(*)</span></label>
                    <textarea rows="8" id="description" name="description" placeholder="Description" required></textarea>
                </div>
                <div class="row-in-form">
                    <label>ảnh phụ <span>*</span> <span>(Tối đa 6 ảnh)</span></label>
                    <div class="row">
                        <div class="col-4">
                            <label for="image_1" class="label-image" id="labelImage1">
                                <span class="fas fa-images"></span>
                                <img src="#" alt="" class="preview-sub-image" id="previewSubImage1">
                            </label>
                            <input type="file" name="subImages[]" id="image_1" class="input-image">
                        </div>
                        @for ($i=2; $i<=6; $i++)
                            <div class="col-4 input-sub-image">
                                <label for="image_{{ $i }}" class="label-image d-none" id="labelImage{{ $i }}">
                                    <span class="fas fa-images"></span>
                                    <img src="#" alt="" class="preview-sub-image" id="previewSubImage{{ $i }}">
                                </label>
                                <input type="file" name="subImages[]" id="image_{{ $i }}" class="input-image">
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="summary-item row-in-form w-100 d-flex">
                    <button type="submit" class="btn btn-medium mx-auto">Tạo mới sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
