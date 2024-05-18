<?php

namespace App\Http\Controllers\Dashboard;

trait UploadImage
{
    protected function uploadImage($imageRequest)
    {
        if (!$imageRequest) {
            return null;
        }

        return $imageRequest->store('images', [
            'disk' => 'public'
        ]);
    }
}
