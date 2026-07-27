<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\UploadedFile;

trait HandlesImageUploads
{
    protected function storeUploadedImage(UploadedFile $file, string $folder): string
    {
        return $file->store('uploads/'.$folder, 'public');
    }
}
