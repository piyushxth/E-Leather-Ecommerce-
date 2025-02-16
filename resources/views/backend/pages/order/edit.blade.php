@extends('backend.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-4">
            <div class="container-fluid">
                <form action="{{ route('admin.order.update', $order->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-12">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Order Status</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Payment Status:</label>
                                                <select
                                                    class="form-control select2 {{ $errors->has('payment_status') ? 'is-invalid' : '' }}"
                                                    name="payment_status" style="width: 100%;">
                                                    <option value="">--Select Payment Status--</option>
                                                    <option value="paid"
                                                        {{ $order->payment_status == 'paid' ? 'selected' : '' }}>
                                                        Paid
                                                    </option>
                                                    <option value="unpaid"
                                                        {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>
                                                        Unpaid
                                                    </option>


                                                </select>
                                                @error('payment_status')
                                                    <span class="text-danger">
                                                        {{ $errors->first('payment_status') }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Order Status:</label>
                                                <select
                                                    class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                                    name="status" style="width: 100%;">
                                                    <option value="">--Select Status--</option>
                                                    <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>
                                                        New
                                                    </option>
                                                    <option value="process"
                                                        {{ $order->status == 'process' ? 'selected' : '' }}>Processing
                                                    </option>
                                                    <option value="delivered"
                                                        {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered
                                                    </option>
                                                    <option value="shipping"
                                                        {{ $order->status == 'shipping' ? 'selected' : '' }}>Shipping
                                                    </option>
                                                    <option value="cancel"
                                                        {{ $order->status == 'cancel' ? 'selected' : '' }}>Cancel
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">
                                                        {{ $errors->first('status') }}
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Action</h3>

                                </div>

                                <div class="card-footer">
                                    <input type="submit" class="btn btn-primary btn-sm  float-right" value="Submit">
                                </div>
                                <!-- /.card-body -->
                            </div>

                        </div>

                        <!-- /.col -->

                    </div>
                    <!-- /.row -->

                </form>

            </div><!-- /.container-fluid -->
        </section>


        </section>
    </div>

@endsection


@section('script')

@endsection
