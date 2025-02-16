@extends('frontend.layouts.master')
@section('seo')
<meta name="title" content="{{$metaTagValue['meta_title']}}">
<meta name="description" content="{{$metaTagValue['meta_description']}}">
<meta name="keywords" content="{{$metaTagValue['meta_keywords']}}">
<meta property='og:title' content="{{$metaTagValue['meta_title']}}">
<meta property="og:description" content="{{$metaTagValue['meta_description']}}" />
<meta property="og:image" content="{{$metaTagValue['logo_img']}}" />
<meta property="og:type" content="home" />
<meta property="og:url" content="{{url()->current()}}" />
<meta name="twitter:card" content="{{$metaTagValue['logo_img']}}" />
<meta name="twitter:title" content="{{$metaTagValue['meta_title']}}" />
<meta name="twitter:description" content="{{$metaTagValue['meta_description']}}" />
<meta name="twitter:image" content="{{$metaTagValue['logo_img']}}" />

@isset($metaTagValue['schema'])
{!!"<script type='application/ld+json'>
   ".$metaTagValue['schema']."
</script>" !!}
@endisset
@endsection
@section('content')
@if($banners->count() > 0)
<section class="banner ">
   <div class="banner-slider">
      @foreach($banners as $banner)
      @if(($banner->image != '') && file_exists(public_path('images/'.$banner->image)))
      <div class="banner-slider-items">
         <figure>
            <img class="w-100 d-block" src="{{ asset('images/'.$banner->image) }}" alt="{{ $banner->name }}">
         </figure>
      </div>
      @endif
      @endforeach
   </div>
</section>
@endif
@if($aboutus->about_us_description != '' || $aboutus->about_us_image != '')
<section class="about-us custom-margin">
   <div class="container">
      <div class="row  gy-4">
         <div class="col-md-6 col-sm-12  wow fadeInLeft animated">
            <div class="heading">
               <h1>welcome to Iconic Clothing </h1>
            </div>
            <p>
               {{ Str::words(strip_tags($aboutus->about_us_description), 80) }}
            </p>
            <div class="button mt-5">
               <a href="{{ route('frontend.aboutus') }}"> Read more</a>
            </div>
         </div>
         <div class="col-md-6 col-sm-12  wow fadeInRight animated ">
            <figure>
               <img class="d-block w-100" src="{{ ($aboutus->about_us_image != '') && file_exists(public_path('images/aboutus/'.$aboutus->about_us_image)) ? asset('images/aboutus/'.$aboutus->about_us_image) :'images/default.png' }}" alt="About us">
            </figure>
         </div>
      </div>
   </div>
</section>
@endif
@if($trending_products->isNotEmpty())
<section class="trending-section custom-margin wow fadeInDown animated">
   <div class="container">
      <div class="heading">
         <h2>TRENDING PRODUCTS</h2>
      </div>
      <div class="product-slider">
         @foreach($trending_products as $trending_product)
         <div class="product-card" data-pcount="{{ $loop->iteration}}" data-section="numberTrendingProduct">
            <div class="card-heading">
               <a href="{{ route('main_product', [$trending_product->slug]) }}">
                  <figure>
                     <img class="d-block w-100" src="{{ ($trending_product->product_image != '') && file_exists(public_path('images/'.$trending_product->product_image)) ? asset('images/'.$trending_product->product_image) : asset('images/default.png') }}" alt="{{ $trending_product->product_name }}">
                  </figure>
               </a>
               @if($trending_product->discount_percent > 0)
               <div class="sale">
                  <span>{{ $trending_product->discount_percent }}% OFF</span>
               </div>
               @endif
            </div>
            <div class="card-body">
               <a href="{{ route('main_product', [$trending_product->slug]) }}">
                  <h3 class=" card-tittle text-center">{{ $trending_product->product_name }}</h3>
               </a>
               <div class="rating text-center pt-2">
                  @php
                  $product_average = getAvgRating($trending_product->id);
                  @endphp
                  @for($i = 1; $i <= 5; $i++) @php $selected=(($product_average> 0) && $i <= $product_average) ? "fas fa-star" : "far fa-star" ; @endphp <i class="{{ $selected }}"></i>
                        @endfor
               </div>
               <div class="price text-center py-1">
                  @if($trending_product->special_price > 0)
                  <span class="text-decoration-line-through text-muted pe-1">
                     {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($trending_product->regular_price,'NPR')) }}
                  </span>
                  <span>
                     {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($trending_product->special_price,'NPR')) }}
                     @php
                     $product_price = $trending_product->special_price;
                     @endphp
                  </span>
                  @else
                  <span>
                     {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($trending_product->regular_price,'NPR')) }}
                     @php
                     ($product_price = $trending_product->regular_price)
                     @endphp
                  </span>
                  @endif
               </div>
            </div>
            <div class="add-to-cart-button">
               <input class="d-none product_qty"  type="number" id="numberTrendingProduct{{ $loop->iteration}}" value="1"  data-id="{{ $trending_product->id }}" data-sp="{{ $product_price }}" data-title="{{ $trending_product->product_name }}" data-size="{{ getProductAttr($trending_product->id, 'size') }}" data-stock="{{ getProductAttr($trending_product->id, 'stock') }}" />
               <button class="Add-to-card-btn addToCartAjax">Add to Cart <i class="fas fa-shopping-cart"></i></button>
               <button class="add-to-wishlist"><i class="fas fa-heart"></i></button>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>
@endif

@if($featuredCategories->isNotEmpty())
<section class="bag-shoes custom-margin">
   <div class="container">
      <div class="row align-items-center g-4">
         @foreach($featuredCategories as $featuredCategory)
         <div class="col-lg-6 col-md-6 col-sm-12 {{ ($loop->index == 0) ? 'animated fadeInLeft wow' : 'animated fadeInRight wow' }}">
            <div class="card">
               <div class="row align-items-center">
                  <div class="col-lg-6 col-md-6 col-sm-12 p-3">
                     <div class="title">
                        {{ $featuredCategory->category_name }}
                     </div>
                     <div class="button mt-5">
                        <a href="{{ route('category', [$featuredCategory->slug ]) }}">View All Products</a>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 p-3">
                     <figure>
                        <img class="w-100 d-block" src="{{ ($featuredCategory->category_image != '') && file_exists(public_path('images/'.$featuredCategory->category_image)) ? asset('images/'.$featuredCategory->category_image) : asset('images/default.png') }}" alt="{{ $featuredCategory->category_name }}">
                     </figure>
                  </div>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>
@endif

<section class="categories-section custom-margin">
   <div class="container">
      <div class="row gy-4">
         <div class="col-lg-4 col-md-6 col-sm-12 men-section  wow fadeInDown animated">
            <a href="{{ ($homepageextras->homepageextra_mentilelink != '') ? $homepageextras->homepageextra_mentilelink : route('productsSuitableFor', ['men']) }}">
               <div class="categories">
                  <figure>
                     <img class="d-block w-100" src="{{ ($homepageextras->homepageextra_mentileimg != '' && file_exists(public_path('images/homepageextra/'.$homepageextras->homepageextra_mentileimg))) ? asset('images/homepageextra/'.$homepageextras->homepageextra_mentileimg) : asset('frontend/images/men.png') }}" alt="Men's Collection">
                  </figure>
                  <div class="categories-name">
                     <span>Men's</span>
                  </div>
               </div>
            </a>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-12 kid-section  wow fadeInDown animated" data-wow-delay="0.5s">
            <a href="{{ ($homepageextras->homepageextra_kidtilelink != '') ? $homepageextras->homepageextra_kidtilelink : route('productsSuitableFor', ['kids']) }}">
               <div class="categories">
                  <figure>
                     <img class="d-block w-100" src="{{ ($homepageextras->homepageextra_kidtileimg != '' && file_exists(public_path('images/homepageextra/'.$homepageextras->homepageextra_kidtileimg))) ? asset('images/homepageextra/'.$homepageextras->homepageextra_kidtileimg) : asset('frontend/images/kid.png') }}" alt="Kid's Collection">
                  </figure>
                  <div class="categories-name">
                     <span>Kid's</span>
                  </div>
               </div>
            </a>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-12 women-section  wow fadeInDown animated" data-wow-delay="1s">
            <a href="{{ ($homepageextras->homepageextra_womentilelink != '') ? $homepageextras->homepageextra_womentilelink : route('productsSuitableFor', ['women']) }}">
               <div class="categories">
                  <figure>
                     <img class="d-block w-100" src="{{ ($homepageextras->homepageextra_womentileimg != '' && file_exists(public_path('images/homepageextra/'.$homepageextras->homepageextra_womentileimg))) ? asset('images/homepageextra/'.$homepageextras->homepageextra_womentileimg) : asset('frontend/images/women.png') }}" alt="Women's Collection">
                  </figure>
                  <div class="categories-name">
                     <span>Women's</span>
                  </div>
               </div>
            </a>
         </div>
      </div>
   </div>
</section>
@if($latest_products->count() > 0)
<section class="trending-section new-arrivals  custom-margin wow fadeInDown animated">
   <div class="container">
      <div class="heading">
         <h2>New arrivals</h2>
      </div>
      <div class="product-slider">
         @foreach($latest_products as $latest_product)
         <div class="product-card" data-pcount="{{ $loop->iteration}}" data-section="numberNewArrivals">
            <div class="card-heading">
               <a href="{{ route('main_product', [$latest_product->slug]) }}">
                  <figure>
                     <img class="d-block w-100" src="{{ ($latest_product->product_image != '') && file_exists(public_path('images/'.$latest_product->product_image)) ? asset('images/'.$latest_product->product_image) : asset('images/default.png') }}" alt="{{ $latest_product->product_name }}">
                  </figure>
               </a>
               @if($latest_product->discount_percent > 0)
               <div class="sale">
                  <span>{{ $latest_product->discount_percent }}% OFF</span>
               </div>
               @endif
            </div>
            <div class="card-body">
               <a href="{{ route('main_product', [$latest_product->slug]) }}">
                  <h3 class=" card-tittle text-center">{{ $latest_product->product_name }}</h3>
               </a>
               <div class="rating text-center pt-1">
                  @php
                  $product_average = getAvgRating($latest_product->id);
                  @endphp
                  @for($i=1; $i<=5; $i++) @php $selected=(($product_average> 0) && $i <= $product_average) ? "fas fa-star" : "far fa-star" ; @endphp <i class="{{$selected}}"></i>
                        @endfor
               </div>
               <div class="price text-center py-1">
                  @if($latest_product->special_price > 0)
                  <span class="text-decoration-line-through text-muted pe-1">
                     {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($latest_product->regular_price,'NPR')) }}
                  </span>
                  <span>
                     {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($latest_product->special_price,'NPR')) }}
                     @php
                     ($product_price = $latest_product->special_price)
                     @endphp
                  </span>
                  @else
                  <span>
                     {{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($latest_product->regular_price,'NPR')) }}
                     @php
                     ($product_price = $latest_product->regular_price)
                     @endphp

                  </span>
                  @endif
               </div>
               <div class="add-to-cart-button">
               <input type="number" id="numberNewArrivals{{$loop->iteration}}" value="1" class=" d-none  product_qty" data-id="{{ $latest_product->id }}" data-sp="{{ $product_price }}" data-title="{{ $latest_product->product_name }}" data-size="{{ getProductAttr($latest_product->id, 'size') }}" data-stock="{{ getProductAttr($latest_product->id, 'stock') }}"/>
                  <button class="Add-to-card-btn addToCartAjax">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                  <button class="add-to-wishlist"><i class="fas fa-heart"></i></button>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>
@endif
@if($video->video_url != '')
<section class="video-section custom-margin wow  animated zoomIn">
   <figure>
      <img src="{{ (($video->video_fallbackimage != '') && file_exists(public_path('images/video/'.$video->video_fallbackimage))) ? asset('images/video/'.$video->video_fallbackimage) : asset('frontend/images/videofallback.png') }}" alt="Video">
   </figure>

   @php
   ($videoParts = parseVideos($video->video_url))
   @endphp
   <a class="vpop popup-video" data-type="youtube" data-id="{{ Str::remove('v=', $videoParts['query']) }}" data-autoplay='true'>
      <i class="fas fa-play-circle"></i>
      <div class="sonar-wave sonar-wave1"></div>
      <div class="sonar-wave sonar-wave2"></div>
      <div class="sonar-wave sonar-wave3"></div>
      <div class="sonar-wave sonar-wave4"></div>
   </a>
   <div id="video-popup-overlay"></div>
   <div id="video-popup-container">
      <div id="video-popup-close" class="fade">X</div>
      <div id="video-popup-iframe-container">
         <iframe id="video-popup-iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
      </div>
   </div>
</section>
@endif
@if($testimonials->isNotEmpty())
<section class="testimonals  custom-margin wow fadeInDown animated">
   <div class="container">
      <div class="heading">
         <h2>Testimonials </h2>
      </div>
      <div class="testimonials-slider ">
         @foreach($testimonials as $testimonial)
         <div class="testimonials-card">
            <div class="card-heading">
               <figure>
                  <img class="d-block w-100" src="{{ (($testimonial->testimonial_image != '') && file_exists(public_path('images/testimonials/'.$testimonial->testimonial_image))) ? asset('images/testimonials/'.$testimonial->testimonial_image) : asset('images/default.png') }}" alt="{{ $testimonial->testimonial_author }}">
               </figure>
            </div>
            <div class="card-body">
               <div class="name">
                  {{ $testimonial->testimonial_author }}
               </div>
               <div class="position">
                  {{ $testimonial->testimonial_designation }}
               </div>
               <p>
                  “{{ $testimonial->testimonial_description }}”
               </p>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>
@endif
@if($blogs->isNotEmpty())
<section class="blog-section  custom-margin wow fadeInDown animated">
   <div class="container">
      <div class="heading">
         <h2>Latest Blogs </h2>
      </div>
      <div class="row gy-4">
         @foreach($blogs as $blog)
         <div class="col-lg-4 col-md-6 col-sm-12">
            <a href="{{ route('frontend.blog_details', [$blog->blog_slug]) }}">
               <div class="blog-card">
                  <div class="card-heading">
                     <figure>
                        <img class="d-block w-100" src="{{ (($blog->blog_image != '') && file_exists(public_path('images/blogs/'.$blog->blog_image))) ? asset('images/blogs/'.$blog->blog_image) : asset('images/default.png') }}" alt="{{ $blog->blog_title }}">
                     </figure>
                  </div>
                  <div class="card-body">
                     <div class="date-heading">
                        <div class="date">
                           <span class="day">{{ date('d', strtotime($blog->created_at))}}</span>
                           <span class="month">{{ date('M', strtotime($blog->created_at))}}</span>
                        </div>
                        <div class="blog-title-wrapper">
                           <h3 class="blog-tittle"> {{ $blog->blog_title }}</h3>
                        </div>
                     </div>
                     <div class="blog-content">
                        <p>
                           {{ Str::words(strip_tags($blog->blog_description), 25)}}
                        </p>
                     </div>
                  </div>
               </div>
            </a>
         </div>
         @endforeach
      </div>
   </div>
</section>
@endif

@endsection