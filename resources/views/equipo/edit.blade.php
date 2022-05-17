@extends('adminlte::page')

@section('title', 'Editar Equipo')

@section('content_header')
    <h1>Editar Equipo</h1>
@stop

@section('content')
    <form action="/equipo/{{$equipo->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Inventario Equipo</label>
			<input id="inventario" name="inventario" type="text" value="{{$equipo->inventario}}" tabindex="1" class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label">Serie</label>
			<input id="serie" name="serie" type="text" tabindex="2" value="{{$equipo->serie}}" class="form-control" required>
		</div>
	</div>
	<div class="mb-3">
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Fecha de Acta de Recepción</label>
			<input id="fecha_adquisicion" name="fecha_adquisicion" type="text" value="{{$equipo->fecha_adquisicion}}" tabindex="3" class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label"> Licitacion del Proyecto</label>
			<input type="text" class="form-control" name="licitacion" id="licitacion" value="{{ $equipo->licitacion }}">
		</div>
		<div class="col">
			<label for="" class="form-label"> OC del Equipo/ Proyecto</label>
			<input type="text" class="form-control" name="oc" id="oc" value="{{ $equipo->oc }}">
		</div>
		<div class="col">
			<label for="" class="form-label">EQ {{ $equipo->eq}}</label>
			<select class="form-control" name="eq" id="eq"  tabindex="4" required>
				<option value="{{ $equipo->eq}}"> {{ $equipo->eq}}</option>
				<option value="Critico">Critico </option>
				<option value="Relevante">Relevante</option>
				<option value="Sin">Sin</option>
			</select>
		</div>
		<div class="col">
			<label for="" class="form-label">Año de Fabricación</label>
			<input id="fabricacion" name="fabricacion" type="text" tabindex="5" value="{{$equipo->fabricacion}}" class="form-control">
		</div>
	</div>
	</div>
	<div class="mb-3">		
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Valor del Equipo IVA Incluido</label>
			<input id="valor" name="valor" type="text" tabindex="6" value="{{$equipo->valor}}" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Tipo Activo</label>
			<select class="form-control" name="tipoactivo" id="tipoactivo" tabindex="7" required>
				<option value="{{$equipo->tipoactivo}}" selected>{{$equipo->tipoactivo}}</option>
				<option value="Propio">Propio</option>
				<option value="Arriendo">Arriendo</option>
				<option value="Arriendo con donacion">Arriendo Con Donacion</option>
				<option value="Comodato">Comodato</option>
			</select>
		</div>
		<div class="col">
			<label for="" class="form-label">Archivador</label>
			<input id="archivador" name="archivador" value="{{$equipo->archivador}}" type="text" tabindex="7" class="form-control">
		</div>
	</div>
	</div>
	<div class="mb-3">
		<div class="row align-items-start">
		<div class="col">
		<label for="" class="form-label">Marca</label>
     	<input id="marca" name="marca" type="text" tabindex="9" value="{{ $equipo->Marca->id.' - '.$equipo->Marca->marca }}" class="form-control" required>
		</div>
	<div class="col">
		<label for="" class="form-label">Modelo</label>
     <input id="modelo" name="modelo" type="text" tabindex="10"value="{{ $equipo->Modelo->id.' - '.$equipo->Modelo->modelo }}" class="form-control" required>
	</div>
</div>
	<div class="mb-3">
		<div class="row align-items-start">
			<div class="col">
				<label for="" class="form-label" >Proveedor</label>
     			<input id="proveedor" name="proveedor" type="text" value="{{ $equipo->Proveedor->id.' - '.$equipo->Proveedor->nombre }}" tabindex="11" class="form-control" required>
			</div>
			<div class="col">
				<label for="" class="form-label">Servicio Clinico Responsable</label>
     			<input id="servicioclinico" name="servicioclinico" tabindex="12" type="text" value="{{ $equipo->ServicioClinico->id.' - '.$equipo->ServicioClinico->nombre.' - '.$equipo->ServicioClinico->ubicacion }}" class="form-control" required>
			</div>
		</div>
	<div class="mb-3">
		<div class="row align-items-start">
			<div class="col">
				<label for="" class="form-label">Familia del Equipo</label>
     			<input id="familia" name="familia" type="text" value="{{ $equipo->Familia->id.' - '.$equipo->Familia->nombre }}" tabindex="13" class="form-control" required>
 			</div> 
 			<div class="col">
     			<label for="" class="form-label">SubFamilia del Equipo</label>
     			<input id="subfamilia" name="subfamilia" type="text" tabindex="14" value="{{ $equipo->SubFamilia->id.' - '.$equipo->SubFamilia->nombre }}" class="form-control" required>
				</div>
			</div>
		</div>
	<div class="mb-3">	
		<div class="row align-items-start">
			<div class="col">
				<label for="" class="form-label">Clase del Equipo</label>
     			<select class="form-control" name="clase" id="clase" tabindex="15" required>
         				<option value="{{ $equipo->Clase->id }}">{{ $equipo->Clase->nombre }}</option>
         					@foreach($clase as $id=>$nombre)
         				<option value="{{$id}}">{{$nombre}}</option>
         					@endforeach
     			</select>
 			</div>
 			<div class="col">
     			<label for="" class="form-label">Sub Clase del Equipo</label>
     			<select class="form-control" name="subclase" id="subclase" tabindex="16" required>
        		<<option value="{{ $equipo->SubClase->id }}">{{ $equipo->SubClase->nombre }}</option>
        			@foreach($subclase as $id=>$nombre)
        				 <option value="{{$id}}">{{$nombre}}</option>
         			@endforeach
     			</select>
				</div>
			</div>
			</div>
			<div class="row align-items-start">
            <div class="col">
                <label for="" class="form-label">Adjuntar Acta </label>
                <input id="documento" name="documento" type="file"  class="form-control">
            </div>
          </div>
      </div>
	</div>
	
<div class="mb-3">
	<div class="row align-items-start mb-3">
		<div class="col">
		<a href="/equipo" class="btn btn-secondary">CANCELAR</a>
	</div>
	<div class="col">
		<button  class="btn btn-primary" tabindex="16">GUARDAR</button>
	</div>
</div>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.css') }}">

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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