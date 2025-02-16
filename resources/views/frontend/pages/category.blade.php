@extends('frontend.layouts.master')
@section('content')
    <section class="category sec-padding">
        <div class="container">
            <div class="sec-title text-center">
                <h2>Shop</h2>
                <h3>Shop</h3>
            </div>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-4">
                        <div class="mc-single">
                            <div class="ms-image">
                                <a href="{{ route('category', $category->slug) }}">
                                    <img src="{{ asset('images/' . $category->category_image) }}" alt="">
                                </a>
                            </div>
                            <div class="ms-title">
                                <h5><a
                                        href="{{ route('category', $category->slug) }}">{{ $category->category_name }}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


@endsection
