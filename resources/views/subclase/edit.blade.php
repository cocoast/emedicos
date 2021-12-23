@extends('adminlte::page')

@section('title', 'Editar SubClase')

@section('content_header')
    <h1>Editar SubClase</h1>
@stop

@section('content')
    <form action="/subclase/{{$subclase->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Nombre de la subclase</label>
		<input id="subclase" name="subclase" type="text" value="{{$subclase->subclase}}" tabindex="1" class="form-control">
	</div>
	<a href="/subclase" class="btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop