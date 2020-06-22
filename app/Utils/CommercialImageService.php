<?php


namespace App\Utils;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CommercialImageService
{
    public function getRandomCommercialImage()
    {
        $dirPath = config('statistic.commercial_images_dir');

        $files = Storage::disk('public')->allFiles($dirPath);

        return Arr::random($files);
    }

}
