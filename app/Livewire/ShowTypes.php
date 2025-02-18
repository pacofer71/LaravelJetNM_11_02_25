<?php

namespace App\Livewire;

use App\Models\Type;
use Livewire\Component;

class ShowTypes extends Component
{
    public function render()
    {
        $types=Type::orderBy('nombre')->get();
        return view('livewire.show-types', compact('types'));
    }
}
