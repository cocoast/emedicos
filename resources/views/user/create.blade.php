@extends('ppa')

@section('title', 'Add Permiso')

@section('content_header')
    <h1>Crear una Permiso</h1>
@stop

@section('body')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Permiso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
<form action="/user" method="POST">
	@csrf
	<div class="mb-3">
		<label for="" class="form-label">Nombre del User</label>
		<input id="nombre" name="nombre" type="text"  class="form-control" required>
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Email del User</label>
		<input id="mail" name="mail" type="text"  class="form-control" required>
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Contraseña</label>
		<input id="password" name="password" type="password"  class="form-control" required>
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Rol</label>
			<select class="form-control" name="rol" id="rol" required >
				<option selected>Seleccione Rol</option>
				@foreach($roles as $rol)
				<option value="{{$rol->id}}">{{$rol->name}} </option>
				@endforeach
			</select>
		</select>
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Establecimiento de Trabajo</label>
			<select class="form-control" name="establecimiento" id="establecimiento" required >
				<option disabled>Servicios de Salud</option>
				@foreach($servicios as $servicio)
				<option value="{{$servicio->id}}">{{$servicio->nombre}} </option>
				@endforeach
				<option value="" disabled> Establecimeintos de Salud</option>
				@foreach ($establecimientos as $establecimiento)
				<option value="{{ $establecimiento->id }}">{{ $establecimiento->nombre }}</option>
				@endforeach
			</select>
		</select>
	</div>
	
	<button  class="btn btn-primary" >GUARDAR</button>
</form>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
@stop

@section('css')
 
@stop

@section('js')

@stop