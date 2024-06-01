<?php

namespace App\Services\FileEncryptionService;

use App\Enum\FileStatusEnum;
use Illuminate\Support\Facades\Storage;

class FileService implements FileServiceInterface
{
    public function do_operation(FileStatusEnum $status, string $path): void
    {
        $status == FileStatusEnum::ENCRYPT ? $this->encrypt($path) : $this->decrypt($path);
    }
    public function get_size(string $path): string
    {
        return Storage::size($path);
    }

    private function encrypt(string $path): void
    {
        $path="public/".$path;
        $fileContent = Storage::get($path);
        $encryptedContent = encrypt($fileContent);
        Storage::put($path, $encryptedContent);
    }

    private function decrypt(string $path): void
    {
        $path="public/".$path;
        $decryptedContent = decrypt(Storage::get($path));
        Storage::put($path, $decryptedContent);
    }
}
