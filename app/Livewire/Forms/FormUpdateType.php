<?php

namespace App\Livewire\Forms;

use App\Models\Type;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdateType extends Form
{
    public ?Type $type=null;
    public string $nombre="";
    
    #[Validate(['required', 'color_hex'])]
    public string $color="#121212";

    public function rules(): array{
        return[
            'nombre'=>['required', 'string', 'min:3', 'max:20', 'unique:types,nombre,'.$this->type->id],
        ];
    }

    public function setType(Type $type){
        $this->type=$type;
        $this->nombre=$type->nombre;
        $this->color=$type->color;
    }

    public function formUpdate(){
        $this->validate();
        $this->type->update($this->all());
    }
    public function formReset(){
        $this->reset();
        $this->resetValidation();
    }


}
