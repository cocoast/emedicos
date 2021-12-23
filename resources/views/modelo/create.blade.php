@extends('adminlte::page')

@section('title', 'Add Modelo')

@section('content_header')
    <h1>Crear Modelo</h1>
@stop

@section('content')
<form action="/modelo" method="POST">
	@csrf
	<div class="mb-3">
		<label for="" class="form-label">Nombre del Modelo</label>
		<input id="modelo" name="modelo" type="text" tabindex="1" class="form-control">
	</div>
	<a href="/modelo" class="btn btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    
@stop

@section('js')
    
@stop