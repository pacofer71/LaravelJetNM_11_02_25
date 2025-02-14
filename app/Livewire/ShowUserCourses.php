<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;

class ShowUserCourses extends Component
{
    use WithPagination;

    public string $campo="id", $orden="asc";
    public string $texto="";

    public bool $openDetalle=false;
    public ?Course $course=null;

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
        return view('livewire.show-user-courses', compact('cursos'));
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
}
