@extends('adminlte::page')

@section('title', 'Editar SubFamilias')

@section('content_header')
    <h1>Editar SubFamilia</h1>
@stop

@section('content')
    <form action="/subfamilia/{{$subfamilia->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Nombre de la subfamilia</label>
		<input id="subfamilia" name="subfamilia" type="text" value="{{$subfamilia->nombre}}" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Vida Util</label>
		<input id="vidautil" name="vidautil" type="text" value="{{$subfamilia->vidautil}}" tabindex="2" class="form-control">
	</div>
	<a href="/subfamilias" class="btn btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
 
@stop