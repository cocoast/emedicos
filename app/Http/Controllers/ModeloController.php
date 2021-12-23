<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelo;

class ModeloController extends Controller
{
     public function __construct(){
        $this->middleware('can:modelo.index')->only('index');
        $this->middleware('can:modelo.edit')->only('edit','update');
        $this->middleware('can:modelo.create')->only('create','store');
        $this->middleware('can:modelo.delete')->only('destroy');
        $this->middleware('can:modelo.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos=Modelo::all();
        return view('modelo.index')->with('modelos',$modelos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modelo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if(Modelo::where('modelo',$request->get('modelo'))->count()==0){
            $modelo= new Modelo();
            $modelo->modelo=$request->get('modelo');
            $modelo->save();
            return redirect ('/modelo')->with('message', 'Modelo '.$request->get('modelo').' Ingresado')->with('status','alert alert-success') ;
         }
         else{
             return redirect ('/modelo')->with('message', 'Modelo '.$request->get('modelo').' ya se encuentra Ingresada')->with('status','alert alert-danger') ;
         }
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
        $modelo=Modelo::find($id);
        return view('modelo.edit')->with('modelo',$modelo);
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
        $modelo=Modelo::find($id);
        $modelo->modelo=$request->get('modelo');
        $modelo->save();
        return redirect ('/modelo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $modelo=Modelo::find($id);
       $modelo->delete();
        return redirect('/modelo');
    }
    public function search(Request $request){
        $term = $request->get('term');
        $querys=Modelo::where('modelo','LIKE','%'.$term.'%')->get();
        $data =[];
        foreach ($querys as $query) {
            $data[]=[
                'label' => $query->modelo
            ];
        }
        return $data;

    }
}
