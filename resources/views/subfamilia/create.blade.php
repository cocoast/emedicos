
@extends('adminlte::page')

@section('title', 'Add SubFamilias')

@section('content_header')
    <h1>Crear una SubFamilias</h1>
@stop

@section('content')
<form action="/subfamilia" method="POST">
	@csrf
	<div class="mb-3">
		<label for="" class="form-label">Nombre de la Sub-Familia</label>
		<input id="subfamilia" name="subfamilia" type="text" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Vida Util</label>
		<input id="vidautil" name="vidautil" type="text" tabindex="2" class="form-control">
	</div>
	<a href="/subfamilia" class="btn btn-secondary" tabindex="3">CANCELAR</a>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
	
@stop