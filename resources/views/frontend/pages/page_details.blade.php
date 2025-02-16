@extends('frontend.layouts.master')
@section('seo')
<meta name='title' content="{{$metaTagValue ? $metaTagValue['meta_title'] : ''}}">
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
                <li class="breadcrumb-item active">{{ $page_details->page_title }}</li>
            </ol>
        </nav>
    </div>
</section>
<section class="new-pages-section custom-margin">
    <div class="container">
        <div class="row gy-4">
            <div class="col-12">
                <div class="page-title">
                    <h1 class="main-heading">{{ $page_details->page_title }}</h1>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 col-sm-12">
                <div class="new-pages-content">{!! $page_details->page_description !!}</div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <figure>
                    <img class="d-block w-100" src="{{ ($page_details->page_image != '') && file_exists(public_path('images/pages/'.$page_details->page_image)) ? asset('images/pages/'.$page_details->page_image) : asset('images/default.png') }}" alt="{{ $title }}">
                </figure>
            </div>
        </div>
    </div>
</section>
@endsection