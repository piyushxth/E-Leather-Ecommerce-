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
                     <strong> Product Attributes</strong>
                  </h3>
                  <h3 class="card-title float-right">
                     <a href="{{ route('admin.product_attribute.create', $product->id) }}" class="btn btn-primary btn-xs" title="Add Product Attributes">
                        Create
                     </a>
                     <a href="{{ route('admin.product_attribute.edit', $product->id) }}" class="btn btn-primary btn-xs" title="Edit Product Attributes">
                        Edit
                     </a>
                  </h3>
               </div>
               <div class="card-body">
                  <hr />
                  <span><b>Product Images</b></span>
                  <hr />

                  <table id="product_images" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>S.N</th>
                           <th>Product Image</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($product_attribute as $attribute)
                        <tr>
                           <td>{{ $loop->index + 1 }}</td>
                           <td>
                              <img src="{{ asset('images/'.$attribute->product_variation_image) }}" alt="{{ $product->product_name }}" width="50px">
                           </td>
                           <td>
                              <form class="form-inline" method="post" action="{{ route('admin.product_attribute.destroy', $attribute->id) }}">
                                 @csrf
                                 @method('delete')
                                 <button onclick="return confirm('Are you sure you want to delete this Product Attributes?')" type="submit" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i>
                                 </button>
                              </form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>

                  <hr />
                  <span><b>Size,Stock Chart</b></span>
                  <hr />
                  <table id="example1" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>S.N</th>
                           <th>Size</th>
                           <th>Stock</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($product_sizes as $product_size)
                        <tr>
                           <td>{{ $loop->index + 1 }}</td>
                           <td>
                              {{ $product_size->size }}
                           </td>
                           <td>
                              {{ $product_size->stock }}
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>

               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection