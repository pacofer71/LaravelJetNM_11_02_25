<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use App\Models\Tag;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ShowUserCourses extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $campo="id", $orden="asc";
    public string $texto="";

    public bool $openDetalle=false;
    public ?Course $course=null;

    public bool $openUpdate=false;
    public FormUpdateCourse $uform;

    #[On('cursoCreado')]
    public function render()
    {
        $cursos=DB::table('courses')
        ->join('types', 'type_id', '=', 'types.id')
        ->select('courses.*', 'types.nombre as tipo', 'color', DB::raw('datediff(fecha_fin, fecha_inicio) as duracion'))
        ->where('user_id', Auth::user()->id)
        ->where(function($q){
            $q->where('courses.nombre', 'like', '%'.$this->texto.'%')
            ->orWhere('types.nombre', 'like', "%{$this->texto}%")
            ->orWhere('descripcion', 'like', "%{$this->texto}%");
        })
        ->orderBy($this->campo, $this->orden)
        ->paginate(5);

        $types=Type::select('id', 'nombre')->orderBy('nombre')->get();
        $tags=Tag::select('id', 'nombre')->orderBy('nombre')->get();

        return view('livewire.show-user-courses', compact('cursos', 'types', 'tags'));
    }
    public function ordenar(string $campo){
        $this->orden=($this->orden=='asc') ? 'desc' : 'asc';
        $this->campo=$campo;
    }

    //Para que el buscador funcione en todas las paginas
    public function updatingTexto(){
        $this->resetPage();
    }

    //Metodos para detalle curso
    public function detalleCurso(int $id){
        $this->course=Course::findOrFail($id);
        $this->openDetalle=true;
    }
    public function cerrarDetalle(){
        $this->reset('openDetalle', 'course');
    }
    // Metodos para borrar un curso --------------------------------------------------------
    public function confirmarBorrado(int $id){
        $course=Course::findOrfail($id);
        $this->authorize('delete', $course);
        $this->dispatch('onConfirmarBorrado', $id);
    }
    #[On('borrarOk')]
    public function delete(int $id){
        $course=Course::findOrfail($id);
        $this->authorize('delete', $course);

        if(basename($course->imagen)!='default.png'){
            Storage::delete($course->imagen);
        }
        $course->delete();
        $this->dispatch('mensaje', 'Curso Borrado.');
    }
    //Métodos para actualizar curso -------------------------------------------------
    public function edit(int $id){
        $course=Course::findOrfail($id);
        $this->authorize('update', $course);
        
        $this->uform->setCourse($course);
        $this->openUpdate=true;

    }
    public function update(){
        $this->uform->formUpdateCourse();
        $this->cancelar();
        $this->dispatch('mensaje', 'Se actualizó el Curso');
    }
    public function cancelar(){
        $this->uform->formReset();
        $this->openUpdate=false;
    }
}
