@extends('backend.layouts.master')


@section('content')

    <div class="content-wrapper">


        <section class="content pt-4">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header ">

                            <h2 class="card-title ">
                                <strong>Order Details</strong>
                            </h2>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Order No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->full_name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>Rs.{{ $order->total_amount }}</td>
                                        <td>
                                            @if ($order->payment_status == 'paid')
                                                <span class="badge badge-primary">{{ $order->payment_status }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $order->payment_status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->status == 'new')
                                                <span class="badge badge-primary">{{ $order->status }}</span>
                                            @elseif($order->status=='process')
                                                <span class="badge badge-warning">{{ $order->status }}</span>
                                            @elseif($order->status=='delivered')
                                                <span class="badge badge-success">{{ $order->status }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $order->status }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <form class="form-inline" method="post"
                                                action="{{ route('admin.order.destroy', $order->id) }}">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('admin.order.edit', $order->id) }}"
                                                    class="btn btn-secondary btn-xs mx-1"><i class="fa fa-edit">
                                                    </i></a>
                                                <button
                                                    onclick="return confirm('Are you sure you want to delete this Order?')"
                                                    type="submit" class="btn btn-danger btn-xs">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-6">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header ">

                            <h2 class="card-title ">
                                <strong>Order Details</strong>
                            </h2>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <tr class="">
                                    <td>Order Number</td>
                                    <td> {{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <td>Order Date</td>
                                    <td> {{ $order->created_at->format('D d M, Y') }} at
                                        {{ $order->created_at->format('g : i a') }} </td>
                                </tr>
                                <tr>
                                    <td>Order Status</td>
                                    <td> {{ $order->status }}</td>
                                </tr>
                                <tr>

                                    <td>Shipping Charge</td>
                                    <td> Rs.{{ $order->shipping->price }}</td>
                                </tr>

                                <tr>
                                    <td>Total Amount</td>
                                    <td> Rs. {{ $order->total_amount }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td> @if ($order->payment_method == 'cod') Cash on Delivery @else E-sewa @endif</td>
                                </tr>
                                <tr>
                                    <td>Payment Status</td>
                                    <td> {{ $order->payment_status }}</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-6">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header ">

                            <h2 class="card-title ">
                                <strong>Shipping Information</strong>
                            </h2>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <tr class="">
                                    <td>Full Name</td>
                                    <td> {{ $order->full_name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td> {{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <td>Phone No.</td>
                                    <td> {{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td> {{ $order->address }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping location</td>
                                    <td> {{ $order->shipping->name }}</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>



                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>

@endsection
