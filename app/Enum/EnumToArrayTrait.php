<?php

namespace App\Enum;

trait EnumToArrayTrait
{
    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = ucfirst(strtolower($case->name));
        }
        return $array;
    }
}
