@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content pt-4">
      <div class="container-fluid">
         <form action="{{ route('admin.pages.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Create Page</h3>
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="blog_title">Title</label>
                                 <input type="text" class="form-control slug_source" name="page_title" id="page_title" placeholder="Enter Page Title" autocomplete="off" />
                                 @error('page_title')
                                 <span class="text-danger">
                                    {{ $errors->first('page_title') }}
                                 </span>
                                 @enderror
                              </div>

                              <div class="form-group">
                                 <label for="page_slug">Slug</label>
                                 <input type="text" class="form-control slug_field" name="page_slug" id="page_slug" placeholder="Enter Page Slug" autocomplete="off" />
                                 @error('page_slug')
                                 <span class="text-danger">
                                    {{ $errors->first('page_slug') }}
                                 </span>
                                 @enderror
                              </div>



                              <div class="form-group">
                                 <label for="page_description">Description</label>
                                 <textarea class="form-control editor {{ $errors->has('page_description') ? 'is-invalid' : '' }}" name="page_description" rows="5" id="page_description">{{ old('page_description') }}</textarea>
                                 @error('page_description')
                                 <span class="text-danger">
                                    {{ $errors->first('page_description') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group">
                                 <label for="page_image">Page Image</label>
                                 <img class="col-md-3" src="{{ asset('images/default.png') }}" alt="Page Image" height="199px" width="318px" id="pic">
                                 <input type="file" name="page_image" onchange="pic.src=window.URL.createObjectURL(this.files[0])" accept="image/*" class="form-control">
                              </div>
                              <div class="form-group col-md-9">
                                 <label for="metatitle">Meta Tittle</label>
                                 <input type="text" placeholder="" id="metatitle" class="form-control" name="page_metatitle">
                              </div>
                              <div class="form-group col-md-9">
                                 <label for="metatkeyword">Meta Keyword</label>
                                 <input type="text" placeholder="" id="metatkeyword" class="form-control" name="page_metakeyword">
                              </div>
                              <div class="form-group col-md-9">
                                 <label for="metadescription">Meta Description</label>
                                 <textarea id="metadescription" class="form-control" name="page_metadescription"></textarea>
                              </div>
                              <div class="form-group col-md-9">
                                 <label for="schema">Schema</label>
                                 <textarea id="schema" class="form-control" name="page_schema"></textarea>
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
@section('script')
<script src="https://cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script type="text/javascript">
   $(function() {
      if ($('.slug_source').length > 0) {
         $('.slug_source').on('keyup change', function() {
            var text = $(this).val();
            text = text.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
            $('.slug_field').val(text);
         });
      }

      if ($('.slug_field').length > 0) {
         $('.slug_field').on('keyup change', function() {
            var text = $(this).val();
            text = text.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-');
            $('.slug_field').val(text);
         });
      }

      if ($('.editor').length > 0) {
         $('.editor').each(function(e) {
            CKEDITOR.replace(this.id, {
               filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
               filebrowserUploadMethod: 'form',
               filebrowserBrowseUrl: "{{ route('getUploadedFiles') }}",
            });
         });
      }
   });
</script>
@endsection