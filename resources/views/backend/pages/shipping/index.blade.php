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
              <strong>Shipping List</strong>
            </h2>
            <h3 class="card-title float-right">
              <a href="{{route('admin.shipping.create')}}"  class="btn btn-primary btn-xs" title="Create New Shipping Location">
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
                    <th scope="col">Location</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($shippings as $shipping)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $shipping->name }}</td>
                                            <td>{{ $shipping->price }}</td>
                                            <td>
                                                @if ($shipping->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>

                                                <form class="form-inline" method="post"
                                                    action="{{ route('admin.shipping.destroy', $shipping->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('admin.shipping.edit', $shipping->id) }}"
                                                        class="btn btn-secondary btn-xs mx-1"><i class="fa fa-edit">
                                                        </i></a>
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this Shipping Location?')"
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