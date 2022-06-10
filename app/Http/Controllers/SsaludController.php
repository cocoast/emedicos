<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ssalud;
use App\Models\CentroSalud;
use App\Models\Sigfe;
use App\Models\MinsalConvenio;
use App\Models\MinsalFactura;

class SsaludController extends Controller
{

     public function __construct(){
        $this->middleware('can:ssalud.index')->only('index');
        $this->middleware('can:ssalud.edit')->only('edit','update');
        $this->middleware('can:ssalud.create')->only('create','store');
        $this->middleware('can:ssalud.destroy')->only('destroy');
        $this->middleware('can:ssalud.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios=Ssalud::all();
        return view('ssalud.index')->with('servicios',$servicios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ssalud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicio=new Ssalud;
        $servicio->nombre=$request->get('nombre');
        $servicio->save();
        return redirect ('/ssalud');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicio=Ssalud::find($id);
        $establecimientos=CentroSalud::where('ssalud',$servicio->id)->get();
        $datos=$this->DatosSsalud($servicio->id);
        //dd($datos);
        return view('ssalud.show')->with('servicio',$servicio)->with('centros',$establecimientos)->with('mp',$datos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio=Ssalud::find($id);
        return view('ssalud.edit')->with('servicio',$servicio);
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
        $servicio=Ssalud::find($id);
        $servicio->nombre=$request->get('nombre');
        $servicio->save();
        return redirect('/ssalud');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicio=Ssalud::find($id);
        $servicio->delete();
        return redirect('/ssalud');
    }
    public function search(Request $request){
        $term = $request->get('term');
        $querys=Ssalud::where('nombre','LIKE','%'.$term.'%')->get();
        $data =[];
        foreach ($querys as $query) {
            $data[]=[
                'label' => $query->id.' - '.$query->nombre
            ];
        }
        return $data;

    }
    public function DatosSsalud($id){
        
        $year=date('Y');
        $servicio=Ssalud::find($id);
        $establecimientos=CentroSalud::where('ssalud',$servicio->id)->get();
        $datos=array();
        $sigfes=Sigfe::all();
           foreach($sigfes as $sigfe){
            $datos['pago_'.$sigfe->id]=0;
            $datos['total_'.$sigfe->id]=0;
            $datos['convenios_'.$sigfe->id]=0;
            foreach($establecimientos as $establecimiento){
            $datos['total_'.$sigfe->id]+=MinsalConvenio::where('ano',$year)
                                ->where('dependencetable_type','App\Models\CentroSalud')
                                ->where('dependencetable_id',$establecimiento->id)
                                ->where('sigfe',$sigfe->id)
                                ->sum('monto_anual');
            $datos['convenios_'.$sigfe->id]+=MinsalConvenio::where('ano',$year)
                                ->where('dependencetable_type','App\Models\CentroSalud')
                                ->where('dependencetable_id',$establecimiento->id)
                                ->where('sigfe',$sigfe->id)
                                ->count();

            foreach(MinsalConvenio::where('ano',$year)
                        ->where('dependencetable_type','App\Models\CentroSalud')
                        ->where('dependencetable_id',$establecimiento->id)
                        ->where('sigfe',$sigfe->id)->get() as $convenio){
                
                 foreach(MinsalFactura::where('minsalconvenio',$convenio->id)->get() as $pago){
                    $datos['pago_'.$sigfe->id]+=$pago->monto;
                }
            }
        }
    }
        
        return $datos;
    }
}
