@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <section class="content pt-4">
      <div class="row">
         <div class="col-12">
            <!-- /.card -->
            <div class="card">
               <div class="card-header">
                  <h2 class="card-title ">
                     <strong>Category List</strong>
                  </h2>
                  <h3 class="card-title float-right">
                     <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-xs"
                        title="Add New Category">
                     Create
                     </a>
                  </h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-hover">
                     <thead>
                        <tr>
                           <th>Category Name</th>
                           <th>Image</th>
                           <th>Order</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($categories as $category)
                        <tr>
                           <td>{{ $category->category_name }}</td>
                           <td>
                              <img class="img-fluid"
                                    src="{{ ($category->category_image != '' && public_path('images/' . $category->category_image)) ? asset('images/' . $category->category_image) : asset('images/default.png') }}"
                                    alt="{{ $category->title }}" height="200px" width="200px" id="pic">
                           </td>
                           <td>{{ $category->order }}</td>
                           <td>
                              @if ($category->status == 1)
                              <span class="badge badge-success">Active</span>
                              @else
                              <span class="badge badge-danger">Inactive</span>
                              @endif
                           </td>
                           <td>
                              <form class="form-inline" method="post"
                                 action="{{ route('admin.category.destroy', $category->id) }}">
                                 @csrf
                                 @method('delete')
                                 <a href="{{ route('admin.category.edit', $category->id) }}"
                                    class="btn btn-secondary btn-xs mx-1"><i class="fa fa-edit">
                                 </i></a>
                                 <button
                                    onclick="return confirm('Are you sure you want to delete this Category?')"
                                    type="submit" class="btn btn-danger btn-xs">
                                 <i class="fa fa-trash"></i>
                                 </button>
                              </form>
                           </td>
                        </tr>
                           @foreach ($category->categories as $child_category)
                              @include('backend/pages/category/recursive_child_category', ['child_category' => $child_category])
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