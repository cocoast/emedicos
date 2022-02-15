<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Traslado;
use App\Models\ServicioClinico;
use App\Models\Equipo;
use PDF2;
use Dompdf\Dompdf;
use DateTime;
class TrasladoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traslados=Traslado::all();
        return view('traslado.index')->with('traslados',$traslados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $numero=Traslado::latest('numero')->first();
        $numero=$numero->numero+1;
        
        return view ('traslado.create')->with('numero',$numero);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipo=explode(' - ', $request->get('equipo'))[0];
        $actual=explode(' - ', $request->get('actual'))[0];
        $destino=explode(' - ', $request->get('destino'))[0];

        $traslado=new Traslado();
        $traslado->fecha=$request->get('fecha');
        $traslado->numero=$request->get('numero');
        $traslado->actual=$actual;
        $traslado->destino=$destino;
        $traslado->equipo=$equipo;
        $traslado->save();
        return redirect ('/traslado')->with('message','Acta Creada Satisfactoriamente')->with("status",'alert alert-success');  
    }
    public function createPDF($id){
        $traslado=Traslado::find($id);
        
        $pdf = PDF2::loadView('traslado.acta', compact('traslado'));
        return $pdf->download('invoice.pdf');

       }
       public function Subir($id){
        $traslado=Traslado::find($id);
        return view('traslado.archivo')->with('traslado',$traslado);
       }
    public function Archivo(Request $request){
        $traslado = traslado::find($request->id);
        $equipo=Equipo::find($traslado->equipo);
        $fecha=new DateTime($traslado->fecha);
        $eq="";
        if($equipo->eq=="Critico")
            $eq="2.1";
        if($equipo->eq=="Relevante")
            $eq="2.2";
        if($equipo->eq=="Sin")
            $eq="Sin";
        if($equipo->inventario!='?'){
            $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario."/";
            $carpetanombre='/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario."/";
            $nombre=$equipo->inventario.'_'.$fecha->format('Y').'_TRASLADO_'.$fecha->format('m')."_".$fecha->format('d');
        }
        else{
            $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie."/";
            $carpetanombre='/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie."/";
            $nombre=$equipo->serie.'_'.$fecha->format('Y').'_TRASLADO_'.$fecha->format('m')."_".$fecha->format('d');
        }
            //if(!file_exists($carpeta))
            //return redirect ('/traslado') ->with('message','Solicite la creacion de la carpeta llamada '.$carpetanombre)->with("status",'alert alert-danger');
        if($request->hasFile('documento')){
            $file=$request->file('documento');
            $nombre=$nombre.'.pdf';
            if($file->guessExtension()=="pdf"){
                if(!file_exists($carpeta))
                    mkdir($carpeta,0777,true);
               $file->move($carpeta, $nombre);
               $traslado->archivo=$carpetanombre.''.$nombre;
               $traslado->save();
               $equipo->servicioclinico=$traslado->destino;
               $equipo->save();
               return redirect('/traslado')->with('message','Archivo Adjunto correctamente')->with("status",'alert alert-success');
            }
            else
                 return redirect ('/traslado') ->with('message','No es PDF el archivo')->with("status",'alert alert-danger');
                
        }
        else 
           return redirect ('/traslado') ->with('message','No hay archivo Adjunto')->with("status",'alert alert-danger');
        
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $traslado=Traslado::find($id);
        return view('traslado.acta')->with('traslado',$traslado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $traslado=Traslado::find($id);
       return view('traslado.edit')->with('traslado',$traslado);
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
        $traslado=Traslado::find($id);
        $copia=Traslado::find($id);
        $equi=Equipo::find($traslado->Equipo->id);

        $equipo=explode(' - ', $request->get('equipo'))[0];
        $actual=explode(' - ', $request->get('actual'))[0];
        $destino=explode(' - ', $request->get('destino'))[0];
        $traslado->fecha=$request->get('fecha');
        $traslado->actual=$actual;
        $traslado->destino=$destino;
        $traslado->equipo=$equipo;
        //dd($copia ."\n". $traslado);
        if($traslado->fecha!=$copia->fecha||$traslado->actual!=$copia->actual||$traslado->destino!=$copia->destino||$traslado->equipo!=$copia->equipo){
            if($traslado->archivo!=null){
                if(unlink($_SERVER['DOCUMENT_ROOT'].$traslado->archivo)){
                $traslado->archivo=null;
            }
        }
            $equi->servicioclinico=$actual;
            $equi->save();
            $traslado->save();
           return redirect ('/traslado')->with('traslado',$traslado)->with('message', 'se Modifico el Traslado Numero: '.$traslado->numero)->with('status','alert alert-success') ;
        }
        
        return redirect ('/traslado')->with('traslado',$traslado)->with('message', 'Para Traslado Numero: '.$traslado->numero.' no hay modificaciones ')->with('status','alert alert-warning') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $traslado=Traslado::find($id);
       $traslado->delete();
        return redirect('/traslado');
    }
       
}
