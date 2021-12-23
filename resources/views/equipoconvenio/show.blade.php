@extends('adminlte::page')

@section('title', 'Mostrar Equipo')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@stop
@section('content_header')
    <h1>Detalles del Convenio: <b>{{$convenio->nombre}}</b></h1>
@stop

@section('content')
<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Licitacion Convenio</label>
			<input id="licitacion" value="{{$convenio->licitacion}}" name="licitacion" type="text" tabindex="1" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Solicitud</label>
			<input id="solicitud" value="{{$convenio->solicitud}}" name="solicitud" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Resolucion</label>
			<input id="resolucion" value="{{$convenio->resolucion}}" name="resolucion" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Resolucion</label>
			<input id="fecharesolucion" value="{{$convenio->fecharesolucion}}" name="fecharesolucion" type="text" tabindex="3" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Valor Convenio+IVA</label>
			<input id="valor" value="{{$convenio->valor}}" name="valor" type="text" tabindex="3" class="form-control"readonly>
		</div>
	</div>
	<div class="mb-3">
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Fecha de Inicio del Convenio</label>
			<input id="fechainicio" value="{{$convenio->fechaincio}}" name="fechainicio" type="text" tabindex="3" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Termino del convenio</label>
			<input id="fechafin" value="{{$convenio->fechafin}}" name="fechafin" type="text" tabindex="5" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Meses</label>
			<input id="meses" name="meses" value="{{$convenio->meses}}" type="text" tabindex="3" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Frecuencia de Pago</label>
			<input id="frecuenciapago" name="frecuenciapago" value="{{$convenio->frecuenciapago}}" type="text" tabindex="3" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Tipo de Convenio</label>
			<input id="tipoconvenio" name="tipoconvenio" value="{{$convenio->tipoconvenio}}" type="text" tabindex="3" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Proveedor</label>
			<input id="proveedor" name="proveedor" value="{{$convenio->Proveedor->nombre}}" type="text" tabindex="3" class="form-control" readonly>
		</div>
	</div>
	<div class="row align-items-start ">
		<div class="col">
			<br>
			<h1>Equipo dentro del Convenio</h1>
			<table class="table table-hover table-success ">
				<thead>
				<th>Equipo</th>
				<th>Fecha de Incorporación</th>
				<th>Valor +IVA</th>
				<th>Cantidad MP</th>
				<th>Cantidad MC</th>
				<th>Respuestos</th>
				<th>Funciones</th>
				</thead>
				<tbody>
					<td>Evita V300 2A-22971</td>
					<td>12-06-2019</td>
					<td>$7.825.000</td>
					<td>2</td>
					<td>FULL</td>
					<td>FULL</td>
					<td><a class="btn btn-warning" href="#"><i class="bi bi-pencil"></i></a></td>
				</tbody>
			</table>
		</div>
		<div class="col">
			<br>
			<h1>Pagos Ejecutados</h1>
			<table class="table table-hover table-primary">
				<thead>
				<th>Estado</th>
				<th>Periodo</th>
				<th>Memo</th>
				<th>Fecha</th>
				<th>OC</th>
				<th>Valor+IVA</th>
				<th>Funciones</th>
				</thead>
				<tbody>
					<td>Pagado</td>
					<td>1</td>
					<td>69/2019</td>
					<td>20-12-2019</td>
					<td>1057539-21-SE19</td>
					<td>$6.785.000</td>
					<td><a class="btn btn-warning" href="#"><i class="bi bi-pencil"></i></a></td>
				</tbody>
			</table>
		</div>	
	</div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop