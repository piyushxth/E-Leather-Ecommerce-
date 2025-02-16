@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content pt-4">
      <div class="container-fluid">
         <form action="{{ route('admin.banner.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Create Banner</h3>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="name">Banner Title:</label>
                                 <input type="text"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    name="name" id="name" value="{{ old('name') }}"
                                    placeholder="Enter Banner Title" autocomplete="off" />
                                 @error('name')
                                 <span class="text-danger">
                                 {{ $errors->first('name') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group d-none">
                                 <label>Slug:</label>
                                 <input type="text"
                                    class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                                    name="slug" value="{{ old('slug') }}" id="slug" autocomplete="off" />
                                 @error('slug')
                                 <span class="text-danger">
                                 {{ $errors->first('slug') }}
                                 </span>
                                 @enderror
                              </div>
                              
                              <div class="form-group d-none">
                                 <label>Description:</label>
                                 <textarea
                                    class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    name="description" rows="5"></textarea>
                                 @error('description')
                                 <span class="text-danger">
                                 {{ $errors->first('description') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label>Banner Image</label>
                                 <img class="col-md-3" src="{{ asset('images/default.png') }}"
                                    alt=Banner Image" height="300px" width="300px" id="pic">
                                 <input type="file" name="image"
                                    onchange="pic.src=window.URL.createObjectURL(this.files[0])"
                                    accept="image/*" class="form-control">
                              </div>

                              <div class="form-group">
                                 <label for="order">Order:</label>
                                 <input type="text"
                                    class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}"
                                    name="order" id="order" value="{{ old('order') }}" autocomplete="off" />
                                 @error('order')
                                 <span class="text-danger">
                                 {{ $errors->first('order') }}
                                 </span>
                                 @enderror
                              </div>

                               <div class="form-group">
                              <div class="custom-control custom-switch">
                                 <input type="checkbox" class="custom-control-input" id="statusSwitch"
                                 name="status" value="1" {{ old('status') ? 'checked' : '' }}>
                                 <label class="custom-control-label" for="statusSwitch"> Active
                                 Status</label>
                              </div>
                           </div>
                           </div>
                           <!-- /.col -->
                        </div>
                        <!-- /.row -->
                     </div>
                     <div class="card-footer">
                        <input type="submit" class="btn btn-primary btn-sm  float-right" value="Submit">
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
@section('script')
<script>
   $(document).ready(function() {
       $('#name').on('keyup change', function() {
           var text = $(this).val();
           text = text.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
           $('#slug').val(text);
       });
   });
</script>
@endsection