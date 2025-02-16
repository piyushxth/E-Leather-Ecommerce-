@extends('frontend.layouts.master')
@section('content')
    <section class="inner-dashboard sec-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    @include('frontend.customer.sidebar')
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                    <!-- ORDERS DETAILS -->
                    <div class="profile">
                        <div class="idr-title">
                            <h4>Order #{{ $order->id }}</h4>
                        </div>
                        <div class="idr-content idrc-orders-details">
                            <div class="orders-details-top">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="orders-details-top-left">
                                            <small>Information</small>
                                            <h6>Placed on:
                                                <span>{{ date('d M Y H:m:s A', strtotime($order->created_at)) }}</span>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 odtr">
                                        <div class="orders-details-top-right">
                                            @if ($order->status == 'new')
                                                {{-- Cancel modal --}}
                                                <div class="authentication-modal">
                                                    <div id="cancelModal" class="modal fade" role="dialog"
                                                        style="z-index: 10000;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Cancel Order</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to cancel the order?</p>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="modal-login">
                                                                                <button type="button"
                                                                                    class="btn btn-primary"
                                                                                    id="confirmDeleteBtn">Yes</button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="modal-register">
                                                                                <button type="button" class="btn btn-danger"
                                                                                    data-dismiss="modal">No</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('customer.order.update', $order->id) }}"
                                                    method="POST" id="cancelForm">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" value="cancel" name="status">
                                                    <input type="button" value="Cancel" id="cancelButton">
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="orders-details-middle">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-id">S.N</th>
                                            <th class="product-name">Product Name</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-qty">Quantity</th>
                                            <th class="product-qty">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderitem as $item)
                                            <tr class="product-ordered-item-details">
                                                <td class="product-id">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="product-name">
                                                    <h4>
                                                        @if (!empty($item->products))
                                                            <a href="{{ route('main_product', $item->products->slug) }}">
                                                                {{ $item->products->product_name }}
                                                            </a>
                                                        @else
                                                            Product Unavailable
                                                        @endif
                                                    </h4>
                                                </td>
                                                <td class="product-price">
                                                    <span>Rs {{ $item->price }}</span>
                                                </td>
                                                <td class="product-qty">
                                                    <span>{{ $item->quantity }}</span>
                                                </td>
                                                <td class="product-qty">
                                                    <span>{{ $item->quantity * $item->price }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="offset-xl-7 col-lg-5">
                                        <div class="odm-total">
                                            <h4> Total</h4>
                                            <table>
                                                <tbody>
                                                    <tr class="odmt-subtotal">
                                                        <td>Subtotal</td>
                                                        <td class="subtotal-amt">Rs {{ $order->sub_total }}</td>
                                                    </tr>
                                                    <tr class="odmt-subtotal">
                                                        <td>Shipping Cost</td>
                                                        <td class="subtotal-amt">Rs {{ $order->shipping->price }}</td>
                                                    </tr>
                                                    <tr class="odmt-total">
                                                        <td>Total</td>
                                                        <td class="total-amt">Rs {{ $order->total_amount }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="orders-details-bottom">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="odb-left">
                                            <h6>Shipping Address</h6>
                                            <ul>
                                                <li>{{ $order->full_name }}</li>
                                                <li>{{ $order->shipping->name }}</li>
                                                <li>{{ $order->phone }}</li>
                                                <li>{{ $order->email }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 odbr">
                                        <div class="odb-right">
                                            <h6>Payement Method</h6>
                                            <ul>
                                                <li>Cash On Delivery</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#cancelButton").click(function(e) {
                e.preventDefault();
                $('#cancelModal').modal('show')
            });
            $("#confirmDeleteBtn").click(function(e) {
                $('#cancelForm').submit();
            });
        });
    </script>
@endsection
