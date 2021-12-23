<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubFamilia;
class SubFamiliaController extends Controller
{
    public function __construct(){
        $this->middleware('can:subfamilia.index')->only('index');
        $this->middleware('can:subfamilia.edit')->only('edit','update');
        $this->middleware('can:subfamilia.create')->only('create','store');
        $this->middleware('can:subfamilia.delete')->only('destroy');
        $this->middleware('can:subfamilia.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subfamilias=SubFamilia::all();
        return view('subfamilia.index')->with('subfamilias',$subfamilias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subfamilia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if(SubFamilia::where('nombre',$request->get('subfamilia'))->count()==0){
            $subfamilia= new SubFamilia();
            $subfamilia->nombre=$request->get('subfamilia');
            $subfamilia->vidautil=$request->get('vidautil');
            $subfamilia->save();
           return redirect ('/subfamilia')->with('message', 'Sub-Familia '.$request->get('subfamilia').' Ingresada')->with('status','alert alert-success') ;
        }
        else
             return redirect ('/subfamilia')->with('message', 'Sub-Familia '.$request->get('subfamilia').' ya se encuentra Ingresada')->with('status','alert alert-danger') ;

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
        $subfamilia=SubFamilia::find($id);
        return view('subfamilia.edit')->with('subfamilia',$subfamilia);
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
        $subfamilia=SubFamilia::find($id);
        $subfamilia->nombre=$request->get('subfamilia');
        $subfamilia->vidautil=$request->get('vidautil');
        $subfamilia->save();
        return redirect ('/subfamilia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $subfamilia=SubFamilia::find($id);
       $subfamilia->delete();
        return redirect('/subfamilia');
    }
    public function search(Request $request){
        $term = $request->get('term');
        $querys=SubFamilia::where('nombre','LIKE','%'.$term.'%')->get();
        $data =[];
        foreach ($querys as $query) {
            $data[]=[
                'label' => $query->nombre
            ];
        }
        return $data;

    }
}
