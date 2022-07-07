<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicioClinico;
use App\Models\Ssalud;
use App\Models\CentroSalud;

class ServicioClinicoController extends Controller
{
   public function __construct(){
        $this->middleware('can:servicioclinico.index')->only('index');
        $this->middleware('can:servicioclinico.edit')->only('edit','update');
        $this->middleware('can:servicioclinico.create')->only('create','store');
        $this->middleware('can:servicioclinico.destroy')->only('destroy');
        $this->middleware('can:servicioclinico.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth()->user();
        if($user->Dependence->dependencetable_type=='App\Models\CentroSalud')
        {
            $establecimiento=CentroSalud::find($user->Dependence->dependencetable_id);
            $unidadesEstablecimientos=ServicioClinico::where('dependentable_type','App\Models\CentroSalud')->where('dependentable_id',$user->Dependence->dependencetable_id)->get();
            dd($unidadesEstablecimientos);
            $aux="";
            $total=array();
            foreach($unidadesEstablecimientos as $unidad)
                $total[$unidad->id]=$unidad;
                $aux=ServicioClinico::where('dependentable_type','App\Models\ServicioClinico')->where('dependentable_id',$unidad->id)->get();
                

        }
        $servicioclinicos=ServicioClinico::where('dependentable_type',$user->Dependence->dependencetable_type)->where('dependentable_id',$user->Dependence->dependencetable_id)->get();
        return view('servicioclinico.index')->with('servicioclinicos',$servicioclinicos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios=Ssalud::all();
        $centros=CentroSalud::all();
        return view('servicioclinico.create')->with('centros',$centros)->with('servicios',$servicios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=Auth()->user();
        $dependencia=$user->Dependence;
        $servicioclinico= new ServicioClinico();
        $servicioclinico->nombre=$request->get('nombre');
        $servicioclinico->ubicacion=$request->get('ubicacion');
        $servicioclinico->email_responsable=$request->get('email_responsable');
        $servicioclinico->responsable=$request->get('responsable');
        $servicioclinico->cr=$request->get('cr');
        $servicioclinico->anexo=$request->get('anexo');
        $servicioclinico->dependentable_id=$dependencia->dependencetable_id;
        $servicioclinico->dependentable_type=$dependencia->dependencetable_type;
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
        $servicioclinico->cr=$request->get('cr');
        $servicioclinico->anexo=$request->get('anexo');
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
                'label' => $query->id.' - '.$query->nombre.' - '.$query->ubicacion
            ];
        }
        return $data;

    }
}
