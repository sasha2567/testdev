<?php

namespace app\components\helpers;


class HelperFormat
{
    /**
     * Get right format for date
     * @param $data
     * @return bool|int|string
     */
    public static function getDateOnFormat($data)
    {
        $dataStr = strtotime($data);
        $dataStr = date('M j, Y', $dataStr);
        return $dataStr;
    }
}