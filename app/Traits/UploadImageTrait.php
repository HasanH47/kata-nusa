<?php

namespace App\Traits;

use App\Jobs\ProcessUploadImage;

trait UploadImageTrait
{
  public function uploadImage($path, $image, $slug, $uuid, $oldImage = null)
  {
    $pathFile = 'features/' . $path;

    $temporaryPath = $image->store('temp');

    $filename = $slug . '-' . $uuid . '.' . $image->getClientOriginalExtension();

    ProcessUploadImage::dispatch($temporaryPath, $pathFile, $filename, $oldImage);

    return $filename;
  }
}
