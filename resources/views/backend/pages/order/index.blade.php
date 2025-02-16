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
                                <strong>Order List</strong>
                            </h2>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">S.N</th>
                                        <th scope="col">Order No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" width="150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->full_name }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>Rs.{{ $order->total_amount }}</td>
                                            <td>
                                                @if ($order->payment_status == 'paid')
                                                    <span class="badge badge-success">{{ $order->payment_status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $order->payment_status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($order->status == 'new')
                                                    <span class="badge badge-primary">new</span>
                                                @elseif($order->status=='process')
                                                    <span class="badge badge-warning">Processing</span>
                                                @elseif($order->status=='shipping')
                                                    <span class="badge badge-success">Shipping</span>
                                                @elseif($order->status=='delivered')
                                                    <span class="badge badge-success">delivered</span>
                                                @else
                                                    <span class="badge badge-danger">Cancel</span>
                                                @endif
                                            </td>

                                            <td>
                                                <form class="form-inline" method="post"
                                                    action="{{ route('admin.order.destroy', $order->id) }}">
                                                    @csrf
                                                    @method('delete')

                                                    <a href="{{ route('admin.order.show', $order->id) }}"
                                                        title="Order Details" class="btn btn-warning btn-xs mx-1"><i
                                                            class="fa fa-eye">
                                                        </i></a>
                                                    <a href="{{ route('admin.order.orderitem', $order->id) }}"
                                                        title="Order Item" class="btn btn-primary btn-xs mx-1"><i
                                                            class="fa fa-list">
                                                        </i></a>
                                                    <a href="{{ route('admin.order.edit', $order->id) }}"
                                                        title="Order Edit" class="btn btn-secondary btn-xs mx-1"><i
                                                            class="fa fa-edit">
                                                        </i></a>
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this Order?')"
                                                        type="submit" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>


                                        </tr>
                                    @endforeach

                                </tbody>

                                </tfoot>
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
