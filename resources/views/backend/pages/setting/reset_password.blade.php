@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content pt-4">
      <div class="container-fluid">
         <form action="{{ route('admin.reset_password') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
               <div class="col-md-12">
                  <!-- SELECT2 EXAMPLE -->
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="col-lg-7">
                           <div class="form-group">
                              <label> Current Password </label><br>
                             
                              <input type="password" name="current_psw"
                                 value="{{ old('current_psw') ? old('current_psw') : '' }}" size="40"
                                 class="form-control {{ $errors->has('current_psw') ? 'is-invalid' : '' }}" required />
                              
                              @error('current_psw')
                              <span class="text-danger">
                              {{ $errors->first('current_psw') }}
                              </span>
                              @enderror
                           </div>
                        </div>
                        <div class="col-lg-7">
                           <div class="form-group">
                              <label> New Password </label><br>
                              
                              <input type="password" name="password" size="40"
                                 class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                 required>
                              
                              @error('password')
                              <span class="text-danger">
                              {{ $errors->first('password') }}
                              </span>
                              @enderror
                           </div>
                        </div>
                        <div class="col-lg-7">
                           <div class="form-group">
                              <label> Confirm Password </label><br>
                              <input type="password" name="password_confirmation" value="" size="40"
                                 class="form-control"
                                 required>
                              
                           </div>
                        </div>
                        <div class="col-lg-7">
                           <div class="idrc-password-btn">
                              <button type="submit" class="btn btn-primary">
                              Save Changes
                              </button>
                           </div>
                        </div>
                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->
         </form>
      </div>
      <!-- /.container-fluid -->
   </section>
   </section>
</div>
@endsection