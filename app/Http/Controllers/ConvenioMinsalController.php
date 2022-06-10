<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Sigfe;
use App\Models\Ssalud;
use App\Models\CentroSalud;
use App\Models\MinsalConvenio;
use App\Models\MinsalFactura;


class ConvenioMinsalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year=date('Y');
        $sigfes=Sigfe::all();
        $convenios="";
        if(Auth()->user()->Dependence==null)
        {
            $convenios=MinsalConvenio::all();
            $datos=$this->datosMinsal();
            //dd($datos);
            return view('minsalconvenio.admin')->with('convenios',$convenios)->with('datos',$datos)->with('sigfes',$sigfes);
        }
            if(Auth()->user()->Dependence->dependencetable_type=='App\Models\Ssalud')
            {
                $centros=CentroSalud::where('ssalud',Auth()->user()->Dependence->dependencetable_id)->get();
                $convenios=array();
                //dd($centros);

                foreach($centros as $centro){
                    $convenios[$centro->id]=MinsalConvenio::where('dependencetable_id',$centro->id)->get();    
                }
               //dd($convenios);
                return view ('minsalconvenio.ssalud')->with('convenios',$convenios)->with('centros',$centros);
                
                return view('minsalconvenio.admin')->with('convenios',$convenios); 
            } 
                else
                {  

                    $id=Auth()->user()->Dependence->dependencetable_id;
                    $type=Auth()->user()->Dependence->dependencetable_type;
                    $convenios=MinsalConvenio::where('dependencetable_type',$type)->where('dependencetable_id',$id)->get();
                    return view('minsalconvenio.index')->with('convenios',$convenios);
                }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sigfes="";
        $centros="";
        $servicio=false;
        if(Auth()->user()->Dependence->dependencetable_type=='App\Models\Ssalud'){
            $sigfes=Sigfe::orderBy('codigo', 'ASC')->get();
            $centros=CentroSalud::where('ssalud',Auth()->user()->Dependence->dependencetable_id)->orderBy('nombre','ASC')->get();
            $servicio=true;
            return view('minsalconvenio.create')->with('sigfes',$sigfes)->with('centros',$centros)->with('servicio',$servicio);    
        }
        elseif(Auth()->user()->Dependence->dependencetable_type=='App\Models\CentroSalud'){
            $sigfes=Sigfe::orderBy('codigo', 'ASC')->get();
            return view('minsalconvenio.create')->with('sigfes',$sigfes)->with('centros',$centros)->with('servicio',$servicio);
        }
        else
            return redirect()->back()->with('message','El usuario no esta autorizado para la creacion de Convenios')->with('status','alert alert-danger');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=Auth()->user()->Dependence->dependencetable_id;
        $type=Auth()->user()->Dependence->dependencetable_type;
        $centro="";
        if($type=='App\Models\Ssalud'){
            $centro=CentroSalud::find($request->get('centro'));
            $convenio=new MinsalConvenio;
            $convenio->nombre=$request->get('nombre');
            $convenio->resolucion=$request->get('resolucion');
            $convenio->fecha_resolucion=$request->get('fecha_resolucion');
            $convenio->fecha_termino=$request->get('fecha_termino');
            $convenio->ano=$request->get('year');
            $convenio->monto_anual=$request->get('monto_anual');
            $convenio->glosa=$request->get('glosa');
            $convenio->sigfe=$request->get('sigfe');
            $convenio->dependencetable_type=$centro->getMorphClass();
            $convenio->dependencetable_id=$centro->id;
            $convenio->save();
           return redirect()->back()->with('message','El Convenio ha sido creado Satisfactoriamente')->with('status','alert alert-success');
        }
        elseif($type=='App\Models\CentroSalud'){
            $convenio=new MinsalConvenio;
            $convenio->nombre=$request->get('nombre');
            $convenio->resolucion=$request->get('resolucion');
            $convenio->fecha_resolucion=$request->get('fecha_resolucion');
            $convenio->fecha_termino=$request->get('fecha_termino');
            $convenio->ano=$request->get('year');
            $convenio->monto_anual=$request->get('monto_anual');
            $convenio->glosa=$request->get('glosa');
            $convenio->sigfe=$request->get('sigfe');
            $convenio->dependencetable_type=$type;
            $convenio->dependencetable_id=$id;
            $convenio->save();
            return redirect()->back()->with('message','El Convenio ha sido creado Satisfactoriamente')->with('status','alert alert-success');
        }
        else
            return redirect()->back()->with('message','El usuario no esta autorizado para la creacion de Convenios')->with('status','alert alert-danger');

        
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
        $sigfes=Sigfe::orderBy('codigo', 'ASC')->get();
        return view('minsalconvenio.show')->with('sigfes',$sigfes)->with('centro',$centro);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $convenio=MinsalConvenio::find($id);
        $sigfes=Sigfe::orderBy('codigo', 'ASC')->get();
        return view('minsalconvenio.edit')->with('sigfes',$sigfes)->with('convenio',$convenio);
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
        $convenio=MinsalConvenio::find($id);
        $convenio->nombre=$request->get('nombre');
        $convenio->resolucion=$request->get('resolucion');
        $convenio->fecha_resolucion=$request->get('fecha_resolucion');
        $convenio->fecha_termino=$request->get('fecha_termino');
        $convenio->ano=$request->get('year');
        $convenio->monto_anual=$request->get('monto_anual');
        $convenio->glosa=$request->get('glosa');
        $convenio->sigfe=$request->get('sigfe');
        $convenio->dependencetable_type=$type;
        $convenio->dependencetable_id=$id;
        $convenio->save();
        return redirect()->back()->with('message','El Convenio ha sido Editado Satisfactoriamente')->with('status','alert alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $convenio=MinsalConvenio::find($id);
        $convenio->delete();
        return redirect()->back()->with('message','El Convenio ha sido Eliminado Satisfactoriamente')->with('status','alert alert-danger');
    }
    public function datosMinsal(){
        
        $year=date('Y');
        $datos=array();
        $sigfes=Sigfe::all();
        foreach($sigfes as $sigfe){
            $datos['pago_'.$sigfe->id]=0;
            $datos[$sigfe->id]=MinsalConvenio::where('ano',$year)->where('sigfe',$sigfe->id)->sum('monto_anual');
            foreach(MinsalConvenio::where('ano',$year)->where('sigfe',$sigfe->id)->get() as $convenio){
                
                 foreach(MinsalFactura::where('minsalconvenio',$convenio->id)->get() as $pago){
                    $datos['pago_'.$sigfe->id]+=$pago->monto;
                }
            }
        }
        return $datos;
    }  
}
