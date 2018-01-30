<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 14:35
 */

namespace AppBundle\Util;


class StringHumanizer
{
    public static function deHumanize($string, $separator = '_', $capitalizeFirstCharacter = false)
    {
        $str = str_replace(' ', '', ucwords(str_replace($separator, ' ', $string)));
        if (!$capitalizeFirstCharacter) {
            $str[0] = lcfirst($str[0]);
        }

        return $str;
    }

    public static function humanize($string, $separator = '_')
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', sprintf('$1%s', $separator), $string));
    }
}
