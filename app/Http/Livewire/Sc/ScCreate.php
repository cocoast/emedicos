<?php

namespace App\Http\Livewire\Sc;

use Livewire\Component;
use App\Models\Marca;

class ScCreate extends Component
{
    //permite el salto al modal del create
    public $open=false;
    //datos de la tabla
    public $marca;
    //validacion de los campos de la tabla
    protected $rules=[
        'marca' => 'required|max:50'
    ];
    //dibuja
    public function render()
    {
        return view('livewire.sc.sc-create');
    }
    //revisa si cumple las validacion los datos que se ingresaron
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    //guarda el registro
    public function save(){
        $this->validate();
        $marca = new Marca;
        $marca->marca=$this->marca;
        $marca->save();
        
        $this->reset(['open','marca']);
        $this->emitTo('marca.marca-index','render');
        $this->emit('alert','la Marca ha sido Creada');
    }
    //borra la info en caso de salir sin cancelar
    public function updatingOpen(){
        $this->reset(['marca']); 
    }

}
