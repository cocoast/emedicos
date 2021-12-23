<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;

class ClaseController extends Controller
{
 public function __construct(){
        $this->middleware('can:clase.index')->only('index');
        $this->middleware('can:clase.edit')->only('edit','update');
        $this->middleware('can:clase.create')->only('create','store');
        $this->middleware('can:clase.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clases=Clase::all();
        return view('clase.index')->with('clases',$clases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clase= new Clase();
        $clase->nombre=$request->get('clase');
        $clase->save();
         return redirect ('/clase');
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
        $clase=Clase::find($id);
        return view('clase.edit')->with('clase',$clase);
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
        $clase=Clase::find($id);
        $clase->nombre=$request->get('clase');
        $clase->save();
        return redirect ('/clase');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $clase=Clase::find($id);
       $clase->delete();
        return redirect('/clase');
    }
}
