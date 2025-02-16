@extends('frontend.layouts.master')
@section('seo')
<meta name="title" content="{{$metaTagValue ? $metaTagValue['title'] : '' }}">
<meta name="description" content="{{isset($metaTagValue['meta_description']) ? $metaTagValue['meta_description'] : ''}}">
<meta name="keywords" content="{{isset($metaTagValue['meta_keywords']) ? $metaTagValue['meta_keywords'] : '' }}">
<meta property='og:title' content="{{isset($metaTagValue['meta_title']) ? $metaTagValue['meta_title'] : ''}}">
<meta property="og:description" content="{{isset($metaTagValue['meta_description']) ? $metaTagValue['meta_description'] : '' }}" />
<meta property="og:image" content="{{isset($metaTagValue['logo_img']) ? $metaTagValue['logo_img'] : ''}}" />
<meta property="og:type" content="{{last(request()->segments())}}" />
<meta property="og:url" content="{{url()->current()}}" />
<meta name="twitter:card" content="{{isset($metaTagValue['logo_img']) ? $metaTagValue['logo_img'] : ''}}" />
<meta name="twitter:title" content="{{isset($metaTagValue['meta_title']) ? $metaTagValue['meta_title'] : '' }}" />
<meta name="twitter:description" content="{{isset($metaTagValue['meta_description']) ? $metaTagValue['meta_title'] : ''}}" />
<meta name="twitter:image" content="{{isset($metaTagValue['logo_img']) ? $metaTagValue['logo_img'] : '' }}" />
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
            <li class="breadcrumb-item active">Brands</li>
         </ol>
      </nav>
   </div>
</section>
<section class="product-categories-section custom-margin">
   <div class="container">
      <div class="page-title">
         <h1 class="main-heading">
            Brands
         </h1>
      </div>
      <div class="row gy-4">
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="product-preview-section">
               <div class="row gy-4">
                  @if($brands->isNotEmpty())
                  @foreach($brands as $brand)
                  <div class="col-lg-4 col-md col-sm-6">
                     <div class="product-card">
                        <div class="card-heading">
                           <a href="{{ route('frontend.brand_details',[$brand->slug]) }}">
                              <figure>
                                 <img class="d-block w-100" src="{{ ($brand->logo != '') && file_exists(public_path('images/'.$brand->logo)) ? asset('images/'.$brand->logo) : asset('images/default.png') }}" alt="{{ $brand->name }}">
                              </figure>
                           </a>
                        </div>
                        <div class="card-body">
                        <a href="{{ route('frontend.brand_details',[$brand->slug]) }}">
                           <h2 class="text-center card-title">{{ $brand->name }}</h2>
                           </a>
                        </div>
                     </div>
                  </div>
                  @endforeach
                  @else
                  <div class="col-lg-12 col-md-12 col-sm-12">
                     <p>No Brands Found</p>
                  </div>
                  @endif
               </div>
            </div>
            {{ $brands->links() }}
         </div>
      </div>
   </div>
</section>
@endsection