@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content pt-4">
      <div class="container-fluid">
         <form action="{{ route('admin.setting.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row">
               <div class="col-md-12">
                  <!-- SELECT2 EXAMPLE -->
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Settings</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">

                        <div class="form-group">
                           <label for="email">Email<span style="color: lightslategray">(Note:Incase of multiple emails, seperate with comma"," )</span></label>
                           <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ? old('email') : $setting->email }}">

                           @error('email')
                           <span class="text-danger">
                              {{ $errors->first('email') }}
                           </span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label for="phone_number">Phone Number<span style="color: lightslategray">(Note:Incase of multiple phone numbers, seperate with comma"," )</span></label>
                           <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') ? old('phone_number') :  $setting->phone_number }}">
                           @error('phone_number')
                           <span class="text-danger">
                              {{ $errors->first('phone_number') }}
                           </span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label for="mobile_number">Mobile Number<span style="color: lightslategray">(Note:Incase of multiple mobile numbers, seperate with comma"," )</span></label>
                           <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') ? old('mobile_number') : $setting->mobile_number }}">
                           @error('mobile_number')
                           <span class="text-danger">
                              {{ $errors->first('mobile_number') }}
                           </span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label for="address">Address</label>
                           <input type="text" class="form-control" id="address" name="address" value="{{ old('address') ? old('address') : $setting->address }}">

                           @error('address')
                           <span class="text-danger">
                              {{ $errors->first('address') }}
                           </span>
                           @enderror
                        </div>


                        <div class="form-group">
                           <label for="facebook_link">Facebook Link</label>
                           <input type="text" class="form-control" id="facebook_link" name="facebook_link" value="{{ old('facebook_link') ? old('facebook_link') : $setting->facebook_link }}">

                           @error('facebook_link')
                           <span class="text-danger">
                              {{ $errors->first('facebook_link') }}
                           </span>
                           @enderror

                        </div>

                        <div class="form-group">
                           <label for="instagram_link">Instagram Link</label>
                           <input type="text" class="form-control" id="instagram_link" name="instagram_link" value="{{ old('instagram_link') ? old('instagram_link') : $setting->instagram_link }}">

                           @error('instagram_link')
                           <span class="text-danger">
                              {{ $errors->first('instagram_link') }}
                           </span>
                           @enderror

                        </div>
                        <div class="form-group">
                           <label for="Youtube_link">Youtube Link</label>
                           <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="{{ old('youtube_link') ? old('youtube_link') : $setting->youtube_link }}">

                           @error('youtube_link')
                           <span class="text-danger">
                              {{ $errors->first('youtube_link') }}
                           </span>
                           @enderror

                        </div>
                        <div class="form-group">
                           <label for="tiktok_link">Tiktok Link</label>
                           <input type="text" class="form-control" id="tiktok_link" name="tiktok_link" value="{{ old('tiktok_link') ? old('tiktok_link') : $setting->tiktok_link }}">

                           @error('tiktok_link')
                           <span class="text-danger">
                              {{ $errors->first('tiktok_link') }}
                           </span>
                           @enderror
                        </div>


                        <div class="form-group">
                           <label for="google_map">Google Map</label>
                           <textarea name="google_map" id="google_map" class="form-control">{{ old('google_map') ? old('google_map') : $setting->google_map }}</textarea>

                           @error('google_map')
                           <span class="text-danger">
                              {{ $errors->first('google_map') }}
                           </span>
                           @enderror

                        </div>
                        <div class="form-group col-md-9">
                           <label for="metatitle">Meta Tittle</label>
                           <input type="text" placeholder="" id="metatitle" class="form-control" name="metatitle" value="{{isset($setting->metatitle) ? $setting->metatitle : ''}}">
                        </div>
                        <div class="form-group col-md-9">
                           <label for="metatkeyword">Meta Keyword</label>
                           <input type="text" placeholder="" id="metatkeyword" class="form-control" name="metakeyword" value="{{isset($setting->metakeyword) ? $setting->metakeyword : ''}}">
                        </div>
                        <div class="form-group col-md-9">
                           <label for="metadescription">Meta Description</label>
                           <textarea id="metadescription" class="form-control" name="metadescription">{{isset($setting->metadescription) ? $setting->metadescription : ''}}</textarea>
                        </div>
                        <div class="form-group col-md-9">
                           <label for="schema">Schema</label>
                           <textarea id="schema" class="form-control" name="schema">{{isset($setting->schema) ? $setting->schema : ''}}</textarea>
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