<?php

namespace app\components\helpers;

class HelperArray
{
    public static function first($array)
    {
        return array_shift($array);
    }

    public static function last($array)
    {
        return reset($array);
    }
}