<section class="trending-section ">
    <div class="container">
        <div class="product-preview-section">
            <div class="row gy-4">
                @if ($products->count() > 0)
                @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product-card" data-pcount="{{ $loop->iteration }}" data-section="numberNewArrivals">
                        <div class="card-heading">
                            <a href="{{ route('main_product', [$product->slug]) }}">
                                <figure>
                                    <img class="d-block w-100" src="{{ $product->product_image != '' && file_exists(public_path('images/' . $product->product_image)) ? asset('images/' . $product->product_image) : asset('images/default.png') }}" alt="{{ $product->product_name }}">
                                </figure>
                            </a>
                            @if ( $product->discount_percent > 0)
                            <div class="sale">
                                <span>{{ $product->discount_percent }}% OFF</span>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <a href="{{ route('main_product', [$product->slug]) }}">
                                <h2 class=" card-tittle text-center">{{ $product->product_name }}</h2>
                            </a>
                            <div class="rating text-center">
                                @php
                                $product_average = getAvgRating($product->id);
                                @endphp
                                @for($i = 1; $i <= 5; $i++) @php $selected=(($product_average> 0) && $i <= $product_average) ? "fas fa-star" : "far fa-star" ; @endphp <i class="{{ $selected }}"></i>
                                        @endfor
                            </div>
                            <div class="price text-center py-1">
                                @if ($product->special_price > 0)
                                <span class="text-decoration-line-through text-muted pe-1">
                                    {{ env('DEFAULT_CURRENCY_SYMBOL', 'Rs.') }}{{ formatcurrency($product->regular_price, 'NPR') }}
                                </span>
                                <span>
                                    {{ env('DEFAULT_CURRENCY_SYMBOL', 'Rs.') }}{{ formatcurrency($product->special_price, 'NPR') }}
                                    @php($product_price = $product->special_price)

                                </span>
                                @else
                                <span>
                                    {{ env('DEFAULT_CURRENCY_SYMBOL', 'Rs.') }}{{ formatcurrency($product->regular_price, 'NPR') }}
                                    @php($product_price = $product->regular_price)

                                </span>
                                @endif
                            </div>
                            <div class="add-to-cart-button">
                                <input class="product_qty d-none" type="number" id="numberNewArrivals{{ $loop->iteration }}" value="1"  data-id="{{ $product->id }}" data-sp="{{ $product_price }}" data-title="{{ $product->product_name }}" data-size="{{ getProductAttr($product->id, 'size') }}" data-sp="{{ $product->regular_price }}" data-stock="{{ getProductAttr($product->id, 'stock') }}" />
                                <button class="Add-to-card-btn addToCartAjax">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                                <button class="add-to-wishlist"><i class="fas fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p class="h-50 d-flex align-items-center justify-content-center">No Products Found</p>
                </div>
                @endif

                <div class="col-lg-12 col-md-12 col-sm-12 h-50 d-flex align-items-center justify-content-center">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
</section>