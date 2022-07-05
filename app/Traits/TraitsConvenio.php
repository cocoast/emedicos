<?php
namespace App\Traits;
use App\Models\Convenio;
use App\Models\EquipoConvenio;
use App\Models\Pago;
use DateTime;

trait TraitsConvenio{

 public function ConveniosMantenimiento(){
        $year=date('Y');
        $preventivos=Convenio::where('tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->get();
        $totalanual=0;
        $totalpagado=0;
        $totalsaldo=0;
        $equipos=0;
        $enero=0;
         foreach($preventivos as $preventivo){
            $equipos+=EquipoConvenio::where('convenio',$preventivo->id)->count();
            $pagos=Pago::where('convenio',$preventivo->id)->whereYear('fecha',$year)->get();
            $enero+=Pago::where('convenio',$preventivo->id)->where('estado', 'Generado')->whereYear('fecha',$year)->whereMonth('fecha','1')->count();
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
        //dd($enero);
        $arr="";
        $arr=   [
            "total"    	=>  $totalanual,
            "pagado"   	=>  $totalpagado,
            "porpagar"	=> 	$totalsaldo,
            "cantidad" 	=>  $preventivos->count(),
            "equipos"  	=>  $equipos
             ];
        return $arr;
}
public function ConveniosArriendo(){
        $year=date('Y');
        $arriendos=Convenio::where('tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->get();
        $donacion=Convenio::where('tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->get();
        $totalanualarriendo=0;
        $totalpagadoarriendo=0;
        $totalsaldoarriendo=0;
        $totalanualdonacion=0;
        $totalpagadodonacion=0;
        $totalsaldodonacion=0;
        $equipos=0;
        foreach($donacion as $don){
            $equipos+=EquipoConvenio::where('convenio',$don->id)->count();
            $pagos=Pago::where('convenio','=',$don->id)->whereYear('fecha',$year)->get();
            foreach($pagos as $pago){
                if($pago->valor!="ingresar"){
                $totalanualdonacion=(int)$totalanualdonacion+(int)$pago->valor;
                $totalpagadodonacion=(int)$totalpagadodonacion+(int)$pago->valor;
                }
            else{
                $pa=$don->meses/$don->frecuenciapago;
                $couta=EquipoConvenio::where('convenio',$pago->convenio)->sum('valor')/$pa;
                $totalanualdonacion=$totalanualdonacion+$couta;
                $totalsaldodonacion=$totalsaldodonacion+$couta;
                }
            }
        }
         foreach($arriendos as $preventivo){
            $equipos+=EquipoConvenio::where('convenio',$preventivo->id)->count();
            $pagos=Pago::where('convenio','=',$preventivo->id)->where('fecha','LIKE',$year.'%')->get();
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
            "cantidad"     =>  $donacion->count()+$arriendos->count(),
            "tarriendo"    =>  $totalanualarriendo,
            "parriendo"    =>  $totalpagadoarriendo,
            "sarriendo"    =>  $totalsaldoarriendo,
            "cantarrie"    =>  $arriendos->count(),
            "tdonacion"    =>  $totalanualdonacion,
            "pdonacion"    =>  $totalpagadodonacion,
            "sdonacion"    =>  $totalpagadodonacion,
            "cantdon"      =>  $donacion->count() 
                ];
        return $arr;
    }


    public function ConveniosCorrectivos(){
        $year=date('Y');
        $correctivos=Convenio::where('tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->get();
        $pagado=0;
        $presupuesto=0;
        $pagoanual=0;
        
        foreach($correctivos as $correctivo){
        	if(date('Y',strtotime($correctivo->fechafin))>$year){
        		$presupuesto+=($correctivo->valor/$correctivo->meses)*12;	
        	}
        	else
        		$presupuesto+=($correctivo->valor/$correctivo->meses)*(int)date('m',strtotime($correctivo->fechafin));
            $pagos=Pago::where('convenio',$correctivo->id)->where('estado','Generado')->get();
          	foreach($pagos as $pago){
          		if(date('Y',strtotime($pago->fecha))==$year && is_numeric($pago->valor) )
          			$pagoanual+=$pago->valor;
                if(is_numeric($pago->valor)){
                    $valor=$pago->valor;
                    }
                    else
                        $valor=0;
                    $pagado+=$valor;
                }
            }

        $arr="";
        $arr=   [
            "pagado"       	=>  $pagado,
            "pagoanual"		=>	$pagoanual,
            "presupuesto"	=>	$presupuesto,
            "total"         =>  $correctivos->sum('valor'),
            "saldo"			=>	$correctivos->sum('valor')-$pagado,
            "cantidad"     	=>  $correctivos->count(),
                ];
        return $arr;

    }
    public function GastoPreventivoMensual($year){

        $mensual=array();
        $generado="Generado";
        $mensual[1]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','1')->select('pagos.*')->sum('pagos.valor');
        $mensual[2]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','2')->select('pagos.*')->sum('pagos.valor');
        $mensual[3]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','3')->select('pagos.*')->sum('pagos.valor');
        $mensual[4]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','4')->select('pagos.*')->sum('pagos.valor');
        $mensual[5]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','5')->select('pagos.*')->sum('pagos.valor');
        $mensual[6]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','6')->select('pagos.*')->sum('pagos.valor');
        $mensual[7]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','7')->select('pagos.*')->sum('pagos.valor');
        $mensual[8]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','8')->select('pagos.*')->sum('pagos.valor');
        $mensual[9]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','9')->select('pagos.*')->sum('pagos.valor');
        $mensual[10]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','10')->select('pagos.*')->sum('pagos.valor');
        $mensual[11]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','11')->select('pagos.*')->sum('pagos.valor');
        $mensual[12]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Mantenimiento')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','12')->select('pagos.*')->sum('pagos.valor');
   
        return $mensual;
    }
    public function GastoCorrectivoMensual($year){
         $mensual=array();
        $generado="Generado";
        $mensual[1]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-01-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[2]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-02-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[3]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-03-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[4]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-04-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[5]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-05-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[6]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-06-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[7]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-07-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[8]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-08-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[9]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-09-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[10]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-10-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[11]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-11-%')->select('pagos.*')->sum('pagos.valor');
        $mensual[12]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Correctivo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-12-%')->select('pagos.*')->sum('pagos.valor');
   
        return $mensual;
    }
    public function GastoDonacionMensual($year){
            $mensual=array();
        $generado="Generado";
        $mensual[1]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','1')->select('pagos.*')->sum('pagos.valor');
        $mensual[2]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','2')->select('pagos.*')->sum('pagos.valor');
        $mensual[3]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','3')->select('pagos.*')->sum('pagos.valor');
        $mensual[4]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','4')->select('pagos.*')->sum('pagos.valor');
        $mensual[5]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','5')->select('pagos.*')->sum('pagos.valor');
        $mensual[6]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','6')->select('pagos.*')->sum('pagos.valor');
        $mensual[7]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','7')->select('pagos.*')->sum('pagos.valor');
        $mensual[8]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','8')->select('pagos.*')->sum('pagos.valor');
        $mensual[9]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','9')->select('pagos.*')->sum('pagos.valor');
        $mensual[10]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','10')->select('pagos.*')->sum('pagos.valor');
        $mensual[11]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','11')->select('pagos.*')->sum('pagos.valor');
        $mensual[12]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo con Donacion')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','12')->select('pagos.*')->sum('pagos.valor');
   
        return $mensual;
    }
    public function GastoArriendoMensual($year){
             $mensual=array();
        $generado="Generado";
        $mensual[1]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','1')->select('pagos.*')->sum('pagos.valor');
        $mensual[2]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','2')->select('pagos.*')->sum('pagos.valor');
        $mensual[3]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','3')->select('pagos.*')->sum('pagos.valor');
        $mensual[4]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','4')->select('pagos.*')->sum('pagos.valor');
        $mensual[5]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','5')->select('pagos.*')->sum('pagos.valor');
        $mensual[6]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','6')->select('pagos.*')->sum('pagos.valor');
        $mensual[7]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','7')->select('pagos.*')->sum('pagos.valor');
        $mensual[8]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','8')->select('pagos.*')->sum('pagos.valor');
        $mensual[9]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','9')->select('pagos.*')->sum('pagos.valor');
        $mensual[10]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','10')->select('pagos.*')->sum('pagos.valor');
        $mensual[11]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','11')->select('pagos.*')->sum('pagos.valor');
        $mensual[12]=Pago::join('convenios','convenios.id','=','pagos.convenio')->where('convenios.tipoconvenio','Arriendo')->whereYear('fechafin','>=',$year)->where('pagos.estado', $generado)->whereYear('pagos.fecha',$year)->whereMonth('pagos.fecha','12')->select('pagos.*')->sum('pagos.valor');
   
        return $mensual;
    }
    public function DesgloceGasto($year){
        $convenios=Convenio::whereYear('fechafin','>=',$year)->get();
        $pagos=array();
        foreach($convenios as $convenio){
            $pagos[$convenio->id][1]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-01-%')->sum('valor');
            $pagos[$convenio->id][2]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-02-%')->sum('valor');
            $pagos[$convenio->id][3]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-03-%')->sum('valor');
            $pagos[$convenio->id][4]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-04-%')->sum('valor');
            $pagos[$convenio->id][5]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-05-%')->sum('valor');
            $pagos[$convenio->id][6]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-06-%')->sum('valor');
            $pagos[$convenio->id][7]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-07-%')->sum('valor');
            $pagos[$convenio->id][8]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-08-%')->sum('valor');
            $pagos[$convenio->id][9]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-09-%')->sum('valor');
            $pagos[$convenio->id][10]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-10-%')->sum('valor');
            $pagos[$convenio->id][11]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-11-%')->sum('valor');
            $pagos[$convenio->id][12]=Pago::where('convenio',$convenio->id)->where('pagos.fecha','LIKE','%'.$year.'%')->where('pagos.fecha','LIKE','%-12-%')->sum('valor');
        }
        
        return $pagos;
    }


}
  ?>    