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
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Baja;

class EquipoController extends Controller
{
     public function __construct(){
        $this->middleware('can:equipo.index')->only('index');
        $this->middleware('can:equipo.edit')->only('edit','update');
        $this->middleware('can:equipo.create')->only('create','store');
        $this->middleware('can:equipo.destroy')->only('destroy');
        $this->middleware('can:equipo.show')->only('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $equipos=Equipo::all();
        
        $fecha=new DateTime();
        $fecha=$fecha->format('d-m-Y');
        $year=date('Y',strtotime($fecha));
        return view('equipo.index')->with('equipos',$equipos)->with('fecha',$fecha)->with('year',$year);
    }
      public function Grafico(){
     
        $mp=Equipo::where('familia','1')->count();
        $de=Equipo::where('familia','2')->count();
        $in=Equipo::where('familia','3')->count();
        $ma=Equipo::where('familia','4')->count();
        $md=Equipo::where('familia','5')->count();
        $vm=Equipo::where('familia','6')->count();
        $data=[
            array('name' =>'Monitor Hemodinamico','y'=>$mp),
            array('name' =>'Desfibrilador','y'  =>$de),
            array('name'=>'Incubadora','y'=>$in),
            array('name'=>'Maquina de Anestesia','y'=>$ma),
            array('name'=>'Maquina de Hemodialisis','y'=>$md),
            array('name'=>'Ventilado Mecanico','y'=>$vm),
        ];
        $data2=[
            array('name' =>'Angiografo','y'=>Equipo::where('familia','7')->count()),
            array('name' =>'Autoclave','y'  =>Equipo::where('familia','8')->count()),
            array('name'=>'Campana de Flujo','y'=>Equipo::where('familia','9')->count()),
            array('name'=>'Equipo de Frio','y'=>Equipo::where('familia','10')->count()),
            array('name'=>'Equipo de Imagenologia','y'=>Equipo::where('familia','11')->count()),
            array('name'=>'Equipo de Laboratorio','y'=>Equipo::where('familia','12')->count()),
            array('name'=>'Equipo de Rayos','y'=>Equipo::where('familia','13')->count()),
            array('name'=>'Microscopios','y'=>Equipo::where('familia','14')->count()),
            array('name'=>'Planta de Tratamiento de Agua','y'=>Equipo::where('familia','15')->count()),
            array('name'=>'Resonador','y'=>Equipo::where('familia','16')->count()),
        ];
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
        $vencido=Pago::where('fecha','<',$hoy)
                    ->where('memo','ingresar')
                    ->orderBy('fecha','ASC')
                    ->get();
                  
        
        return view ('home',["data"=>json_encode($data)])->with('data2',json_encode($data2))->with('realizados',$realizados)->with('porvencer',$porvencer)->with('hoy',$hoy)->with('vencido',$vencido);

      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$familia=Familia::orderBy('nombre','ASC')->pluck('nombre','id');
        $subfamilia=SubFamilia::orderBy('nombre','ASC')->pluck('nombre','id');
        $clase=Clase::orderBy('nombre','ASC')->pluck('nombre','id');
        $subclase=Subclase::orderBy('nombre','ASC')->pluck('nombre','id'); 

        $proveedor=Proveedor::orderBy('nombre','ASC')->get()->pluck('nombre','id');
        
        //orderBy('nombre','ASC')->pluck('nombre','rut');
        $servicioclinico=ServicioClinico::orderBy('nombre','ASC')->pluck('nombre','id');
        $modelo=Modelo::orderBy('modelo','ASC')->pluck('modelo','id');
        $marca=Marca::orderBy('marca','ASC')->pluck('marca','id');

        return view('equipo.create')->with('familia',$familia)->with('subfamilia',$subfamilia)->with('clase',$clase)->with('subclase',$subclase)->with('proveedor',$proveedor)->with('servicioclinico',$servicioclinico)->with('modelo',$modelo)->with('marca',$marca);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $proveedor=explode(' - ', $request->get('proveedor'))[0];
    $servicio=explode(' - ', $request->get('servicioclinico'))[0];
    $modelo=explode(' - ', $request->get('modelo'))[0];
    $marca=explode(' - ', $request->get('marca'))[0];
    $familia=explode(' - ', $request->get('familia'))[0];
    $subfamilia=explode(' - ', $request->get('subfamilia'))[0];
    if ($request->get('inventario')!='?') {
        if(Equipo::where('inventario',$request->get('inventario'))->where('familia',$request->get('familia'))->count()==0){
            $equipo= new Equipo();
            $equipo->inventario=$request->get('inventario');
            $equipo->serie=$request->get('serie');
            $equipo->fecha_adquisicion=$request->get('fecha_adquisicion');
            $equipo->eq=$request->get('eq');
            $equipo->fabricacion=$request->get('fabricacion');
            $equipo->tipoactivo=$request->get('tipoactivo');
            $equipo->valor=$request->get('valor');
            $equipo->archivador=$request->get('archivador');
            $equipo->familia=$familia;
            $equipo->fabricacion=$request->get('fabricacion');
           	$equipo->subfamilia=$subfamilia;
           	$equipo->clase=$request->get('clase');
           	$equipo->subclase=$request->get('subclase');
           	$equipo->modelo=$modelo;
           	$equipo->marca=$marca;
          	$equipo->proveedor=$proveedor;
            $equipo->licitacion=$request->get('licitacion');
            $equipo->oc=$request->get('oc');
           	$equipo->servicioclinico=$servicio;
            //creacion de Carpeta del equipo y subida del acta
            $eq="";
            if($equipo->eq=="Critico")
                $eq="2.1";
            if($equipo->eq=="Relevante")
                $eq="2.2";
            if($equipo->eq=="Sin")
                $eq="Sin";
            
            $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario."/";
            $carpetanombre='/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario."/";
            
            if(!file_exists($carpeta))
                mkdir($carpeta,0777,true);
            if($request->hasFile('documento')){
                $fecha=new DateTime($equipo->fecha_adquisicion);
                $nombre=$equipo->inventario.'_'.$fecha->format('Y').'_ACTA_'.$fecha->format('m');
                $file=$request->file('documento');
                $nombre=$nombre.'.pdf';
                if($file->guessExtension()=="pdf"){    
                    $file->move($carpeta, $nombre);
                }
            }
            $equipo->save();
        //Ingreso de Garantias
        if($request->get('fin')!=null){
            $garantia=new Garantia();
            $inicio=DateTime::createFromFormat('d-m-Y',date('d-m-Y',strtotime($request->get('fecha_adquisicion'))));
            $garantia->inicio=$inicio;
            $garantia->fin=$request->get('fin');
            $garantia->mp=$request->get('mpa');
            $garantia->mp_disponible=$request->get('mp');
            $garantia->frecuencia=$request->get('frecuencia');
            $garantia->equipo=$equipo->id;
            $garantia->proveedor=$proveedor;
            $garantia->save();
        }
        return redirect ('/equipo')->with('message', 'El Equipo '.$equipo->inventario.' a sido Ingresado')->with('status','alert alert-success');
    }
        else{
            $equipo=Equipo::where('inventario',$request->get('inventario'))->where('familia',$request->get('familia'))->first();
            return redirect ('/equipo')->with('message', 'El Equipo '.$equipo->inventario.' se encuentra ingresado')->with('status','alert alert-danger');              
        }
    }
    else{
        if(Equipo::where('serie',$request->get('serie'))->where('familia',$request->get('familia'))->count()==0){
            $marca=explode(' - ', $request->get('marca'))[0];
            $modelo=explode(' - ', $request->get('modelo'))[0];
            $proveedor=explode(' - ', $request->get('proveedor'))[0];
            $sc=explode(' - ', $request->get('servicioclinico'))[0];
            $familia=explode(' - ', $request->get('familia'))[0];
            $subfamilia=explode(' - ', $request->get('subfamilia'))[0];
            $equipo= new Equipo();
            $equipo->inventario=$request->get('inventario');
            $equipo->serie=$request->get('serie');
            $equipo->fecha_adquisicion=$request->get('fecha_adquisicion');
            $equipo->eq=$request->get('eq');
            $equipo->fabricacion=$request->get('fabricacion');
            $equipo->tipoactivo=$request->get('tipoactivo');
            $equipo->valor=$request->get('valor');
            $equipo->archivador=$request->get('archivador');
            $equipo->familia=$familia;
            $equipo->fabricacion=$request->get('fabricacion');
            $equipo->subfamilia=$subfamilia;
            $equipo->clase=$request->get('clase');
            $equipo->subclase=$request->get('subclase');
            $equipo->modelo=$modelo;
            $equipo->marca=$marca;
            $equipo->proveedor=$proveedor;
            $equipo->servicioclinico=$sc;
            //Creacion de Carpeta y subida del Acta 
            $eq="";
            if($equipo->eq=="Critico")
                $eq="2.1";
            if($equipo->eq=="Relevante")
                $eq="2.2";
            if($equipo->eq=="Sin")
                $eq="Sin";
            
            $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie."/";
            $carpetanombre='/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie."/";
            
            if(!file_exists($carpeta))
                mkdir($carpeta,0777,true);
            if($request->hasFile('documento')){
                $fecha=new DateTime($equipo->fecha_adquisicion);
                $nombre=$equipo->inventario.'_'.$fecha->format('Y').'_ACTA_'.$fecha->format('m');
                $file=$request->file('documento');
                $nombre=$nombre.'.pdf';
                if($file->guessExtension()=="pdf"){    
                    $file->move($carpeta, $nombre);
                }
            }
            $equipo->save();
        //Ingreso de Garantias
        if($request->get('fin')!=null){
            $garantia=new Garantia();
            $fecha=DateTime::createFromFormat('d-m-Y',$request->get('fecha_adquisicion'));
            $garantia->inicio=$fecha;
            $garantia->fin=$request->get('fin');
            $garantia->mp=$request->get('mp');
            $garantia->frecuencia=$request->get('frecuencia');
            $garantia->equipo=$equipo->id;
            $garantia->proveedor=$request->get('proveedor');
            $garantia->save();
        }
        return redirect ('/equipo')->with('message', 'El Equipo '.$equipo->serie.' a sido Ingresado')->with('status','alert alert-success');
    }
        else{
            $equipo=Equipo::where('serie',$request->get('serie'))->where('familia',$request->get('familia'))->first();
            return redirect ('/equipo')->with('message', 'El Equipo '.$equipo->serie.' se encuentra ingresado')->with('status','alert alert-danger');              
        }
    

    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rtls($id){
        $blyottloc="Sin Registro";
        $blyotttemp="Sin Registro";
        if(session('rtls')==null||session('rtls')=='"Token has expired."')
            session(['rtls'=>EquipoController::BlyottConec()]);
        $equipo=Equipo::find($id);
        //Datos de Blyott
        $cadena=EquipoController::BlyottAsset(session('rtls'),$equipo->inventario);
      
       if($cadena=='cambio token'){
            session(['rtls'=>EquipoController::BlyottConec()]);
            $cadena=EquipoController::BlyottAsset(session('rtls'),$equipo->inventario);
            if($cadena!="sin Registro"){  
                $blyottloc=$cadena->LocationDetails->LocationName;
                $blyotttemp=$cadena->TagDetails->TagActivities[0]->Temperature;
            }
            
             return view('equipo.rtls')->with('blyottloc',$blyottloc)->with('blyotttemp',$blyotttemp);
       }

       if($cadena!="sin Registro"){  
                $blyottloc=$cadena->LocationDetails->LocationName;
                $blyotttemp=$cadena->TagDetails->TagActivities[0]->Temperature;
        }
        
        return view('equipo.rtls')->with('blyottloc',$blyottloc)->with('blyotttemp',$blyotttemp);
    }

    public function show($id)
    {       
           
            $equipo=Equipo::find($id);
            
            $convenio;
            $ec;
            $garantia=null;
            $eq="";
            if($equipo->eq=="Critico")
                $eq="2.1";
            if($equipo->eq=="Relevante")
                $eq="2.2";
            if($equipo->eq=="Sin")
                $eq="Sin";
            $fecha=new DateTime();
            $fecha=$fecha->format('d-m-Y');
            $year=date('Y',strtotime($fecha));
            if(Garantia::where('equipo',$equipo->id)->count()>0)
            $garantia=Garantia::where('equipo',$equipo->id)->first();   
            if(EquipoConvenio::where('equipo',$equipo->id)->count()>0){
            $ecs=EquipoConvenio::where('equipo',$equipo->id)->get();
            
            foreach($ecs as $econ){
                $ffin=$econ->Convenio->fechafin;
               //dd(strtotime($ffin)>strtotime($fecha));
                if(strtotime($ffin)>strtotime($fecha)){
                     $convenio=Convenio::find($econ->convenio);
                     $ec=$econ;
                     //dd($ec);
                    break;
                }
                else{
                    $ec="Sin Convenio";
                    $convenio="Sin Convenio";
                }     
            }
            }
                else{
                    $ec="Sin Convenio";
                    $convenio="Sin Convenio";
                }
                    //si tiene inventario toma ruta con 2 o 2A
                    if (strncmp($equipo->inventario, '2', 1) === 0){
                        $directorio='storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario;
                        //dd($equipo);

                    }
                    else
                        //de lo contrario toma la ruta por serie
                        $directorio='storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie;
                    // Array en el que obtendremos los resultados
                    $res = array();
                    // Agregamos la barra invertida al final en caso de que no exista
                    if(substr($directorio, -1) != "/") 
                        $directorio .= "/";
                    //dd($directorio) ;
                    // Creamos un puntero al directorio y obtenemos el listado de archivos     
                    //dd(@dir($directorio));
                    if( @dir($directorio)){
                        $dir = @dir($directorio);
                            while(($archivo = $dir->read()) !== false) {
                                // Obviamos los archivos ocultos
                                if($archivo[0] == ".") continue;

                                if(is_dir($directorio . $archivo)) {
                                    $res[] = array(
                                    "Nombre" => $directorio . $archivo . "/",
                                    "Tamaño" => 0,
                                    "Modificado" => filemtime($directorio . $archivo)
                                    );} 
                                    else if (is_readable($directorio . $archivo)) {
                                        $res[] = array(
                                        "Nombre" => $directorio . $archivo,
                                        "Tamaño" => filesize($directorio . $archivo),
                                        "Modificado" => filemtime($directorio . $archivo)
                                        );}
                            }
                        $dir->close();
                        $res=array_reverse($res);
                    
                        //dd($data);
                        }

                        else
                            $res=null;
                        
                        //enviar a vista para mostrar los datos
                    return view('equipo.show')->with('equipo',$equipo)->with('res',$res)->with('ec',$ec)->with('convenio',$convenio)->with('garantia',$garantia)->with('year',$year);
                    
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipo=Equipo::find($id);
        $familia=Familia::orderBy('nombre','ASC')->pluck('nombre','id');
        $subfamilia=SubFamilia::orderBy('nombre','ASC')->pluck('nombre','id');
        $clase=Clase::orderBy('nombre','ASC')->pluck('nombre','id');
        $subclase=Subclase::orderBy('nombre','ASC')->pluck('nombre','id'); 
        $garantia=Garantia::where('equipo',$equipo->id)->first();

        $proveedor=Proveedor::orderBy('nombre','ASC')->get()->pluck('nombre','id');
        
        //orderBy('nombre','ASC')->pluck('nombre','rut');
        $servicioclinico=ServicioClinico::orderBy('nombre','ASC')->pluck('nombre','id');
        $modelo=Modelo::orderBy('modelo','ASC')->pluck('modelo','id');
        $marca=Marca::orderBy('marca','ASC')->pluck('marca','id');
        //dd($equipo);
        return view('equipo.edit')->with('familia',$familia)->with('subfamilia',$subfamilia)->with('clase',$clase)->with('subclase',$subclase)->with('proveedor',$proveedor)->with('servicioclinico',$servicioclinico)->with('modelo',$modelo)->with('marca',$marca)->with('equipo',$equipo)->with('garantia',$garantia);
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
        $marca=explode(' - ', $request->get('marca'))[0];
        $modelo=explode(' - ', $request->get('modelo'))[0];
        $proveedor=explode(' - ', $request->get('proveedor'))[0];
        $sc=explode(' - ', $request->get('servicioclinico'))[0];
        $familia=explode(' - ', $request->get('familia'))[0];
        $subfamilia=explode(' - ', $request->get('subfamilia'))[0];

        $equipo=Equipo::find($id);
        $inv=$equipo->inventario;
        $ser=$equipo->serie;
        $equipo->inventario=$request->get('inventario');
        $equipo->serie=$request->get('serie');
        $equipo->fecha_adquisicion=$request->get('fecha_adquisicion');
        $equipo->eq=$request->get('eq');
        $equipo->fabricacion=$request->get('fabricacion');
        $equipo->tipoactivo=$request->get('tipoactivo');
        $equipo->valor=$request->get('valor');
        $equipo->familia=$familia;
        $equipo->fabricacion=$request->get('fabricacion');
        $equipo->archivador=$request->get('archivador');
       	$equipo->subfamilia=$subfamilia;
       	$equipo->clase=$request->get('clase');
       	$equipo->subclase=$request->get('subclase');
       	$equipo->modelo=$modelo;
       	$equipo->marca=$marca;
      	$equipo->proveedor=$proveedor;
       	$equipo->servicioclinico=$sc;
        $equipo->licitacion=$request->get('licitacion');
        $equipo->oc=$request->get('oc');
        if($equipo->inventario!='?'&&$inv!=$equipo->inventario){
            $eq="";
            if($equipo->eq=="Critico")
                $eq="2.1";
            if($equipo->eq=="Relevante")
                $eq="2.2";
            if($equipo->eq=="Sin")
                $eq="Sin";
            $fecha=new DateTime($equipo->fecha_adquisicion);
            $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario."/";
            if(!file_exists($carpeta))
                mkdir($carpeta,0777,true);                
        }
        if($equipo->inventario=='?'&&$ser!=$equipo->serie){
            $eq="";
            if($equipo->eq=="Critico")
                $eq="2.1";
            if($equipo->eq=="Relevante")
                $eq="2.2";
            if($equipo->eq=="Sin")
                $eq="Sin";
            $fecha=new DateTime($equipo->fecha_adquisicion);
            
            $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie."/";
            if(!file_exists($carpeta))
                mkdir($carpeta,0777,true);
        }
      
        $equipo->save();
        if($request->get('fin')!=null){
            $garantia=new Garantia();
            $fecha=DateTime::createFromFormat('d-m-Y',$request->get('fecha_adquisicion'));
            $garantia->inicio=$fecha;
            $garantia->fin=$request->get('fin');
            $garantia->mp=$request->get('mp');
            $garantia->frecuencia=$request->get('frecuencia');
            $garantia->equipo=$equipo->id;
            $garantia->proveedor=$proveedor;
            $garantia->save();
        }
        return redirect ('/equipo')->with('message', 'El Equipo '.$equipo->inventario.' a sido actualizado')->with('status','alert alert-warning') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $equipo=Equipo::find($id);
       $equipo->delete();
        return redirect('/equipo');
    }
     public function BlyottConec(){

        $config['useragent'] =$_SERVER['HTTP_USER_AGENT'];
        $user="sebastian.fernandez@hofmann.cl";
        $password="Hofmann01";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.blyott.com/login');
        curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"username\":\"".$user."\",\"password\":\"".$password."\"}");

        $headers = array();
        $headers[] = 'Authority:api.blyott.com';
        $headers[] = 'Accept: application/json, text/plain, */*';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Origin: https://portal.blyott.com';
        $headers[] = 'Sec-Fetch-Site: same-site';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Referer: https://portal.blyott.com/login';
        $headers[] = 'Accept-Language: en-US,en;q=0.9';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if($result!=""){
        $token = explode('"',$result);
        $result=$token[3];
    }
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
       
     
    }

    public function BlyottTag($token,$tag){
        $config['useragent'] =$_SERVER['HTTP_USER_AGENT'];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.blyott.com/tag/'.$tag);
        curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        //dd($token);
        $headers = array();
        $headers[] = 'Authority: api.blyott.com';
        $headers[] = 'Accept: application/json, text/plain, */*';
        $headers[] = 'Token: '.$token;
        $headers[] = 'Origin: https://portal.blyott.com';
        $headers[] = 'Sec-Fetch-Site: same-site';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Referer: https://portal.blyott.com/admin-panel/tags';
        $headers[] = 'Accept-Language: en-US,en;q=0.9';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
    public function BlyottAsset($token,$asset)
    {   
        $config['useragent'] =$_SERVER['HTTP_USER_AGENT'];
        $total="";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.blyott.com/assetDetails/'.$asset);
        curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Authority: api.blyott.com';
        $headers[] = 'Accept: application/json, text/plain, */*';
        $headers[] = 'Token:'.$token;
        $headers[] = 'Origin: https://portal.blyott.com';
        $headers[] = 'Sec-Fetch-Site: same-site';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Referer: https://portal.blyott.com/admin-panel/assets';
        $headers[] = 'Accept-Language: en-US,en;q=0.9';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        
      
        if($result=='Token has expired.'||$result==""){
            $loc="cambio token";
            session(['rtls'=>null]);
            return $loc;

        }
        if($result!='{"message":"Asset with given Code does not exist"}'){
            $loc=json_decode($result);
        }
        else
        $loc="sin Registro";
        
       if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $loc;
    }
    
    public function search(Request $request){
        $term = $request->get('term');
        $querys=Equipo::where('inventario','LIKE','%'.$term.'%')
                ->orWhere('serie','LIKE','%'.$term.'%')
                ->orWhere('id','LIKE','%'.$term.'%')->get();
        $data =[];
        foreach ($querys as $query) {
            $data[]=[
                'label' => $query->id.' - '.$query->inventario.' - '.$query->serie
            ];
        }
        return $data;

    }
    public function subir($id)
    {
        $equipo=Equipo::find($id);
        return view('equipo.archivo')->with('equipo',$equipo);
    }

    public function archivo(Request $request, $id)
    {
        $equipo=Equipo::find($id);
        $eq="";
            if($equipo->eq=="Critico")
                $eq="2.1";
            if($equipo->eq=="Relevante")
                $eq="2.2";
            if($equipo->eq=="Sin")
                $eq="Sin";
        if($equipo->inventario!='?')
        $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->inventario."/";
        else
        $carpeta=$_SERVER['DOCUMENT_ROOT'].'/storage/'.$eq.'/'.$equipo->Familia->nombre.'/'.$equipo->SubFamilia->nombre.'/'.$equipo->serie."/";

        if(!file_exists($carpeta)){
            mkdir($carpeta,0777,true);
        }

        if($request->hasFile('documento')){
            $fecha=new DateTime($request->fecha);
            $nombre=$equipo->inventario.'_'.$fecha->format('Y').'_'.$request->archivo.'_'.$fecha->format('m').'_'.$fecha->format('d');
            $file=$request->file('documento');
            $nombre=$nombre.'.pdf';
                if($file->guessExtension()=="pdf"){    
                    $file->move($carpeta, $nombre);
                }
        }
        return redirect()->back();
    }

}



            
            
            