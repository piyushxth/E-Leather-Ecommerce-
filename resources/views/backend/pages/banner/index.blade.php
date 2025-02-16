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
                     <strong>Banner List</strong>
                  </h2>
                  <h3 class="card-title float-right">
                     <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-xs"
                        title="Create New Brand">
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
                           <th scope="col">Banner Image</th>
                           <th scope="col">Banner Name</th>
                           <th scope="col">Order</th>
                           <th scope="col">Status</th>
                           <th scope="col">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($banners as $banner)
                        <tr>
                           <td>{{ $loop->index + 1 }}</td>
                           <td>
                              <img src="{{ (($banner->image != '') && file_exists(public_path().'/images/'.$banner->image)) ? asset('images/'.$banner->image) : asset('images/default.png') }}" alt="Card image cap"
                                 width="150px">
                           </td>
                           <td>{{ $banner->name }}</td>
                           <td>{{ $banner->order }}</td>
                           <td>
                              @if ($banner->status == 1)
                              <span class="badge badge-success">Active</span>
                              @else
                              <span class="badge badge-danger">Inactive</span>
                              @endif
                           </td>
                           <td>
                              <form class="form-inline" method="post"
                                 action="{{ route('admin.banner.destroy', $banner->id) }}">
                                 @csrf
                                 @method('delete')
                                 <a href="{{ route('admin.banner.edit', $banner->id) }}"
                                    class="btn btn-secondary btn-xs mx-1"><i class="fa fa-edit">
                                 </i></a>
                                 <button
                                    onclick="return confirm('Are you sure you want to delete this banner?')"
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