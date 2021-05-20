@extends('layouts.app')
@section('title', 'Đăng bài viết mới')
@section('class-body', 'checkout page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><span>đăng bài</span></li>
        </ul>
    </div>
    <div class=" main-content-area col-lg-12">
        <label class="wrap-address-billing create-product-form">
            <h3 class="box-title">bài viết mới</h3>
            <form action="{{ route('products.store') }}" method="POST" name="frm-billing" enctype="multipart/form-data">
                @csrf
                <div class="row-in-form">
                    <label for="title">tên sản phẩm <span>(*)</span></label>
                    <input id="title" type="text" name="title" value="" placeholder="Nhập tên sản phẩm" required>
                </div>
                <div class="row-in-form">
                    <label for="categories[]">thể loại <span>(*)</span></label>
                    <select id="categories[]" name="category" class="d-none">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
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
                    <label>ảnh phụ <span>(Tối đa 6 ảnh)</span></label>
                    <div class="row">
                        <div class="col-4">
                            <label for="image_1" class="label-image" id="labelImage1">
                                <span class="fas fa-images"></span>
                                <img src="#" alt="" class="preview-sub-image" id="previewSubImage1">
                            </label>
                            <input type="file" name="subImages[]" id="image_1" class="input-image">
                        </div>
                        @for ($i=2; $i<=6; $i++)
                            <div class="col-4">
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
                    <button type="submit" class="btn btn-medium mx-auto">Create</button>
                </div>
            </form>
        </div>
        <div class="wrap-show-advance-info-box style-1 box-in-site">
            <h3 class="title-box">Most Viewed Products</h3>
            <div class="wrap-products">
                <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item new-label">new</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_17.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item sale-label">sale</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_15.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item new-label">new</span>
                                <span class="flash-item sale-label">sale</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_01.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item bestseller-label">Bestseller</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_21.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_03.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item sale-label">sale</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item new-label">new</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>

                    <div class="product product-style-2 equal-elem ">
                        <div class="product-thumnail">
                            <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="assets/images/products/digital_05.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                            <div class="group-flash">
                                <span class="flash-item bestseller-label">Bestseller</span>
                            </div>
                            <div class="wrap-btn">
                                <a href="#" class="function-link">quick view</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                            <div class="wrap-price"><span class="product-price">$250.00</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
