@extends('backend.layouts.master')
@section('content')
<div class="content-wrapper">
   <section class="content pt-4">
      <div class="container-fluid">
         <form action="{{ route('admin.product_attribute.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
               <div class="col-md-9">
                  <!-- SELECT2 EXAMPLE -->
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Create Product Attribute</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <input type="hidden" value="{{ $product->id }}" name="product_id" />
                              <div class="form-group col-md-9">
                                 <label>Product Name:</label>
                                 <input type="text" class="form-control" disabled name="product_name"
                                    id="product_name" placeholder="Enter Product Name"
                                    value="{{ $product->product_name }}" required>
                              </div>
                              <div class="form-group col-md-9 d-none">
                                 <label>Available Color:</label>
                                 <input type="color"
                                    class="form-control {{ $errors->has('color_code') ? 'is-invalid' : '' }}"
                                    name="color_code" id="color_code" value="{{ old('color_code') }}"
                                    placeholder="Available Color" required>
                                 @error('color_code')
                                 <span class="text-danger">
                                 {{ $errors->first('color_code') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group col-md-9 d-none">
                                 <label>Color Name:</label>
                                 <input type="text"
                                    class="form-control {{ $errors->has('color_name') ? 'is-invalid' : '' }}"
                                    name="color_name" id="color_name" value="{{ old('color_name') ? old('color_name') : 'Black' }}"
                                    placeholder="Enter Color Name" required readonly="readonly" />
                                 @error('color_name')
                                 <span class="text-danger">
                                 {{ $errors->first('color_name') }}
                                 </span>
                                 @enderror
                              </div>
                              <div class="form-group col-md-9">
                                 <label for="product_image">Images</label>
                                 <span class="text-muted">
                                 You can select multiple image at once by pressing Ctrl and selecting images.
                                 </span>
                                 <div class="col-md-12">
                                    <div class="row" id="image_preview">
                                    </div>
                                 </div>
                                 <input type="file" id="product_image" name="product_image[]" accept="image/*" class="form-control" onchange="preview_image();" multiple>
                                 @if($errors->has('product_image.*'))
                                 <span class="text-danger">
                                  {{ $errors->first('product_image.*') }}
                                 </span>
                                 @endif
                              </div>
                           </div>
                        </div>
                        <!-- /.row -->
                     </div>
                     <!-- /.card-body -->
                  </div>
                  <div class="card card-default">
                     <div class="card-header">
                        <h3 class="card-title">Size</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="row">
                           <div class="field_wrapper">
                              <div style="display: flex">
                                 <input type="text" name="size[]" id="size" placeholder="SIZE"
                                    class="form-control" style="width:150px;margin-right:10px" autocomplete="off" />
                                    @error('size.*')
                                      <span class="text-danger">
                                          {{ $errors->first('size.*') }}
                                      </span>
                                    @enderror
                                 <input type="number" name="price[]"
                                    value="0"
                                    id="price" placeholder="PRICE" class="form-control d-none"
                                    style="width:150px;margin-right:10px" autocomplete="off" />
                                   @error('price.*')
                                      <span class="text-danger">
                                          {{ $errors->first('price.*') }}
                                      </span>
                                    @enderror
                                 <input type="number" name="stock[]" id="stock" placeholder="STOCK"
                                    class="form-control" style="width:150px;margin-right:10px" autocomplete="off" />
                                    @error('stock.*')
                                      <span class="text-danger">
                                          {{ $errors->first('stock.*') }}
                                      </span>
                                    @enderror
                                 <a href="javaascript:void(0);" class="add_button" title="Add Field"
                                    style="font-size: 25px"><i class="fa fa-plus"></i></a>
                              </div>
                           </div>
                        </div>
                        <!-- /.row -->

                        <div class="form-group d-none">
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="statusSwitch"
                              name="status" value="1" checked="{{ old('status') ? 'checked' : '' }}" readonly="readonly">
                              <label class="custom-control-label" for="statusSwitch"> Active
                              Status</label>
                           </div>
                        </div>
                        <div class="form-group">
                          <input type="submit" class="btn btn-primary  btn-sm float-right" value="Submit">
                        </div>

                     </div>
                     <!-- /.card-body -->
                  </div>
               </div>
               
            </div>
         </form>
      </div>
   </section>
</div>
@endsection
@section('script')
<script type="text/javascript">
   $(document).ready(function() {
      $('#color_code').change(function(e){
        e.preventDefault();
        var color_code = $(this).val();
        var n_match  = ntc.name(color_code);
        $('#color_name').val(n_match[1]);
      });

       var maxField = 8; //Input fields increment limitation
       var addButton = $('.add_button'); //Add button selector
       var wrapper = $('.field_wrapper'); //Input field wrapper
       var text = 0;
   
       var fieldHTML =
           '<div style="display:flex"><input type="text" name="size[]" id="size" placeholder="SIZE" class="form-control d-none" style="width:150px;margin-right:10px;margin-top:10px" autocomplete="off" /><input type="number" name="price[]" id="price" placeholder="PRICE" value="' +text +'" class="form-control" style="width:150px;margin-right:10px;margin-top:10px" autocomplete="off" /> <input type="number" name="stock[]" id="stock" placeholder="STOCK" class="form-control" style="width:150px;margin-right:10px;margin-top:10px" autocomplete="off" />  &nbsp <a href="javascript:void(0);" class="remove_button pt-2" style="font-size:25px"><i class="fa fa-trash"></i></a></div>'; //New input field html 

       var x = 1; //Initial field counter is 1
       //Once add button is clicked
       $(addButton).click(function() {
           if (x < maxField) {
               x++; //Increment field counter
               $(wrapper).append(fieldHTML); //Add field html
           }
       });
       //Once remove button is clicked
       $(wrapper).on('click', '.remove_button', function(e) {
           e.preventDefault();
           $(this).parent('div').remove(); //Remove field html
           x--; //Decrement field counter
       });
   });
   
   function preview_image() {
       var total_file = document.getElementById("product_image").files.length;
       var arrayExtensions = ["jpg","jpeg","png"];
       for (var i = 0; i < total_file; i++) {
          var ext = event.target.files[i].name.split(".").pop().toLowerCase();
          if (arrayExtensions.lastIndexOf(ext) == -1) {
            toastr.error("Please upload image with extension jpg,jpeg,png", 'OOps!', {closeButton :true, positionClass:"toast-top-right",timeOut: 10000 ,progressBar:true} )
          } else {
            $('#image_preview').append("<div class='col-md-3 card p-4 mr-4' id=\"image_preview_card_" + i + "\"><img src='" + URL.createObjectURL(event.target.files[i]) + "' style='width200px;height:auto;'><a href=\"javascript:void(0)\" class=\"mt-1 btn btn-danger remove_image remove"+i+"\" id=\"" + i + "\" data-imagename=\"" + event.target.files[i].name + "\">Remove</a>" +"</span></div>");
          } 
       }
   }
   
   $(document).on('click', '.remove_image', function() {
       var imageTiles = $('.remove_image').length;
       console.log(imageTiles);
       if(imageTiles > 1){
         var fileInput = document.getElementById("product_image");
         var img_preview_id = $(this).attr('id');
         var img_name = $(this).attr('data-imagename');
         var confirm_response = confirm("Are you sure to delete this image?");
         if (confirm_response == true) {
            $("#image_preview_card_"+img_preview_id).remove();
             var fileListArr = [...fileInput.files]
            fileListArr.splice(img_preview_id, 1) // here u remove the file
            fileInput.addEventListener("change", updatedList(fileListArr));
         }
       } else {
        alert('At least one image is required');
        return false
       }
   });

    function updatedList(fileListArr){
      var fileInput = document.getElementById("product_image");
      fileInput.files = new FileListItems(fileListArr)
      console.log(fileInput.files);
    }

    function FileListItems (files) {
      var b = new ClipboardEvent("").clipboardData || new DataTransfer()
      for (var i = 0, len = files.length; i<len; i++) b.items.add(files[i])
      return b.files
    }
</script>
@endsection