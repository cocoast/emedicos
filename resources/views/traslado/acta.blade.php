@extends('pdf')

@section('title', 'Acta de Traslado')


@section('style')
.table td, .table th{
padding-top: .2rem !important ;
padding-bottom: .2rem !important ;
padding-left: .5rem !important;

}
.row {
margin-left:-5px;
margin-right:-5px;
}

.column {
float: left;
width: 50%;
}


@stop


@section('content_header')

<b>ACTA DE TRASLADO DE EQUIPO MEDICO</b>

@stop

@section('subtitle')



<h3 class="p-2 text-center"><b>Acta N°: {{$traslado->numero}}</b></h3>
<p style="text-align: right; font-size: larger;"><b>Fecha: {{date("d/m/Y", strtotime($traslado->fecha))}}</b></p>





@stop

@section('body')

<div class='row'>
    <div class="column" style="padding-right:20px;">
        <p style="text-align: left;"><b>1. Servicio Actual: </b> </p>
    </div>
    <div class="column" style="padding-left:20px;">
        <p style="text-align: left;"><b>2. Servicio Destino: </b> </p>
    </div>
</div>

<div class="row">
    <div class="column" style="padding-right:20px;">
        <table class="table table-striped text-justify">
            <col width="auto">
            <tbody>
                <tr>
                    <td><b>CR Actual: </b></td>
                    <td><b> {{$traslado->Actual->cr}} </b></td>
                </tr>
                <tr>
                    <td><b>Nombre del Servicio Actual:</b></td>
                    <td><b>{{ $traslado->Actual->nombre }} </b></td>
                </tr>
                <tr>
                    <td><b>Ubicación del Servicio Actual:</b></td>
                    <td><b>{{ $traslado->Actual->ubicacion }} </b></td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="column" style="padding-left:20px;">
        <table class="table table-striped text-justify">
            <col width="auto">
            <tbody>
                <tr>
                    <td><b>CR Destino: </b></td>
                    <td><b>{{ $traslado->Destino->cr }} </b></td>
                </tr>
                <tr>
                    <td><b>Nombre del Servicio Destino:</b></td>
                    <td><b>{{ $traslado->Destino->nombre }} </b></td>
                </tr>
                <tr>
                    <td><b>Ubicación del Servicio Destino:</b></td>
                    <td><b>{{ $traslado->Destino->ubicacion }} </b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



<p style="text-align: left;"><b>3. Datos del Equipo: </b> <br> </p>


<table class="table table-striped text-justify" style="width: 100%">

    <tbody>
        <tr>
            <td><b>Nombre: </b></td>
            <td><b>{{ $traslado->Equipo->Familia->nombre }} </b></td>
        </tr>
        <tr>
            <td><b>N° de Inventario:</b></td>
            <td><b>{{ $traslado->Equipo->inventario }} </b></td>
        </tr>
        <tr>
            <td><b> Marca:</b></td>
            <td><b>{{ $traslado->Equipo->Marca->marca }} </b></td>
        </tr>
        <tr>
            <td><b> Modelo:</b></td>
            <td><b> {{ $traslado->Equipo->Modelo->modelo }}</b></td>
        </tr>
        <tr>
            <td><b> Serie:</b></td>
            <td><b>{{ $traslado->Equipo->serie }} </b></td>
        </tr>
    </tbody>
</table>


<p style="text-align: left;"><b>4. Perifericos del Equipo: </b> <br> </p>


<table class="table table-striped text-justify">
    <col width="auto">
    <thead>
        <th width="30px" style="text-align: center;"><b>#</b></th>
        <th><b>Nombre: </b></th>
        <th><b>Marca: </b></th>
        <th><b>Modelo: </b></th>
        <th><b>Serie: </b></th>
    </thead>
    <tbody>
        @if($perifericos->count()>0)
            @foreach ($perifericos as $periferico)
                <tr>
                    <td width="30px" style="text-align: center">{{ $i }}</td>
                    <td>{{ $periferico->nombre }}</td>
                    <td>{{ $periferico->marca }}</td>
                    <td>{{ $periferico->modelo }}</td>
                    <td>{{ $periferico->serie }}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        @else
            @for ($i = 0; $i < 5; $i++) 
            <tr>
                <td width="30px" style="text-align: center">0{{$i+1}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
                @endfor
        @endif
    </tbody>
</table>



<p style="text-align: left;"><b>5. Responsable {{$traslado->Actual->nombre}} </b> <br> </p>


<table class="text-justify" cellpadding="7px" style="width: 100%">
    <col width="200">


    <tbody>
        <tr>
            <td><b>Cargo:</b></td>
            <td><b>Nombre: </b></td>
            <td><b>RUT: </b></td>
            <td><b>Firma:</b> </td>
        </tr>
        <tr height="100px">


            <td><i>Jefe/Supervisor/<br>Designado</i></td>
            <td>______________________</td>
            <td>______________________</td>
            <td>______________________</td>

        </tr>

    </tbody>
</table>


<p style="text-align: left;"><b><br>6. Responsable {{$traslado->Destino->nombre}} </b> <br> </p>

<table class="text-justify" cellpadding="7px" style="width: 100%">
    <col width="200">


    <tbody>
        <tr>
            <td><b>Cargo:</b></td>
            <td><b>Nombre: </b></td>
            <td><b>RUT: </b></td>
            <td><b>Firma:</b> </td>
        </tr>
        <tr height="100px">


            <td><i>Jefe/Supervisor/<br>Designado</i></td>
            <td>______________________</td>
            <td>______________________</td>
            <td>______________________</td>

        </tr>

    </tbody>
</table>


@stop