<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planificamp;
use App\Models\Equipo;
use App\Models\EquipoConvenio;
use App\Models\Garantia;
use App\Models\Proveedor;
use App\Models\Convenio;
use DateTime;


class PlanificaController extends Controller
{

      public function __construct()
    {
        $this->middleware('can:planifica.index')->only('index');
        $this->middleware('can:planifica.edit')->only('edit', 'update');
        $this->middleware('can:planifica.create')->only('create', 'store');
        $this->middleware('can:planifica.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year=date('Y');
        $equipos=Equipo::all();
       //$conmp=Planificamp::whereYear('fechacorte',$year)->where('tipomp','interna')->get();
        $paso=0;
        //$equi=$conmp->unique('equipo');
        //dd($equi);
        
        //$planificados=Planificamp::join('bajas','bajas.equipo',"=",'planificamps.equipo')->select('planificamps.id','planificamps.fechacorte','planificamps.fechaprogramacion','planificamps.tipomp','planificamps.equipo','planificamps.proveedor')->where('bajas.equipo','!=','planificamps.equipo')->get();
       
        return view('planifica.index')->with('year',$year)->with('equipos',$equipos)->with('paso',$paso);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responsable=Proveedor::orderBy('nombre','ASC')->get()->pluck('nombre','id');
        return view('planifica.create')->with('responsable',$responsable);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $equipo="";
        $planificado="";
        $fallo="";
        $paso=0;
        //dd($request);
        $identificador=$request->identificador;
        //dd($identificador);
        $yaprogramados="";
        $equiposdatos=explode(' ',$request->get('equiposdatos'));
        $mes=date("m", strtotime($request->get('fecha')));
        $year=date("Y", strtotime($request->get('fecha')));
        $duplicados="";
        $proveedor=explode(' - ', $request->get('responsable'))[0];
        //dd($equiposdatos);
        if($identificador=="inventario"){
            foreach($equiposdatos as $dato){
            if(Equipo::where('inventario',$dato)->count()==1){
                $equipo=Equipo::where('inventario',$dato)->first();
                if(Planificamp::where('equipo',$equipo->id)->whereMonth('fechacorte',$mes)->whereYear('fechacorte',$year)->count()==0){
                    $planificado=new Planificamp();
                    $planificado->equipo=$equipo->id;
                    $planificado->fechacorte=$request->get('fecha');
                    $planificado->tipomp=$request->get('tipo');
                    $planificado->proveedor=$proveedor;
                    $planificado->save();
                   $paso=$paso+1;
                }
                else{
                    $duplicados=$duplicados." ".$dato." ";
                }
            }
        }
    }
    if($identificador=="id"){
        foreach($equiposdatos as $dato){
        if(Equipo::where('id',$dato)->count()==1){
            $equipo=Equipo::find($dato);
            if(Planificamp::where('equipo',$equipo->id)->whereMonth('fechacorte',$mes)->whereYear('fechacorte',$year)->count()==0){
                if($request->get('tipo')=='Convenio')
                $planificado=new Planificamp();
                //dd($equipo);
                $planificado->equipo=$equipo->id;
                $planificado->fechacorte=$request->get('fecha');
                $planificado->tipomp=$request->get('tipo');
                $planificado->proveedor=$proveedor;
                
                $planificado->save();
                $paso=$paso+1;
                }
                else{
                    $duplicados=$duplicados." ".$dato." ";
                }
            }
        }
    }
    if($identificador=="serie"){
        foreach($equiposdatos as $dato){
            if(Equipo::where('serie',$dato)->count()==1){
                $equipo=Equipo::where('serie',$dato)->first();
                if(Planificamp::where('equipo',$equipo->id)->whereMonth('fechacorte',$mes)->whereYear('fechacorte',$year)->count()==0){
                    $planificado=new Planificamp();
                    //dd($equipo);
                    $planificado->equipo=$equipo->id;
                    $planificado->fechacorte=$request->get('fecha');
                    $planificado->tipomp=$request->get('tipo');
                    $planificado->proveedor=$proveedor;
                    $planificado->save();
                    $paso=$paso+1;
                }
                else{
                    $duplicados=$duplicados." ".$dato." ";
                }
            }    
        }
    }
        //dd('Fallo'.$fallo.' - Duplicados '.$duplicados.' -Paso '.$paso);
       //si solo hay OK
        if($fallo==""&&$paso=!""&&$duplicados=="")
            return redirect ('/planifica/')->with('paso',$paso)->with('message', 'Se Planificó '.$paso.' Equipos ')->with('status','alert alert-success'); 
            //si no nada cambio
        if($fallo==""&&$paso==""&&$duplicados=="")
         return redirect ('/planifica/')->with('paso',$paso)->with('message', 'No se han realizado cambios')->with('status','alert alert-danger');
            // Si solo hay fallos
        if($fallo!=""&&$paso==""&&$duplicados=="")
            return redirect ('/planifica/')->with('paso',$paso)->with('message', 'No se encontraron los Equipos: '.$fallo)->with('status','alert alert-danger');
            //si hay fallos y ok
        if($fallo!=""&&$paso!=""&&$duplicados=="")
            return redirect ('/planifica/')->with('paso',$paso)->with('message', 'No se encontraron los Equipos: '.$fallo.'. Se Planificaron'.$paso.' Equipos: ')->with('status','alert alert-warning');
            //si hay solo duplicados
        if($fallo==""&&$paso==""&&$duplicados!="")
            return redirect ('/planifica/')->with('paso',$paso)->with('message', 'los Equipos: '.$duplicados.'. Se encuentran ya Ingresados durante el mes '.$mes)->with('status','alert alert-warning');
        //Si hay duplicados y Fallos
        if($fallo!=""&&$paso==""&&$duplicados!="")
            return redirect ('/planifica/')->with('paso',$paso)->with('message', 'No se encontraron los Equipos: '.$fallo.'. Los Equipos: '.$duplicados.' Ya se encuentran Ingresados durante el mes '.$mes)->with('status','alert alert-danger');
        //Si hay duplicados Ok y Fallos
        if($fallo!=""&&$paso!=""&&$duplicados!="")
            return redirect ('/planifica/')->with('paso',$paso)->with('message', 'No se encontraron'.$fallo.' Equipos.  Ya se encuentran Ingresados durante el mes de '.$mes.' son: '.$duplicados.'. Se Planificaron'.$paso.' Equipos')->with('status','alert alert-warning');
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
       $planifica=Planificamp::find($id);
       $responsable=Proveedor::orderBy('nombre','ASC')->get()->pluck('nombre','id');
        return view('planifica.edit')->with('planifica',$planifica)->with('responsable',$responsable);
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
        $programacion=date('Y-m-d',strtotime($request->get('programacion')));
        $planifica=Planificamp::find($id);
        $equipo=$planifica->Equipo;
        //dd($request->get('fecha'));
       
        $eq = "";
        if ($equipo->eq == "Critico")
            $eq = "2.1";
        if ($equipo->eq == "Relevante")
            $eq = "2.2";
        if ($equipo->eq == "Sin")
            $eq = "Sin";
        if($request->file('documento')!=null){
            if($equipo->inventario!='?'){
                $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $eq . '/' . $equipo->Familia->nombre . '/' . $equipo->SubFamilia->nombre . '/' . $equipo->inventario . "/";
            }
            else{
                $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $eq . '/' . $equipo->Familia->nombre . '/' . $equipo->SubFamilia->nombre . '/' . $equipo->serie . "/";  
            }
        }
        if($planifica->fechacorte!=$request->get('fecha')){

            $planifica->fechacorte=$request->get('fecha');
            $planifica->save();
            return redirect('/planifica/listado/')->with('message', 'ha sido Editada el mes de planificacion')->with('status','alert alert-success');
        }
        if(date('m-Y',strtotime($planifica->fechacorte))==date('m-Y',strtotime($programacion))){
            $planifica->fechaprogramacion=$programacion;
            $planifica->proveedor=$request->get('responsable');    
            if (!file_exists($carpeta))
                mkdir($carpeta, 0777, true);
            if ($request->hasFile('documento')) {
                $fecha = new DateTime($programacion);
                if($equipo->inventario!='?')
                $nombre = $equipo->inventario . '_' . $fecha->format('Y') . '_' . $request->archivo . '_' . $fecha->format('m') . '_' . $fecha->format('d');
                else
                    $nombre = $equipo->serie . '_' . $fecha->format('Y') . '_' . $request->archivo . '_' . $fecha->format('m') . '_' . $fecha->format('d');
                //Captura de archivo view create
                $file = $request->file('documento');
                $nombre = $nombre . '.pdf';
                if ($file->guessExtension() == "pdf") {
                    $file->move($carpeta, $nombre);
                }
            }
            $planifica->save();

            return redirect('/planifica/listado/')->with('message', 'El Equipo '.$planifica->Equipo->inventario.' ha sido Programada para el dia: '.date('d-m-Y',strtotime($planifica->fechaprogramacion)))->with('status','alert alert-success');
        }
        else
             if($request->get('programacion')==null&&$planifica->proveedor!=$request->get('responsable')&&$planifica->tipomp==$request->get('tipo')){
                 $planifica->proveedor=$request->get('responsable');
                 $planifica->save();
                 return redirect('/planifica/listado/')->with('message', 'El responasable del Mantenimiento ha sido modificado')->with('status','alert alert-warning');
             }
             else
                 if($request->get('programacion')==null&&$planifica->proveedor!=$request->get('responsable')&&$planifica->tipomp!=$request->get('tipo')){
                 $planifica->proveedor=$request->get('responsable');
                 $planifica->tipomp=$request->get('tipo');
                 $planifica->save();
                 return redirect('/planifica/listado/')->with('message', 'Se actualizó el tipo  y el Responsable del Mantenimiento ')->with('status','alert alert-warning');
             }
                 else
                    if($request->get('programacion')==null&&$planifica->tipomp!=$request->get('tipo')&&$planifica->proveedor==$request->get('responsable')){
                     $planifica->tipomp=$request->get('tipo');
                     $planifica->save();
                     return redirect('/planifica/listado/')->with('message', 'Se actualizó el tipo  de Mantenimiento ')->with('status','alert alert-warning');
                    }
                    else
                        return redirect('/planifica/listado/')->with('message', 'El Equipo no ha sido Programado Por no encontrarse en mes programado')->with('status','alert alert-danger');
    
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function programa(){
        return view ('planifica.programa');
    }
    
    public function programacion(Request $request)
    {
        $equipo="";
        $planifica="";
        $mesprograma=date('Y-m',strtotime($request->get("fecha")));
        $equiposdatos=explode(' ',$request->get('equiposdatos'));
        foreach($equiposdatos as $dato){
            if(Equipo::where('inventario',$dato)->count()==1){
                $equipo=Equipo::where('inventario',$dato)->first();
                if(Planificamp::where('equipo',$equipo->id)->where('fechacorte','like','%'.$mesprograma.'%')->count()==1)
                    $planifica=Planificamp::where('equipo',$equipo->id)->where('fechacorte','like','%'.$mesprograma.'%')->first();
                else 
                    return redirect('/planifica/programa/')->with('message', 'El Equipo no ha sido Programado ')->with('status','alert alert-danger');
                
            }
            elseif (Equipo::where('serie',$dato)->count()==1) {
                $equipo=Equipo::where('serie',$dato)->first();
                if(Planificamp::where('equipo',$equipo->id)->where('fechacorte','like','%'.$mesprograma.'%')->count()==1)
                    $planifica=Planificamp::where('equipo',$equipo->id)->where('fechacorte','like','%'.$mesprograma.'%')->first();
                else 
                    return redirect('/planifica/programa/')->with('message', 'El Equipo no ha sido Programado')->with('status','alert alert-danger'); 
            }
            else{
                return redirect('/planifica/programa/')->with('message', 'El Equipo '.$dato.' no se encuentran')->with('status','alert alert-danger');
            }
            $planifica->fechaprogramacion=date('Y-m-d',strtotime($request->get("fecha")));
            $planifica->save();
        }
         return redirect('/planifica/programa/');    

    }
    public function listado()
     {
        $year=date('Y');
        $planificados=Planificamp::whereYear('fechacorte',$year)->get(); 
        
        
        //$planificados=Planificamp::join('bajas','bajas.equipo',"=",'planificamps.equipo')->select('planificamps.id','planificamps.fechacorte','planificamps.fechaprogramacion','planificamps.tipomp','planificamps.equipo','planificamps.proveedor')->where('bajas.equipo','!=','planificamps.equipo')->get();
       
        return view('planifica.listado')->with('planificados',$planificados)->with('year',$year);
    }
    public function minsal()
     {
        $year=date('Y');
        $equipos=Equipo::all();
        return view('planifica.minsal')->with('year',$year)->with('equipos',$equipos);
    }
}
/*foreach($equiposdatos as $dato){
            if(Equipo::where('inventario',$dato)->count()==1){
                $equipo=Equipo::where('inventario',$dato)->first();
                if(Planificamp::where('equipo',$equipo->id)->whereMonth('fechacorte',$mes)->whereYear('fechacorte',$year)->count()==0){
                    $planificado=new Planificamp();
                    $planificado->equipo=$equipo->id;
                    $planificado->fechacorte=$request->get('fecha');
                    $planificado->tipomp=$request->get('tipo');
                    $planificado->proveedor=$request->get('responsable');
                    $planificado->save();
                    $paso+=1;
                }
                else{
                    $duplicados=$duplicados." ".$dato." ";
                }

            }
            else
            if(Equipo::where('serie',$dato)->count()==1){
                $equipo=Equipo::where('serie',$dato)->first();
                if(Planificamp::where('equipo',$equipo->id)->whereMonth('fechacorte',$mes)->whereYear('fechacorte',$year)->count()==0){
                    $planificado=new Planificamp();
                    //dd($equipo);
                    $planificado->equipo=$equipo->id;
                    $planificado->fechacorte=$request->get('fecha');
                    $planificado->tipomp=$request->get('tipo');
                    $planificado->proveedor=$request->get('responsable');
                    $planificado->save();
                    $paso+=1;
                }
                else{
                    $duplicados=$duplicados." ".$dato." ";
                }
            }
            else
                 if(Equipo::where('id',$dato)->count()==1){
                $equipo=Equipo::find($dato);
                if(Planificamp::where('equipo',$equipo->id)->whereMonth('fechacorte',$mes)->whereYear('fechacorte',$year)->count()==0){
                    $planificado=new Planificamp();
                    //dd($equipo);
                    $planificado->equipo=$equipo->id;
                    $planificado->fechacorte=$request->get('fecha');
                    $planificado->tipomp=$request->get('tipo');
                    $planificado->proveedor=$request->get('responsable');
                    $planificado->save();
                    $paso+=1;
                }
                else{
                    $duplicados=$duplicados." ".$dato." ";
                }
            }*/