<?php

namespace App\Support;

class StringUtil
{
    public static function ucFirstPhrase(string $string, string $separator = ' '): string
    {
        return collect(explode($separator, $string))->map(function ($value) {
            return ucfirst($value);
        })->implode($separator);
    }
}
