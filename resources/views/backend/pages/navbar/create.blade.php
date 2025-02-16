@extends('backend.layouts.master')


@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-4">
            <div class="container-fluid">
                <form action="{{ route('admin.navbar.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Create Navbar</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Navbar Name:</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    name="name" id="name" placeholder="Enter Navbar Name" required>
                                                @error('name')
                                                    <span class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Redirect Url:</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('route') ? 'is-invalid' : '' }}"
                                                    name="route" value="{{ old('route') }}" id="route" required>
                                                @error('route')
                                                    <span class="text-danger">
                                                        {{ $errors->first('route') }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Target:</label>
                                                <select
                                                    class="form-control select2 {{ $errors->has('target') ? 'is-invalid' : '' }}"
                                                    name="target" style="width: 100%;">
                                                    <option value="_self">Self</option>
                                                    <option value="_blank">New Page</option>

                                                </select>
                                                @error('target')
                                                    <span class="text-danger">
                                                        {{ $errors->first('target') }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Navbar Hierarchy:</label>
                                                <select
                                                    class="form-control select2 {{ $errors->has('parent_id') ? 'is-invalid' : '' }}"
                                                    name="parent_id" style="width: 100%;">
                                                    <option value="">Main Navbar</option>
                                                    @foreach ($navbars as $navbar)
                                                        <option value="{{ $navbar->id }}">
                                                            {{ $navbar->name }}</option>
                                                        @foreach ($navbar->childrenNavbars as $childNavbar)
                                                            @include('backend/pages/navbar/recursive_create_child_navbar',
                                                            ['child_navbar' => $childNavbar])
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                                @error('parent_id')
                                                    <span class="text-danger">
                                                        {{ $errors->first('parent_id') }}
                                                    </span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label>Order:</label>
                                                <input type="number"
                                                    class="form-control {{ $errors->has('ordering') ? 'is-invalid' : '' }}"
                                                    name="ordering" value="{{ old('ordering') }}" id="ordering">
                                                @error('ordering')
                                                    <span class="text-danger">
                                                        {{ $errors->first('ordering') }}
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
                        </div>

                        <div class="col-md-3">
                            <div class="card card-default sticky-card">
                                <div class="card-header">
                                    <h3 class="card-title">Action</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="statusSwitch"
                                                name="status" value="1" {{ old('status') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="statusSwitch"> Active Status</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-footer">
                                    <input type="submit" class="btn btn-primary btn-sm float-right" value="Submit">
                                </div>
                                <!-- /.col -->

                            </div>
                        </div>
                        <!--card-->
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
