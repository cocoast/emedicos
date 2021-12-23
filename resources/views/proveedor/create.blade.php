
@extends('adminlte::page')

@section('title', 'Add Proveedor')

@section('content_header')
    <h1>Crear una Proveedor</h1>
@stop

@section('content')
<form action="/proveedor" method="POST">
	@csrf
	<div class="mb-3">
		<label for="" class="form-label">Nombre del Proveedor</label>
		<input id="nombre" name="nombre" type="text" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Rut del Proveedor</label>
		<input id="rut" name="rut" type="text" tabindex="2" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Telefono del Proveedor</label>
		<input id="telefono" name="telefono" type="text" tabindex="3" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Correo del Proveedor</label>
		<input id="email" name="email" type="text" tabindex="4" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Direccion del Proveedor</label>
		<input id="direccion" name="direccion" type="text" tabindex="5" class="form-control">
	</div>
	<a href="/proveedor" class="btn btn-secondary" >CANCELAR</a>
	<button  class="btn btn-primary" >GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    
@stop