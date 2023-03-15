<?php

namespace Utils\Str;


class Str
{
    public static function random($length): string
    {
        return  substr(bin2hex(random_bytes(32)), 0, $length);
    }
}
