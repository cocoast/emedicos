@extends('adminlte::page')

@section('title', 'Editar Modelo')

@section('content_header')
    <h1>Editar Modelo</h1>
@stop

@section('content')
    <form action="/modelo/{{$modelo->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Nombre de la modelo</label>
		<input id="modelo" name="modelo" type="text" value="{{$modelo->modelo}}" tabindex="1" class="form-control">
	</div>
	<a href="/modelo" class="btn btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop