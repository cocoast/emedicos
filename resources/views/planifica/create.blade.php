
@extends('adminlte::page')

@section('title', 'Add Marca')

@section('content_header')
    <h1>Planificar Equipos Por Responsable</h1>
@stop

@section('content')
<form action="/planifica" method="POST">
	@csrf
 	<div class="row align-items-start">
		<div class="col">
		<label for="" class="form-label">Responsable</label>
		<select class="form-control" name="responsable" id="responsable" tabindex="1">
	         <option selected>Seleccione</option>
	         @foreach($responsable as $id=>$nombre)
	         <option value="{{$id}}">{{$nombre}}</option>
	         @endforeach
     	</select>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha Planificada</label>
			<input type="date" name="fecha" id="fecha" class="form-control" tabindex="2">
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Equipos (separar por espacio)</label>
			<textarea name="equiposdatos" id="equiposdatos" class="form-control" tabindex="3"></textarea>
			
		</div>
		<div class="col">
			<label for="" class="form-label">Tipo de Mantencion</label>
			<select class="form-control" name="tipo" id="tipo" tabindex="1">
	         <option selected>Seleccione</option>
	         <option value="Garantia">Garantia</option>
	         <option value="Convenio">Convenio</option>
	         <option value="Interna">Interna</option>
	         <option value="Compra de Servicio">Compra de Servicio</option>
     	</select>
			
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