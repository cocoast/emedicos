@extends('adminlte::page')

@section('title', 'Editar Proveedor')

@section('content_header')
    <h1>Editar Proveedor</h1>
@stop

@section('content')
    <form action="/proveedor/{{$proveedor->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Nombre del Proveedor</label>
		<input id="nombre" name="nombre" type="text" value="{{$proveedor->nombre}}" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Rut del Proveedor</label>
		<input id="rut" name="rut" type="text" tabindex="2" value="{{$proveedor->rut}}" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Telefono del Proveedor</label>
		<input id="telefono" name="telefono" type="text" tabindex="3" value="{{$proveedor->telefono}}" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Correo del Proveedor</label>
		<input id="email" name="email" type="text" tabindex="4" value="{{$proveedor->email}}" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Direccion del Proveedor</label>
		<input id="direccion" name="direccion" type="text" tabindex="5" value="{{$proveedor->direccion}}" class="form-control">
	</div>
	<a href="/proveedor" class="btn btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop