<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCrearCurso;
use App\Models\Tag;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearCurso extends Component
{
    use WithFileUploads;
    public bool $openCrear=false;
    public FormCrearCurso $cform;

    public function render()
    {
        $tags=Tag::select('id', 'nombre')->orderBy('nombre')->get();
        $types=Type::select('id', 'nombre')->orderBy('nombre')->get();
        return view('livewire.crear-curso', compact('tags', 'types'));
    }
    // Guardar curso
    public function store(){
        $this->cform->formStoreCourse();
        $this->dispatch('cursoCreado')->to(ShowUserCourses::class);
        $this->dispatch('mensaje', 'Curso Creado');
        $this->cancelar();
    }
    public function cancelar(){
        $this->openCrear=false;
        $this->cform->formReset();
    }
}
