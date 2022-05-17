
@extends('ppa')

@section('title', 'Add Servicio de Salud')

@section('content_header')
    <h1>Editar un Servicio de Salud</h1>
@stop

@section('body')
<div class="modal-body">
    <form action="/ssalud/{{$servicio->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Nombre del Servicio de Salud</label>
		<input id="nombre" name="nombre" type="text" value="{{$servicio->nombre}}" tabindex="1" class="form-control">
	</div>
	<a href="/familia" class="btn btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

@stop

