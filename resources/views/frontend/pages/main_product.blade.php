@extends('frontend.layouts.master')
@section('seo')
<meta name="title" content="{{$metaTagValue ? $metaTagValue['title'] : '' }}">
<meta name="description" content="{{$metaTagValue ? $metaTagValue['meta_description'] : '' }}">
<meta name="keywords" content="{{$metaTagValue ? $metaTagValue['meta_keywords'] : ''}}">
<meta property='og:title' content="{{$metaTagValue ? $metaTagValue['meta_title'] : ''}}">
<meta property="og:description" content="{{$metaTagValue ? $metaTagValue['meta_description'] : ''}}" />
<meta property="og:image" content="{{$metaTagValue ? $metaTagValue['logo_img'] : ''}}" />
<meta property="og:type" content="{{last(request()->segments())}}" />
<meta property="og:url" content="{{url()->current()}}" />
<meta name="twitter:card" content="{{$metaTagValue ? $metaTagValue['logo_img'] : ''}}" />
<meta name="twitter:title" content="{{$metaTagValue ? $metaTagValue['meta_title'] : ''}}" />
<meta name="twitter:description" content="{{$metaTagValue ? $metaTagValue['meta_description'] : ''}}" />
<meta name="twitter:image" content="{{$metaTagValue ? $metaTagValue['logo_img'] : ''}}" />
@isset($metaTagValue['schema'])
{!! "<script type='application/ld+json'>
    ".$metaTagValue['schema']."
</script>" !!}
@endisset
@endsection
@section('content')
<section class="breadcrumb-section py-4">

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category', [$product->category[0]->slug]) }}">{{ $product->category[0]->category_name }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $product->product_name }}</li>
            </ol>
        </nav>
    </div>
</section>
<section class="product-details-section custom-margin">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-6 col-sm-12">
                <div class="product-previw">
                    <div class="main-banner-images">
                        <figure id="product-main-images" class="picZoomer">
                            <img class="" id="products-images" src="{{ ($product->product_image != '') && file_exists(public_path('images/'.$product->product_image)) ? asset('images/'.$product->product_image) : asset('images/default.png') }}" alt="{{ $product->product_name }}">
                        </figure>
                    </div>
                    @if ($product_images->isNotEmpty())
                    <div class="products-images-nav">
                        @foreach($product_images as $product_image)
                        @if(($product_image->product_variation_image != '') &&
                        file_exists(public_path('images/'.$product_image->product_variation_image)))
                        <figure>
                            <img class="product-preview-list" src="{{ asset('images/'.$product_image->product_variation_image) }}" alt="{{ $product->product_name }}">
                        </figure>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-7 col-md-6 col-sm-12 ">
                <div class="products-details">
                    <div class="product-name d-flex align-items-center">
                        <h1>{{ $product->product_name }}</h1>
                        <div class="add-to-wishlist ps-3">
                            <a data-bs-toggle="tooltip" data-bs-placement="right" title="Add to Wishlist" href="">
                                @if($itemsAvailableInWishList==1)
                                <i class="fas fa-heart"></i>
                                @else
                                <i class="far fa-heart"></i>
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="rating py-2">
                        @for($i = 1; $i <= 5; $i++) @php $selected=(($product_average> 0) && $i <= $product_average) ? "fas fa-star" : "far fa-star" @endphp <i class="{{ $selected }}"></i>
                                @endfor
                    </div>
                    <div class="price py-1">
                        @if($product->special_price > 0)
                        <span class="text-decoration-line-through text-muted pe-1">
                            {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($product->regular_price,'NPR')) }}
                        </span>
                        <span>
                            {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($product->special_price,'NPR')) }}
                        </span>
                        @php
                        $product_price = $product->special_price;
                        @endphp
                        @else
                        <span>
                            {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($product->regular_price,'NPR')) }}
                        </span>
                        @php
                        $product_price = $product->regular_price
                        @endphp
                        @endif
                    </div>
                    @if($product->description != '')
                    <div class="product-description my-3 py-4">
                        <p>{{ Str::limit($product->description,430)}}</p>
                    </div>
                    @endif
                    <div class="action-buttons py-4">
                        <form>
                            <input class="me-3 product_qty qty_active" type="number" min="1" value="1" autocomplete="off" data-id="{{ $product->id }}" data-sp="{{ $product_price }}" data-title="{{ $product->product_name }}" data-size="{{ getProductAttr($product->id, 'size') }}" data-stock="{{ getProductAttr($product->id, 'stock') }}" data-fromlisting="false" />
                            <button class="add-to-cart me-3 addToCartAjax">add to cart</button>
                        </form>
                        @if($product_sizes->isNotEmpty())
                        <div class="sizes mt-3">
                            @foreach($product_sizes as $product_size)
                            <button id="productsizes{{$loop->iteration}}" class="product-sizes-listing {{ ($loop->iteration == 1) ? 'active' : '' }}" data-size="{{ $product_size->size }}" data-sp="{{ $product_price }}" data-stock="{{ $product_size->stock }}">
                                {{ $product_size->size }}
                            </button>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="categories-share my-3">
                        <div class="categories">
                            <p>
                                Categories:<span> {{ $product->category[0]->category_name }}</span>
                            </p>
                        </div>
                        <div class="share-option py-2">
                            <!-- <span>Share this Product</span> -->
                            {{-- <ul>
                                <li><a href=""><i class="fab fa-facebook"></i></a></li>
                                <li><a href=""><i class="fab fa-instagram"></i></a></li>
                                <li><a href=""><i class="fab fa-tiktok"></i></a></li>
                                <li><a href=""><i class="fab fa-youtube"></i></a></li>
                            </ul> --}}
                            <!-- ShareThis BEGIN -->
                            <div class="sharethis-inline-share-buttons"></div>
                            <!-- ShareThis END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@php
$reviews = $product->getReview;
$reviewCount = $product->getReview->count();
@endphp
<section class="produts-description-section custom-margin">
    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-description" aria-selected="true">Description</button>
                <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review" aria-selected="false">Reviews
                    (<span>{{ $reviewCount }}</span>)</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                {{ $product->description }}
            </div>
            <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                <div class="review-writting-form ">
                    <form action="{{ route('customer.review.store') }}" method="post" class="submit_review_form">
                        @csrf()
                        <input type="hidden" name="product_slug" value="{{ $product->slug }}" readonly autocomplete="off" />
                        <div class="rating-box">
                            <label for="rating">Your rating</label> <br>
                            <div class="ratings">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <input type="hidden" id="rating-value" name="rating" max="5" min="0" value="" readonly>
                            <span class="error-message error-ratings-message text-danger pt-3"></span>
                        </div>
                        <div class="review-box mt-3">
                            <label for="review">Write a review</label><br>
                            <textarea name="review" id="review" cols="30" rows="4"></textarea><br>
                            <span class="error-message error-review-message text-danger pt-3"></span>
                        </div>
                        <div class="submit-button d-block"><button type="submit" name="submit_review" class="submit_review">Submit</button></div>
                    </form>
                </div>
                @if($reviews->isNotEmpty())
                @foreach($reviews as $review)
                @php
                ($userRating = $review->rating)
                @endphp
                <div class="reviews-items">
                    <div class="name">{{ $review->customer_name }}</div>
                    <div class="rating">
                        @for ($count = 1; $count <= 5; $count++) @if ($count <=$userRating) <i class="fas fa-star"></i>
                            @else
                            <i class="far fa-star"></i>
                            @endif
                            @endfor
                    </div>
                    <div class="review">
                        <p>
                            {{ $review->review }}
                        </p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endsection