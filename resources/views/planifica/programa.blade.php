
@extends('adminlte::page')

@section('title', 'Add Marca')

@section('content_header')
    <h1>Programar Equipos Por Fecha</h1>
@stop

@section('content')
<form action="/planifica/programacion" method="POST">
	@csrf
 	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Fecha Programada</label>
			<input type="date" name="fecha" id="fecha" class="form-control" tabindex="2">
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Equipos (separar por espacio)</label>
			<textarea name="equiposdatos" id="equiposdatos" class="form-control" tabindex="3"></textarea>
		</div>
		
	</div>
	<br>
	<a href="/planifica" class="btn btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
	
</form>
@stop

@section('css')
    
@stop

@section('js')
    
@stop