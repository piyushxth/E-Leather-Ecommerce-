@extends('frontend.layouts.master')


@section('content')

    <section class="category sec-padding">
        <div class="container">
            <div class="sec-title text-center">
                @if ($keyword)
                    <h2>{{ $keyword }}</h2>
                    <h3>{{ $keyword }}</h3>
                @elseif($sub_category)
                    <h2>{{ $sub_category }}</h2>
                    <h3>{{ $sub_category }}</h3>
                @elseif($color)
                    <h2>{{ $color }}</h2>
                    <h3>{{ $color }}</h3>
                @elseif($gender)
                    <h2>{{ $gender }}</h2>
                    <h3>{{ $gender }}</h3>
                @else
                    <h2>{{ $equipment }}</h2>
                    <h3>{{ $equipment }}</h3>
                @endif
            </div>
            <div class="row">
                @foreach ($products->unique('id') as $product)
                    <div class="col-lg-3">
                        <div class="card-product">
                            <a href="{{ route('main_product', $product->slug) }}">
                                <div class="cp-img">
                                    @if (!empty($product->attr_product_image))
                                        <img src="{{ asset('images/' . $product->attr_product_image) }}" alt="">
                                    @else
                                        <img src="{{ asset('images/' . $product->product_image) }}" alt="">

                                    @endif
                                </div>
                                 <ul class="shop-feature">
                                    <li><a data-bs-toggle="tooltip" data-bs-placement="top"  title="Search " href="{{ route('main_product', $product->slug) }}"><i
                                                class="fas fa-search"></i></a></li>
                                    <li><a  data-bs-toggle="tooltip" data-bs-placement="top"  title="Add to Cart" href="#" class="addToCartAjax" data-id="{{ $product->id }}"
                                            data-title="{{ $product->product_name }}"
                                            data-sp="{{ $product->special_price != null ? $product->special_price : $product->regular_price }}"><i
                                                class="fas fa-shopping-cart"></i></a>
                                    </li>
                                    <li>
                                        @if (Auth::check())
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist" href="#" class="toggle-wishlist" data-id="{{ $product->id }}"><i
                                                    class="fas fa-heart"></i></a>
                                        @else
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist" href="#" data-toggle="modal" data-target="#exampleModal"><i
                                                    class="fas fa-heart"></i></a>
                                        @endif
                                    </li>
                                </ul>


                                <div class="cp-title">
                                    <h6>{{ $product->product_name }}</h6>
                                </div>
                                <div class="prices">
                                    @if ($product->special_price > 0)
                                        <span class="discount">Rs.{{ $product->regular_price }}</span>
                                        <span class="new-price">Rs.{{ $product->special_price }}</span>
                                    @else
                                        <span class="new-price">Rs.{{ $product->regular_price }}</span>
                                    @endif

                                </div>
                        </div>
                        </a>
                    </div>
                @endforeach


            </div>
            <div class="d-flex justify-content-end">
                {!! $products->links() !!}
            </div>
        </div>
    </section>


@endsection



@section('script')

    <script>
        $(document).ready(function() {

            $('input[type=checkbox]').on('click', function() {
                var value = $(this).val();
                $('#filter-form').submit();
            });

            // $('#colors').change(function() {
            //     var value = $(this).val();
            //     $('#filter-form').submit();
            // });

            //Add to WishList
            $(".toggle-wishlist").click(function(e) {
                e.preventDefault();
                var item = $(this);
                var productId = item.data('id');
                //   console.log(productId);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('wishlist.store') }}",
                    method: 'post',
                    data: {
                        product_id: productId,
                    },
                    success: function(result) {
                        // console.log(result);
                        if (result == 'added') {
                            var wish_count = $('#wish-count').text();
                            var wish_count_num = parseInt(wish_count);
                            $('#wish-count').text(wish_count_num + 1);
                            toastr.success('Item Added To Wishlist!', 'Success', {
                                closeButton: true,
                                positionClass: "toast-bottom-right"
                            });
                            item.children().attr("src",
                                "{{ asset('frontend/images/wishlisted.png') }}");
                        } else if (result == 'removed') {
                            var wish_count = $('#wish-count').text();
                            var wish_count_num = parseInt(wish_count);
                            $('#wish-count').text(wish_count_num - 1);
                            toastr.info('Item Removed From Wishlist', 'Success', {
                                closeButton: true,
                                positionClass: "toast-bottom-right"
                            });
                            item.children().attr("src",
                                "{{ asset('frontend/images/wish.png') }}");
                        } else if (result == 'bad') {
                            toastr.warning('Bad Request', 'Sorry', {
                                closeButton: true,
                                positionClass: "toast-bottom-right"
                            });
                        } else {
                            toastr.error('Server Error Occoured', 'Error', {
                                closeButton: true,
                                positionClass: "toast-bottom-right"
                            });
                        }

                    },
                    error: function(result) {
                        toastr.error('Server Error Occoured', 'Error', {
                            closeButton: true,
                            positionClass: "toast-bottom-right"
                        });
                    }
                });
            });

            //Add to Cart
            $(".addToCartAjax").click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var sp = $(this).data("sp");
                var title = $(this).data("title");
                var color = $(this).data("color");
                console.log("id is" + id + "sp is " + sp + "title is " + color + ".");

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('cart.store') }}",
                    method: 'post',
                    data: {
                        id: id,
                        title: title,
                        sale_price: sp,
                    },
                    success: function(result) {
                        console.log(result);
                        if (result == 'added') {
                            var cart_count = $('#cart-count').text();
                            var cart_count_num = parseInt(cart_count);
                            $('#cart-count').text(cart_count_num + 1);
                            toastr.success('Item Added To Cart!', 'Success', {
                                closeButton: true,
                                positionClass: "toast-bottom-right"
                            });
                        } else if (result == 'exist') {
                            toastr.info('Item Exist In Cart', 'Success', {
                                closeButton: true,
                                positionClass: "toast-bottom-right"
                            });
                        } else if (result == 'outOfStock') {
                            toastr.info('Item Out Of Stock', 'Success', {
                                closeButton: true,
                                positionClass: "toast-bottom-right"
                            });
                        } else {
                            toastr.error('Server Error Occoured', 'Error', {
                                closeButton: true,
                                positionClass: "toast-bottom-right"
                            });
                        }

                    },
                    error: function(result) {
                        toastr.error('Server Error Occoured', 'Error', {
                            closeButton: true,
                            positionClass: "toast-bottom-right"
                        });
                    }
                });
            });
        });
    </script>
@endsection
