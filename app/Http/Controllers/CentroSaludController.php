<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentroSalud;
use App\Models\Ssalud;
use App\Models\MinsalConvenio;
use App\Models\Sigfe;
use App\Models\MinsalFactura;

class CentroSaludController extends Controller
{

      public function __construct(){
        $this->middleware('can:centrosalud.index')->only('index');
        $this->middleware('can:centrosalud.edit')->only('edit','update');
        $this->middleware('can:centrosalud.create')->only('create','store');
        $this->middleware('can:centrosalud.destroy')->only('destroy');
        $this->middleware('can:centrosalud.show')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(!Auth()->user()->Dependence)
        {
            $centros=CentroSalud::all();
            return view('centrosalud.index')->with('centros',$centros);
        }
            if(Auth()->user()->Dependence->dependencetable_type=='App\Models\Ssalud')
            {
                $centros=CentroSalud::where('ssalud',Auth()->user()->Dependence->dependencetable_id)->get();
                return view('centrosalud.index')->with('centros',$centros);                
            } 
                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('porque');
          return view('centrosalud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ssalud = $request->get('ssalud');
        $centro=new CentroSalud;
        $centro->nombre=$request->get('nombre');
        //dd($ssalud);
        $centro->ssalud=$ssalud;
        $centro->save();
        return redirect('/centrosalud');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $centro=CentroSalud::find($id);
        $convenios=MinsalConvenio::where('dependencetable_type','App\Models\CentroSalud')->where('dependencetable_id',$centro->id)->get();
        $datos=$this->DatosEstablecimiento($centro->id);
        return view('centrosalud.show')->with('centro',$centro)->with('convenios',$convenios)->with('datos',$datos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $centro=CentroSalud::find($id);
         return view('centrosalud.edit')->with('centro',$centro);

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
        $centro=CentroSalud::find($id);
        $ssalud = explode(' - ', $request->get('ssalud'))[0];
        $centro->nombre=$request->get('nombre');
        $centro->ssalud=$ssalud;
        $centro->save();
        return redirect('/centrosalud');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $centro=CentroSalud::find($id);
        $centro->delete();
        return redirect('/centrosalud');
    }

     public function DatosEstablecimiento($id){
        
        $year=date('Y');
        $establecimiento=CentroSalud::find($id);
        $datos=array();
        $sigfes=Sigfe::all();
        foreach($sigfes as $sigfe){
            $datos['pago_'.$sigfe->id]=0;
            $datos[$sigfe->id]=MinsalConvenio::where('ano',$year)
                                ->where('dependencetable_type','App\Models\CentroSalud')
                                ->where('dependencetable_id',$establecimiento->id)
                                ->where('sigfe',$sigfe->id)
                                ->sum('monto_anual');
            foreach(MinsalConvenio::where('ano',$year)
                        ->where('dependencetable_type','App\Models\CentroSalud')
                        ->where('dependencetable_id',$establecimiento->id)
                        ->where('sigfe',$sigfe->id)->get() as $convenio){
                
                 foreach(MinsalFactura::where('minsalconvenio',$convenio->id)->get() as $pago){
                    $datos['pago_'.$sigfe->id]+=$pago->monto;
                }
            }
        }
        return $datos;
    }
}
