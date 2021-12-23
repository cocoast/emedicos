@extends('adminlte::page')

@section('title', 'Servicio Clinico')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@stop
@section('content_header')
    <h1>Detalles del Servicio Clinico: <b>{{$servicio->nombre}}</b></h1>
@stop

@section('content')
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">ID</label>
			<input id="licitacion" value="{{$servicio->id}}" name="licitacion" type="text" tabindex="1" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Ubicación</label>
			<input id="solicitud" value="{{$servicio->ubicacion}}" name="solicitud" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Responsable</label>
			<input id="resolucion" value="{{$servicio->responsable}}" name="resolucion" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Correo del Responsable</label>
			<input id="fecharesolucion" value="{{$servicio->email_responsable}}" name="fecharesolucion" type="text" tabindex="3" class="form-control"readonly>
		</div>
		
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop