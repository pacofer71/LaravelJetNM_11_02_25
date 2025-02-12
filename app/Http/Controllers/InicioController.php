<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){
        $cursos=Course::with('type', 'tags', 'user')->where('fecha_inicio', '>', 'curdate')
        ->orderBy('fecha_inicio')
        ->paginate(5);
        return view('welcome', compact('cursos'));
    }
}
