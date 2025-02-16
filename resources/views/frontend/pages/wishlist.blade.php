@extends('frontend.layouts.master')
@section('content')
<section class="breadcrumb-section py-4">
   <div class="container">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">My Wishlist</li>
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
            <div class="profile">
               @if($wishlistItems->isNotEmpty())
               <div class="title">
                  <h4>My Wishlist</h4>
               </div>
               <div class="my-cart-table">
                  <table>
                     <tr>
                        <th>S.N</th>
                        <th>Product Image</th>
                        <th>Product Detail</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Action</th>
                     </tr>
                     @php($priceArray = [])

                     @foreach($wishlistItems as $wishlistItem)
                     @php($priceArray[$loop->iteration] = $wishlistItem->price * $wishlistItem->qty)
                     <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                           <a href="{{ route('main_product', [$wishlistItem->model->slug]) }}" target="_blank">
                              <figure>
                                 <img src="{{ (isset($wishlistItem->options[1])) && ($wishlistItem->options[1] != '') && file_exists(public_path('images/'.$wishlistItem->options[1])) ? asset('images/'.$wishlistItem->options[1]) : asset('images/default.png') }}"
                                    alt="{{ ($wishlistItem->name) }}">
                              </figure>
                           </a>
                        </td>
                        <td>
                           <a href="{{ route('main_product', [$wishlistItem->model->slug]) }}" target="_blank">{{ ($wishlistItem->name) }}</a>
                        </td>
                        <td>
                           <input type="number" min="1" value="{{ ($wishlistItem->qty) }}"
                              autocomplete="off" />
                        </td>
                        <td>{{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency($wishlistItem->price,'NPR')) }}
                        </td>
                        <td >
                           <div class="wishlist-action-button">
                              <form action="{{ route('customer.wishlist.destroy', $wishlistItem->rowId) }}"
                                 method="POST">
                                 @csrf
                                 @method('delete')
                                 <button type="submit" class="delet-product"
                                    onclick="return confirm('Are you sure you want to delete?');">
                                 <i class="fas fa-trash-alt"></i>
                                 </button>
                              </form>
                              <form id="wishlist-to-cart-add-action-button">
                                 <input class="me-3 product_qty qty_active"  type="hidden" id="wishlist-to-cart-add-action-button{{$loop->iteration}}" min="1"
                                 value="{{ ($wishlistItem->qty) }}" autocomplete="off"
                                 data-id="{{ $wishlistItem->id }}" data-sp="{{ $wishlistItem->price }}"
                                 data-title="{{ $wishlistItem->name }}" data-size="{{ $wishlistItem->options[0] }}" data-stock="{{ $wishlistItem->options[2]}}"  data-fromlisting="false" data-wishlistitem="{{ $wishlistItem->rowId }}" />
                                 <button class="add-to-cart addToCartAjax">
                                 <i class="fas fa-cart-plus"></i>
                                 </button>
                              </form>
                           </div>
                        </td>
                     </tr>
                     @endforeach
                  </table>
               </div>
               @else
                  <div class="title">
                     <h4>My WishList</h4>
                  </div>
                  <div class="my-cart-table">
                     <p>No items on WishList</p>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
