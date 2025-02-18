<?php

namespace App\Livewire\Forms;

use App\Models\Type;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCrearType extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:20', 'unique:types,nombre'])]
    public string $nombre="";

    #[Validate(['required', 'color_hex'])]
    public string $color="";

    public function formStoreType(){
        $this->validate();
        Type::create($this->all());
    }
    public function formReset(){
        $this->resetValidation();
        $this->reset();
    }

}
