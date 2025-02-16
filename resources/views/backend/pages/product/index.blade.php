@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <section class="content pt-4">
      <div class="row">
         <div class="col-12">
            <!-- /.card -->
            <div class="card">
               <div class="card-header ">
                  <h3 class="card-title ">
                     <strong> Product List</strong>
                  </h3>
                  <h3 class="card-title float-right">
                     <a href="{{route('admin.product.create')}}" class="btn btn-primary btn-xs" title="Create New Product">
                     Create
                     </a>
                  </h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th scope="col">S.N</th>
                           <th scope="col">Product Name</th>
                           <th scope="col">Product Code</th>
                           <th scope="col">Created at</th>
                           <th scope="col">Status</th>
                           <th scope="col">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($products as $product)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td> <strong></strong>{{ $product->product_name }}</td>
                           <td>{{ $product->product_code }}</td>
                           <td>{{ date_format(($product->created_at),('D, d M Y')) }}</td>
                           <td>
                              @if ( $product->status == 1 )
                              <span class="badge badge-success">Active</span>
                              @else
                              <span class="badge badge-danger">Inactive</span>
                              @endif
                           </td>
                           <td>
                              <form class="form-inline" method="post"
                                 action="{{ route('admin.product.destroy', $product->id) }}">
                                 @csrf
                                 @method('delete')
                                 <a href="{{route('admin.product_attribute.index',$product->id)}}"
                                    class="btn btn-primary btn-xs mx-1"><i class="fa fa-list"> </i></a>
                                 <a href="{{ route('admin.product.edit', $product->id) }}"
                                    class="btn btn-secondary btn-xs mx-1"><i class="fa fa-edit"> </i></a>
                                 <button onclick="return confirm('Are you sure you want to delete this Product?')"
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