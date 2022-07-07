
@extends('ppa')

@section('title', 'Add Servicio Clinico')

@section('content_header')
    <h1>Crear una Servicio Clinico</h1>
@stop

@section('body')
<form action="/servicioclinico" method="POST">
	@csrf
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Servicio Clínico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body ui-front">

	<div class="mb-3">
		<label for="" class="form-label">Nombre del Servicio Clinico</label>
		<input id="nombre" name="nombre" type="text"  class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Ubicación del Servicio Clinico</label>
		<input id="ubicacion" name="ubicacion" type="text"  class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Responsable del Servicio Clinico</label>
		<input id="responsable" name="responsable" type="text" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Correo del Responsable del Servicio Clinico</label>
		<input id="email_responsable" name="email_responsable" type="text"  class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Centro de Recurso Fisico</label>
		<select class="form-control" name="cr" id="cr"  tabindex="5">
			<option value="" selected>Seleccione</option>
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
		<input id="anexo" name="anexo" type="text"  class="form-control">
	</div>
	
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	<button  class="btn btn-primary" type="submit">GUARDAR</button>
</div> 
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    
@stop