<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MinsalFactura;
use App\Models\MinsalConvenio;

class MinsalFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $convenio=MinsalConvenio::find($id);
        return view ('minsalfactura.create')->with('convenio',$convenio);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $factura=new MinsalFactura;
        $factura->numero=$request->get('numero');
        $factura->fecha=$request->get('fecha');
        $factura->monto=$request->get('monto');
        $factura->minsalconvenio=$request->get('minsalconvenio');
        $factura->save();
        return redirect('/minsalconvenio');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $convenio=MinsalConvenio::find($id);
        $pagos=MinsalFactura::where('minsalconvenio',$id)->get();
        return view('minsalfactura.show')->with('pagos',$pagos)->with('convenio',$convenio);
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
