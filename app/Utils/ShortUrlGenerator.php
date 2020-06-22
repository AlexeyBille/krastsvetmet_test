<?php


namespace App\Utils;


use App\Models\Link;
use Illuminate\Support\Str;

class ShortUrlGenerator
{
    public function generate($length = 12)
    {
        do {
            $uri = Str::random($length);
        } while (Link::query()->where('uri', $uri)->first());

        return $uri;
    }

}
