@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content pt-4">
      <div class="container-fluid">
         <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
               <div class="col-md-9">
                  <!-- SELECT2 EXAMPLE -->
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Create Product</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="row">
                           {{--
                           <div class="col-md-12">
                              --}}
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Product Name</label>
                                 <input type="text" class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" name="product_name" id="product_name" value="{{ old('product_name') }}" placeholder="Enter Product Name" autocomplete="off" />
                                 @error('product_name')
                                 <span class="text-danger">
                                    {{ $errors->first('product_name') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Product Code</label>
                                 <input type="text" class="form-control {{ $errors->has('product_code') ? 'is-invalid' : '' }}" name="product_code" id="product_code" value="{{ old('product_code') }}" placeholder="Enter Product Code" autocomplete="off" />
                                 @error('product_code')
                                 <span class="text-danger">
                                    {{ $errors->first('product_code') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6 d-none">
                              <div class="form-group">
                                 <label>Slug</label>
                                 <input type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" value="{{ old('slug') }}" name="slug" id="slug" autocomplete="off" />
                                 @error('slug')
                                 <span class="text-danger">
                                    {{ $errors->first('slug') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6 d-none">
                              <div class="form-group">
                                 <label>Brand</label>
                                 <select class="form-control select2 {{ $errors->has('brand_id') ? 'is-invalid' : '' }}" name="brand_id" style="width: 100%;" />
                                 <option value="1" selected>--Select-Brand--</option>
                                 @foreach ($brand as $b)
                                 <option value="{{ $b->id }}">{{ $b->name }}</option>
                                 @endforeach
                                 </select>
                                 @error('brand_id')
                                 <span class="text-danger">
                                    {{ $errors->first('brand_id') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Category</label>
                                 <select class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id[]" style="width: 100%;" multiple="multiple" />
                                 <option value="">Select Category</option>
                                 @foreach ($categories as $category)
                                 <option value="{{ $category->id }}">
                                    {{ $category->category_name }}
                                 </option>
                                 @endforeach
                                 </select>
                                 @error('category_id')
                                 <span class="text-danger">
                                    {{ $errors->first('category_id') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6 d-none">
                              <div class="form-group">
                                 <label>Product Weight(in KG)</label>
                                 <input type="number" class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" name="weight" id="weight" value="2" placeholder="Enter Weight Of Product" autocomplete="off" />
                                 @error('weight')
                                 <span class="text-danger">
                                    {{ $errors->first('weight') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Regular Price</label>
                                 <input type="number" class="form-control {{ $errors->has('regular_price') ? 'is-invalid' : '' }}" name="regular_price" id="regular_price" value="{{ old('regular_price') }}" placeholder="Price" autocomplete="off" />
                                 @error('regular_price')
                                 <span class="text-danger">
                                    {{ $errors->first('regular_price') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Discount Percent(%)</label>
                                 <input type="number" class="form-control {{ $errors->has('discount_percent') ? 'is-invalid' : '' }}" min="0" value="0" max="100" name="discount_percent" id="discount_percent" placeholder="Enter Discount Percent" autocomplete="off">
                                 @error('discount_precent')
                                 <span class="text-danger">
                                    {{ $errors->first('discount_percent') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="suitable_for">Suitable For</label>
                                 <select name="suitable_for" class="form-control {{ $errors->has('suitable_for') ? 'is-invalid' : '' }}" id="suitable_for">
                                    <option value="">Select</option>
                                    <option value="1" {{ (old('suitable_for') == 1) ? 'selected' : '' }}>Male</option>
                                    <option value="2" {{ (old('suitable_for') == 2) ? 'selected' : '' }}>Female</option>
                                    <option value="3" {{ (old('suitable_for') == 3) ? 'selected' : '' }}>Kid</option>
                                 </select>
                                 @error('suitable_for')
                                 <span class="text-danger">
                                    {{ $errors->first('suitable_for') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Description</label>
                                 <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" rows="5"></textarea>
                                 @error('description')
                                 <span class="text-danger">
                                    {{ $errors->first('description') }}
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           {{--
                           </div>
                           --}}
                           <!-- /.col -->
                        </div>
                        <!-- /.row -->
                     </div>
                     <!-- /.card-body -->
                  </div>
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title font-weight-bold">Image</h3>
                        <span class="ml-2 muted">Note:This image is display as primary image in listings</span>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-4 append-col">
                              <div class="card">
                                 <img class="card-img-top" src="{{ asset('images/default.png') }}" alt="Product Image" height="auto" width="200px" id="pic">
                                 <div class="card-body">
                                    <p class="card-text">
                                       <label>Thumbnail Image</label>
                                       <input type="file" name="product_image" onchange="pic.src=window.URL.createObjectURL(this.files[0])" accept="image/*">
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
                        <h3 class="card-title">Cross Selling Product</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Cross Selling Product</label>
                                 <select class="form-control  select2" style="width: 100%;" name="cross_selling_product[]" multiple="multiple">
                                    <option disabled>Select cross selling product</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                       {{ $product->product_name }}
                                    </option>
                                    @endforeach
                                 </select>
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
                                 <label>SEO Title</label>
                                 <input type="text" class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}" name="seo_title" id="seo_title" value="{{ old('seo_title') }}" placeholder="Enter SEO Title">
                                 @error('seo_title')
                                 <span class="text-danger">
                                    {{ $errors->first('seo_title') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label>SEO Description</label>
                                 <textarea class="form-control {{ $errors->has('seo_description') ? 'is-invalid' : '' }}" value="{{ old('seo_description') }}" name="seo_description" rows="5"></textarea>
                                 @error('seo_description')
                                 <span class="text-danger">
                                    {{ $errors->first('seo_description') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label>SEO Keyword</label>
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
                  <div class="card card-default sticky-card">
                     <div class="card-header">
                        <h3 class="card-title">Action</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="form-group">
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="statusSwitch" name="status" value="1" {{ old('status') ? 'checked' : '' }}>
                              <label class="custom-control-label" for="statusSwitch"> Active
                                 Status</label>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="saleSwitch" name="sale" value="1" {{ old('sale') ? 'checked' : '' }}>
                              <label class="custom-control-label" for="saleSwitch">On Sale</label>
                           </div>
                        </div>
                     </div>
                     <!-- /.col -->
                     <div class="card-footer">
                        <input type="submit" class="btn btn-primary  btn-sm float-right" value="Submit">
                     </div>
                  </div>
                  <!--card-->
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
      $('#product_name').on('keyup change', function() {
         var text = $(this).val();
         text = text.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
         $('#slug').val(text);
      });

      $('#slug').on('keyup change', function() {
         var text = $(this).val();
         text = text.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
         $('#slug').val(text);
      });
   });
</script>
@endsection