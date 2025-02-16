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
                     <strong>Notification List</strong>
                  </h2>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  @if(count(Auth::user()->Notifications) > 0)
                  <table class="table table-hover admin-table" id="example1">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Time</th>
                           <th>Title</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach (Auth::user()->Notifications as $notification)
                        <tr class="@if ($notification->unread()) bg-light border-left-light @else border-left-success @endif">
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ $notification->created_at->format('F d, Y h:i A') }}</td>
                           <td>{{ $notification->data['title'] }}</td>
                           <td>
                              <a href="{{ route('admin.notification.show', $notification->id) }}"
                                 class="btn btn-primary btn-sm float-left mr-1"
                                 style="height:30px; width:30px;border-radius:50%"
                                 data-toggle="tooltip" title="view" data-placement="bottom"><i
                                 class="fas fa-eye"></i></a>
                              <form method="POST"
                                 action="{{ route('admin.notification.destroy', $notification->id) }}">
                                 @csrf
                                 @method('delete')
                                 <button class="btn btn-danger btn-sm dltBtn"
                                    data-id={{ $notification->id }}
                                 style="height:30px; width:30px;border-radius:50%"
                                 data-toggle="tooltip" data-placement="bottom" title="Delete"><i
                                    class="fas fa-trash-alt"></i></button>
                              </form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  @else
                  <h2>Notifications Empty!</h2>
                  @endif
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