@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Dependencia del Usuario</h1>
@stop

@section('content')
    <form action="{{route('user.checkdependencia',$user->id)  }}" method="POST">
	@csrf
	
	<div class="mb-3">
		<label for="" class="form-label">Nombre del Usuario</label>
		<input id="nombre" name="nombre" type="text" value="{{$user->name}}" readonly class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Correo del Usuario</label>
		<input id="nombre" name="nombre" type="text" value="{{$user->email}}" readonly class="form-control">
	</div>
	<div class="col">
			<label for="" class="form-label">Dependencia</label>
			<select class="form-control" name="dependencia" id="dependencia" required >
				<option selected disabled>Servicios de Salud</option>
				@foreach($servicios as $servicio)
				<option value="{{'servicio- '.$servicio->id}}">{{$servicio->nombre}} </option>
				@endforeach
				<option selected disabled>Centros de Salud</option>
				@foreach($centros as $centro)
				<option value="{{'centro-'.$centro->id}}">{{$centro->nombre}} </option>
				@endforeach
			</select>
		</div>
		
	<a href="/user" class="btn btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop