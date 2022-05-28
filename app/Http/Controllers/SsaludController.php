<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ssalud;
use App\Models\CentroSalud;

class SsaludController extends Controller
{

     public function __construct(){
        $this->middleware('can:ssalud.index')->only('index');
        $this->middleware('can:ssalud.edit')->only('edit','update');
        $this->middleware('can:ssalud.create')->only('create','store');
        $this->middleware('can:ssalud.destroy')->only('destroy');
        $this->middleware('can:ssalud.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios=Ssalud::all();
        return view('ssalud.index')->with('servicios',$servicios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ssalud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicio=new Ssalud;
        $servicio->nombre=$request->get('nombre');
        $servicio->save();
        return redirect ('/ssalud');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $centros=CentroSalud::where('ssalud',$id);
         return view('centrosalud.show')->with('centros',$centros);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio=Ssalud::find($id);
        return view('ssalud.edit')->with('servicio',$servicio);
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
        $servicio=Ssalud::find($id);
        $servicio->nombre=$request->get('nombre');
        $servicio->save();
        return redirect('/ssalud');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicio=Ssalud::find($id);
        $servicio->delete();
        return redirect('/ssalud');
    }
    public function search(Request $request){
        $term = $request->get('term');
        $querys=Ssalud::where('nombre','LIKE','%'.$term.'%')->get();
        $data =[];
        foreach ($querys as $query) {
            $data[]=[
                'label' => $query->id.' - '.$query->nombre
            ];
        }
        return $data;

    }
}
