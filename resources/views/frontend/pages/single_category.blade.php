@extends('frontend.layouts.master')
@section('content')
<section class="breadcrumb">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
         <li class="breadcrumb-item active" aria-current="page">{{ $category->category_name }}</li>
      </ol>
   </nav>
</section>
<section class="category sec-padding">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-2">
            <div class="test">
               <div class="sec-title-inner ">
                  <h2>{{ $category->category_name }}</h2>
               </div>
               <form action="{{ route('product.filter') }}" method="GET" id="filter-form">
                  @csrf
                  <input type="hidden" name="category_slug" value="{{ $category->slug }}" />
                  <!-- FILTER BY Price -->
                  <div class="filter-single-check"  style="background-color: blue;">
                     <div class="fsc-title">
                        <h6>Sort By</h6>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="recommended" @if (!empty($_GET['recommended']) && $_GET['recommended']==='recommended' ) checked @endif name="recommended" id="recommended">
                        <label class="form-check-label">
                           Recommended
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="latest" @if (!empty($_GET['latest_product']) && $_GET['latest_product']==='latest' ) checked @endif name="latest_product" id="latest_product">
                        <label class="form-check-label" for="flexCheckDefault">
                           Newest
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ isset($min_price) ? $min_price : 1 }}" name="min_price" @if (!empty($_GET['min_price']) && $_GET['min_price']=='1' ) checked @endif id="min_price">
                        <label class="form-check-label" for="flexCheckDefault">
                           Lowest Price
                        </label>
                     </div>
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ isset($max_price) ? $max_price : 1000000 }}" name="max_price" @if (!empty($_GET['max_price']) && $_GET['max_price']=='1000000' ) checked @endif id="max_price">
                        <label class="form-check-label" for="flexCheckDefault">
                           Highest Price
                        </label>
                     </div>
                  </div>
                  <!-- FILTER BY BRAND -->
                  <div class="filter-single-check">
                     <div class="fsc-title">
                        <h6>Brand</h6>
                     </div>
                     @foreach ($brands as $brand)
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $brand->name }}" @if (!empty($_GET['brand']) && $_GET['brand']==$brand->name) checked @endif id="brands" name="brand">
                        <label class="form-check-label" for="flexCheckDefault">
                           {{ $brand->name }}
                        </label>
                     </div>
                     @endforeach
                  </div>
                  <!-- FILTER BY Color -->
                  <div class="filter-single-check">
                     <div class="fsc-title">
                        <h6>Color Option</h6>
                     </div>
                     @foreach ($colors->unique('color_name') as $color)
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="color" value="{{ $color->color_name }}" @if (!empty($_GET['color']) && $_GET['color']===$color->color_name) checked @endif id="colors">
                        <label class="form-check-label" for="flexCheckDefault">
                           {{ $color->color_name }}
                        </label>
                     </div>
                     @endforeach
                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-10">
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
                           <li>
                              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Search " href="{{ route('main_product', $product->slug) }}"><i class="fas fa-search"></i></a>
                           </li>
                           <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Cart" href="#" class="addToCartAjax" data-id="{{ $product->id }}" data-title="{{ $product->product_name }}" data-sp="{{ $product->special_price != null ? $product->special_price : $product->regular_price }}"><i class="fas fa-shopping-cart"></i></a>
                           </li>
                           <li>
                              @if (Auth::check())
                              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist" href="#" class="toggle-wishlist" data-id="{{ $product->id }}"><i class="fas fa-heart"></i></a>
                              @else
                              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Add to Wishlist" href="#" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-heart"></i></a>
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
            <div>
               {{ $products->links() }}
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
@section('script')
<script>
   $(document).ready(function() {

      // $('input[type=checkbox]').on('click', function() {
      //     // var value = $(this).val();
      //     $('#filter-form').submit();
      // });

      $('input:checkbox').on('click', function(e) {
         e.preventDefault();
         // var value = $(this).val();
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