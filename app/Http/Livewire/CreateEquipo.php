<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateEquipo extends Component
{
    public $open=true;
    
    public function render()
    {
        return view('livewire.create-equipo')
        ->layout('layouts.app');
    }
}
