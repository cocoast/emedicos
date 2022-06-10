<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoLicitacion;

class EstadoLicitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('can:estadolicitacion.index')->only('index');
        $this->middleware('can:estadolicitacion.edit')->only('edit', 'update');
        $this->middleware('can:estadolicitacion.create')->only('create', 'store');
        $this->middleware('can:estadolicitacion.destroy')->only('destroy');
        $this->middleware('can:estadolicitacion.show')->only('show');
    }
    public function index()
    {
     $estados=EstadoLicitacion::all();
     //dd($estados);
     return view ('estadolicitacion.index')->with('estados',$estados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estadolicitacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(EstadoLicitacion::where('nombre',$request->get('nombre'))->count()==0)
        {
            $estado=new EstadoLicitacion;
            $estado->nombre=$request->get('nombre');
            $estado->save();
            return redirect()->back()->with('message','Estado Creado')->with('status','alert alert-success');
        }
        else
            return redirect()->back()->with('message','Estado ya se encuentra Creado')->with('status','alert alert-warning');   
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
        $estado=EstadoLicitacion::find($id);
        return view('estadolicitacion.edit')->with('estado',$estado);
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
        $estado=EstadoLicitacion::find($id);
        if(EstadoLicitacion::where('nombre',$request->get('nombre'))->count()==0)
        {
            $estado->nombre=$request->get('nombre');
            $estado->save();
            return redirect()->back()->with('message','Estado Modificado')->with('status','alert alert-success');
        }
        else
            return redirect()->back()->with('message','Estado ya se encuentra Creado')->with('status','alert alert-warning');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado=EstadoLicitacion::find($id);
        $estado->delete();
        return redirect()->back()->with('message','Estado Eliminado')->with('status','alert alert-danger');      
    }
}
