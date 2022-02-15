
@extends('adminlte::page')

@section('title', 'Add Planificación')

@section('content_header')
    <h1>Planificar Equipos Por Responsable</h1>
@stop

@section('content')
<form action="/planifica" method="POST">
	@csrf
 	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label" >Proveedor</label>
	     	<input id="responsable" name="responsable" type="text" tabindex="1" class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha Planificada</label>
			<input type="date" name="fecha" id="fecha" class="form-control" tabindex="2" required>
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label"> Tipo de Identificador</label>
			<div>
 				<input type="radio" id="id" name="identificador" value="id" >
  			<label for="id">ID</label>
			</div>
			<div>
  			<input type="radio" id="inventario" name="identificador" value="inventario">
  			<label for="inventario">Inventario</label>
			</div>
			<div>
  			<input type="radio" id="serie" name="identificador" value="serie">
  			<label for="serie">Serie</label>
			</div>
		</div>
		<div class="col">
			<label for="" class="form-label">Equipos (separar por espacio)</label>
			<textarea name="equiposdatos" id="equiposdatos" class="form-control" tabindex="3" required></textarea>
			
		</div>
	
		<div class="col">
			<label for="" class="form-label">Tipo de Mantencion</label>
			<select class="form-control" name="tipo" id="tipo" tabindex="1" required>
	         <option value="">Seleccione</option>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.css') }}">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
    	$('#responsable').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.proveedor') }}",
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