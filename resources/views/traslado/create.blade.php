
@extends('adminlte::page')

@section('title', 'Generar Acta de Traslado')

@section('content_header')
    <h1>Crear un Traslado</h1>
@stop

@section('content')
<h1>Traslado de Equipos</h1>
<form action="/traslado" method="POST">
	@csrf
 	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Fecha</label>
			<input id="fecha" name="fecha" type="date" tabindex="1" class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label">Numero</label>
			<input id="numero" name="numero" type="text" value="{{ $numero }}"  class="form-control" readonly >
		</div>
	</div>
	<div class="mb-3">
		<div class="row align-items-start">
			<div class="col">
			<label for="" class="form-label">Servicio Clinico Actual</label>
	     		<input id="actual" name="actual" type="text" tabindex="2"  class="form-control" required>
				</div>
			<div class="col">
				<label for="" class="form-label">Servicio Clinico Destino</label>
	     		<input id="destino" name="destino" type="text" tabindex="3"  class="form-control" required>
			</div>
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Equipo</label>
	     	<input id="equipo" name="equipo" type="text" tabindex="4"  class="form-control" required>
		</div>
	</div>
	<div class="mt-4 mb-3">
	<div class="row align-items-start mb-3">
		
	<div class="col">
		<button  class="btn btn-primary" tabindex="6">GUARDAR</button>
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
    	
    	
    	$('#actual').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.servicio') }}",	
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
    	$('#destino').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.servicio') }}",	
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
    	$('#equipo').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.equipo') }}",	
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