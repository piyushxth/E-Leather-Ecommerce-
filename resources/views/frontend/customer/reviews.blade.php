@extends('frontend.layouts.master')
@section('content')
    <section class="breadcrumb-section py-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Review</li>
                </ol>
            </nav>
        </div>
    </section>
    <div class="profile-dashboard-section custom-margin">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    @include('frontend.customer.sidebar')
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div class=" profile">
                        <div class="title">
                            <span>My Review <span>({{ $reviews->count() }})</span></span>
                        </div>


                        @if ($reviews->isNotEmpty())

                            <div class="order-table">
                                <table>
                                    <tr>
                                        <th>
                                            <h6>S.N</h6>
                                        </th>
                                        <th>
                                            <h6>Product Name</h6>
                                        </th>
                                        <th>
                                            <h6>Product Image</h6>
                                        </th>
                                        <th>
                                            <h6>Rating</h6>
                                        </th>
                                    </tr>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $review->product_name }}</td>
                                            <td>
                                                <figure>
                                                    <img class="d-block w-100"
                                                        src="{{ $review->product_image != '' && file_exists(public_path('images/' . $review->product_image)) ? asset('images/' . $review->product_image) : asset('images/default.png') }}"
                                                        alt="{{ $review->product_name }}">
                                                </figure>
                                            </td>
                                            <td>
                                                <div class="ratings" id="{{ $loop->index + 1 }}"
                                                    data-rating="{{ $review->rating }}">
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            {{ $reviews->links() }}
                        @else
                            <div class="my-cart-table">
                                <p>No items on Review</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
