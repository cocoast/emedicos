<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Familia;
use App\Models\SubFamilia;
use App\Models\Clase;
use App\Models\SubClase;
use App\Models\ServicioClinico;
use App\Models\Proveedor;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Pago;
use App\Models\Convenio;
use App\Models\EquipoConvenio;
use DateTime;
use App\Models\User;
use App\Models\Garantia;
use App\Models\Planificamp;
use App\Models\Ssalud;
use App\Models\CentroSalud;
use App\Models\Sigfe;
use App\Models\MinsalConvenio;
use App\Models\MinsalFactura;
use App\Models\Licitacion;
use App\Traits\TraitsConvenio;


class DashBoardController extends Controller
{
    use TraitsConvenio;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //dd(Auth()->user()->Dependence);
        $user=Auth()->user();
        //dd(!$user->Dependence);
        //dd($user->getRoleNames()[0]);
        if($user->getRoleNames()[0]=="Dios" ||$user->getRoleNames()[0] =="User" ||$user->getRoleNames()[0] == "Admin" ){
            return $this->DashEquiposMedicos();
        }
        else
            if($user->getRoleNames()[0]=="Licitador"){
                $user=User::find(Auth()->user()->id);
                $licitaciones=Licitacion::where('licitador',$user->id)->get();
                return view('licitacion.licitador')->with('licitaciones',$licitaciones);
            }
        else
        if($user->getRoleNames()[0]=='InfoMinsal' && !$user->Dependence){
          return $this->DashMinsal($user->id);
        }
        else
        if($user->getRoleNames()[0]=='Minsal.SS' && $user->Dependence ){
            return  $this->DashMinsal($user->id);  
        }
         if($user->getRoleNames()[0]=='minsal.ss.centro' && $user->Dependence && $user->Dependence->dependencetable_type=='App\Models\CentroSalud'){
            return  $this->DashMinsal($user->id);  
        }
        else 
            return $this->DashEquiposMedicos();
    }

    public function DashLicitaciones(){
        $licitaciones=Licitacion::all();
        return view("licitacion.index")->with('licitaciones',$licitaciones);
    }
     public function DashMinsal($id){
        $user=User::find($id);
        $year=date('Y');
        $datos=array();
        $sigfes=Sigfe::all();

        if($user->Dependence==null){
            foreach($sigfes as $sigfe){
                $datos['pago_'.$sigfe->id]=0;
                $datos['total_'.$sigfe->id]=0;
                $datos['convenios_'.$sigfe->id]=0;
                $datos['total_'.$sigfe->id]=MinsalConvenio::where('ano',$year)->where('sigfe',$sigfe->id)->sum('monto_anual');
                $datos['convenios_'.$sigfe->id]+=MinsalConvenio::where('ano',$year)->where('sigfe',$sigfe->id)->count();
                foreach(MinsalConvenio::where('ano',$year)->where('sigfe',$sigfe->id)->get() as $convenio){
                    foreach(MinsalFactura::where('minsalconvenio',$convenio->id)->get() as $pago){
                        $datos['pago_'.$sigfe->id]+=$pago->monto;
                    }
                }
            }
        }
    else{
            
        if($user->Dependence->dependencetable_type=='App\Models\Ssalud'){
               $establecimientos=CentroSalud::where('ssalud',$user->Dependence->dependencetable_id)->get();
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
    }
        if($user->Dependence->dependencetable_type=='App\Models\CentroSalud'){
            $establecimiento=CentroSalud::find($user->Dependence->dependencetable_id);
            //dd('hasta aqui');
            foreach($sigfes as $sigfe){
            $datos['pago_'.$sigfe->id]=0;
            $datos['total_'.$sigfe->id]=0;
            $datos['convenios_'.$sigfe->id]=0;
            $datos['convenios_'.$sigfe->id]=MinsalConvenio::where('ano',$year)
                                    ->where('dependencetable_type','App\Models\CentroSalud')
                                    ->where('dependencetable_id',$establecimiento->id)
                                    ->where('sigfe',$sigfe->id)
                                    ->count();
            $datos['total_'.$sigfe->id]=MinsalConvenio::where('ano',$year)
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
    }
}
//dd($datos);
       return view('dashboard.minsal')->with('mp',$datos);
    }
    
    public function DashEquiposMedicos()
    {
        $mp=$this->PlanMP();
        //dd($this->CumplimientoMP());
        $preventivo=$this->ConveniosMantenimiento();
        $arriendos=$this->ConveniosArriendo();
        $correctivos=$this->ConveniosCorrectivos();
        $cantidadequipos=$this->EquiposMedicos();
        $garantias=$this->Garantias();
        $hoy = new DateTime();
        $year=date('Y'); 
        $realizados=Pago::where('memo','!=','ingresar')
                    ->orderBy('updated_at','desc')
                    ->take(5)
                    ->get();
        $porvencer=Pago::where('fecha','>',date('Y-m-d'))
                    ->where('memo','ingresar')
                    ->orderBy('fecha','ASC')
                    ->take(10)
                    ->get();
        $vencido=Pago::where('fecha','<',date('Y-m-d'))
                    ->where('memo','ingresar')
                    ->orderBy('fecha','ASC')
                    ->get();
       
    
                  
        return view("dashboard.index")->with('preventivo',$preventivo)->with("arriendos",$arriendos)->with("correctivos",$correctivos)->with("data", $cantidadequipos)->with('garantias',$garantias)->with('realizados',$realizados)->with('porvencer',$porvencer)->with('hoy',$hoy)->with('vencido',$vencido)->with('mp',$mp);
    }

    

    public function EquiposMedicos(){
        $critico=Equipo::where("eq","Critico")->count();
        $relevante=Equipo::where("eq","Relevante")->count();
        $sineq=Equipo::where("eq","Sin")->count();
        $total=$critico+$relevante+$sineq;
        $arr=[$critico,$relevante,$sineq];
        return $arr;
    }
    public function Garantias(){
        $fecha=new DateTime();
        $preventivo=$this->ConveniosMantenimiento();
        $arriendos=$this->ConveniosArriendo();
        $con=Garantia::where('fin','>',$fecha)->count();
        $con+=$preventivo["equipos"]+$arriendos["equipos"];
        $sin=Equipo::all()->count()-$con;
        $arr="";
        $arr=[$con,$sin];
        return $arr;
    }
    public function PlanMP(){
        $year=date('Y');
        $enero=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',1)->count();
        $febrero=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',2)->count();
        $marzo=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',3)->count();
        $abril=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',4)->count();
        $mayo=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',5)->count();
        $junio=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',6)->count();
        $julio=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',7)->count();
        $agosto=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',8)->count();
        $septiembre=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',9)->count();
        $octubre=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',10)->count();
        $noviembre=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',11)->count();
        $diciembre=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',12)->count();
        $res ="";
        $res= [$enero,$febrero,$marzo,$abril,$mayo,$junio,$julio,$agosto,$septiembre,$octubre,$noviembre,$diciembre];
        return $res;
    }

    public function EquiposMP(){
        $equipos= array();
        $year=date('Y');
        $iconmp=Planificamp::whereYear('fechacorte',$year)->where('tipomp','interna')->get();
        $equipos['interno']=$iconmp->unique('equipo')->count();
        $econmp=Planificamp::whereYear('fechacorte',$year)->where('tipomp','!=','interna')->get();
        $equipos['externo']=$econmp->unique('equipo')->count();
        //dd($equipos);
        return $equipos;
        

    }
    public function CumplimientoMP(){
        $meses=['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
        $year=date('Y');
        $mp=array();
        $i=1;
        foreach($meses as $mes){
            $mp[$mes]['interno_planificado']=Planificamp::whereYear('fechacorte',$year)->where('tipomp','interna')->whereMonth('fechacorte',$i)->count();
            $mp[$mes]['externo_planificado']=Planificamp::whereYear('fechacorte',$year)->where('tipomp','!=','interna')->whereMonth('fechacorte',$i)->count();
            $mp[$mes]['interno_ejecutado']=Planificamp::whereYear('fechacorte',$year)->where('tipomp','interna')->whereMonth('fechacorte',$i)->where('fechaprogramacion','!=','null')->count();
            $mp[$mes]['externo_ejecutado']=Planificamp::whereYear('fechacorte',$year)->where('tipomp','!=','interna')->whereMonth('fechacorte',$i)->where('fechaprogramacion','!=','null')->count();
            $mp[$mes]['2.1']=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',$i)->join('equipos','equipos.id','=','planificamps.equipo')->where('equipos.eq','=','Critico')->count();
            $mp[$mes]['2.2']=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',$i)->join('equipos','equipos.id','=','planificamps.equipo')->where('equipos.eq','=','Relevante')->count();
            $i++;
        }
         return $mp;
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mes=date('m');
        $year=date('Y');
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $ejecucion=$this->CumplimientoMP();
        $mpsubidas=Planificamp::orderby('updated_at','Desc')->where('fechaprogramacion','!=','null')->take(50)->get();
        $mpporvencer=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte','>',$mes)->take(50)->orderby('fechacorte','ASC')->get();
        $mpvencida=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte','<',$mes)->where('fechaprogramacion',null)->take(50)->orderby('fechacorte','ASC')->get();
        return view ('dashboard.ejecucionmp')->with('ejecucion',$ejecucion)->with('subidas',$mpsubidas)->with('porvencer',$mpporvencer)->with('vencido',$mpvencida)->with('meses',$meses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
   
    public function Mantenciones($year){
        $datos=array();
        for($i=1;$i<13;$i++){
            $datos[$i.'.1']=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',$i)->count();
            $datos[$i.'.2']=Planificamp::whereYear('fechacorte',$year)->whereMonth('fechacorte',$i)->whereYear('fechaprogramacion',$year)->count();
        }
        return $datos;
    }

    public function search(Request $request)
    {
        $term = $request->get('term');
        $querys = Equipo::where('inventario', 'LIKE', '%' . $term . '%')
            ->orWhere('serie', 'LIKE', '%' . $term . '%')
            ->orWhere('id', 'LIKE', '%' . $term . '%')->get();
        $data = [];
        foreach ($querys as $query) {
            $data[] = [
                'label' =>$query->id." - ". $query->inventario . ' - ' . $query->serie . ' - ' . $query->Familia->nombre . ' - ' . $query->Marca->marca,
                'id'    =>$query->id
            ];
        }
        return $data;
    }
}
