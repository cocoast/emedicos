@extends('adminlte::page')

@section('title', 'Edit Centro Salud')

@section('content_header')
    <h1>Editar Centro Salud</h1>
@stop

@section('content')
<form action="/centrosalud/{{$centro->id}}" method="POST">
	@csrf
	@method('PUT')
 	<div class="col align-items-start">
		<label for="" class="form-label">Nombre centro de Salud</label>
		<input id="nombre" name="nombre" value="{{ $centro->nombre }}" type="text"  class="form-control" required >
	</div>

	<div class="col">
		<label for="" class="form-label" >Servicio de salud</label>
		<input id="ssalud" name="ssalud" type="text" value="{{ $centro->ssalud.' - '.$centro->Ssalud->nombre }}" class="form-control" required>
	</div>


	
<div class="mb-3">
	<div class="row align-items-start mb-3">
		<div class="col">
		<a href="/equipo" class="btn btn-secondary">CANCELAR</a>
	</div>
	<div class="col">
		<button  class="btn btn-primary" >GUARDAR</button>
	</div>
</div>

</form>
@stop

@section('css')
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.css') }}">

@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
    	$('#ssalud').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.ssalud') }}",
    				dataType: 'json',
    				data:{
    					term: request.term
    				},
    				success: function(data){
    					response(data)
    				}
    			});
    		}
    	});
    </script> 
@stop