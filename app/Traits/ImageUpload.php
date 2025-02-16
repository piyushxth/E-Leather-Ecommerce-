<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

trait ImageUpload
{
  /**
   * method to upload image.
   * @param request.
   * @return filename.
   */
  public function image_upload(Request $request, $image_name = 'image')
  {
    $img_tmp = $request->file($image_name);
    $orgName = $img_tmp->getClientOriginalName();
    // $extension = $img_tmp->getClientOriginalExtension();
    $filename = rand(111, 99999) . '-' . $orgName;
    $img_tmp->move(public_path() . '/images/', $filename);

    return $filename;
  }


  /**
   * method to update image.
   * @param request.
   * @param old file name to delete.
   * @param new file name.
   * @return  name of saved file.
   */
  public function update_image(Request $request, $old_file, $image_name = 'image')
  {
    File::delete('images/' . $old_file);
    $img_tmp = $request->file($image_name);
    $orgName = $img_tmp->getClientOriginalName();
    $filename = rand(111, 99999) . '-' . $orgName;
    $img_tmp->move(public_path() . '/images/', $filename);

    return $filename;
  }
}
