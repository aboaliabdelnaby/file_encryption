<?php

namespace App\MyPackages\Livewire\Components\Traits;

use App\MyPackages\Livewire\Validation\Validation;

trait EditHelper
{
    public int $rowId;
    protected Validation $updateValidation;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

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
        return $this->updateValidation::rules();
    }
}
