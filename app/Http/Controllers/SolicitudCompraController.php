<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\solicitudCompra;
use App\Models\ServicioClinico;
use App\Models\DetalleSolicitud;
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
        $scs=solicitudCompra::whereYear('fecha',$fecha->format('Y'))->get();
        //dd($sc);
        return view('SC.index')->with('scs',$scs)->with('fecha',$fecha);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('SC.create');

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
        $size=count($request->get('field_tipo'));
        dd($size);
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

            //Guardar Informe
            $tec=$sc->numero."-".$sc->fecha->format('Y');
            $carpeta='/storage/solicitudes/'.$sc->fecha->format('Y')."/";
            if (!file_exists($_SERVER['DOCUMENT_ROOT'].$carpeta))
                mkdir($_SERVER['DOCUMENT_ROOT'].$carpeta,0777,true);
            if($request->hasFile("documento")){
                $file=$request->file('documento');
                $nombre=$tec.".".$file->guessExtension();
                if($file->guessExtension()=="pdf"){
                 $file->move($_SERVER['DOCUMENT_ROOT'].$carpeta, $nombre);
                 $sc->informe=$carpeta.$nombre;
                }
            else
                dd("no es un archivo pdf");
        }
          $sc->save();
         for ($i=0; $i < $size ; $i++) { 
             $dt=new DetalleSolicitud;
             $dt->sc=$sc->id;
             //aqui tengo que preguntar si es accesorio insumo o repuesto y linkearlo con producto de lo contrario guardar el nombre. 
             $dt->producto=$request->get('field_producto')[$i];

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
