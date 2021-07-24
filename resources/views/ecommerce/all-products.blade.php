@extends('layouts.app')
@section('title', 'Danh sách sản phẩm')
@section('class-body', 'home-page home-01')
@section('class-main', 'main-site left-sidebar')

@section('content')
    <div class="wrap-breadcrumb">
        <div>
            <a href="{{ route('home') }}" class="link">fastBuy</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12 main-content-area">
            <div class="wrap-shop-control">
                <h1 class="shop-title">Sắp xếp theo:</h1>
                <form action="{{ route('filter-product-all') }}" method="POST">
                    @csrf
                    <div class="sort-item orderby ">
                        <select name="filter" id="" onchange="this.form.submit()">
                            <option value="" disabled selected hidden>Giá</option>
                            <option value="cheap">Giá: Thấp đến cao</option>
                            <option value="expensive">Giá: Cao đến thấp</option>
                        </select>
                    </div>
                </form>
            </div>
            <input type="hidden" id="urlFollowProduct" value="{{ route('user.follow-product') }}">
            <input type="hidden" id="userId" value="{{ Auth::id() }}">
            <div class="row w-100 m-0">
                <ul class="product-list grid-products equal-container row w-100">
                    @foreach ($products as $product)
                        <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <figure><img src="{{ asset('storage/products/' . $product->image) }}" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>{{ $product->name }}</span></a>
                                    <div class="wrap-price"><span>₫</span>{{ number_format($product->price, 0) }}</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center action-product">
                                    <a href="{{ route('products.show', $product->id) }}" class="m-2"><button class="btn btn-success">Xem</button></a>
                                    <i class="fas fa-heart m-2 follow-product {{ $product->checkIfUserFollowProduct() ? 'followed' : '' }}" data-id="{{ $product->id }}"></i>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="pagination-custom d-flex justify-content-end pt-3">
                {{ $products->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
