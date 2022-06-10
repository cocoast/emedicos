<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaLicitacion;

class CategoriaLicitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias=CategoriaLicitacion::all();
        return view('categorialicitacion.index')->with('categorias',$categorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorialicitacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(CategoriaLicitacion::where('nombre',$request->get('nombre'))->count()==0){
            $categoria=new CategoriaLicitacion;
            $categoria->nombre=$request->get('nombre');
            $categoria->save();
            return redirect()->back()->with('message','Categoria Creada')->with('status','alert alert-success');
        }
        else
            return redirect()->back()->with('message','Categoria ya se encuentra Creada')->with('status','alert alert-warning');
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
        $categoria=CategoriaLicitacion::find($id);
         return view('categorialicitacion.edit')->with('categoria',$categoria);
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
        if(CategoriaLicitacion::where('nombre',$request->get('nombre'))->count()==0){
            $categoria=CategoriaLicitacion::find($id);
            $categoria->nombre=$request->get('nombre');
            $categoria->save();
            return redirect()->back()->with('message','Categoria Editada')->with('status','alert alert-success');
        }
        else
            return redirect()->back()->with('message','Categoria ya se encuentra Creada')->with('status','alert alert-warning');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria=CategoriaLicitacion::find($id);
        $categoria->delete();
        return redirect()->back()->with('message','Categoria eliminada')->with('status','alert alert-danger');
    }
}
