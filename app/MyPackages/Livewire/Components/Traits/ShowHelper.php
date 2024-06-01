<?php

namespace App\MyPackages\Livewire\Components\Traits;

trait ShowHelper
{
    protected  $data;

    public function render()
    {
        return view('livewire.' . $this->view,['data'=>$this->data]);
    }
}
