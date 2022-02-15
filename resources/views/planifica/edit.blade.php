
@extends('adminlte::page')

@section('title', 'Programar MP')

@section('content_header')
    <h1>Programar Equipo </h1>
@stop

@section('content')
 <form action="/planifica/{{$planifica->id}}" method="POST">
	@csrf
	@method('PUT')
 	<div class="row align-items-start">
		<div class="col">
		<label for="" class="form-label">Responsable</label>
		<select class="form-control" name="responsable" id="responsable" tabindex="1">
	         <option value="{{ $planifica->Proveedor->id }}">{{ $planifica->Proveedor->nombre }}</option>
	         @foreach($responsable as $id=>$nombre)
	         <option value="{{$id}}">{{$nombre}}</option>
	         @endforeach
     	</select>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha Planificada</label>
			<input type="date" name="fecha" id="fecha" value="{{ $planifica->fechacorte }}" class="form-control"  readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Tipo de Mantencion</label>
			<select class="form-control" name="tipo" id="tipo" tabindex="1">
	         <option value="{{ $planifica->tipomp }}">{{ $planifica->tipomp }}</option>
	         <option value="Garantia">Garantia</option>
	         <option value="Convenio">Convenio</option>
	         <option value="Interna">Interna</option>
	         <option value="Compra de Servicio">Compra de Servicio</option>
     	</select>
			
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Equipo</label>
			<input type="text" name="equipo" id="equipo" value="Inventario: {{ $planifica->Equipo->inventario }} Serie: {{ $planifica->Equipo->serie }} Modelo: {{ $planifica->Equipo->Modelo->modelo }} Familia: {{ $planifica->Equipo->Familia->nombre }}" class="form-control" readonly >
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Programacion</label>
			<input type="date" name="programacion" id="programacion" class="form-control" tabindex="1">
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