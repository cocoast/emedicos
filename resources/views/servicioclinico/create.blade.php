
@extends('ppa')

@section('title', 'Add Servicio Clinico')

@section('content_header')
    <h1>Crear una Servicio Clinico</h1>
@stop

@section('body')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Servicio Clínico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
<form action="/servicioclinico" method="POST">
	@csrf
	<div class="mb-3">
		<label for="" class="form-label">Nombre del Servicio Clinico</label>
		<input id="nombre" name="nombre" type="text" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Ubicación del Servicio Clinico</label>
		<input id="ubicacion" name="ubicacion" type="text" tabindex="2" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Responsable del Servicio Clinico</label>
		<input id="responsable" name="responsable" type="text" tabindex="3" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Correo del Responsable del Servicio Clinico</label>
		<input id="email_responsable" name="email_responsable" type="text" tabindex="4" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Centro de Recurso Fisico</label>
		<input id="cr" name="cr" type="text" tabindex="3" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Anexo Responsable</label>
		<input id="anexo" name="anexo" type="text" tabindex="4" class="form-control">
	</div>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
</div> 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    
@stop