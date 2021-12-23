<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubClase;

class SubClaseController extends Controller
{
  public function __construct(){
        $this->middleware('can:subclase.index')->only('index');
        $this->middleware('can:subclase.edit')->only('edit','update');
        $this->middleware('can:subclase.create')->only('create','store');
        $this->middleware('can:subclase.delete')->only('destroy');
        $this->middleware('can:subclase.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subclases=SubClase::all();
        return view('subclase.index')->with('subclases',$subclases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subclase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subclase= new SubClase();
        $subclase->nombre=$request->get('subclase');
        $subclase->save();
         return redirect ('/subclase');
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
        $subclase=SubClase::find($id);
        return view('subclase.edit')->with('subclase',$subclase);
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
        $subclase=SubClase::find($id);
        $subclase->nombre=$request->get('subclase');
        $subclase->save();
        return redirect ('/subclase');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $subclase=SubClase::find($id);
       $subclase->delete();
        return redirect('/subclase');
    }
}
