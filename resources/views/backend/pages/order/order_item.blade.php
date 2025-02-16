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
                                <strong>Order Item</strong>
                            </h2>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                {{--  {{ dd($orderitem) }}  --}}
                                <tbody>
                                    @foreach ($orderitem as $item)
                                        <tr>
                                    <td><figure>
                                        <img class="d-block " style="height:150px"
                                            src="{{ ($item->products->product_image != '') && file_exists(public_path('images/'.$item->products->product_image)) ? asset('images/'.$item->products->product_image) : asset('images/default.png') }}"
                                            alt="{{ $item->product_name }}">
                                    </figure></td>
                                            <td>{{ $item->products->product_name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->size }}</td>
                                            <td>{{ env('DEFAULT_CURRENCY_SYMBOL','Rs.') }}{{ (formatcurrency( $item->price,'NPR')) }}</td>


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
