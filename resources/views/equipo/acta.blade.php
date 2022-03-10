@extends('pdf')

@section('title', 'Acta de Recepción')

@section('style')

.table td, .table th{
padding-top: .3rem !important ;
padding-bottom: .1rem !important ;
padding-left: .5rem !important;

@stop


@section('content_header')

<b>ACTA DE RECEPCIÓN CONFORME ADQUISICIÓN DE EQUIPAMIENTO </b>

@stop

@section('body')

<p style="text-align: left;"><b>1. Datos de la Adquisición: </b> <br> </p>


<table class="table table-striped text-justify" style="width: 100%">

	<col width="27%">
	<col width="25%">
	<col width="25%">
	<col width="23%">
	<tbody>
		<tr>
			<td><b>Procedencia:</b></td>
			<td colspan="3"> {{$equipo->tipoactivo}} </td>
		</tr>
		<tr>
			<td><b> Fecha Acta Recepción:</b> </td>
			<td> {{date("d-m-Y", strtotime($equipo->fecha_adquisicion))}} </td>
			<td> <b>Fecha Ingreso Bodega: </b> </td>
			<td></td>
		</tr>

		<tr>
			<td><b> Nombre Licitación/Proyecto</b></td>
			@if($licitacion != 0 )
			@if($licitacion['Nombre'] != "" )

			<td colspan="3">{{$licitacion['Nombre']}}</td>

			@elseif($oce['Nombre'] != "")


			<td colspan="3">{{$oce['Nombre']}}</td>

			@else
			<td colspan="3"> </td>
			@endif
			@else
			<td colspan="3"> </td>
			@endif
		</tr>
		<tr>
			<td><b>ID Licitacion:</b></td>
			<td>{{$equipo->licitacion}}</td>
			<td><b> N° O.C.:</b></td>
			<td>{{ $equipo->oc}}</td>
		</tr>
		<tr>
			<td><b>Valor O.C. (IVA incl.):</b></td>
			<td> @if($oce != 0 )
				{{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY_ACCOUNTING)->format($oce['Total'])}}
				@endif
			</td>
			<td><b>Valor Equipo (IVA incl.):</b></td>
			<td> {{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY_ACCOUNTING)->format($equipo->valor) }}</td>
		</tr>
		<tr>
			<td><b>Guía Despacho:</b></td>
			<td></td>
			<td><b>Factura:</b></td>
			<td></td>
		</tr>
		@if($equipo->tipoactivo == "Arriendo" || $equipo->tipoactivo == "Arriendo Con Donacion" || $equipo->tipoactivo == "Arriendo con donacion")
		<tr>
			<td colspan="4" style="background-color: white; color: black; border: white;"> <b>Datos Arriendo:</b> </td>
		</tr>
		<tr>
			<td><b>Frecuencia Cuota:</b> </td>
			<td>
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
			</td>
			<td><b> N° de Cuotas:</b></td>
			<td>{{$convenio->meses/$convenio->frecuenciapago}}</td>
		</tr>
		<tr>
			<td><b>Finalización Arriendo: </b></td>
			<td> {{date("d-m-Y", strtotime($convenio->fechafin))}}</td>
			<td><b> Valor Cuota: </b></td>
			<td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY_ACCOUNTING)->format( $convenio->valor/($convenio->meses/$convenio->frecuenciapago)) }}</td>
		</tr>
		@endif


	</tbody>

</table>

<p style="text-align: left;"><b>2. Datos del Proveedor: </b> <br> </p>

<table class="table table-striped text-justify" style="width: 100%">
	<col width="25%">
	<col width="25%">
	<col width="25%">
	<col width="25%">
	<tbody>
		<tr>
			<td><b>Proveedor: </b> </td>
			<td colspan="3"> {{$equipo->Proveedor->nombre}}</td>
		</tr>
		<tr>
			<td><b> Dirección:</b> </td>
			<td colspan="3">{{$equipo->Proveedor->direccion}}</td>
		</tr>
		<tr>
			<td><b>RUT:</b> </td>
			<td>{{$equipo->Proveedor->rut}}</td>
			<td><b>Teléfono: </b> </td>
			<td>{{$equipo->Proveedor->telefono}}</td>
		</tr>
	</tbody>
</table>

<p style="text-align: left;"><b>3. Datos del Equipo: </b> <br> </p>

<table class="table table-striped text-justify" style="width: 100%">
	<col width="25%">
	<tbody>
		<tr>
			<td><b> Equipo: </b></td>
			<td>{{$equipo->SubFamilia->nombre}}</td>
		</tr>
		<tr>
			<td><b> Marca: </b></td>
			<td> {{$equipo->Marca->marca}}</td>
		</tr>
		<tr>
			<td><b> Modelo: </b></td>
			<td> {{$equipo->Modelo->modelo}}</td>
		</tr>
		<tr>
			<td><b> N° Serie: </b></td>
			<td>{{$equipo->serie}}</td>
		</tr>
		<tr>
			<td><b> Año Fabricación: </b></td>
			<td>{{$equipo->fabricacion}}</td>
		</tr>
		<tr>
			<td><b> Vida Útil: </b></td>
			<td>{{$equipo->SubFamilia->vidautil}} años</td>
		</tr>
		<tr>
			<td><b> N° Inventario: </b></td>
			<td>{{$equipo->inventario ?? '-'}}</td>
		</tr>
		<tr>
			<td><b> Servicio Clínico: </b></td>
			<td>{{$equipo->ServicioClinico->nombre}}</td>
		</tr>
		<tr>
			<td><b> Edificio/Piso: </b></td>
			<td>{{$equipo->ServicioClinico->ubicacion}}</td>
		</tr>
		<tr>
			<td><b> C. Responsabilidad: </b></td>
			<td>{{$equipo->ServicioClinico->cr}}</td>
		</tr>

	</tbody>

</table>

<p style="text-align: left;"><b> 4. Condiciones de Compra: </b> <br> </p>

<table class="table table-striped text-justify" style="width: 100%">

	<tbody>

		<tr>
			<td><b>Cumplimiento EE.TT </b></td>
			<td width="30px"></td>
			<td><b>Catálogo C. Marco</b></td>
			<td width="30px"></td>
			<td><b>Cumplimiento Corización</b></td>
			<td width="30px"></td>

		</tr>
		<tr>
			<td><b>Capacitación clínica</b></td>
			<td width="30px"></td>
			<td><b>Capacitación técnica</b></td>
			<td width="30px"></td>
			<td><b>Compromiso capacitación</b></td>
			<td width="30px"></td>
		</tr>
		<tr>
			@if($garantia != "")
			<td><b>Meses de Garantía: </b></td>
			<td colspan="2">{{$garantia->meses_garantia }} meses</td>

			<td colspan="2"><b> MP Anuales: </b></td>
			<td width="30px" style="text-align: center;">{{12/$garantia->frecuencia }}</td>
			@else
			<td colspan="2"><b>Meses de Garantía: </b></td>
			<td>Sin Garantia</td>
			<td colspan="2"><b> MP Anuales: </b></td>
			<td> -- </td>
			@endif
		</tr>
		<tr>
			<td><b>Equipo Back Up:</b></td>
			<td colspan="5"></td>
		</tr>
		<tr height="100px">
			<td style="vertical-align: middle;"><b>Observaciones: </b></td>
			<td colspan="5"></td>
		</tr>

	</tbody>
</table>

<div style="page-break-after: always;"></div>

<p style="text-align: left;"><b>5. Componentes del Equipo </b> <br> </p>

<table class="table table-striped text-justify" style="width: 100%">
	<thead>
		<th width="30px" style="text-align: center;"><b>#</b></th>
		<th>Nombre</th>
		<th>Marca</th>
		<th>Modelo</th>
		<th>Serie</th>
	</thead>
	<tbody>
		@for ($i = 0; $i < 15; $i++) <tr>
			<td width="30px" style="text-align: center">@if($i < 9) 0{{$i+1}} @else {{$i+1}} @endif </td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			</tr>
			@endfor
	</tbody>
</table>

<p style="text-align: left;"><b>6. Responsables </b> <br> </p>

<p> Para constancia de conformidad firman los siguientes funcionarios, parte de la comisión de recepción: </p>


<table class="text-justify" cellpadding="7px" style="width: 100%">
	<col width="25%">
	<col width="25%">
	<col width="25%">
	<col width="25%">


	<tbody>
		<tr>
			<td><b>Cargo:</b></td>
			<td><b>Nombre: </b></td>
			<td><b>RUT: </b></td>
			<td><b>Firma:</b> </td>
		</tr>

		<tr height="100px">
			<td><i>Responsable de Servicio<br> o quien designe</i></td>
			<td>______________________</td>
			<td>______________________</td>
			<td>______________________</td>

		</tr>

		<tr height="100px">
			<td><i>Jefe Sub-Departamento de Equipos Médicos <br> o quien designe</i></td>
			<td>______________________</td>
			<td>______________________</td>
			<td>______________________</td>

		</tr>

		<tr height="100px">
			<td><i>Jefe de Unidad de Inventario</i></td>
			<td>______________________</td>
			<td>______________________</td>
			<td>______________________</td>

		</tr>

	</tbody>
</table>




@stop