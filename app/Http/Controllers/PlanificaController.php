<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planificamp;
use App\Models\Equipo;
use App\Models\EquipoConvenio;
use App\Models\Garantia;
use App\Models\Proveedor;
use App\Models\Convenio;


class PlanificaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year=date('Y');
        $equipos=Equipo::all();
        
        //$planificados=Planificamp::join('bajas','bajas.equipo',"=",'planificamps.equipo')->select('planificamps.id','planificamps.fechacorte','planificamps.fechaprogramacion','planificamps.tipomp','planificamps.equipo','planificamps.proveedor')->where('bajas.equipo','!=','planificamps.equipo')->get();
       
        return view('planifica.index')->with('year',$year)->with('equipos',$equipos);
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
        $yaprogramados="";
        $equiposdatos=explode(' ',$request->get('equiposdatos'));
        $mes=date("m", strtotime($request->get('fecha')));
        $year=date("Y", strtotime($request->get('fecha')));
        $duplicados="";
        //dd($equiposdatos);
        foreach($equiposdatos as $dato){
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
            }
            else{
                $fallo=$fallo." ".$dato." ";
            }
        }
        //dd($fallo.' 1 '.$duplicados.' 2 '.$paso);
            //si no nada cambio
        if($fallo==""&&$paso==""&&$duplicados=="")
         return redirect ('/planifica')->with('message', 'No se han realizado cambios')->with('status','alert alert-danger');
            // Si solo hay fallos
        if($fallo!=""&&$paso==""&&$duplicados=="")
            return redirect ('/planifica')->with('message', 'No se encontraron los Equipos: '.$fallo)->with('status','alert alert-danger');
            //si solo hay OK
        if($fallo==""&&$paso=!""&&$duplicados=="")
            return redirect ('/planifica')->with('message', 'Se Planificaron'.$paso.' Equipos: ')->with('status','alert alert-success'); 
            //si hay fallos y ok
        if($fallo!=""&&$paso!=""&&$duplicados=="")
            return redirect ('/planifica')->with('message', 'No se encontraron los Equipos: '.$fallo.'. Se Planificaron'.$paso.' Equipos: ')->with('status','alert alert-warning');
            //si hay solo duplicados
        if($fallo==""&&$paso==""&&$duplicados!="")
            return redirect ('/planifica')->with('message', 'los Equipos: '.$duplicados.'. Se encuentran ya Ingresados durante el mes '.$mes)->with('status','alert alert-warning');
        //Si hay duplicados y Fallos
        if($fallo!=""&&$paso==""&&$duplicados!="")
            return redirect ('/planifica')->with('message', 'No se encontraron los Equipos: '.$fallo.'. Los Equipos: '.$duplicados.' Ya se encuentran Ingresados durante el mes '.$mes)->with('status','alert alert-danger');
        //Si hay duplicados Ok y Fallos
        if($fallo!=""&&$paso!=""&&$duplicados!="")
            return redirect ('/planifica')->with('message', 'No se encontraron los Equipos: '.$fallo.'. los Equipos: '.$duplicados.' Ya se encuentran Ingresados durante el mes '.$mes.'. Se Planificaron'.$paso.' Equipos: ')->with('status','alert alert-warning');
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
        if(date('m',strtotime($planifica->fechacorte))==date('m',strtotime($programacion))){
            $planifica->fechaprogramacion=$programacion;
            $planifica->proveedor=$request->get('responsable');
            $planifica->save();
            return redirect('/planifica')->with('message', 'El Equipo '.$planifica->Equipo->inventario.' ha sido Programada para el dia: '.date('d-m-Y',strtotime($planifica->fechaprogramacion)))->with('status','alert alert-success');
        }
        else
            return redirect('/planifica')->with('message', 'El Equipo no ha sido Programado Por no encontrarse en mes programado')->with('status','alert alert-danger');
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
                    return redirect('/planifica')->with('message', 'El Equipo no ha sido Programado ')->with('status','alert alert-danger');
                
            }
            elseif (Equipo::where('serie',$dato)->count()==1) {
                $equipo=Equipo::where('serie',$dato)->first();
                if(Planificamp::where('equipo',$equipo->id)->where('fechacorte','like','%'.$mesprograma.'%')->count()==1)
                    $planifica=Planificamp::where('equipo',$equipo->id)->where('fechacorte','like','%'.$mesprograma.'%')->first();
                else 
                    return redirect('/planifica')->with('message', 'El Equipo no ha sido Programado')->with('status','alert alert-danger'); 
            }
            else{
                return redirect('/planifica')->with('message', 'El Equipo '.$dato.' no se encuentran')->with('status','alert alert-danger');
            }
            $planifica->fechaprogramacion=date('Y-m-d',strtotime($request->get("fecha")));
            $planifica->save();
        }
         return redirect('/planifica');    

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
