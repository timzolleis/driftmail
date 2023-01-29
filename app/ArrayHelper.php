<?php

namespace App;

use Illuminate\Support\Str;

class ArrayHelper
{
    public static function convertKeysToSnakeCase(array $array): array
    {

        $result = [];
        foreach ($array as $key => $value) {
            $result[Str::snake($key)] = $value;

        }
        return $result;
    }

    public static function getValueWithDotAnnotation(array &$array, string $path): string | null
    {
        $keys = explode('.', $path);
        foreach ($keys as $key) {
            $array = &$array[$key];
        }
        return $array;
    }

}
