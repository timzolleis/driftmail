<?php

namespace App;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PHPUnit\Exception;

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

    public static function getValueWithDotAnnotation(array &$array, string $path): mixed
    {
        try {
            $keys = explode('.', $path);
            foreach ($keys as $key) {
                $array = &$array[$key];
            }
            return $array;
        } catch (Exception $exception) {
            Log::debug($exception);
            return null;
        }

    }

}
