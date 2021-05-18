<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ImageProcessor
{
    /**
     * Get the thumbnail of the image
     * 
     * @param Illuminate\Http\Request $request
     * @param string $userTypeInitial
     * @return Illuminate\Http\Request $photo['up_photo','up_filename']
     */
    public static function getImageThumbnail(Request $request, $imageKey, $userTypeInitial)
    {
        $photo = new Request();
        $imgFile = $request->file($imageKey);
        $imgExt = $imgFile->getClientOriginalExtension();
        $up_filename = $userTypeInitial.'_'.$request->u_username.'_ProfilePhoto.'.$imgExt;
        $up_photo = Image::make($imgFile->getRealPath())->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        });
        Response::make($up_photo->encode($imgExt));

        $photo->merge([
            'up_photo' => $up_photo,
            'up_filename' => $up_filename,
        ]);

        return $photo;
    }
}
