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
            <li class="breadcrumb-item">{{ $title }}</li>
         </ol>
      </nav>
   </div>
</section>
<section class="product-categories-section custom-margin">
   <div class="container">
      <div class="page-title">
         <h1 class="main-heading">
            Brand : {{ $title }}
         </h1>
      </div>
      <div class="row gy-4">
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="product-preview-section">
               <div class="row gy-4">
                  @if($brandProducts->isNotEmpty())
                  @foreach($brandProducts as $product)
                  <div class="col-lg-4 col-md col-sm-6">
                     <div class="product-card" data-pcount="{{ $loop->iteration }}" data-section="numberNewArrivals">
                        <div class="card-heading">
                           <a href="{{ route('main_product', [$product->slug]) }}">
                              <figure>
                                 <img class="d-block w-100" src="{{ ($product->product_image != '') && file_exists(public_path('images/'.$product->product_image)) ? asset('images/'.$product->product_image) : asset('images/default.png') }}" alt="{{ $product->product_name }}">
                              </figure>
                           </a>
                           @if(($product->discount_percent != '') || ($product->discount_percent > 0))
                           <div class="sale">
                              <span>{{ $product->discount_percent }}% OFF</span>
                           </div>
                           @endif
                        </div>
                        <div class="card-body">
                           <a href="{{ route('main_product', [$product->slug]) }}">
                              <h2 class="text-center card-tittle ">{{ $product->product_name }}</h2>
                           </a>
                           <div class="rating text-center">
                              @php
                              $product_average = getAvgRating($product->id)
                              @endphp
                              @for($i=1; $i<=5 ; $i++ ) @php $selected=(($product_average>0) && $i <= $product_average ? "fas fa-star" : "far fa-star" ); @endphp <i class="{{$selected}}"></i> @endfor
                           </div>
                           <div class="price text-center py-1">
                              @if($product->special_price > 0)
                              <span class="text-decoration-line-through text-muted pe-1">
                                 {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($product->regular_price,'NPR')) }}
                              </span>
                              <span>
                                 {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($product->special_price,'NPR')) }}
                                 @php($product_price = $product->special_price)

                              </span>
                              @else
                              <span>
                                 {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($product->regular_price,'NPR')) }}
                                 @php($product_price =$product->regular_price)

                              </span>
                              @endif
                           </div>
                           <div class="add-to-cart-button">
                              <button class="Add-to-card-btn addToCartAjax">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                              <button class="add-to-wishlist"><i class="fas fa-heart"></i></button>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach
                  @else
                  <div class="col-lg-12 col-md-12 col-sm-12">
                     <p>No Products Found</p>
                  </div>
                  @endif
               </div>
            </div>
            {{ $brandProducts->links() }}
         </div>
      </div>
   </div>
</section>
@endsection