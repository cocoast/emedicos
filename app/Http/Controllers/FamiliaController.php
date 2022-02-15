<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Familia;

class FamiliaController extends Controller
{
     public function __construct(){
        $this->middleware('can:familia.index')->only('index');
        $this->middleware('can:familia.edit')->only('edit','update');
        $this->middleware('can:familia.create')->only('create','store');
        $this->middleware('can:familia.delete')->only('destroy');
        $this->middleware('can:familia.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $familias=Familia::all();
        return view('familia.index')->with('familias',$familias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('familia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Familia::where('nombre',$request->get('familia'))->count()==0){
            $familia= new Familia();
            $familia->nombre=$request->get('familia');
            $familia->save();
            return redirect ('/familia')->with('message', 'Familia '.$request->get('familia').' Ingresada')->with('status','alert alert-success') ;
        }
        else
             return redirect ('/familia')->with('message', 'Familia '.$request->get('familia').' ya se encuentra Ingresada')->with('status','alert alert-danger') ;

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
        $familia=Familia::find($id);
        return view('familia.edit')->with('familia',$familia);
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
        $familia=Familia::find($id);
        $familia->nombre=$request->get('familia');
        $familia->save();
        return redirect ('/familia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $familia=Familia::find($id);
       $familia->delete();
        return redirect('/familia');
    }
    public function search(Request $request){
        $term = $request->get('term');
        $querys=Familia::where('nombre','LIKE','%'.$term.'%')->get();
        $data =[];
        foreach ($querys as $query) {
            $data[]=[
                'label' => $query->id.' - '.$query->nombre
            ];
        }
        return $data;

    }
}
