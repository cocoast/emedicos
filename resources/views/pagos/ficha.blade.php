@extends('pdf')

@section('title', 'Ficha de Pago')

@section('style')
.table td, .table th{
vertical-align: middle !important;
}
@stop


@section('content_header')
<b>Informe Técnico de Cumplimiento de MP, Plazo de Respuesta de Acciones Correctivas, Operatividad de los Equipos</b>
@stop


@section('subtitle')
<div class="text-center">
    <h3 class="p-2">
        @if($pago->periodo==1)
        @if($convenio->frecuenciapago == 1)
        <b>Periodo que Informa: {{date("d-m-Y", strtotime('-1 months', strtotime($pago->fecha)))}} al {{date("d-m-Y", strtotime($pago->fecha))}} </b>
        @elseif ($convenio->frecuenciapago == 3)
        <b>Periodo que Informa: {{date("d-m-Y", strtotime('-3 months', strtotime($pago->fecha)))}} al {{date("d-m-Y", strtotime($pago->fecha))}} </b>
        @elseif ($convenio->frecuenciapago == 4)
        <b>Periodo que Informa: {{date("d-m-Y", strtotime('-4 months', strtotime($pago->fecha)))}} al {{date("d-m-Y", strtotime($pago->fecha))}} </b>
        @elseif ($convenio->frecuenciapago == 6)
        <b>Periodo que Informa: {{date("d-m-Y", strtotime('-6 months', strtotime($pago->fecha)))}} al {{date("d-m-Y", strtotime($pago->fecha))}} </b>
        @elseif ($convenio->frecuenciapago == 12)
        <b>Periodo que Informa: {{date("d-m-Y", strtotime('-1 year', strtotime($pago->fecha)))}} al {{date("d-m-Y", strtotime($pago->fecha))}} </b>
        @endif
        @else
        @if($convenio->frecuenciapago == 1)
        <b>Periodo que Informa: {{date("d-m-Y", strtotime('+1 days', strtotime('-1 months', strtotime($pago->fecha))))}} al {{date("d-m-Y", strtotime($pago->fecha))}} </b>
        @elseif ($convenio->frecuenciapago == 3)
        <b>Periodo que Informa: {{date("d-m-Y", strtotime('+1 days', strtotime('-3 months', strtotime($pago->fecha))))}} al {{date("d-m-Y", strtotime($pago->fecha))}} </b>
        @elseif ($convenio->frecuenciapago == 4)
        <b>Periodo que Informa: {{date("d-m-Y", strtotime('+1 days', strtotime('-4 months', strtotime($pago->fecha))))}} al {{date("d-m-Y", strtotime($pago->fecha))}} </b>
        @elseif ($convenio->frecuenciapago == 6)
        <b>Periodo que Informa: {{date("d-m-Y", strtotime('+1 days', strtotime('-6 months', strtotime($pago->fecha))))}} al {{date("d-m-Y", strtotime($pago->fecha))}} </b>
        @elseif ($convenio->frecuenciapago == 12)
        <b>Periodo que Informa: {{date("d-m-Y", strtotime('+1 days', strtotime('-1 year', strtotime($pago->fecha))))}} al {{date("d-m-Y", strtotime($pago->fecha))}} </b>
        @endif
        @endif

    </h3>
</div>

@stop

@section('body')
<p style="text-align: left;"><b>1. Información Convenio: </b> <br> </p>


<div class="row justify-content-center">

    <table class="table table-striped text-justify">
        <col width="auto">
        <tbody>
            <tr>
                <td><b>ID de Licitación Convenio</b></td>
                <td><b>{{$convenio->licitacion}}</b></td>
            </tr>
            <tr>
                <td><b>Nombre Convenio</b></td>
                <td><b>{{$convenio->nombre}}</b></td>
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
                <td><b>Resolucion </b></td>
                <td><b>N°{{$convenio->resolucion}}, con fecha {{date("d-m-Y", strtotime($convenio->fecharesolucion)) }}
            </tr>
            <tr>
                <td><b>Inicio de Contrato /Término </b></td>
                <td><b> {{date("d-m-Y", strtotime($convenio->fechaincio))}} al {{date("d-m-Y", strtotime($convenio->fechafin))}}</b></td>
            </tr>
            <tr>
                <td><b>Tipo de Emisión de OC</b></td>
                <td><b>
                    @if($convenio->tipoconvenio!='Correctivo')
                        @if($convenio->frecuenciapago == 1)
                        Mensual
                        @elseif ($convenio->frecuenciapago == 3)
                        Trimestral
                        @elseif ($convenio->frecuenciapago == 4)
                        Cuatrimestral
                        @elseif ($convenio->frecuenciapago == 6)
                        Semestral
                        @elseif ($convenio->frecuenciapago == 12)
                        Anual
                        @endif
                        , cuota {{$pago->periodo}} de {{$convenio->meses/$convenio->frecuenciapago}}
                    @else
                        cuota {{$pago->periodo}}
                        @endif
                    </b></td>
            </tr>
            <tr>
                <td><b>Monto total del contrato IVA incluido</b></td>
                <td><b> {{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY_ACCOUNTING )->format($convenio->valor)}}</b></td>

            </tr>
            <tr>
                <td><b>Monto cuota contrato IVA incluido</b></td>
                <td><b> {{ $valor }} </b></td>
            </tr>


        </tbody>
    </table>
</div>

<p style="text-align: left;"><b>2. Mantención Preventiva: </b> <br> </p>
<p>Si el proveedor contratado realizó mantención en el presente periodo llenar en punto 2. de lo contrario pasar al 3.</p>

<div class="row justify-content-center">
    <table class="table table-striped text-justify ">
        <col width="323">

        <tbody>
            <tr>
                <td><b>Cumplimiento de la Mantención preventiva segun Contrato.</b></td>
                <td><b>Si ______</b></td>
                <td><b>No ______ <br> Observaciones: <br> <br> <br> </b></td>
            </tr>
            <tr>
                <td><b>Ingreso de Técnicos con previa coordinación con el SubDpto. de Equipos Médicos, respeta el protocolo sobre ingreso y salida de técnicos y llenado de hojas de servicios, cumple sus obligaciones.<br>Respeta Calendario de Mantención preventiva fijado por las partes.</b></td>
                <td><b>Si ______</b></td>
                <td><b>No ______ <br> Observaciones: <br> <br> <br> <br> <br> <br> <br> </b></td>
            </tr>
            <tr>
                <td><b>Proveedor entrega hoja de Servicio conforme el protocolo de mantenimiento</b></td>
                <td><b>Si ______</b></td>
                <td><b>No ______ <br> Observaciones: <br> <br> <br> </b></td>
            </tr>
        </tbody>
    </table>
</div>

<div style="page-break-after: always;"> </div>

<div class="row justify-content-center">
    <table class="table table-striped text-justify ">
        <col width="323">

        <tbody>


            <tr>
                <td><b>Respaldos, se deben adjuntar como anexo Formulario de mantenimiento preventivo y correctivo.</b></td>
                <td><b>Si ______</b></td>
                <td><b>No ______ <br> Observaciones: <br> <br> <br> </b></td>
            </tr>


        </tbody>
    </table>
</div>

<p style="text-align: left;"><b>3. Mantención Correctiva por Evento y por Equipo: </b> <br> </p>

<div class="row justify-content-center">
    <table class="table table-striped text-justify">
        <col width="323">

        <tr>
            <td><b>Indicar si existe cumplimiento en cuanto a los tiempos de reparación de los equipos establecido en el convenio
            </td>
            <td><b>Si ______</b></td>
            <td><b>No ______ <br> Observaciones: <br> <br> <br> <br> <br> <br> <br> </b></td>
        </tr>
    </table>

</div>




<p style="text-align: left;"><b>4. Conclusión Informe Desempeño: </b> <br> </p>

<div class="row justify-content-center">
    <table class="table table-striped text-justify">
        <col width="323">

        <tr>
            <td><b>Empresa cumple con los requisitos para el pago del servicio</b></td>
            <td><b>Si ______</b></td>
            <td><b>No ______ <br>
                    Observaciones y antecedentes adjuntos <br>(Oficios, Cartas de Descargo, Resoluciones): <br>
                    <br> <br> <br> <br> </b></td>
        </tr>
    </table>

</div>

<p style="text-align: left;"><b>5. Indicadores </b> <br> </p>

<div class="row justify-content-center">
    <table class="table table-striped text-justify">
        <col width="323">
        <col width="323">

        <tr>
            <td><b>Cumplimiento de conformidad en la ejecución de manteniciones preventivas y correctivas</b></td>
            <td>@if($convenio->tipoconvenio!="Correctivo")Cumplimiento = <br>Cantidad de Equipos Conforme / <br>Cantidad de Equipos en Convenio @else Cumplimiento = <br> Ejecucion de los servicios (SI/NO)@endif </td>
            <td>@if($convenio->tipoconvenio!="Correctivo")<b> ____/{{count($convenio->EquipoConvenio)}}</b> @else<b> _____</b>@endif  </td>
            <td><b>____%</b></td>
        </tr>
    </table>

</div>






<p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
    <b>Obs: Se solicita extender Orden de compra con detalle de equipos, dado que estos presentan distintos valores.</b>
</p>
<p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
    Se extiende el siguiente certificado para el pago de servicios de mantención en conformidad del servicio contratado para el periodo anterior con la aprobación del Gestor Técnico y da curso a la solicitud de emisión de Orden de Compra del contrato.
</p>
<p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
    Nombre, Firma y timbre del Gestor Técnico;
</p>
<br>
<br>
<p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
    __________________________________________Fecha de emisión de documento: {{date("d-m-Y")}}
</p>
<p align="justify" style="margin-bottom: 0.11in; line-height: 108%"><u><b>
            Distribución:
        </b></u>
</p>

<ul>
    <li />
    <p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
        Jefe de Logística (Copia Original)</p>
    <li />
    <p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
        Jefe de SubDpto. de Equipos (Digital)</p>
    <li />
    <p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
        Sección de Administración de Contratos de Dpto. de Operaciones
        (Digital)</p>
    <li />
    <p align="justify" style="margin-bottom: 0.11in; line-height: 108%">
        Jefe de Operaciones (Digital)</p>
</ul>

<p><br /><br /></p>
@if($convenio->tipoconvenio!='Correctivo')
<div style="page-break-after: always;">

</div>

<p style="text-align: left; margin-bottom: 0px;"><b>Anexo 1. Equipos Involucrados: </b> </p>

<div class="row justify-content-center">

    <table class="table table-striped text-justify">
        <thead>
            <th style=" padding-left: 4px; padding-right: 4px; text-align: center;">#</th>
            <th>Equipo</th>
            <th>Serie</th>
            <th>Familia</th>
            <th>Modelo</th>
            <th>Incorporación</th>
            <th>Valor +IVA</th>

        </thead>
        <tbody>
            @foreach($convenio->EquipoConvenio as $equipoconvenio)
            @if($equipoconvenio->fechaincorporacion<$pago->fecha)
            <tr>
                <td style="padding-left: 4px; padding-right: 4px; text-align: center">
                    @if($counter+1 <10) <b>0{{ $counter+1 }}</b>
                        @else
                        <b>{{ $counter+1 }}</b>
                        @endif
                </td>
                <td>
                    {{$equipoconvenio->Equipo->inventario}}
                </td>
                <td>{{ $equipoconvenio->Equipo->serie }}</td>
                <td>{{$equipoconvenio->Equipo->Familia->nombre}}</td>
                <td>{{$equipoconvenio->Equipo->Modelo->modelo}}</td>
                    @if (strtotime($equipoconvenio->fechaincorporacion)!=strtotime($convenio->fechaincio))
                 <td>{{date("d-m-Y", strtotime($equipoconvenio->fechaincorporacion))}}</td>   
                 <td>@php
                $fin=date('Y-m-d',strtotime($convenio->fechafin));
                $inicio=date('Y-m-d',strtotime($equipoconvenio->fechaincorporacion));
                $time1=DateTime::createFromFormat('Y-m-d',$fin);
                $time2=DateTime::createFromFormat('Y-m-d',$inicio);
                $delta=$time1->diff($time2); 
                $deltameses=$delta->format("%m");  
                $deltaano=$delta->format("%y")*12;
                $delta=$deltameses+$deltaano; 
                $periodos=ceil($delta/$convenio->frecuenciapago);

                 @endphp
                {{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY_ACCOUNTING)->format($equipoconvenio->valor/$periodos) }}
                 </td>   
                 @else 
                <td>{{date("d-m-Y", strtotime($equipoconvenio->fechaincorporacion))}}</td>
                <td>{{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY_ACCOUNTING)->format($equipoconvenio->valor/(($convenio->meses / $convenio->frecuenciapago)))}}</td>
               @endif

            </tr>
            @endif
            <!-- Si el contador de equipos llega al máximo soportado por página; termina la tabla anterior e inicia una nueva.  -->
            @if((++$counter == 24 ) && (count($convenio->EquipoConvenio) > 24))
        </tbody>
    </table>
    <div style="page-break-after: always;"></div>
    <table class="table table-striped text-justify">
        <thead>
            <th>#</th>
            <th>Equipo</th>
            <th>Serie</th>
            <th>Familia</th>
            <th>Modelo</th>
            <th>Incorporación</th>
            <th>Valor +IVA</th>

        </thead>
        <tbody>
            @endif
            @endforeach

            <th colspan="6" style="text-align: right; padding-top: 9px; padding-bottom:5px;"> Valor Total Iva Includo</th>
            <th style="text-align: left; padding-top: 9px; padding-bottom:5px;">{{ $valor }}</th>


        </tbody>
    </table>

</div>
@endif
@stop