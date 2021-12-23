@extends('ppa')

@section('title', 'Add Baja')

@section('content_header')
    <h1>Crear una Baja</h1>
@stop

@section('content')
<form action="/baja" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="mb-3">
		<label for="" class="form-label">Numero Baja/ Año Baja</label>
		<input id="baja" name="baja" type="text" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Fecha de la Baja</label>
		<input id="fecha" name="fecha" type="date" tabindex="2" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Equipo</label>
		<input id="equipo" name="equipo" type="text" tabindex="3" placeholder="Ingrese Inventario o Serie" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Archivo de la Baja</label>
		<input id="documento" name="documento" type="file" tabindex="4" class="form-control">
	</div>
	<a href="/proveedor" class="btn btn-secondary" >CANCELAR</a>
	<button  class="btn btn-primary" >GUARDAR</button>
</form>
@stop

