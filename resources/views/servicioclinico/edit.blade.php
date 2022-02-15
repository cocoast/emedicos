@extends('ppa')

@section('title', 'Editar Servicio Clinico')

@section('content_header')
    <h1>Editar Servicio Clinico</h1>
@stop

@section('body')
    <form action="/servicioclinico/{{$servicioclinico->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Nombre del Servicio Clinico</label>
		<input id="nombre" name="nombre" type="text" value="{{$servicioclinico->nombre}}" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Ubicación del Servicio Clinico</label>
		<input id="ubicacion" name="ubicacion" type="text" value="{{$servicioclinico->ubicacion}}" tabindex="2" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Responsable del Servicio Clinico</label>
		<input id="responsable" name="responsable" type="text" tabindex="3" value="{{$servicioclinico->responsable}}" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Correo del Responsable del Servicio Clinico</label>
		<input id="email_responsable" name="email_responsable" type="text" tabindex="4" value="{{$servicioclinico->email_responsable}}" class="form-control">
	</div>
	<div class="col">
			<label for="" class="form-label">Centro de Recurso Fisico</label>
			<select class="form-control" name="cr" id="cr"  tabindex="5">
				<option value="{{$servicioclinico->cr}}" selected>{{ $servicioclinico->cr }}</option>
				<option value="Medico del Adulto">Medico del Adulto </option>
				<option value="Operaciones">Operaciones</option>
				<option value="Materno Infantil">Materno Infantil</option>
				<option value="Quirurgico">Quirurgico</option>
				<option value="Atencion Abierta">Atencion Abierta</option>
				<option value="Apoyo Diagnostico Terapeutico">Apoyo Diagnostico Terapeutico</option>
				
			</select>
		</div>
	<div class="mb-3">
		<label for="" class="form-label">Anexo Responsable</label>
		<input id="anexo" name="anexo" type="text" tabindex="6" value="{{ $servicioclinico->anexo }}" class="form-control">
	</div>
	
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop