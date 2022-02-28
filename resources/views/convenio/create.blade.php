
@extends('adminlte::page')

@section('title', 'Add Convenio')

@section('content_header')
    <h1>Ingresar Convenio</h1>
@stop

@section('content')
<form action="/convenio" method="POST">
	@csrf
 	<div class="row align-items-start">
 		<div class="col">
			<label for="" class="form-label">Nombre Convenio</label>
			<input id="nombre" name="nombre" type="text" tabindex="1" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Licitacion Convenio</label>
			<input id="licitacion" name="licitacion" type="text" tabindex="1" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Solicitud</label>
			<input id="solicitud" name="solicitud" type="text" tabindex="2" class="form-control">
		</div>

	</div>
	<div class="mb-3">
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Resolucion</label>
			<input id="resolucion" name="resolucion" type="text" tabindex="2" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Resolucion</label>
			<input id="fecharesolucion" name="fecharesolucion" type="text" tabindex="3" class="form-control">
		</div>
	</div>
	</div>
	<div class="mb-3">
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Fecha de Inicio del Convenio</label>
			<input id="fechainicio" name="fechainicio" type="date" tabindex="3" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Termino del convenio</label>
			<input id="fechafin" name="fechafin" type="date" tabindex="5" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Valor +IVA del  convenio</label>
			<input id="valor" name="valor" type="text" tabindex="5" class="form-control">
		</div>
	</div>
</div>
	
	<div class="mb-3">		
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Cantidad de Meses</label>
			<input id="meses" name="meses" type="text" tabindex="6" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Frecuencia de Pago</label>
			<select class="form-control" name="frecuenciapago" id="frecuenciapago" tabindex="7">
				<option selected>Seleccione</option>
				<option value="">Seleccione</option>
				<option value="1">Mensual (cada mes)</option>
				<option value="3">Trimestral (Que se repite cada 3 meses)</option>
				<option value="4">Cuatrimestral (Que se repite cada 4 meses)</option>
				<option value="6">Semestral (Que se repite cada 6 meses)</option>
				<option value="12">Anual (Que se repite cada 12 meses)</option>
				<option value="Manual">Manual</option>
		
			</select>
		</div>
	</div>
</div>
	<div class="mb-3">		
	<div class="row align-items-start">
	<div class="col">
		<label for="" class="form-label">Tipo de Convenio</label>
     	<select class="form-control" name="tipoconvenio" id="tipoconvenio" tabindex="7">
				<option selected>Seleccione</option>
				<option value="Arriendo">Arriendo</option>
				<option value="Arriendo con Donacion">Arriendo con Donación</option>
				<option value="Garantia">Garantia</option>
				<option value="Mantenimiento">Mantenimiento</option>
				<option value="Correctivo">Correctivo</option>
			</select>
		</div>
		<div class="col">
			<label for="" class="form-label">URL Mercado Publico</label>
			<input id="link" name="link" type="text" tabindex="3" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Proveedor</label>
			<input id="proveedor" name="proveedor" type="text" class="form-control">
		</div>
	</div>
</div>
<div class="mb-3">
	<div class="row align-items-start mb-3">
		<div class="col">
		<a href="/convenio" class="btn btn-secondary">CANCELAR</a>
	</div>
	<div class="col">
		<button  class="btn btn-primary" tabindex="16">GUARDAR</button>
	</div>
</div>

</form>
@stop

@section('css')
	<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.css') }}">
 
@stop

@section('js')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
    	$('#proveedor').autocomplete({
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