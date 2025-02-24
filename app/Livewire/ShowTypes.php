<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateType;
use App\Models\Type;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowTypes extends Component
{
    public bool $openEditar=false;
    public FormUpdateType $uform;

    #[On('tipoCreado')]
    public function render()
    {
        $types=Type::orderBy('nombre')->get();
        return view('livewire.show-types', compact('types'));
    }

    public function confirmarBorrado(int $id){
        $type=Type::findOrFail($id);
        $this->dispatch('onBorrarType', $id);
    }
    #[On('borrarOk')]
    public function delete(int $id){
        $type=Type::findOrFail($id);
        $type->delete();
        $this->dispatch('mesaje', 'Tipo Eliminado');
    }
    //--------------------- Metodos para editar
    public function edit(int $id){
        $type=Type::findOrFail($id);
        $this->uform->setType($type);
        $this->openEditar=true; 
    }
    public function update(){
        $this->uform->formUpdate();
        $this->salir();

    }
    public function salir(){
        $this->uform->formReset();
        $this->openEditar=false;
    }
}
