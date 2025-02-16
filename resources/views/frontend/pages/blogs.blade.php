@extends('frontend.layouts.master')
@section('seo')
<meta name="title" content="{{isset($metaTagValue['title'])? $metaTagValue['title'] : '' }}">
<meta name="description" content="{{isset($metaTagValue['meta_description'])? $metaTagValue['meta_description'] : '' }}">
<meta name="keywords" content="{{isset($metaTagValue['meta_keywords'] ) ? $metaTagValue['meta_keywords'] : ''}}">
<meta property='og:title' content="{{isset($metaTagValue['meta_title']) ? $metaTagValue['meta_title'] : ''}}">
<meta property="og:description" content="{{isset($metaTagValue['meta_description'] ) ? $metaTagValue['meta_description'] : ''}}" />
<meta property="og:image" content="{{isset( $metaTagValue['logo_img'] ) ? $metaTagValue['logo_img'] : ''}}" />
<meta property="og:type" content="{{last(request()->segments())}}" />
<meta property="og:url" content="{{url()->current()}}" />
<meta name="twitter:card" content="{{isset($metaTagValue['logo_img'] ) ? $metaTagValue['logo_img'] : ''}}" />
<meta name="twitter:title" content="{{isset($metaTagValue['meta_title']) ? $metaTagValue['meta_title'] : ''}}" />
<meta name="twitter:description" content="{{ isset($metaTagValue['meta_description'])? $metaTagValue['meta_description'] : ''}}" />
<meta name="twitter:image" content=" {{($metaTagValue['logo_img'] ) ? $metaTagValue['logo_img'] : ''}}" />
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
                <li class="breadcrumb-item active">
                    <a>Blogs</a>
                </li>
            </ol>
        </nav>
    </div>
</section>
<section class="product-categories-section custom-margin">
    <div class="container">
        <div class="page-title">
            <h1 class="main-heading">
                Blogs
            </h1>
        </div>
        <div class="row gy-4">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="blogs-preview-section">
                    <div class="row gy-4">
                        @if($blogs->isNotEmpty())
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
                                                <h2 class="blog-tittle">{{ $blog->blog_title }}</h2>
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
                        @else
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>No Blogs Found</p>
                        </div>
                        @endif
                    </div>
                </div>
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
</section>
@endsection