<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function __construct(){
        $this->middleware('can:proveedor.index')->only('index');
        $this->middleware('can:proveedor.edit')->only('edit','update');
        $this->middleware('can:proveedor.create')->only('create','store');
        $this->middleware('can:proveedor.delete')->only('destroy');
        $this->middleware('can:proveedor.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedors=Proveedor::all();
        return view('proveedor.index')->with('proveedors',$proveedors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor= new Proveedor();
        $proveedor->rut=$request->get('rut');
        $proveedor->nombre=$request->get('nombre');
        $proveedor->telefono=$request->get('telefono');
        $proveedor->email=$request->get('email');
        $proveedor->direccion=$request->get('direccion');
        $proveedor->save();
         return redirect ('/proveedor');
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
        $proveedor=Proveedor::find($id);
        return view('proveedor.edit')->with('proveedor',$proveedor);
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
        $proveedor=Proveedor::find($id);
        $proveedor->rut=$request->get('rut');
        $proveedor->nombre=$request->get('nombre');
        $proveedor->telefono=$request->get('telefono');
        $proveedor->email=$request->get('email');
        $proveedor->direccion=$request->get('direccion');
        $proveedor->save();
        return redirect ('/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $proveedor=Proveedor::find($id);
       $proveedor->delete();
        return redirect('/proveedor');
    }
    public function search(Request $request){
        $term = $request->get('term');
        $querys=Proveedor::where('nombre','LIKE','%'.$term.'%')->get();
        $data =[];
        foreach ($querys as $query) {
            $data[]=[
                'label' => $query->id.' - '.$query->nombre
            ];
        }
        return $data;

    }
}
