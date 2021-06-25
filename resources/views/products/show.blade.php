@extends('layouts.app')
@section('title', 'Chi tiết sản phẩm')
@section('class-body', 'detloail page')
@section('class-main', 'main-site')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="{{ route('home') }}" class="link">Shopee</a>
            <i class="fas fa-chevron-right"></i>
            <a href="#" class="link">{{ $product->name_category }}</a>
            <i class="fas fa-chevron-right"></i>
            <span>{{ $product->name }}</span>
        </div>
    </div>
    <div class="row">
        <div class="message-success"></div>
        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12 main-content-area">
            <div class="wrap-product-detail">
                <div class="detail-media">
                    <div class="product-gallery">
                        <ul class="slides">
                            <li data-thumb="{{ asset('storage/products/' . $product->image) }}" class="d-flex justify-content-center">
                                <img src="{{ asset('storage/products/' . $product->image)}}" alt="product-thumbnail" />
                            </li>
                            @foreach ($subImageName as $subImage)
                                @if ($subImage !== null)
                                    <li data-thumb="{{ asset('storage/products/' . $subImage) }}" class="d-flex justify-content-center">
                                        <img src="{{ asset('storage/products/' . $subImage)}}" alt="product-thumbnail" />
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="detail-info">
                    <input type="hidden" id="productId" value="{{ $product->id }}">
                    @if (Auth::check())
                        <input type="hidden" id="customerId" value="{{ Auth::user()->id }}">
                    @endif
                    <input type="hidden" id="urlAddToCart" value="{{ route('orders.store') }}">
                    <input type="hidden" id="unitPrice" value="{{ $product->price }}">
                    <input type="hidden" id="numberOrder" value="{{ $numberOrder }}">
                    <input type="hidden" id="imageSuccess" value="{{ asset('images/add-to-card-successfully.png') }}">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <div class="wrap-price"><span class="product-price"><span>₫</span>{{ number_format($product->price, 0) }}</span></div>
                    <div class="quantity row m-0">
                        <span class="col-md-3 d-flex align-items-center">Số lượng:</span>
                        <div class="quantity-input">
                            <div class="btn btn-reduce" href="#"></div>
                            <input type="text" name="product-quantity" id="productQuantity" value="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            <div class="btn btn-increase" href="#"></div>
                        </div>
                        <span class="d-flex align-items-center ml-4">{{ $product->amount }} sản phẩm có sẵn</span>
                    </div>
                    <div class="wrap-buttons">
                        @if (Auth::check())
                            <button class="btn add-to-cart" style="outline: none;" id="cartBtn"><i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng</button>
                        @else
                            <button class="btn add-to-cart" style="outline: none;"><a href="{{ route('login') }}" style="color: #ee4d2d"><i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng</a></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12 product-content-area">
            <div class="product-description">
                <div class="title">chi tiết sản phẩm</div>
                <div class="row">
                    <div class="col-md-2 title-description">Danh mục:</div>
                    <div class="col-md-8 d-flex flex-row align-items-center wrap-breadcrumb m-0">
                        <a href="{{ route('home') }}" class="link">Shopee</a>
                        <i class="fas fa-chevron-right"></i>
                        <a href="#" class="link">{{ $product->name_category }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 title-description">Kho hàng:</div>
                    <div class="col-md-8 d-flex flex-row align-items-center wrap-breadcrumb m-0">
                        <span>{{ $product->amount }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 title-description">Gửi từ:</div>
                    <div class="col-md-8 d-flex flex-row align-items-center wrap-breadcrumb m-0">
                        <span>{{ $product->address }}</span>
                    </div>
                </div>
                <div class="title">mô tả sản phẩm</div>
                <div class="description">
                    {{ $product->description }}
                </div>
            </div>
        </div>
        <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="wrap-show-advance-info-box style-1 box-in-site">
                <h3 class="title-box">Related Products</h3>
                <div class="wrap-products">
                    <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src={{ asset('images/products/digital_04.jpg') }} width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src={{ asset('images/products/digital_17.jpg') }} width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src={{ asset('images/products/digital_15.jpg') }} width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src={{ asset('images/products/digital_01.jpg') }} width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src={{ asset('images/products/digital_21.jpg') }} width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src={{ asset('images/products/digital_03.jpg') }} width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src={{ asset('images/products/digital_04.jpg') }} width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
                                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src={{ asset('images/products/digital_05.jpg') }} width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
                </div><!--End wrap-products-->
            </div>
        </div>

    </div>
@endsection
