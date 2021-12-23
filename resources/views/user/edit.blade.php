@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <form action="/user/{{$user->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Nombre de la user</label>
		<input id="nombre" name="nombre" type="text" value="{{$user->name}}" class="form-control">
	</div>
	<div class="col">
			<label for="" class="form-label">Rol</label>
			<select class="form-control" name="rol" id="rol"  >
				<option selected>Seleccione Rol</option>
				@foreach($roles as $rol)
				<option value="{{$rol->id}}">{{$rol->name}} </option>
				@endforeach
			</select>
		</div>
		<div class="col">
		<label for="" class="form-label">Rol Asignado al usuario</label>
		@foreach($user->roles as $ro1)
		<input id="user" name="user" type="text" value="{{$ro1->name}}" readonly class="form-control">
		@endforeach
		</div>
	<a href="/user" class="btn btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
<div class="mb-3">
		
		<br>

		@foreach($user->roles as $ro1)
		
      	<form action="{{route('user.destroy',($ro1->id.'-'.$user->id ))}}" method="POST">
      	@csrf
      	@method('DELETE')
      	<button class="btn btn-danger" type="submit" onClick="javascript: return confirm('¿Estas seguro?');">{{$ro1->name}}</button>
      	</form>
      	<br>
		@endforeach
		
		</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop