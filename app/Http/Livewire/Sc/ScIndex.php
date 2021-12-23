<?php

namespace App\Http\Livewire\Sc;

use Livewire\Component;
use App\Models\solicitudCompra;
use Livewire\WithPagination;

class ScIndex extends Component
{
    
    // se inicializa para la creacion de paginacion 
    use WithPagination;
    public $search ;
    // para orden segun columna
    public $sort='id';
    // para orden segun desesdente o ascendente
    public $direction='desc';
    // son lo metodos que escuchan
    protected $listeners = ['render','delete'];
    //permite la apertura del modal edit
    public $openedit=false;
    // datos de la tabla
    public $solicitud;
    //select de cantidad de registros
    public $cant='10';
    //permite la carga de la pagina antes de la del contenido
    public $readyToLoad=false;

    public function render()
    {
        $scs="";
        if($this->readyToLoad==true){
            $scs=solicitudCompra::where('numero','LIKE','%'.$this->search.'%')
                                ->orderBy($this->sort,$this->direction)
                                ->paginate($this->cant);

        }

        return view('livewire.sc.sc-index',compact('scs'));
    }
    // validar 
    protected $queryString=[
        'cant'  =>['except'=>'10']
    ];
    //reglas de validacion
    protected $rules=[
        'solicitud.numero' => 'required|max:5',
        'solicitud.fecha'   =>'required'
    ];
   
    
    //da el orden 
    public function order($sort)
    {
        if($this->sort==$sort){
            if($this->direction=='desc')
                $this->direction='asc';
                else
                $this->direction='desc';
        }
        else{
            $this->sort=$sort;
            $this->direction='desc';
        }      
        
    }
    //permite montar la info en el edit
    public function mount(){
        $this->solicitud=new solicitudCompra;
    }
    //permite el modal edit
   public function edit(solicitudCompra $sc){
       $this->solicitud=$sc;
       $this->openedit=true;
   }
   //cambia la informacion que se pone en el modal edit
   public function update(solicitudCompra $sc){
    $this->validate();
    $this->solicitudCompra->save();
           
    $this->reset(['openedit']);
    $this->emit('alert','la sc ha sido Actualizada');
    }
    //borrar la paginacion si es menor a 10 registgros
    public function updatingSearch(){
        $this->resetPage();

    }
    //permite la carga de la pagina antes que el contenido
    public function loadMarca(){
        $this->readyToLoad  =   true;
    }
    //elimina el registro seleccionado desde js
    public function delete(solicitudCompra $sc)
    {
        $sc->delete();    
    }


}
