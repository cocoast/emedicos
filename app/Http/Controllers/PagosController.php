<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\EquipoConvenio;
use App\Models\Convenio;
use NumberFormatter;
use DateTime;
use PDF2;

use Barryvdh\DomPDF\Facade\Pdf;

class PagosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:pago.index')->only('index');
        $this->middleware('can:pago.edit')->only('edit', 'update');
        $this->middleware('can:pago.create')->only('create', 'store');
        $this->middleware('can:pago.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store($id)
    {
        $periodo = Pago::where('convenio', $id)->count();
        $pago = new Pago();
        $hoy = new DateTime();
        $fecha = $hoy->format('d-m-Y');
        $pago->fecha = $fecha;
        $pago->periodo = $periodo + 1;
        $pago->memo = "ingresar";
        $pago->estado = "Pendiente";
        $pago->oc = "ingresar";
        $pago->valor = "ingresar";
        $pago->convenio = $id;
        $pago->save();
        return redirect()->route('convenio.show', $pago->convenio);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $oc = $id;
        $url = "http://api.mercadopublico.cl/servicios/v1/publico/ordenesdecompra.json?codigo=" . $oc . "&ticket=51F64BE8-87A8-404B-B5C6-E954D059117C";
        $data = json_decode(file_get_contents($url), true);
        //$da=json_encode($data["Listado"]);
        //$da=json_decode($da);
        //dd($da);
        //dd(sizeof($data["Listado"]));
        if (sizeof($data["Listado"]) != 0) {
            return view("pagos.show")->with('oc', $data["Listado"][0]);
        } else
            return view("pagos.show")->with('oc', "no");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $pago = Pago::find($id);
        $convenio = Convenio::find($pago->convenio);
        if ($convenio->tipoconvenio != "Correctivo") {
            //Sacamos las cantidades de pagos
            $pa = $convenio->meses / $convenio->frecuenciapago;
            //sumamos todos los equipos que comenzaron junto con el convenio
            $total = EquipoConvenio::where('convenio', $pago->convenio)->where('fechaincorporacion', $pago->Convenio->fechaincio)->sum('valor') / $pa;
            //obtenemos los equipos que son del convenio pero se agregaron en una fecha distinta al inicio del convenio. 
            $anexos = EquipoConvenio::where('convenio', $pago->convenio)->where('fechaincorporacion', '>', $pago->Convenio->fechaincio)->get();

            foreach ($anexos as $anexo) {
                foreach (Pago::where('convenio', $convenio->id)->get() as $p) {
                    if ($anexo->fechaincorporacion < $p->fecha) {
                        //calculamos los pagos que quedan
                        $paane = $pa - $p->periodo;
                        if ($pago->fecha > $anexo->fechaincorporacion) {
                            //sumamos el valor del equipo al total del pago (dividiendo por los pagos que quedan) 
                            $total = $total + ($anexo->valor / $paane);

                            break;
                        }
                    }
                }
            }
            $total = NumberFormatter::create('es_CL', NumberFormatter::DECIMAL)->format($total);
        } else {
            $total = 0;
        }

        return view('pagos.edit')->with('pago', $pago)->with('total', $total);
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

        if ($request->get('memo') == "ingresar") {
            $pagos = Pago::find($id);
            return redirect()->route('convenio.show', $pagos->convenio)->with('message', 'El Pago No fue procesado Correctamente Verifique que la informacion este completa')->with('status', 'alert alert-danger');
        } else {
            $pagos = Pago::find($id);
            $pagos->memo = $request->get('memo');
            $pagos->estado = "Generado";
            $pagos->periodo = $request->get('periodo');
            $pagos->oc = $request->get('oc');
            $pagos->valor = $request->get('valor');
            $memo = explode("/", $pagos->memo)[0] . "-" . explode("/", $pagos->memo)[1];
            $carpeta = '/storage/convenios/' . $pagos->convenio . "/pagos/";
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $carpeta))
                mkdir($_SERVER['DOCUMENT_ROOT'] . $carpeta, 0777, true);
            if ($request->hasFile("documento")) {
                $file = $request->file('documento');
                $nombre = $memo . "." . $file->guessExtension();
                if ($file->guessExtension() == "pdf") {
                    $file->move($_SERVER['DOCUMENT_ROOT'] . $carpeta, $nombre);
                    $pagos->link = $carpeta . $nombre;
                } else
                    dd("no es un archivo pdf");
            }
            $pagos->save();
            return redirect()->back()->with('message', 'El Pago Couta N° ' . $pagos->periodo . ' se Ingreso Correctamente')->with('status', 'alert alert-success');
        }
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
    public function Ficha($id)
    {
        $pago = Pago::find($id);
        $convenio = Convenio::find($pago->Convenio->id);
        $inicio = date('d-m-Y', (strtotime($pago->fecha . "- 1 month + 1 days")));

        return view('pagos.ficha')->with('convenio', $convenio)->with('pago', $pago);
    }


    public function createPDF($id)
    {
        $pago = Pago::find($id);
        $convenio = Convenio::find($pago->Convenio->id);
        $counter = 0;
        if($convenio->tipoconvenio!="Correctivo"){
        
        $valor = PagosController::ValorPagar($pago->id);
        $ncuotas = $convenio->meses / $convenio->frecuenciapago;

        $pdf = PDF2::loadview('pagos.ficha', compact('pago', 'convenio', 'counter', 'valor'));
        return $pdf->inline("{$convenio->nombre}, cuota {$pago->periodo} de {$ncuotas}.pdf");
    }
        else
        $valor="$";
        $ncuotas=$pago->periodo;
        $pdf = PDF2::loadview('pagos.ficha', compact('pago', 'convenio', 'counter', 'valor'));
        return $pdf->inline("{$convenio->nombre}, cuota {$pago->periodo} de {$ncuotas}.pdf");
    }
    public function ValorPagar($id)
    {
        $pago = Pago::find($id);
        $convenio = Convenio::find($pago->convenio);
        if ($convenio->tipoconvenio != "Correctivo") {
            //Sacamos las cantidades de pagos
            $pa = $convenio->meses / $convenio->frecuenciapago;
            //sumamos todos los equipos que comenzaron junto con el convenio
            $total = EquipoConvenio::where('convenio', $pago->convenio)->where('fechaincorporacion', $pago->Convenio->fechaincio)->sum('valor') / $pa;
            //obtenemos los equipos que son del convenio pero se agregaron en una fecha distinta al inicio del convenio. 
            $anexos = EquipoConvenio::where('convenio', $pago->convenio)->where('fechaincorporacion', '>', $pago->Convenio->fechaincio)->get();

            foreach ($anexos as $anexo) {
                foreach (Pago::where('convenio', $convenio->id)->get() as $p) {
                    if ($anexo->fechaincorporacion < $p->fecha) {
                        //calculamos los pagos que quedan
                        $paane = $pa - $p->periodo;
                        if ($pago->fecha > $anexo->fechaincorporacion) {
                            //sumamos el valor del equipo al total del pago (dividiendo por los pagos que quedan) 
                            $total = $total + ($anexo->valor / $paane);

                            break;
                        }
                    }
                }
            }
            $total = NumberFormatter::create('es_CL', NumberFormatter::CURRENCY_ACCOUNTING)->format($total);
        } else {
            $total = 0;
        }
        return $total;
    }
}
