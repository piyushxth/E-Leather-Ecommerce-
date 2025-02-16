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
                     <strong> Testimonials List</strong>
                  </h3>
                  <h3 class="card-title float-right">
                     <a href="{{route('admin.testimonials.create')}}" class="btn btn-primary btn-xs" title="Create New Testimonial">
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
                           <th scope="col">Testimonial Author</th>
                           <th scope="col">Designation</th>
                           <th scope="col">Created at</th>
                           <th scope="col">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($testimonials as $testimonial)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $testimonial->testimonial_author }}</td>
                           <td>{{ $testimonial->testimonial_designation }}</td>
                           <td>{{ date_format(($testimonial->created_at),('D, d M Y')) }}</td>
                           <td>
                              <form class="form-inline" method="post"
                                 action="{{ route('admin.testimonials.destroy', $testimonial->id) }}">
                                 @csrf
                                 @method('delete')
                                 <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                    class="btn btn-secondary btn-xs mx-1"><i class="fa fa-edit"> </i></a>
                                 <button onclick="return confirm('Are you sure you want to delete this testimonial?')"
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