<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCrearType;
use Livewire\Component;

class CrearType extends Component
{
    public bool $openCrear=false;
    public FormCrearType $cform;

    public function render()
    {
        return view('livewire.crear-type');
    }

    public function insertar(){
        $this->cform->formStoreType();
        $this->salir();
        $this->dispatch('tipoCreado')->to(ShowTypes::class);
        $this->dispatch('mensaje', 'Tipo Creado');
    }

    public function salir(){
        $this->cform->formReset();
        $this->openCrear=false;
    }



}
