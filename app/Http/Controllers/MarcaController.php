<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
class MarcaController extends Controller
{
     public function __construct(){
        $this->middleware('can:marca.index')->only('index');
        $this->middleware('can:marca.edit')->only('edit','update');
        $this->middleware('can:marca.create')->only('create','store');
        $this->middleware('can:marca.destroy')->only('destroy');
        $this->middleware('can:marca.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas=Marca::all();
        return view('marca.index')->with('marcas',$marcas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if(Marca::where('marca',$request->get('marca'))->count()==0){
            $marca= new Marca();
            $marca->marca=$request->get('marca');
            $marca->save();
            return redirect ('/marca')->with('message', 'Marca '.$request->get('marca').' Ingresado')->with('status','alert alert-success') ;
        }
        else{ 
            return redirect ('/marca')->with('message', 'Marca '.$request->get('marca').' ya se encuentra Ingresada')->with('status','alert alert-danger') ;
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
        $marca=Marca::find($id);
        return view('marca.edit')->with('marca',$marca);
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
        $marca=Marca::find($id);
        $marca->marca=$request->get('marca');
        $marca->save();
        return redirect ('/marca');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $marca=Marca::find($id);
       $marca->delete();
        return redirect('/marca');
    }
    public function search(Request $request){
        $term = $request->get('term');
        $querys=Marca::where('marca','LIKE','%'.$term.'%')->get();
        $data =[];
        foreach ($querys as $query) {
            $data[]=[
                'label' =>$query->id.' - '.$query->marca
            ];
        }
        return $data;

    }
}
