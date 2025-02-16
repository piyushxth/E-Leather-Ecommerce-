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
                     <strong> Pages List</strong>
                  </h3>
                  <h3 class="card-title d-none float-right">
                     <a href="{{route('admin.pages.create')}}" class="btn btn-primary btn-xs" title="Create New Page">
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
                           <th scope="col">Title</th>
                           <th scope="col">Created at</th>
                           <th scope="col">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($pages as $page)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td> <strong></strong>{{ $page->page_title }}</td>
                           <td>{{ date_format(($page->created_at),('D, d M Y')) }}</td>
                           <td>
                              <form class="form-inline" method="post"
                                 action="{{ route('admin.pages.destroy', $page->id) }}">
                                 @csrf
                                 @method('delete')
                                 <a href="{{ route('admin.pages.edit', $page->id) }}"
                                    class="btn btn-secondary btn-xs mx-1"><i class="fa fa-edit"> </i></a>
                                 <button onclick="return confirm('Are you sure you want to delete this page?')"
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