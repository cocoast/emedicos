<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baja;
use App\Models\Equipo;
use DateTime;

class BajaController extends Controller
{
     public function __construct(){
        $this->middleware('can:baja.index')->only('index');
        $this->middleware('can:baja.edit')->only('edit','update');
        $this->middleware('can:baja.create')->only('create','store');
        $this->middleware('can:baja.destroy')->only('destroy');
        $this->middleware('can:baja.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bajas=Baja::all();
        return view('baja.index')->with('bajas',$bajas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('baja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $fecha=new DateTime($request->get('fecha'));
        if(Equipo::where('inventario',$request->equipo)->count()==1){
            $equipo=Equipo::where('inventario',$request->equipo)-> first();
            $eq="";
        if($equipo->eq=="Critico")
            $eq="2.1";
        if($equipo->eq=="Relevante")
            $eq="2.2";
        if($equipo->eq=="Sin")
            $eq="Sin";
            $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario."/";
             $carpetanombre='/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario."/";
            
            $nombre=$equipo->inventario.'_'.$fecha->format('Y').'_BAJA_'.$fecha->format('m');
        }
        else{
            if(Equipo::where('serie',$request->equipo)->count()==1){
                $equipo=Equipo::where('serie',$request->equipo)-> first();
                $eq="";
        if($equipo->eq=="Critico")
            $eq="2.1";
        if($equipo->eq=="Relevante")
            $eq="2.2";
        if($equipo->eq=="Sin")
            $eq="Sin";
                $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie."/";
                $carpeta='/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie."/";
                $nombre=$equipo->serie.'_'.$fecha->format('Y').'_BAJA_'.$fecha->format('m');
            }
            else
                return view('baja.create');
        }
        
        $baja=new Baja();
        $baja->baja=$request->get('baja');
        $baja->fecha=$request->get('fecha');
        $baja->equipo=$equipo->id;
        if(!file_exists($carpeta))
            mkdir($carpeta,0777,true);
        if($request->hasFile('documento')){
            $file=$request->file('documento');

            $nombre=$nombre.'.'.$file->guessExtension();
            if($file->guessExtension()=="pdf"){
               $file->move($carpeta, $nombre);
            }
            else
                dd("no es .pdf");
        }
        $baja->documento=$carpetanombre.''.$nombre;
        $baja->save();

        return redirect ('/baja');
            

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
        $baja=Baja::find($id);
        return view ('baja.edit')->with('baja',$baja);
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
        $fecha=new DateTime($request->get('fecha'));
        if(Equipo::where('inventario',$request->equipo)->count()==1){
            $equipo=Equipo::where('inventario',$request->equipo)-> first();
            $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$equipo->eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario."/";
             $carpetanombre='/storage/'.$equipo->eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario."/";
            
            $nombre=$equipo->inventario.'_'.$fecha->format('Y').'_BAJA_'.$fecha->format('m');
        }
        else{
            if(Equipo::where('serie',$request->equipo)->count()==1){
                $equipo=Equipo::where('serie',$request->equipo)-> first();
                $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$equipo->eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie."/";
                $carpeta='/storage/'.$equipo->eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie."/";
                $nombre=$equipo->serie.'_'.$fecha->format('Y').'_BAJA_'.$fecha->format('m');
            }
            else
                return view('baja.create');
        }
        
        $baja=Baja::find($id);
        $baja->baja=$request->get('baja');
        $baja->fecha=$request->get('fecha');
        $baja->equipo=$equipo->id;
        if(!file_exists($carpeta))
            mkdir($carpeta,0777,true);
        if($request->hasFile('documento')){
            $file=$request->file('documento');
            $nombre=$nombre.'.'.$file->guessExtension();
            if($file->guessExtension()=="pdf"){
               $file->move($carpeta, $nombre);
            }
            else
                dd("no es .pdf");
        }
        $baja->documento=$carpetanombre.''.$nombre;
        $baja->save();

        return redirect ('/baja');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $baja=Baja::find($id);
        $baja->delete();
        return redirect('/baja');
    }
}
