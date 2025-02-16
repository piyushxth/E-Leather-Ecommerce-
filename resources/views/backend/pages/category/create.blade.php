@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content pt-4">
      <div class="container-fluid">
         <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
               <div class="col-md-9">
                  <!-- SELECT2 EXAMPLE -->
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Create Category</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        {{-- @include('backend.show-errors') --}}
                        <div class="form-group">
                           <label>Category Name: <span style="color:red">*</span></label>
                           <input type="text" class="form-control {{ $errors->has('category_name') ? 'is-invalid' : '' }}" name="category_name" id="category_name" placeholder="Enter Category Name" value="{{ old('category_name') }}" required>
                           @error('category_name')
                           <span class="text-danger">
                              {{ $errors->first('category_name') }}
                           </span>
                           @enderror
                        </div>
                        <div class="
                     form-group">
                           <label>Slug: <span style="color:red">*</span></label>
                           <input type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" name="slug" id="slug" value="{{ old('slug') }}" required>
                           @error('slug')
                           <span class="text-danger">
                              {{ $errors->first('slug') }}
                           </span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label>Category Hierarchy:</label>
                           <select class="form-control select2 {{ $errors->has('parent_id') ? 'is-invalid' : '' }}" name="parent_id" style="width: 100%;" value="{{ old('parent_id') }}">
                              <option value="">Main Category</option>
                              @foreach ($categories as $category)
                              <option value="{{ $category->id }}">
                                 {{ $category->category_name }}
                              </option>
                              @foreach ($category->childrenCategories as $childCategory)
                              @include('backend/pages/category/recursive_create_child_category',
                              ['child_category' => $childCategory])
                              @endforeach
                              @endforeach
                           </select>
                           @error('parent_id')
                           <span class="text-danger">
                              {{ $errors->first('parent_id') }}
                           </span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label>Order:</label>
                           <input type="number" class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" name="order" id="order" value="{{ old('order') }}">
                           @error('order')
                           <span class="text-danger">
                              {{ $errors->first('order') }}
                           </span>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Category Image</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-4 append-col">
                              <div class="card">
                                 <img class="img-fluid mx-auto d-block" src="{{ asset('images/default.png') }}" alt="Card image cap" height="200px" width="200px" id="pic">
                                 <div class="card-body">
                                    <p class="card-text">
                                       <label>Category Image</label>
                                       <input type="file" name="category_image" onchange="pic.src=window.URL.createObjectURL(this.files[0])" accept="image/*">
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <!-- /.col -->
                        </div>
                        <!-- /.row -->
                     </div>
                     <!-- /.card-body -->
                  </div>
                  <div class="card card-default d-none">
                     <div class="card-header">
                        <h3 class="card-title">SEO Management</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Seo Title:</label>
                                 <input type="text" class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}" name="seo_title" id="seo_title" value="{{ old('seo_title') }}" placeholder="Enter Seo Title">
                                 @error('seo_title')
                                 <span class="text-danger">
                                    {{ $errors->first('seo_title') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label>Seo Description:</label>
                                 <textarea class="form-control {{ $errors->has('seo_description') ? 'is-invalid' : '' }}" value="{{ old('seo_description') }}" name="seo_description" rows="5"></textarea>
                                 @error('seo_description')
                                 <span class="text-danger">
                                    {{ $errors->first('seo_description') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label>Seo Keyword:</label>
                                 <textarea name="seo_keyword" id="seo_keyword" class="form-control {{ $errors->has('seo_keyword') ? 'is-invalid' : '' }}">{!! old('seo_keyword') !!}</textarea>
                                 @error('seo_keyword')
                                 <span class="text-danger">
                                    {{ $errors->first('seo_keyword') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label>Schema</label>
                                 <textarea name="schema" id="schema" class="form-control {{ $errors->has('schema') ? 'is-invalid' : '' }}">{!! old('schema') !!}</textarea>
                                 @error('schema')
                                 <span class="text-danger">
                                    {{ $errors->first('schema') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <!-- /.col -->
                        </div>
                        <!-- /.row -->
                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card card-default sticky-card ">
                     <div class="card-header">
                        <h3 class="card-title">Action</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        {{--
                  <div class="row">
                     --}}
                        {{--
                     <div class="col-md-6">
                        --}}
                        <div class="form-group">
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" {{ old('status') ? 'checked' : '' }}>
                              <label class="custom-control-label" for="statusSwitch"> Active Status</label>
                           </div>
                        </div>
                        {{--
                     </div>
                     --}}
                        {{--
                     <div class="cd-md-6">
                        --}}
                        <div class="form-group">
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="featuredSwitch" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                              <label class="custom-control-label" for="featuredSwitch"> Featured</label>
                           </div>
                        </div>
                     </div>
                     <div class="card-footer">
                        <input type="submit" class="btn btn-primary btn-sm float-right" value="Submit">
                     </div>
                  </div>
                  <!--card-->
               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->
         </form>
      </div><!-- /.container-fluid -->
   </section>
   </section>
</div>
@endsection
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
      $('#category_name').on('keyup change', function() {
         var text = $(this).val();
         text = text.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
         $('#slug').val(text);
      });
   });
</script>
@endsection