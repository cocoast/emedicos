@extends('ppa')

@section('title', 'Ficha de Pagos')

@section('content_header')

    <h3>Informe Técnico de Cumplimiento de MP, Plazo de Respuesta de Acciones Correctivas, Operatividad de los Equipos</h3>

@stop


@section('body')
  
  


    <div class="container" id="widget">
    <div class="d-flex justify-content-between text-center">
            <img id="ministerio" src="{{ asset('img/ministerio.png') }}" width="150" alt="Logo">        
            <h3 class="p-2"><b>Informe Técnico de Cumplimiento de MP, Plazo de Respuesta de Acciones Correctivas, Operatividad de los Equipos</b></h3>
            <img src="{{ asset('img/hpm.png') }}" width="150" height="100" alt="">
    </div>
    
    <div class="d-flex justify-content-center">
        <h3 class = "p-2"> <b>Periodo que Informa: {{date("d-m-Y", strtotime('+1 days', strtotime('-1 months', strtotime($pago->fecha))))}}  al {{date("d-m-Y", strtotime($pago->fecha))}} </b> </h3>
    </div>


    <p> <br><br> </p>

    <p ><b>1. Información Convenio: </b> <br> </p>
    

    <div class="row justify-content-center">

        <table class = "table table-striped text-justify"  > 
            <col width="auto">
            <tbody>
                <tr>
                    <td><b>ID de Licitación Convenio</b></td>
                    <td><b>{{$convenio->licitacion}}</b></td>
                </tr>
                <tr>
                    <td><b>Razón Social del Proveedor</b></td>
                    <td><b>{{$convenio->Proveedor->nombre}}</b></td>
                </tr>
                <tr>
                    <td><b>Rut</b></td>
                    <td><b>{{$convenio->Proveedor->rut}}</b></td>
                </tr>
                <tr>
                    <td><b>Inicio de Contrato /Término </b></td>
                    <td><b>Res.: {{$convenio->resolucion}};<br> {{date("d-m-Y", strtotime($convenio->fechaincio))}} al {{date("d-m-Y", strtotime($convenio->fechafin))}}</b></td>
                </tr>
                <tr>
                    <td><b>Tipo de Emisión de OC</b></td>
                    <td><b> 
                        @if($convenio->frecuenciapago == 1) 
                        Mensual
                        @elseif ($convenio->frecuenciapago == 4)
                        Trimetstral
                        @elseif ($convenio->frecuenciapago == 6)
                        Semestral
                        @elseif ($convenio->frecuenciapago == 12)
                        Anual
                        @endif
                        , cuota {{$pago->periodo}} de {{$convenio->meses/$convenio->frecuenciapago}}
                        
                    </b></td>
                </tr>
                <tr>
                    <td><b>Monto total del contrato IVA incluido</b></td>
                    <td><b> $ {{ number_format($convenio->valor,0,",", ".")}}</b></td>
                    
                </tr>
                <tr>
                    <td><b>Monto Mensual contrato Neto</b></td>
                    <td><b> $ </b></td>
                </tr>
                               
                <tr>
                    <td><b>Si el proveedor contratado realizó mantención en el presente periodo <br>llenar en punto 2. de lo contrario pasar al 3.</b></td>
                    <td></td>
                </tr>
</tbody>
</table>
</div>

<p ><b>2. Mantención Preventiva: </b> <br> </p>

<div class="row justify-content-center" >
        <table class = "table table-striped text-justify " > 
            <col width="323">
           
            <tbody>
                <tr>
                    <td ><b>Cumplimiento de la Mantención preventiva. Art. 10 del contrato.</b></td>
                    <td><b>Si ______</b></td>
                    <td><b>No ______ <br> Observaciones: <br>  <br>  <br> </b></td>
                </tr>
                <tr>
                    <td><b>Ingreso de Técnicos con previa coordinación con el SubDpto. de Equipos Médicos, respeta el protocolo sobre ingreso y salida de técnicos y llenado de hojas de servicios, cumple sus obligaciones.<br>Respeta Calendario de Mantención preventiva fijado por las partes.</b></td>
                    <td><b>Si ______</b></td>
                    <td><b>No ______ <br> Observaciones: <br>  <br>  <br> </b></td>
                </tr>
                <tr>
                    <td><b>Proveedor entrega hoja de Servicio conforme el protocolo de mantenimiento</b></td>
                    <td><b>Si ______</b></td>
                    <td><b>No ______ <br> Observaciones: <br>  <br>  <br> </b></td>
                </tr>
                <tr>
                    <td><b>Respaldos, se deben adjuntar como anexo Formulario de mantenimiento preventivo y correctivo.</b></td>
                    <td><b>Si ______</b></td>
                    <td><b>No ______ <br> Observaciones: <br>  <br>  <br> </b></td>
                </tr>
                
                
</tbody>
</table>
</div>

<p ><b>3. Mantención Correctiva por Evento y por Equipo: </b> <br> </p>

<div class="row justify-content-center">
    <table class = "table table-striped text-justify">
        <col width="323">
        
        <tr>
            <td ><b>Indicar si existe cumplimiento en cuanto a los tiempos de reparación de los equipos establecido en el convenio de 24 horas más tiempo de traslados art. 10 del contrato.
                <br>Respuesta telefónica 60 minutos
                <br>Despacho de repuestos 5 días hábiles.(Adjuntar formulario)</b>
            </td>
            <td><b>Si ______</b></td>
            <td><b>No ______ <br> Observaciones: <br>  <br>  <br> </b></td>
        </tr>
    </table>

</div>




<p ><b>4. Conclusión Informe Desempeño: </b> <br> </p>

<div class="row justify-content-center">
    <table class = "table table-striped text-justify">
        <col width="323">
        
        <tr>
            <td ><b>Empresa cumple con los requisitos para el pago del servicio</b></td>
            <td><b>Si ______</b></td>
            <td><b>No ______ <br> 
                    Observaciones y antecedentes adjuntos <br>(Oficios, Cartas de Descargo, Resoluciones): <br>
                      <br>  <br> </b></td>
        </tr>
    </table>

</div>

<p><b>5. Indicadores </b> <br> </p>

<div class="row justify-content-center">
    <table class = "table table-striped text-justify">
        <col width="323">
        <col width="323">
        
        <tr>
            <td ><b>Cumplimiento de conformidad en la ejecución de manteniciones preventivas y correctivas</b></td>
            <td>Cumplimiento = <br>Cantidad de Equipos Conforme / <br>Cantidad de Equipos en Convenio</td>
            <td><b> ____/{{count($convenio->EquipoConvenio)}}</b></td>
            <td><b>____%</b></td>
        </tr>
    </table>

</div>

<p ><b>6. Equipos Involucrados: </b> <br> </p>

<div class="row justify-content-center">
<table class="table table-striped text-justify">
                <thead>
                <th>Equipo</th>
                <th>Serie</th>
                <th>Familia</th>
                <th>Modelo</th>
                <th>Incorporación</th>
                <th>Valor +IVA</th>
                <th>MP 
                </thead>
                <tbody>
                    @foreach($convenio->EquipoConvenio as $equipoconvenio)
                <tr>
                    <td>
                    
                    
                        {{$equipoconvenio->Equipo->inventario}}
                    </td>
                    <td>{{ $equipoconvenio->Equipo->serie }}</td>
                    <td>{{$equipoconvenio->Equipo->Familia->nombre}}</td>
                    <td>{{$equipoconvenio->Equipo->Modelo->modelo}}</td>
                    <td>{{date("d-m-Y", strtotime($equipoconvenio->fechaincorporacion))}}</td>
                    <td>{{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($equipoconvenio->valor)}}</td>
                    <td>{{$equipoconvenio->mp}}</td>
            </tr>
            @endforeach
                </tbody>
            </table>
</div>

<p><br/><br/></p>

<p align="justify" style="margin-left: -0.1in; margin-bottom: 0.11in; line-height: 108%">
    <b>Obs; Se solicita extender Orden de compra con detalle de equipos, dado que estos presentan distintos valores.</b>
</p>
<p align="justify" style="margin-left: -0.1in; margin-bottom: 0.11in; line-height: 108%">
    Se extiende el siguiente certificado para el pago de servicios de mantención en conformidad del servicio contratado para el periodo anterior con la aprobación del Gestor Técnico y da curso a la solicitud de emisión de Orden de Compra del contrato.
</p>
<p align="justify" style="margin-left: -0.1in; margin-bottom: 0.11in; line-height: 108%">
    Nombre, Firma y timbre del Gestor Técnico; 
</p>
<p align="justify" style="margin-left: -0.1in; margin-bottom: 0.11in; line-height: 108%">
    __________________________________________Fecha de emisión de documento: {{date("d-m-Y")}}
</p>
<p align="justify" style="margin-bottom: 0.11in; line-height: 108%"><u><b>
    Distribución:
</b></u>
</p>

<ul>
    <li/>
<p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
    Jefe de Logística (Copia Original)</p>
    <li/>
<p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
    Jefe de SubDpto. de Equipos (Digital)</p>
    <li/>
<p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
    Sección de Administración de Contratos de Dpto. de Operaciones
    (Digital)</p>
    <li/>
<p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
    Jefe de Operaciones (Digital)</p>
</ul>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <!--Aqui Va la informacion del modal -->
        </div>
    </div>
</div>

@stop 
@section('css')
<!-- CSS only -->

<link rel="stylesheet" href="/css/ficha_pagos.css"  >
<link rel="stylesheet" href="/css/ficha_pagos.css" media="print" >

@stop

@section('js')
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script type="text/javascript">
    
    $('.EquipoBtn').on('click',function(){
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>



@stop

