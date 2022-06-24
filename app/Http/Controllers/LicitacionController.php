<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Licitacion;
use App\Models\ServicioClinico;
use Spatie\Permission\Models\Role;
use App\Models\CategoriaLicitacion;
use App\Models\EstadosLicitacion;
use App\Models\EstadoLicitacion;

class LicitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $licitaciones=Licitacion::all();
        $licitacion=Licitacion::find(18);
        //dd($licitacion->Estados->last()->nombre);
        //$estado=EstadoLicitacion::all();
        //dd($estado);
        //$licitaciones=Licitacion::where('licitador',$user->id)->get();
        //dd($licitaciones);
        return view('licitacion.index')->with('licitaciones',$licitaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   //acceso para la creacion de licitaciones inicio en MJ 
        //$licitadores =  User::with('roles')->get();
        $categorias=CategoriaLicitacion::all();
        $licitadores=User::whereHas("roles", function($q){ $q->where("name", "Licitador"); })->get();
        return view('licitacion.create')->with('licitadores',$licitadores)->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $year=date('Y');
        $hoy=date('d-m-Y');
        $estado=EstadosLicitacion::where('nombre','Asignada')->first();
        $licitacion=new Licitacion;
        $servicio=ServicioClinico::find(explode(' - ', $request->get('servicio')) [0]);
        $licitacion->licitador=$request->get('licitador');
        $licitacion->servicio=$servicio->id;
        $licitacion->presupuesto=$request->get('presupuesto');
        $licitacion->categoria=$request->get('categoria');
        $licitacion->solicitud_compra=$request->get('solicitud');
        $licitacion->fecha_solicitud_compra=$request->get('fecha');
        $licitacion->nombre=$licitacion->Servicio->nombre.' - '.$licitacion->solicitud_compra;
        $estadoactual= new EstadoLicitacion;

        if($request->hasFile('documento')){
            $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/storage/ModuloLicitacion/' . $year.'/'.$licitacion->solicitud_compra.' - '.$licitacion->Servicio->nombre.'/'; 
            $direccion='/storage/ModuloLicitacion/' . $year.'/'.$licitacion->solicitud_compra.' - '.$licitacion->Servicio->nombre.'/';
            if(!file_exists($carpeta)){
                mkdir($carpeta, 0777, true);
            }
            
            $file = $request->file('documento');
            $nombre = 'Solicitud de Compra N°'.$licitacion->solicitud_compra. '.pdf';
            if ($file->guessExtension() == "pdf") {
                //dd($licitacion);
                $file->move($carpeta, $nombre);
                $licitacion->file_solicitud_compra=$direccion.'/'.$nombre;
                $licitacion->save();
                $estadoactual->licitacion=$licitacion->id;
                $estadoactual->estado=$estado->id;
                $estadoactual->comentario="Asignada a ".$licitacion->Licitador->name." el ".$hoy ;
                //dd($estadoactual);
                $estadoactual->save();
                return redirect()->back()->with('message','Licitacion Generada')->with('status','alert alert-success');
                }
                else{
                    return redirect()->back()->with('message','Tipo de Archivo no Compativo Compruebe .pdf')->with('status','alert alert-danger');
                }
            }
            else
                return redirect()->back()->with('message','No se Adjunto ningún Documento')->with('status','alert alert-danger');
    }
     

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $licitacion=Licitacion::find($id);
        return view ('licitacion.show')->with('licitacion',$licitacion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $licitacion=Licitacion::find($id);
        $licitacion->delete();
        return redirect()->back()->with('message','Se ha eliminado la licitacion')->with('status','alert alert-danger');
    }
    public function Estados($id){
        $licitacion=Licitacion::find($id);
        $estados=EstadosLicitacion::where('nombre','!=','Asignada')->get();
        //dd($estados);
        //$licitacion->Estados->last()->nombre 
        return view('licitacion.estado')->with('licitacion',$licitacion)->with('estados',$estados);

    }
    public function ChangeEstado($id,Request $request){
        $estado=EstadosLicitacion::find($request->get('estado'));
        $licitacion=Licitacion::find($id);
        $estadoactual= new EstadoLicitacion;
        if($estado->nombre!="Publicada"){
            $estadoactual->licitacion=$licitacion->id;
            $estadoactual->estado=$estado->id;
            $estadoactual->comentario=$request->get('comentario');
            $estadoactual->save();
            return redirect()->back()->with('message','Estado actualizado')->with('status','alert alert-success');
        }
        else{
            $licitacion->id_mercadopublico=$request->get('idmp');
            $licitacion->url_mercadopublico=$request->get('linkmp');
            $licitacion->save();
            $estadoactual->licitacion=$licitacion->id;
            $estadoactual->estado=$estado->id;
            $estadoactual->comentario=$request->get('comentario');
            $estadoactual->save();
            return redirect()->back()->with('message','Estado actualizado')->with('status','alert alert-success');
               
        }
       

    }

    public function Licitador()
    {
        $user=User::find(Auth()->user()->id);
        $licitaciones=Licitacion::where('licitador',$user->id)->get();
        return view('licitacion.licitador')->with('licitaciones',$licitaciones);
    }
}
