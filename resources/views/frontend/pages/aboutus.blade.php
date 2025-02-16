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
<section class="breadcrumb-section py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">About us</li>
            </ol>
        </nav>
    </div>
</section>
<section class="about-us custom-margin">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <div class="page-title">
                    <h1 class="main-heading">About us</h1>
                </div>
                <div class="about-us-content">{!! $aboutus->about_us_description !!}</div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <figure>
                    <img class="d-block w-100" src="{{ ($aboutus->about_us_image != '') && file_exists(public_path('images/aboutus/'.$aboutus->about_us_image)) ? asset('images/aboutus/'.$aboutus->about_us_image) :'images/default.png' }}" alt="About us">
                </figure>
            </div>
        </div>
    </div>
</section>

@endsection