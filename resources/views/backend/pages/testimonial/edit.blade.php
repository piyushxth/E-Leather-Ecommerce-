@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content pt-4">
      <div class="container-fluid">
         <form action="{{ route('admin.testimonials.update',[$testimonial->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Edit Testimonial</h3>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="testimonial_author">Author</label>
                                 <input type="text"
                                    class="form-control {{ $errors->has('testimonial_author') ? 'is-invalid' : '' }}"
                                    name="testimonial_author" id="testimonial_author" value="{{ old('testimonial_author') ? old('testimonial_author') : $testimonial->testimonial_author }}"
                                    placeholder="Enter Author" autocomplete="off" />
                                 @error('testimonial_author')
                                 <span class="text-danger">
                                 {{ $errors->first('testimonial_author') }}
                                 </span>
                                 @enderror
                              </div>

                              <div class="form-group">
                                 <label for="testimonial_designation">Author</label>
                                 <input type="text"
                                    class="form-control {{ $errors->has('testimonial_designation') ? 'is-invalid' : '' }}"
                                    name="testimonial_designation" id="testimonial_designation" value="{{ old('testimonial_designation') ? old('testimonial_designation') : $testimonial->testimonial_designation }}"
                                    placeholder="Enter Designation" autocomplete="off" />
                                 @error('testimonial_designation')
                                 <span class="text-danger">
                                 {{ $errors->first('testimonial_designation') }}
                                 </span>
                                 @enderror
                              </div>

                              <div class="form-group">
                                 <label for="testimonial_description">Description</label>
                                 <textarea
                                    class="form-control editor {{ $errors->has('testimonial_description') ? 'is-invalid' : '' }}"
                                    name="testimonial_description" rows="5" id="testimonial_description ">{{ old('testimonial_description') ? old('testimonial_description') : $testimonial->testimonial_description }}</textarea>
                                 @error('testimonial_description')
                                 <span class="text-danger">
                                 {{ $errors->first('testimonial_description') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label for="testimonial_image">Image</label>
                                 <img class="col-md-3" src="{{ (($testimonial->testimonial_image != '') && file_exists(public_path('images/testimonials/'.$testimonial->testimonial_image))) ? asset('images/testimonials/'.$testimonial->testimonial_image) : asset('images/default.png') }}"
                                    alt="Testimonial Image" height="300px" width="300px" id="pic">
                                 <input type="file" name="testimonial_image"
                                    onchange="pic.src=window.URL.createObjectURL(this.files[0])"
                                    accept="image/*" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label for="testimonial_order">Order</label>
                                 <input type="text"
                                    class="form-control"
                                    name="testimonial_order" id="testimonial_order" value="{{ old('testimonial_order') ? old('testimonial_order') : $testimonial->testimonial_order }}"
                                    placeholder="Enter Order" autocomplete="off" />
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card-footer">
                        <input type="submit" class="btn btn-primary btn-sm  float-left" value="Submit">
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
</div>
@endsection