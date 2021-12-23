
@extends('adminlte::page')

@section('title', 'Add Servicio Clinico')

@section('content_header')
    <h1>Crear una Servicio Clinico</h1>
@stop

@section('content')
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
	<a href="/servicioclinico" class="btn btn-secondary" >CANCELAR</a>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    
@stop