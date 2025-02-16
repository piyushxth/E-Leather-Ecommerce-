@extends('backend.layouts.master')


@section('content')

    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content pt-4">
            <div class="container-fluid">
                <form action="{{ route('admin.shipping.update', $shipping->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-12">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Shipping Location</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Location Name:</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    name="name" id="name" value="{{ $shipping->name }}"
                                                    placeholder="Enter Location Name" required>
                                                @error('name')
                                                    <span class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Price:</label>
                                                <input type="number"
                                                    class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                                    name="price" value="{{ $shipping->price }}" id="price" required>
                                                @error('price')
                                                    <span class="text-danger">
                                                        {{ $errors->first('price') }}
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
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="statusSwitch"
                                                    name="status" value="1" {{ old('status') ? 'checked' : '' }}
                                                    @if ($shipping->status == 1) checked @endif>
                                                <label class="custom-control-label" for="statusSwitch"> Active
                                                    Status</label>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.row -->
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
