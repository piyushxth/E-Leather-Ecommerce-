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
                <li class="breadcrumb-item"><a href="{{ route('frontend.blogs') }}">Blogs</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </div>
</section>
<section class="blog-section custom-margin">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="page-title">
                    <h1 class="main-heading">{{$blog_details->blog_title}}</h1>
                </div>
                <div class="blog-cover-image">
                    <figure>
                        <img class="d-block w-100" src="{{ (($blog_details->blog_image != '') && file_exists(public_path('images/blogs/'.$blog_details->blog_image))) ? asset('images/blogs/'.$blog_details->blog_image) : asset('images/default.png') }}" alt="{{ $title }}">
                    </figure>
                    <div class="published-date">
                        <span class="day">{{ date('d', strtotime($blog_details->created_at) )}}</span>
                        <span class="month">{{ date('M', strtotime($blog_details->created_at) )}}</span>
                    </div>
                </div>
                <div class="blog-content-page pt-4">
                    {!! $blog_details->blog_description !!}
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="recent-post ">
                    <div class="page-title">
                        <span class="main heading">Recent Post</span>
                    </div>
                    @if($blogs->isNotEmpty())
                    <div class="wrapper">
                        <ul>
                            @foreach($blogs as $blog)
                            <li>
                                <a href="{{ route('frontend.blog_details',[$blog->blog_slug]) }}">
                                    <div class="blog-recent ">
                                        <div class="blog-heading">
                                            <figure>
                                                <img class="d-block w-100" src="{{ (($blog->blog_image != '') && file_exists(public_path('images/blogs/'.$blog->blog_image))) ? asset('images/blogs/'.$blog->blog_image) : asset('images/default.png') }}" alt="{{ $blog->blog_title }}">
                                            </figure>
                                        </div>
                                        <div class="blog-body">
                                            <div class="blog-tittle">
                                                {{ Str::words(strip_tags($blog->blog_title), 13)}}
                                            </div>
                                            <div class="date">
                                                <i class="fas fa-calendar-alt"></i>
                                                {{ date('d F Y', strtotime($blog->created_at)) }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                    @endif
                </div>

            </div>
        </div>

    </div>
</section>

@endsection