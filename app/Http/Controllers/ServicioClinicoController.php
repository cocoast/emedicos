<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicioClinico;

class ServicioClinicoController extends Controller
{
   public function __construct(){
        $this->middleware('can:servicioclinico.index')->only('index');
        $this->middleware('can:servicioclinico.edit')->only('edit','update');
        $this->middleware('can:servicioclinico.create')->only('create','store');
        $this->middleware('can:servicioclinico.delete')->only('destroy');
        $this->middleware('can:servicioclinico.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicioclinicos=ServicioClinico::all();
        return view('servicioclinico.index')->with('servicioclinicos',$servicioclinicos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicioclinico.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicioclinico= new ServicioClinico();
        $servicioclinico->nombre=$request->get('nombre');
        $servicioclinico->ubicacion=$request->get('ubicacion');
        $servicioclinico->email_responsable=$request->get('email_responsable');
        $servicioclinico->responsable=$request->get('responsable');
        $servicioclinico->save();
         return redirect ('/servicioclinico');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicio=servicioclinico::find($id);
        return view("servicioclinico.show")->with("servicio",$servicio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicioclinico=ServicioClinico::find($id);
        return view('servicioclinico.edit')->with('servicioclinico',$servicioclinico);
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
        $servicioclinico= ServicioClinico::find($id);
        $servicioclinico->nombre=$request->get('nombre');
        $servicioclinico->ubicacion=$request->get('ubicacion');
        $servicioclinico->email_responsable=$request->get('email_responsable');
        $servicioclinico->responsable=$request->get('responsable');
        $servicioclinico->save();
        return redirect ('/servicioclinico');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $servicioclinico=ServicioClinico::find($id);
       $servicioclinico->delete();
        return redirect('/servicioclinico');
    }
    public function search(Request $request){
        $term = $request->get('term');
        $querys=ServicioClinico::where('nombre','LIKE','%'.$term.'%')->get();
        $data =[];
        foreach ($querys as $query) {
            $data[]=[
                'label' => $query->nombre
            ];
        }
        return $data;

    }
}
