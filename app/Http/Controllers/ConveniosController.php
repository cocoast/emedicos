<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Models\EquipoConvenio;
use App\Models\Pago;
use DateTime;
use DatePeriod;
use DateInterval;

class ConveniosController extends Controller
{
    public function __construct(){
        $this->middleware('can:convenio.index')->only('index');
        $this->middleware('can:convenio.edit')->only('edit','update');
        $this->middleware('can:convenio.create')->only('create','store');
        $this->middleware('can:convenio.destroy')->only('destroy');
        $this->middleware('can:convenio.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $hoy=date('Y-m-d');
        $fecha=new DateTime();
        $year=$fecha->format('Y');
        $preventivos=Convenio::where('tipoconvenio','Mantenimiento')->where('fechafin','>',$hoy)->get();
        $arriendos=Convenio::where('tipoconvenio','Arriendo')->where('fechafin','>',$hoy)->get();
        $donacion=Convenio::where('tipoconvenio','Arriendo con Donacion')->where('fechafin','>',$hoy)->get();
        //dd($donacion);
        $conmantt=Convenio::where('tipoconvenio','Mantenimiento')->where('fechafin','>',$hoy)->count();
        $arr=   Convenio::where('tipoconvenio','Arriendo')->where('fechafin','>',$hoy)->count()+
                Convenio::where('tipoconvenio','Arriendo con Donacion')->where('fechafin','>',$hoy)->count();
        $correc=Convenio::where('tipoconvenio','Correctivo')->where('fechafin','>',$hoy)->count();
        $totalanualpreventivo=0;
        $totalpagado=0;
        $totalsaldo=0;
        $totalanualarriendo=0;
        $totalpagadoarriendo=0;
        $totalsaldoarriendo=0;
        $totalanualdonacion=0;
        $totalpagadodonacion=0;
        $totalsaldodonacion=0;
        $tcorrec=0;
        $correctivos=Convenio::where('tipoconvenio','Correctivo')->where('fechafin','>',$hoy)->get();
         foreach($correctivos as $correctivo){
            //dd($correctivo);
            $pagos=Pago::where('convenio',$correctivo->id)->where('fecha','LIKE','%'.$year)->where('estado','Generado')->get();
            //dd($pagos);
            foreach($pagos as $pago)
                if(is_numeric($pago->valor)){
                    $valor=$pago->valor;
                }
                else
                    $valor=0;
                $tcorrec=$tcorrec+$valor;
            }
            //dd($tcorrec);   
        foreach($preventivos as $preventivo){
            $pagos=Pago::where('convenio','=',$preventivo->id)->where('fecha','LIKE',$year.'%')->get();
            //dd($pagos);
            foreach($pagos as $pago){
                if($pago->valor!="ingresar"){
                $totalanualpreventivo=$totalanualpreventivo+$pago->valor;
                $totalpagado=$totalpagado+$pago->valor;
                }
            else{
                $pa=$preventivo->meses/$preventivo->frecuenciapago;
                $couta=EquipoConvenio::where('convenio',$pago->convenio)->sum('valor')/$pa;
                //dd($couta);
                $totalanualpreventivo=$totalanualpreventivo+$couta;
                $totalsaldo=$totalsaldo+$couta;
                }
            }
        }
        foreach($donacion as $don){
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
         
            
            $convenios=Convenio::all();
            $totalanualarriendo=$totalanualarriendo+$totalanualdonacion;
            $totalpagadoarriendo=$totalpagadoarriendo+$totalpagadodonacion;
            $totalsaldoarriendo=$totalsaldoarriendo+$totalsaldodonacion;
            //dd($totalsaldodonacion);
        return view('convenio.index')->with('convenios',$convenios)->with('totalanualpreventivo',$totalanualpreventivo)->with('totalpagado',$totalpagado)->with('totalsaldo',$totalsaldo)->with('conmantt',$conmantt)->with('arr',$arr)->with('correc',$correc)->with('totalanualarriendo',$totalanualarriendo)->with('totalpagadoarriendo',$totalpagadoarriendo)->with('totalsaldoarriendo',$totalsaldoarriendo)->with('tcorrec',$tcorrec)->with('hoy',$hoy);
                                                    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function seguimiento(){
        $realizados=Pago::where('estado','=','generado')
                    ->where('oc','=','ingresar')
                    ->orderBy('fecha','asc')
                    ->get();
                    return view('convenio.seguimiento')->with('realizados',$realizados);
    }
     public function seguimientomemos(){
        $realizados=Pago::where('estado','=','generado')
                    ->where('link',NULL)
                    ->where('fecha', '>','2021-01-01' )
                    ->orderBy('fecha','asc')
                    ->get();
                    return view('convenio.seguimientomemo')->with('realizados',$realizados);
    }
    public function create()
    {
        $proveedor=Proveedor::orderBy('nombre','ASC')->get()->pluck('nombre','id');
        return view('convenio.create')->with('proveedor',$proveedor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $convenio=new Convenio();
        $proveedor=explode(' - ', $request->get('proveedor'))[0];
        if($request->get('tipoconvenio')=='Correctivo'){
            $convenio->nombre=$request->get('nombre');
            $convenio->licitacion=$request->get('licitacion');
            $convenio->solicitud=$request->get('solicitud');
            $convenio->resolucion=$request->get('resolucion');
            $convenio->fecharesolucion=$request->get('fecharesolucion');
            $convenio->fechaincio=$request->get('fechainicio');
            $convenio->fechafin=$request->get('fechafin');
            $convenio->meses=$request->get('meses');
            $convenio->frecuenciapago='Manual';
            $convenio->link=$request->get('link');
            $convenio->valor=$request->get('valor');
            $convenio->tipoconvenio=$request->get('tipoconvenio');
            $convenio->proveedor=$proveedor;
            $convenio->save();
             return redirect ('/convenio');
        }
        else{
        $convenio->nombre=$request->get('nombre');
        $convenio->licitacion=$request->get('licitacion');
        $convenio->solicitud=$request->get('solicitud');
        $convenio->resolucion=$request->get('resolucion');
        $convenio->fecharesolucion=$request->get('fecharesolucion');
        $convenio->fechaincio=$request->get('fechainicio');
        $convenio->fechafin=$request->get('fechafin');
        $convenio->meses=$request->get('meses');
        $convenio->frecuenciapago=$request->get('frecuenciapago');
        $convenio->valor=$request->get('valor');
        $convenio->link=$request->get('link');
        $convenio->tipoconvenio=$request->get('tipoconvenio');
        $convenio->proveedor=$proveedor;
        //  dd($convenio);
        $convenio->save();
        $cantidadpagos=$convenio->meses/$convenio->frecuenciapago;
        for ($i=0; $i < $cantidadpagos; $i++) { 
            $pagos=new Pago();
            $intervalo=new DateInterval('P'.$convenio->frecuenciapago*($i+1).'M');
            $fecha=new DateTime($convenio->fechaincio);
            $fecha=$fecha->add(new DateInterval('P'.$convenio->frecuenciapago*($i+1).'M'));
            $pagos->fecha=$fecha;
            $pagos->periodo=$i+1;
            $pagos->memo="ingresar";
            $pagos->estado="Pendiente";
            $pagos->oc="ingresar";
            $pagos->valor="ingresar";
            $pagos->convenio=$convenio->id;
            $pagos->save();
        }
         return redirect ('/convenio');
     }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $convenio=Convenio::find($id);
        $equiposconvenios=EquipoConvenio::where('convenio',$convenio->id)->get();
        $pagospendientes=Pago::where('convenio',$convenio->id)->where('estado','Pendiente')->get();
        $pagosrealizados=Pago::where('convenio',$convenio->id)->where('estado','Generado')->get();
        $gasto=Pago::where('convenio',$convenio->id)->where('estado','Generado')->sum('valor');
        $carpeta='storage/convenios/'.$convenio->id."/";
        $res = array();
        if(@dir($carpeta)){
            $dir=@dir($carpeta);
            while(($archivo = $dir->read())!==false){
                if($archivo[0]==".") continue;
                if(is_readable($carpeta.$archivo)&&$archivo!="pagos"){
                    $res[]=array(
                        "Nombre" => $archivo,
                        
                        "direccion" =>$carpeta.$archivo
                    );}
            }
            $dir->close();
        }
        else
                $res=null;
            //dd($res);
        return view('convenio.show')->with('convenio',$convenio)->with('equiposconvenios',$equiposconvenios)->with('pagospendientes',$pagospendientes)->with('pagosrealizados',$pagosrealizados)->with('gasto',$gasto)->with('res',$res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $convenio=Convenio::find($id);
        $proveedors=Proveedor::orderBy('nombre','ASC')->get()->pluck('nombre','id');
       
        return view ('convenio.edit')->with('convenio',$convenio)->with('proveedors',$proveedors);

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
        $convenio=Convenio::find($id);
        $ninicio=new DateTime($request->fechainicio);
        $nfin=new DateTime($request->fechafin);
        $cinicio=new DateTime($convenio->fechaincio);
        $cfin=new DateTime($convenio->fechafin);
        $periodospagos=$request->meses/$request->frecuenciapago;

        $count=1;
        $aux="";
        if($convenio->tipoconvenio!="Correctivo"){
            if($ninicio!=$cinicio||$cfin!=$nfin||$convenio->meses!=$request->meses||$convenio->frecuenciapago!=$request->frecuenciapago){
                $pagos=Pago::where('convenio',$convenio->id)->get();
                foreach ($pagos as $pago) {
                    $pagofecha=new DateTime($pago->fecha);
                    //dd($pagofecha);
                    //dd($ninicio->add(new DateInterval('P'.$convenio->frecuenciapago*($count).'M')));
                    //dd($pagofecha!=$ninicio->add(new DateInterval('P'.$convenio->frecuenciapago*($count).'M')));
                    if($pago->periodo!=$count){
                        $pago->periodo=$count;
                        
                    }
                    $nueva=$ninicio->add(new DateInterval('P'.$convenio->frecuenciapago*(1).'M'));
                    if($pagofecha!=$nueva){
                        $pago->fecha=$nueva;
                        //$aux=$aux.' - Fecha '. date('Y-m-d',strtotime($pago->fecha));
                    }
                    $pago->save();
                    $aux=$aux. ' \n'.' Contador '.$count;
                    $aux=$aux.' - Fecha '.$nueva->format('d-m-Y');
                    $count=$count+1;
                }
                $count=$pagos->count();
                while($count<$periodospagos){
                    $pago=new Pago();
                    $pago->fecha=$ninicio->add(new DateInterval('P'.$convenio->frecuenciapago*(1).'M'));
                    $pago->periodo=$count+1;
                    $pago->memo="ingresar";
                    $pago->estado="Pendiente";
                    $pago->oc="ingresar";
                    $pago->valor="ingresar";
                    $pago->convenio=$convenio->id;
                    $pago->save();
                    $count=$count+1;
                }

                                
            }
        }
        $convenio->nombre=$request->get('nombre');
        $convenio->licitacion=$request->get('licitacion');
        $convenio->solicitud=$request->get('solicitud');
        $convenio->resolucion=$request->get('resolucion');
        $convenio->fecharesolucion=$request->get('fecharesolucion');
        $convenio->fechaincio=$request->get('fechainicio');
        $convenio->fechafin=$request->get('fechafin');
        $convenio->meses=$request->get('meses');
        $convenio->frecuenciapago=$request->get('frecuenciapago');
        $convenio->valor=$request->get('valor');
        $convenio->tipoconvenio=$request->get('tipoconvenio');
        $convenio->link=$request->get('link');
        $convenio->proveedor=$request->get('proveedorid');
        $convenio->save();
        $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/convenios/'.$convenio->id."/";
        if(!file_exists($carpeta))
            mkdir($carpeta,0777,true);
        if($request->hasFile("documento")){
            $file=$request->file('documento');
            $nombre=$request->get("archivo").".".$file->guessExtension();
            if($file->guessExtension()=="pdf"){
               $file->move($carpeta, $nombre);
            }
            else
                dd("no es .pdf");
        }


         return redirect ('/convenio');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $convenio=Convenio::find($id);
        $convenio->delete();
        return redirect('/convenio');
    }
     public function subir($id)
    {
        $convenio=Convenio::find($id);
        return view('convenio.file')->with('convenio',$convenio);
    }
    public function archivo(Request $request, $id)
    {
        $convenio=Convenio::find($id);
        $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/convenios/'.$convenio->id."/";
        if(!file_exists($carpeta)){
            mkdir($carpeta,0777,true);
        }
        if($request->hasFile("documento")){
            $file=$request->file('documento');
            $nombre=$request->get("archivo").".".$file->guessExtension();
            if($file->guessExtension()=="pdf"){
               $file->move($carpeta, $nombre);
               return redirect ('/convenio/'.$convenio->id);
            }
            else
                dd("no es .pdf");
        }
    }
    public function Baja($id){
        $convenio=Convenio::find($id);
        $pagos=Pago::where('convenio',$convenio->id)->get();
        return view('convenio.baja')->with('convenio',$convenio)->with('pagos',$pagos);
    }
    public function darBaja(Request $request,$id){
        $convenio=Convenio::find($id);
        $ultimopago=Pago::find($request->get('pago'));
        $pagosdelete=Pago::where('convenio',$convenio->id)->where('periodo','>',$ultimopago->periodo)->get();
        $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/convenios/'.$convenio->id."/";
        if(!file_exists($carpeta)){
            mkdir($carpeta,0777,true);
        }
        if($request->hasFile("documento")){
            $file=$request->file('documento');
            $nombre="Resolucion Termino Contrato.".$file->guessExtension();
            if($file->guessExtension()=="pdf"){
               $file->move($carpeta, $nombre);
               foreach($pagosdelete as $pago){
                    $pago->delete();
                }
                $convenio->fechafin=date('d-m-Y',strtotime($ultimopago->fecha));
                $convenio->save();
            }
        }
            else
                dd("no es .pdf");
        return redirect('convenio/')->with('funciono');

    }
}
