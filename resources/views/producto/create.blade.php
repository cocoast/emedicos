
@extends('adminlte::page')

@section('title', 'Add Producto')

@section('content_header')
    <h1>Crear un producto</h1>
@stop

@section('content')
<form action="/producto" method="POST">
	@csrf
	<div class="mb-3">
		<label for="" class="form-label">Nombre del producto</label>
		<input id="nombre" name="nombre" type="text" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Familia producto</label>
		<input id="familia" name="familia" type="text" tabindex="2" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">SubFamilia producto</label>
		<input id="subfamilia" name="subfamilia" type="text" tabindex="3" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Proveedor producto</label>
		<input id="proveedor" name="proveedor" type="text" tabindex="4" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Codigo Proveedor del producto</label>
		<input id="codigoproveedor" name="codigoproveedor" type="text" tabindex="5" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Codigo Proveedor hpm</label>
		<input id="codigoHPM" name="codigoHPM" type="text" tabindex="6" class="form-control">
	</div>
	<a href="/proveedor" class="btn btn-secondary" >CANCELAR</a>
	<button  class="btn btn-primary" >GUARDAR</button>
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
    	$('#marca').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.marca') }}",	
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
    	$('#modelo').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.modelo') }}",	
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
    	$('#servicioclinico').autocomplete({
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
    	$('#familia').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.familia') }}",	
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
    	$('#subfamilia').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.subfamilia') }}",	
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