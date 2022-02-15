<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garantia;
use DateTime;

class GarantiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $garantias=Garantia::all();
        return view('garantia.index')->with('garantias',$garantias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $garantia=Garantia::find($id);
        return view ('garantia.edit')->with('garantia',$garantia);
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
            $garantia=Garantia::find($id);

            $inicio=DateTime::createFromFormat('d-m-Y',date('d-m-Y',strtotime($request->get('init'))));
            $fin=DateTime::createFromFormat('d-m-Y',date('d-m-Y',strtotime($request->get('fin'))));
            $garantia->inicio=$inicio;
            $garantia->fin=$fin;
            $garantia->mp=$request->get('mpa');
            $garantia->mp_disponible=$request->get('mp');
            $garantia->frecuencia=$request->get('frecuencia');
            $garantia->save();
            return redirect('/garantia')->with('message', 'Se modifico la Garantia ID='.$garantia->id)->with('status','alert alert-warning');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $equipo=Garantia::find($id);
       $equipo->delete();
        return redirect('/garantia');
    }
}
