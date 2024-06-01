<?php

namespace App\Models;

use App\Enum\FileStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'size', 'extension','status', 'path'];
    protected $casts = [
        'status' => FileStatusEnum::class,
    ];
    public function action(){
        $action=['action'=>strtolower(FileStatusEnum::ENCRYPT->name),'class'=>'btn btn-danger'];
        if ($this->status==FileStatusEnum::ENCRYPT){
            $action=['action'=>strtolower(FileStatusEnum::DECRYPT->name),'class'=>'btn btn-success'];
        }
        return $action;
    }
}
