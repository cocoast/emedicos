
@extends('ppa')

@section('title', 'Add Licitacion')

@section('content_header')
    <h1>Generar Licitacion</h1>
@stop

@section('body')
<form action="/licitacion" method="POST"  enctype="multipart/form-data">
	@csrf
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generar Licitacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body ui-front">
<div class="row">
	<div class="col">
		<label for="" class="form-label">Seleccione Licitador</label>
		<select name="licitador" id="licitador" class="form-control" required>
			<option value="" selected>Seleccione</option>
			@foreach($licitadores as $licitador)
			<option value="{{ $licitador->id }}">{{ $licitador->name }}</option>
			@endforeach
		</select>
	</div>
	<div class="col">
		<label for="" class="form-label">Categoria</label>
		<select name="categoria" id="categoria" class="form-control" required>
			<option value="">Seleccion</option>
			@foreach ($categorias as $categoria)
				<option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
			@endforeach	
		</select>
		
	</div>
	
</div>
<div class="row">
	<div class=" col-6">
		<label for="" class="form-label">Servicio Demandante</label>
     	<input id="servicio" name="servicio" type="text" class="form-control" required>
     	<small id="presupuestoHelp" class="form-text text-muted">Busqueda de Servicio Demandante</small>
	</div>
	<div class="col">
		<label for="" class="form-label">N° de Solicitud</label>
		<input id="solicitud" name="solicitud" type="number" class="form-control" required>
		<small id="presupuestoHelp" class="form-text text-muted">Ingrese Valores numericos</small>
	</div>
	<div class="col">
		<label for="" class="form-label">Fecha de Solicitud</label>
		<input id="fecha" name="fecha" type="date" class="form-control" required>
		<small id="presupuestoHelp" class="form-text text-muted">Ingrese fecha</small>
	</div>
</div>
<div class="row">
	<div class="col">
		<label for="" class="form-label">Presupuesto</label>
		<input id="presupuesto" name="presupuesto" type="number" class="form-control" required>
		<small id="presupuestoHelp" class="form-text text-muted">Ingrese Valores numericos</small>
	</div>
	
		<div class="col">
		<label for="" class="form-label">Documento Solicitud</label>
		<input id="documento" name="documento" type="file" class="form-control" required >
		<small id="presupuestoHelp" class="form-text text-muted">Debe ser formato "PDF"</small>
	</div>
</div>


</div>
<div class="modal-footer">
	<button  class="btn btn-primary" tabindex="3">Guardar</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
      	$('#servicio').autocomplete({
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
    	

    </script> 
@stop