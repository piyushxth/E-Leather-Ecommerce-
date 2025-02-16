@extends('backend.layouts.master')


@section('content')

    <div class="content-wrapper">


        <section class="content pt-4">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header  ">
                            <h2 class="card-title ">
                                <strong> Navbar List</strong>
                            </h2>
                            <h3 class="card-title float-right">
                                <a href="{{ route('admin.navbar.create') }}" class="btn btn-primary btn-xs"
                                    title="Create New Navbar">
                                    Create
                                </a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">S.N</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">URL</th>
                                        <th scope="col">order</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($navbar as $n)
                                        <tr>
                                            <th>{{ $loop->index + 1 }}</th>
                                            <th>{{ $n->name }}</th>
                                            <th>{{ $n->route }}</th>
                                            <th>{{ $n->ordering }}</th>
                                            <th>
                                                @if ($n->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </th>
                                            <td>

                                                <form class="form-inline" method="post"
                                                    action="{{ route('admin.navbar.destroy', $n->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('admin.navbar.edit', $n->id) }}"
                                                        class="btn btn-secondary btn-xs mx-1"><i class="fa fa-edit">
                                                        </i></a>
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this Navbar?')"
                                                        type="submit" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                        @foreach ($n->navbars as $child_navbar)
                                            @include('backend/pages/navbar/recursive_child_navbar', ['child_navbar' =>
                                            $child_navbar])
                                        @endforeach


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
