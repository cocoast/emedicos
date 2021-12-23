<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\solicitudCompra;
use App\Models\ServicioClinico;
use DateTime;

class SolicitudCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $fecha= new DateTime();
        $sc=solicitudCompra::whereYear('fecha',$fecha->format('Y'))->get();
        //dd($sc);
        return view('SC.index')->with('sc')->with('fecha',$fecha);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios=ServicioClinico::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('SC.create')->with('servicios',$servicios);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        if(solicitudCompra::where('numero',$request->get('numero'))->whereYear('fecha',$request->get('fecha')->format('Y'))->count()==0){
            $sc=new solicitudCompra();
            $sc->numero=$request->get('numero');
            $sc->fecha=$request->get('fecha');
            $sc->tipo=$request->get('tipo');
            $sc->referente=$request->get('referente');
            $sc->servicio=$request->get('servicio');
            $sc->justificacion=$request->get('justificacion');
            $sc->neto=$request->get('neto');
            $sc->iva=$request->get('iva');
            $sc->total=$request->get('total');
            $sc->informe=$request->get('informe');
            $sc->referentetecnico=$request->get('reftectnico');

            //Guardar Archivo
            $sol=$sc->numero.$sc->fecha->format('Y');
            $carpeta='/storage/solicitudes/'.$sc->fecha->format('Y')."/";
            if (!file_exists($_SERVER['DOCUMENT_ROOT'].$carpeta))
                mkdir($_SERVER['DOCUMENT_ROOT'].$carpeta,0777,true);
            if($request->hasFile("documento")){
                $file=$request->file('documento');
                $nombre=$sol.".".$file->guessExtension();
                if($file->guessExtension()=="pdf"){
                 $file->move($_SERVER['DOCUMENT_ROOT'].$carpeta, $nombre);
                 $sc->archivo=$carpeta.$nombre;
                }
            else
                dd("no es un archivo pdf");
        }
            
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
        //
    }
}
