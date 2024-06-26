<?php

namespace App\Services\FileEncryptionService;

use App\Enum\FileStatusEnum;

interface FileServiceInterface
{
    public function do_operation(FileStatusEnum $status, string $path): void;

}
