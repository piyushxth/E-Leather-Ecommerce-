@extends('frontend.layouts.master')
@section('content')
<section class="breadcrumb-section py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
</section>
<div class="profile-dashboard-section  custom-margin">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-4 col-sm-12">
                @include('frontend.customer.sidebar')
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="profile">
                    <div class="title">
                        <span>Dashboard</span>
                    </div>
                    @if($orders->isNotEmpty())
                    <div class="order-table linked-order-table">
                        <table>
                            <tr>
                                <th>
                                    <h6>S.N</h6>
                                </th>
                                <th>
                                    <h6>Order ID</h6>
                                </th>
                                <th>
                                    <h6>Order Date</h6>
                                </th>
                                <th>
                                    <h6>Status</h6>
                                </th>
                            </tr>
                            @foreach ($orders as $order)
                            <tr class="orderItemsShow" id="{{$loop->index + 1}}" slug-data="{{ $order->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td class="order-items-status" >
                                   <span  @if($order->status=="new") 
                                    class="new "gi
                                    @elseif($order->status=="process")
                                    class="process"
                                    @elseif($order->status=="cancel")
                                    class="cancel"
                                    @elseif($order->status=="delivered")
                                    class="delivered"
                                    @endif> 
                                    {{ ucfirst(trans($order->status)) }}</span></td>
                            </tr>
                            @endforeach
                        </table>
                    {{ $orders->links() }}

                    </div>
                    @else
                    <div class="my-cart-table">
                        <p>No items on Available</p>
                     </div>
                    @endif
                </div>
                <div class="order-table-showModel order-table " data-toggle="modal" data-target="#orderItemsModel">
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
