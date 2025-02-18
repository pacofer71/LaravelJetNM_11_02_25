<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FormUpdateCourse extends Form
{
    public string $fecha_fin="";
    public string $fecha_inicio="";
    public string $nombre="";
    public ?Course $course=null;
    public bool $fechaInicioDisable=false, $fechaFinDisable=false; 
     
    
    #[Rule(['required', 'string', 'min:10', 'max:500'])]
    public string $descripcion="";
    
    #[Rule(['nullable', 'image', 'max:2048'])]
    public $imagen;

  
    
    
    
    #[Rule(['required', 'exists:types,id'])]
    public int $type_id=0;
    
    #[Rule(['required', 'array', 'exists:tags,id'])]
    public array $tags=[];
    
    #[Rule(['required', 'numeric', 'min:10', 'max:9999.99'])]
    public float $precio=0.0;

    public function setCourse(Course $course){
        $this->course=$course;

        $this->nombre=$course->nombre;
        $this->descripcion=$course->descripcion;
        $this->type_id=$course->type_id;
        $this->fecha_inicio=$course->fecha_inicio->format('Y-m-d');
        $this->fecha_fin=$course->fecha_fin->format('Y-m-d');
        $this->precio=$course->precio;
        $this->tags=$course->getArrayIdCourseTags();
        $this->fechaInicioDisable=($course->fecha_inicio < now()->toDateString());
        $this->fechaFinDisable=($course->fecha_fin < now()->toDateString());
    }

    public function rules(): array{
        $validacion=($this->course->fecha_inicio>now()->toDateString()) 
        ? ['required', 'date', 'after_or_equal:today']: 
        ['required', 'date'];
        return [
            'nombre'=>['required', 'string', 'min:3', 'max:100', 'unique:courses,nombre,'.$this->course->id],
            'fecha_fin'=>['required', 'date', 'after_or_equal:'.$this->fecha_inicio],
            'fecha_inicio'=>$validacion,
        ];
    }

    public function formUpdateCourse(){
        $this->validate();
        $imagenVieja=$this->course->imagen;
        $datos=[
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
           // 'fecha_inicio'=>$this->fecha_inicio,
           // 'fecha_fin'=>$this->fecha_fin,
            'precio'=>$this->precio,
            'type_id'=>$this->type_id,
            'imagen'=>$this->imagen?->store('images/courses') ?? $imagenVieja,
        ];
        if(!$this->fechaInicioDisable) $datos['fecha_inicio']=$this->fecha_inicio;
        if(!$this->fechaFinDisable) $datos['fecha_fin']=$this->fecha_fin;
        //dd($datos);
        $this->course->update($datos);
        $this->course->tags()->sync($this->tags);
        
        if($this->imagen && basename($imagenVieja)!='default.png'){
            Storage::delete($imagenVieja);
        }
    }

    public function formReset(){
        $this->reset();
        $this->resetValidation();
    }
}
