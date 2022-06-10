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


class DashBoardController extends Controller
{
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
                return $this->DashLicitaciones();
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
        return view("dashboard.licitacion");
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
       
        $mantenciones=$this->Mantenciones($year);
                  
        return view("dashboard.index")->with('preventivo',$preventivo)->with("arriendos",$arriendos)->with("correctivos",$correctivos)->with("data", $cantidadequipos)->with('garantias',$garantias)->with('realizados',$realizados)->with('porvencer',$porvencer)->with('hoy',$hoy)->with('vencido',$vencido)->with('mp',$mp)->with('mantenciones',json_encode($mantenciones));
    }

    public function ConveniosMantenimiento(){
        $fecha=new DateTime();
        $year=$fecha->format('Y');
        $preventivos=Convenio::where('tipoconvenio','Mantenimiento')->get();
        $conmantt=Convenio::where('tipoconvenio','Mantenimiento')->where('fechafin','>',$fecha)->count();
        $totalanual=0;
        $totalpagado=0;
        $totalsaldo=0;
        $equipos=0;
         foreach($preventivos as $preventivo){
            $equipos+=EquipoConvenio::where('convenio',$preventivo->id)->count();
            $pagos=Pago::where('convenio','=',$preventivo->id)->where('fecha','LIKE',$year.'%')->get();
            //dd($pagos);
            foreach($pagos as $pago){
                if($pago->valor!="ingresar"){
                $totalanual=$totalanual+$pago->valor;
                $totalpagado=$totalpagado+$pago->valor;
                }
            else{
                $pa=$preventivo->meses/$preventivo->frecuenciapago;
                $couta=EquipoConvenio::where('convenio',$pago->convenio)->sum('valor')/$pa;
                //dd($couta);
                $totalanual=$totalanual+$couta;
                $totalsaldo=$totalsaldo+$couta;
                }
            }
        }
        $arr="";
        $arr=   [
            "total"    =>  $totalanual,
            "pagado"   =>  $totalpagado,
            "cantidad" =>  $conmantt,
            "equipos"  =>  $equipos
             ];
        return $arr;
}
    public function ConveniosArriendo(){
        $fecha=new DateTime();
        $year=$fecha->format('Y');
        
        $arriendos=Convenio::where('tipoconvenio','Arriendo')->get();
        $donacion=Convenio::where('tipoconvenio','Arriendo con Donacion')->get();
        $arrtotal=Convenio::where('tipoconvenio','Arriendo')->where('fechafin','>',$fecha)->count()+Convenio::where('tipoconvenio','Arriendo con Donacion')->where('fechafin','>',$fecha)->count();
        $arrdon=Convenio::where('tipoconvenio','Arriendo con Donacion')->where('fechafin','>',$fecha)->count();
        $arrcount=Convenio::where('tipoconvenio','Arriendo')->where('fechafin','>',$fecha)->count();
        $totalanualarriendo=0;
        $totalpagadoarriendo=0;
        $totalsaldoarriendo=0;
        $totalanualdonacion=0;
        $totalpagadodonacion=0;
        $totalsaldodonacion=0;
         $equipos=0;
        foreach($donacion as $don){
             $equipos+=EquipoConvenio::where('convenio',$don->id)->count();
            $pagos=Pago::where('convenio','=',$don->id)->where('fecha','LIKE',$year.'%')->get();
            foreach($pagos as $pago){
                if($pago->valor!="ingresar"){
                $totalanualdonacion=(int)$totalanualdonacion+(int)$pago->valor;
                $totalpagadodonacion=(int)$totalpagadodonacion+(int)$pago->valor;
                }
            else{
                $pa=$don->meses/$don->frecuenciapago;
                $couta=EquipoConvenio::where('convenio',$pago->convenio)->sum('valor')/$pa;
                //dd($couta);
                $totalanualdonacion=$totalanualdonacion+$couta;
                $totalsaldodonacion=$totalsaldodonacion+$couta;
                }
            }
        }
         foreach($arriendos as $preventivo){
             $equipos+=EquipoConvenio::where('convenio',$preventivo->id)->count();
            $pagos=Pago::where('convenio','=',$preventivo->id)->where('fecha','LIKE',$year.'%')->get();
            //dd($pagos);
            foreach($pagos as $pago){
                if($pago->valor!="ingresar"){
                $totalanualarriendo=$totalanualarriendo+$pago->valor;
                $totalpagadoarriendo=$totalpagadoarriendo+$pago->valor;
                }
            else{
                $pa=$preventivo->meses/$preventivo->frecuenciapago;
                $couta=EquipoConvenio::where('convenio',$pago->convenio)->sum('valor')/$pa;
                //dd($couta);
                $totalanualarriendo=$totalanualarriendo+$couta;
                $totalsaldoarriendo=$totalsaldoarriendo+$couta;
                }
            }
        }
            $totalanual=$totalanualarriendo+$totalanualdonacion;
            $totalpagado=$totalpagadoarriendo+$totalpagadodonacion;
            $totalsaldo=$totalsaldoarriendo+$totalsaldodonacion;

        $arr="";
        $arr=   [
            "total"        =>  $totalanual,
            "pagado"       =>  $totalpagado,
            "saldo"        =>  $totalsaldo,
            "equipos"      =>  $equipos,
            "cantidad"     =>  $arrtotal,
            "tarriendo"    =>  $totalanualarriendo,
            "parriendo"    =>  $totalpagadoarriendo,
            "sarriendo"    =>  $totalsaldoarriendo,
            "cantarrie"    =>  $arrcount,
            "tdonacion"    =>  $totalanualdonacion,
            "pdonacion"    =>  $totalpagadodonacion,
            "sdonacion"    =>  $totalpagadodonacion,
            "cantdon"      =>  $arrdon 
                ];
        return $arr;
    }

    public function ConveniosCorrectivos(){
        $fecha=new DateTime();
        $year=$fecha->format('Y');
        $hoy=date('Y-m-d');
        $correc=Convenio::where('tipoconvenio','Correctivo')->where('fechafin','>',$hoy)->count();
        $tcorrec=0;
        $tvalor=0;
        $correctivos=Convenio::where('tipoconvenio','Correctivo')->where('fechafin','>',$hoy)->get();
         foreach($correctivos as $correctivo){
            //dd($correctivo);
            $pagos=Pago::where('convenio',$correctivo->id)->where('estado','Generado')->get();
            $tvalor+=$correctivo->valor;
            foreach($pagos as $pago)
                if(is_numeric($pago->valor)){
                    $valor=$pago->valor;
                }
                else
                    $valor=0;
                $tcorrec=$tcorrec+$valor;
            }
        $arr="";
        $arr=   [
            "pagado"       =>  $tcorrec,
            "total"         =>  $tvalor,
            "cantidad"     =>  $correc
                ];
        return $arr;

    }

    public function EquiposMedicos(){
        $critico=Equipo::where("eq","Critico")->count();
        $relevante=Equipo::where("eq","Relevante")->count();
        $sineq=Equipo::where("eq","Sin")->count();
        $total=$critico+$relevante+$sineq;
        $arr=[$critico,$relevante,$sineq];
        /*$arr=[
            array('name'  =>  'critico'   ,   'y' =>  $critico),
            array('name'  =>  'relevante' ,   'y' =>  $relevante),
            array('name'  =>  'sineq'     ,   'y' =>  $sineq)
        ];*/
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

    public function EquiposMP(date $year){
        $equipos= array();
        $iconmp=Planificamp::whereYear('fechacorte',$year)->where('tipomp','interna')->get();
        $equipos['interno']=$iconmp->unique('equipo')->count();
        $econmp=Planificamp::whereYear('fechacorte',$year)->where('tipomp','convenio')->get();
        $equipos['externo']=$conmp->unique('equipo')->count();
        return $equipos;
        

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
