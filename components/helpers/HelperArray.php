<?php

namespace app\components\helpers;

class HelperArray
{
    /**
     * Return first element in $array
     *
     * @param $array
     * @return mixed
     */
    public static function first($array)
    {
        return array_shift($array);
    }

    /**
     * Return last element in $array
     *
     * @param $array
     * @return mixed
     */
    public static function last($array)
    {
        return end($array);
    }
}