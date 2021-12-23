@extends('adminlte::page')

@section('title', 'Editar Familia')

@section('content_header')
    <h1>Editar Familia</h1>
@stop

@section('content')
    <form action="/familia/{{$familia->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Nombre de la familia</label>
		<input id="familia" name="familia" type="text" value="{{$familia->nombre}}" tabindex="1" class="form-control">
	</div>
	<a href="/familia" class="btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop