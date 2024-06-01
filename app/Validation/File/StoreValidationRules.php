<?php
namespace App\Validation\File;

use App\Enum\FileStatusEnum;
use App\Enum\RoomType;
use App\MyPackages\Livewire\Validation\Validation;
use Illuminate\Validation\Rules\Enum;

class StoreValidationRules implements Validation
{
    public static function rules(): array
    {
        return [
            'name'=> ['required', 'string', 'max:255'],
            'location'=> ['required', 'string', 'max:255'],
            'file' => ['required', 'max:5000','file'],
            'status'=>  [new Enum(FileStatusEnum::class)],
        ];
    }

}
