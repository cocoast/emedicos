@extends('adminlte::page')

@section('title', 'Editar Clase')

@section('content_header')
    <h1>Editar Clase</h1>
@stop

@section('content')
    <form action="/clase/{{$clase->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Nombre de la clase</label>
		<input id="clase" name="clase" type="text" value="{{$clase->clase}}" tabindex="1" class="form-control">
	</div>
	<a href="/clase" class="btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop