@extends('frontend.layouts.master')
@section('seo')
<meta name="title" content="{{$metaTagValue['meta_title']}}">
<meta name="description" content="{{$metaTagValue['meta_description']}}">
<meta name="keywords" content="{{$metaTagValue['meta_keywords']}}">
<meta property='og:title' content="{{$metaTagValue['meta_title']}}">
<meta property="og:description" content="{{$metaTagValue['meta_description']}}" />
<meta property="og:image" content="{{$metaTagValue['logo_img']}}" />
<meta property="og:type" content="{{last(request()->segments())}}" />
<meta property="og:url" content="{{url()->current()}}" />
<meta name="twitter:card" content="{{$metaTagValue['logo_img']}}" />
<meta name="twitter:title" content="{{$metaTagValue['meta_title']}}" />
<meta name="twitter:description" content="{{$metaTagValue['meta_description']}}" />
<meta name="twitter:image" content="{{$metaTagValue['logo_img']}}" />
@isset($metaTagValue['schema'])
{!! "<script type='application/ld+json'>
   ".$metaTagValue['schema']."
</script>" !!}
@endisset
@endsection
@section('content')
@php
if(isset($category_name)){
$showcategory_breadcrumb = true;
} else {
$showcategory_breadcrumb = false;
}
@endphp

<section class="breadcrumb-section py-4">
   <div class="container">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            @if($group_slug != '')
            <li class="breadcrumb-item {{ ($showcategory_breadcrumb == false) ? 'active' : '' }}">
               <a href="{{ route('productsSuitableFor',[$group_slug]) }}">
                  {{ $group_name }}
               </a>
            </li>
            @elseif($group_name != '')
            <li class="breadcrumb-item {{ ($showcategory_breadcrumb == false) ? 'active' : '' }}">
               <a>{{ $group_name }}</a>
            </li>
            @endif

            @if($showcategory_breadcrumb == true)
            <li class="breadcrumb-item active">
               <a>{{ $category_name->category_name }}</a>
            </li>
            @endif
         </ol>
      </nav>
   </div>
</section>
<section class="product-categories-section custom-margin">
   <div class="container">
      <div class="page-title">
         <h1 class="main-heading">
            @if($showcategory_breadcrumb == true)
            {{ $category_name->category_name }}
            @else
            {{ $group_name }}
            @endif
         </h1>
      </div>
      <div class="row gy-4 ">
         <div class="col-lg-3 col-md-4 col-sm-12">
            @include('frontend.pages.partials.sidesearch')
         </div>
         <div class="col-lg-9 col-md-8 col-sm-12" id="ajaxLoadedProducts">
            @include('frontend.pages.partials.productslist')
         </div>
      </div>
   </div>
</section>
@endsection