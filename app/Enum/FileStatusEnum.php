<?php

namespace App\Enum;

enum FileStatusEnum:string
{
    use EnumToArrayTrait;
    case ENCRYPT  = 'encrypted';
    case DECRYPT ='decrypted';
}
