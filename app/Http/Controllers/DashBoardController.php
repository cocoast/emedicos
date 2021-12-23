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


class DashBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preventivo=$this->ConveniosMantenimiento();
        $arriendos=$this->ConveniosArriendo();
        $correctivos=$this->ConveniosCorrectivos();
        $cantidadequipos=$this->EquiposMedicos();
        $garantias=$this->Garantias();
        $hoy = new DateTime(); 
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
                  
        return view("dashboard.index")->with('preventivo',$preventivo)->with("arriendos",$arriendos)->with("correctivos",$correctivos)->with("data", $cantidadequipos)->with('garantias',$garantias)->with('realizados',$realizados)->with('porvencer',$porvencer)->with('hoy',$hoy)->with('vencido',$vencido);

        
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
        $correc=Convenio::where('tipoconvenio','Correctivo')->count();
        $tcorrec=0;
        $tvalor=0;
        $correctivos=Convenio::where('tipoconvenio','Correctivo')->get();
         foreach($correctivos as $correctivo){
            //dd($correctivo);
            $pagos=Pago::where('convenio',$correctivo->id)->where('fecha','LIKE','%'.$year)->where('estado','Generado')->get();
            $tvalor+=$correctivo->valor;
            foreach($pagos as $pago)
                $tcorrec=$tcorrec+$pago->valor;
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
}
