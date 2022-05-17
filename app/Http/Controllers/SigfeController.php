<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sigfe;

class SigfeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sigfes=Sigfe::all();
        return view('sigfe.index')->with('sigfes',$sigfes);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sigfe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sigfe=new Sigfe;
        $sigfe->nombre=$request->get('nombre');
        $sigfe->codigo=$request->get('codigo');
        $sigfe->save();
        return redirect('/sigfe');

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
        $sigfe=Sigfe::find($id);
        return view('sigfe.edit')->with('sigfe',$sigfe);
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
        $sigfe=Sigfe::find($id);
        $sigfe->nombre=$request->get('nombre');
        $sigfe->codigo=$request->get('codigo');
        $sigfe->save();
        return redirect('/sigfe');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sigfe=Sigfe::find($id);
        $sigfe->delete();
        return redirect('/sigfe');
    }
}
