@extends('adminlte::page')

@section('title', 'Edit Baja')

@section('content_header')
    <h1>Editar una Baja</h1>
@stop

@section('content')
<form action="/baja/{{ $baja->id }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Numero Baja/ Año Baja</label>
		<input id="baja" name="baja" type="text" value="{{ $baja->baja }}" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Fecha de la Baja</label>
		<input id="fecha" name="fecha" type="date" value="{{$baja->fecha }}" tabindex="2" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Equipo</label>
		<input id="equipo" name="equipo" type="text" value="{{ $baja->Equipo->inventario  }}" tabindex="3"  class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Archivo de la Baja</label>
		<input id="documento" name="documento" type="file" tabindex="4" class="form-control">
	</div>
	<a href="/proveedor" class="btn btn-secondary" >CANCELAR</a>
	<button  class="btn btn-primary" >GUARDAR</button>
</form>

@stop


