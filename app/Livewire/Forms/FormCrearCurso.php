<?php

namespace App\Livewire\Forms;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCrearCurso extends Form
{
    public string $fecha_fin="";

    #[Rule(['required', 'string', 'min:3', 'max:100', 'unique:courses,nombre'])]
    public string $nombre="";
    
    #[Rule(['required', 'string', 'min:10', 'max:500'])]
    public string $descripcion="";
    
    #[Rule(['nullable', 'image', 'max:2048'])]
    public $imagen;

    #[Rule(['required', 'date', 'after_or_equal:today'])]
    public string $fecha_inicio="";
    
    
    #[Rule(['required', 'exists:types,id'])]
    public int $type_id=0;
    
    #[Rule(['required', 'array', 'exists:tags,id'])]
    public array $tags=[];
    
    #[Rule(['required', 'numeric', 'min:10', 'max:9999.99'])]
    public float $precio=0.0;

    public function rules(): array{
        return [
            'fecha_fin'=>['required', 'date', 'after_or_equal:'.$this->fecha_inicio]
        ];
    }

    public function formStoreCourse(){
        $this->validate();
        
        $course=Course::create([
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'fecha_inicio'=>$this->fecha_inicio,
            'fecha_fin'=>$this->fecha_fin,
            'precio'=>$this->precio,
            'type_id'=>$this->type_id,
            'imagen'=>$this->imagen?->store('images/courses') ?? 'images/default.png',
            'user_id'=>Auth::id()
        ]);
        $course->tags()->attach($this->tags);
    }

    public function formReset(){
        $this->reset();
        $this->resetValidation();
    }

}
