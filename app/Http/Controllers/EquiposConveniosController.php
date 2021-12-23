<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convenio;
use App\Models\EquipoConvenio;
use App\Models\Equipo;

class EquiposConveniosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
        $this->middleware('can:equipoconvenio.index')->only('index');
        $this->middleware('can:equipoconvenio.edit')->only('edit','update');
        $this->middleware('can:equipoconvenio.create')->only('create','store');
        $this->middleware('can:equipoconvenio.destroy')->only('destroy');
        $this->middleware('can:equipoconvenio.show')->only('show');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($convenio)
    {
        $convenios=Convenio::find($convenio);
        //dd($convenios);
        return view('equipoconvenio.create')->with('convenios',$convenios); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $convenio=Convenio::find($request->get('convenio'));
        if(Equipo::where('inventario',$request->get('equipo'))->count()==1){
            $equipo=Equipo::where('inventario',$request->get('equipo'))-> first();  
            if(EquipoConvenio::where('equipo',$equipo->id)->where('convenio',$convenio->id)->count()==0){   
                $equipoconvenio=new EquipoConvenio();
                $equipoconvenio->valor=$request->get('valor');
                $equipoconvenio->fechaincorporacion=$request->get('fechaincorporacion');
                $equipoconvenio->mp=$request->get('mp');
                $equipoconvenio->mc=$request->get('mc');
                $equipoconvenio->repuesto=$request->get('repuesto');
                $equipoconvenio->equipo=$equipo->id;
                $equipoconvenio->convenio=$request->get('convenio');
                $equipoconvenio->save();
            return redirect()->route('convenio.show',$equipoconvenio->convenio)->with('message', 'El Equipo '.$equipo->inventario.' se Ingreso Correctamente')->with('status','alert alert-success');
            }
            else{
                return redirect()->route('convenio.show',$convenio->id)->with('message', 'El Equipo '.$equipo->inventario.' ya se encontraba Ingresado')->with('status','alert alert-danger');
                
            }
        }
        else
            if(Equipo::where('serie',$request->get('equipo'))->count()==1){
                $equipo=Equipo::where('serie',$request->get('equipo'))-> first();
                if(EquipoConvenio::where('equipo',$equipo->id)->where('convenio',$convenio->id)->count()==0){    
                    $equipoconvenio=new EquipoConvenio();
                    $equipoconvenio->valor=$request->get('valor');
                    $equipoconvenio->fechaincorporacion=$request->get('fechaincorporacion');
                    $equipoconvenio->mp=$request->get('mp');
                    $equipoconvenio->mc=$request->get('mc');
                    $equipoconvenio->repuesto=$request->get('repuesto');
                    $equipoconvenio->equipo=$equipo->id;
                    $equipoconvenio->convenio=$request->get('convenio');
                    $equipoconvenio->save();
                    return redirect()->route('convenio.show',$equipoconvenio->convenio)->with('message', 'El Equipo '.$equipo->serie.' se Ingreso Correctamente')->with('status','alert alert-success');    
                    }
                    else{
                        return redirect()->route('convenio.show',$convenio->id)->with('message', 'El Equipo '.$equipo->serie.' ya se encontraba Ingresado')->with('status','alert alert-danger');   
                    }
            } 
                else{
            return redirect('/convenio/'.$convenio->id)->with('message', 'El Equipo  NO a sido Ingresado, por no estar Creado')->with('status','alert alert-danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipoconvenio=EquipoConvenio::find($id);
        $convenios=Convenio::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('equipoconvenio.edit')->with('equipoconvenio',$equipoconvenio)->with('convenios',$convenios);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        //dd($equipo->id);  
        $equipoconvenio= EquipoConvenio::find($id);
        $equipo=Equipo::find($equipoconvenio->equipo);
        $equipoconvenio->valor=$request->get('valor');
        $equipoconvenio->fechaincorporacion=$request->get('fechaincorporacion');
        $equipoconvenio->mp=$request->get('mp');
        $equipoconvenio->mc=$request->get('mc');
        $equipoconvenio->repuesto=$request->get('repuesto');
        $equipoconvenio->equipo=$equipo->id;
        $equipoconvenio->convenio=$request->get('convenio');
        $equipoconvenio->save();
        return redirect()->route('convenio.show',$equipoconvenio->convenio);
       
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipoconvenio=EquipoConvenio::find($id);
        $convenio=Convenio::find($equipoconvenio->convenio);
        $equipoconvenio->delete();
        return redirect('/convenio');
    }
}
