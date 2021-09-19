<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait UploadTrait
{
    public function uploadOne($image, $folder = null, $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);
        $file = $image->storeOnCloudinaryAs($folder, $name)->getPath();
        return $file;
    }

    public function deleteOne($file)
    {
        return Storage::disk('s3')->delete($file);
    }
}
