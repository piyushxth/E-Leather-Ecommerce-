@extends('frontend.layouts.master')
@section('content')
<!-- breadcrumb -->

<section class="breadcrumb-section py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Search</li>
            </ol>
        </nav>
    </div>
</section>
<section class="search-page custom-margin">
    <div class="container">
        <div class="page-title">
            <h4>
                Search : {{ $_GET['keywords'] }}
            </h4>
        </div>
        <div class="new-pages-content">
            @if (count($brands) > 0 || count($products) > 0)
            @if (count($products) > 0)
            <h1>Products</h1>
            <ul>
                @foreach ($products as $product)
                <li>
                    <a href="{{ route('main_product', [$product->slug]) }}">{{ $product->product_name }}</a>
                </li>
                @endforeach
            </ul>
            @endif
            @if (count($brands) > 0)
            <h1>Brands</h1>
            <ul>
                @foreach ($brands as $brand)
                <li>
                    <a href="{{ route('frontend.brand_details', [$brand->slug]) }}">{{ $brand->name }}</a>
                </li>
                @endforeach
            </ul>
            @endif
            @else
            <p>No search results</p>
            @endif
        </div>
    </div>
</section>
@endsection