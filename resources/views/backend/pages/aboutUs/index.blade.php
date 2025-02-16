@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content pt-4">
      <div class="container-fluid">
         <form action="{{ route('admin.aboutus.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">About Us</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="form-group">
                           <label for="about_us_description">Description About us</label>
                           <textarea name="about_us_description" id="about_us_description" class="form-control editor">{{ old('about_us_description')?old('about_us_description'):$aboutUs->about_us_description }}</textarea>
                           @if($errors->has('about_us_description'))
                           <span class="text-danger">
                              {{ $errors->first('about_us_description') }}
                           </span>
                           @endif
                        </div>
                        <div class="form-group">
                           <label for="about_us_image">About us Image</label>
                           <img src="{{ ($aboutUs->about_us_image != '' && file_exists(public_path('images/aboutus/'.$aboutUs->about_us_image))) ? asset('images/aboutus/'.$aboutUs->about_us_image) : asset('images/default.png') }}" alt="About us Image" class="rounded" id="about_us_image" height="200px" width="200px">
                           <input type="file" name="about_us_image" onchange="document.getElementById('about_us_image').src = window.URL.createObjectURL(this.files[0])" accept="image/*" class="form-control">
                           @if($errors->has('about_us_image'))
                           <span class="text-danger">
                              {{ $errors->first('about_us_image') }}
                           </span>
                           @endif
                        </div>

                        <div class="form-group col-md-9">
                           <label for="metatitle">Meta Tittle</label>
                           <input type="text" placeholder="" id="metatitle" class="form-control" name="about_us_metatitle" value="{{isset($aboutUs->about_us_metatitle) ? $aboutUs->about_us_metatitle : ''}}">
                        </div>
                        <div class="form-group col-md-9">
                           <label for="metatkeyword">Meta Keyword</label>
                           <input type="text" placeholder="" id="metatkeyword" class="form-control" name="about_us_metakeyword" value="{{isset($aboutUs->about_us_metakeyword) ? $aboutUs->about_us_metakeyword : '' }}">
                        </div>
                        <div class="form-group col-md-9">
                           <label for="metadescription">Meta Description</label>
                           <textarea id="metadescription" class="form-control" name="about_us_metadescription">{{isset($aboutUs->about_us_metadescription) ? $aboutUs->about_us_metadescription : '' }}</textarea>
                        </div>
                        <div class="form-group col-md-9">
                           <label for="schema">Schema</label>
                           <textarea id="schema" class="form-control" name="about_us_schema">{{isset($aboutUs->about_us_schema) ? $aboutUs->about_us_schema : '' }}</textarea>
                        </div>

                     </div>
                     <!-- /.card-body -->
                     <div class="card-footer">
                        <input type="submit" class="btn btn-primary  btn-sm float-left" value="Submit">
                     </div>
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
<script src="https://cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script type="text/javascript">
   if ($('.editor').length > 0) {
      $('.editor').each(function(e) {
         CKEDITOR.replace(this.id, {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            filebrowserBrowseUrl: "{{ route('getUploadedFiles') }}",
         });
      });
   }
</script>
@endsection