<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::orderBy('nombre')->get();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules());
        Tag::create($request->all());
        return redirect()->route('tags.index')->with('mensaje', 'Tag Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $tag=Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $tag=Tag::findOrFail($id);
        $request->validate($this->rules($tag->id));
        $tag->update($request->all());
        return redirect()->route('tags.index')->with('mensaje', 'Tag Editado');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $tag=Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('tags.index')->with('mensaje', 'Tag Borrado');
    }

    private function rules(?int $id=null):array{
        return [
            'nombre'=>['required', 'string', 'min:3', 'max:15', 'unique:tags,nombre,'.$id],
            'color'=>['required', 'color_hex'],
        ];
    }
}
