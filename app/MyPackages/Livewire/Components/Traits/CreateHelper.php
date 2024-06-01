<?php

namespace App\MyPackages\Livewire\Components\Traits;

use App\MyPackages\Livewire\Validation\Validation;

trait CreateHelper
{
    protected Validation $storeValidation;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.' . $this->view);
    }

    protected function rules(): array
    {
        return $this->storeValidation::rules();
    }

}
