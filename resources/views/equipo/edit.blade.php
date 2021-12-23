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
			<input id="inventario" name="inventario" type="text" value="{{$equipo->inventario}}" tabindex="1" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Serie</label>
			<input id="serie" name="serie" type="text" tabindex="2" value="{{$equipo->serie}}" class="form-control">
		</div>
	</div>
	<div class="mb-3">
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Fecha de Acta de Recepción</label>
			<input id="fecha_adquisicion" name="fecha_adquisicion" type="text" value="{{$equipo->fecha_adquisicion}}" tabindex="3" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">EQ</label>
			<select class="form-control" name="eq" id="eq"  tabindex="4">
				<option value="{{$equipo->eq}}" selected>{{$equipo->eq}}</option>
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
			<select class="form-control" name="tipoactivo" id="tipoactivo" tabindex="7">
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
     	<select class="form-control" name="marca" id="marca" tabindex="8">
         <option value="{{$equipo->marca}}" selected>{{$equipo->Marca->marca}}</option>
         @foreach($marca as $id=>$nombre)
         <option value="{{$id}}">{{$nombre}}</option>
         @endforeach
     </select>
		</div>
	<div class="col">
		<label for="" class="form-label">Modelo</label>
     	<select class="form-control" name="modelo" id="modelo" tabindex="9">
         <option value="{{$equipo->modelo}}" selected>{{$equipo->Modelo->modelo}}</option>
         @foreach($modelo as $id=>$nombre)
         <option value="{{$id}}">{{$nombre}}</option>
         @endforeach
     </select>
	</div>
</div>
	<div class="mb-3">
		<div class="row align-items-start">
			<div class="col">
		<label for="" class="form-label" >Proveedor</label>
     	<select class="form-control" name="proveedor" id="proveedor" tabindex="10">
         <option value="{{$equipo->proveedor}}" selected>{{$equipo->Proveedor->nombre}}</option>
         @foreach($proveedor as $id=>$nombre)
         <option value="{{$id}}">{{$nombre}}</option>
         @endforeach
     </select>
	</div>
	<div class="col">
		<label for="" class="form-label">Servicio Clinico Responsable</label>
     	<select class="form-control" name="servicioclinico" id="servicioclinico" tabindex="11">
         <option value="{{$equipo->servicioclinico->id}}" selected>{{$equipo->ServicioClinico->nombre}}</option>
         @foreach($servicioclinico as $id=>$nombre)
         <option value="{{$id}}">{{$nombre}}</option>
         @endforeach
     </select>
	</div>
</div>
	<div class="mb-3">
		<div class="row align-items-start">
			<div class="col">
				<label for="" class="form-label">Familia del Equipo</label>
     			<select class="form-control" name="familia" id="familia" tabindex="12">
         		<option value="{{$equipo->familia}}" selected>{{$equipo->Familia->nombre}}</option>
         			@foreach($familia as $id=>$nombre)
         				<option value="{{$id}}">{{$nombre}}</option>
         			@endforeach
     			</select>
 			</div>
 			<div class="col">
     			<label for="" class="form-label">SubFamilia del Equipo</label>
     			<select class="form-control" name="subfamilia" id="subfamilia" tabindex="13">
        		<option value="{{$equipo->subfamilia}}" selected>{{$equipo->SubFamilia->nombre}}</option>
        			@foreach($subfamilia as $id=>$nombre)
        				 <option value="{{$id}}">{{$nombre}}</option>
         			@endforeach
     			</select>
				</div>
			</div>
	</div>
		<div class="row align-items-start">
			<div class="col">
				<label for="" class="form-label">Clase del Equipo</label>
     			<select class="form-control" name="clase" id="clase" tabindex="14">
         		<option value="{{$equipo->clase}}" selected>{{$equipo->Clase->nombre}}</option>
         			@foreach($clase as $id=>$nombre)
         				<option value="{{$id}}">{{$nombre}}</option>
         			@endforeach
     			</select>
 			</div>
 			<div class="col">
     			<label for="" class="form-label">Sub Clase del Equipo</label>
     			<select class="form-control" name="subclase" id="subclase" tabindex="15">
        		<option value="{{$equipo->subclase}}" selected>{{$equipo->SubClase->nombre}}</option>
        			@foreach($subclase as $id=>$nombre)
        				 <option value="{{$id}}">{{$nombre}}</option>
         			@endforeach
     			</select>
				</div>
			</div>
			<h2>Garantias</h2>
			
			<div class="row align-items-start">
				<div class="col">
					<label for="" class="form-label">Fecha de Vencimiento</label>
	     			<input type="date" name="fin"  id="fin" value="{{ $garantia->fin??"" }}" tabindex="16" class="form-control">
	 			</div>
	 			<div class="col">
	     			<label for="" class="form-label">Cantidad de Mantenciones</label>
	     			<input type="text" name="mp" id="mp" value="{{ $garantia->mp?? "" }}" tabindex="17" class="form-control">
				</div>
				<div class="col">
	     			<label for="" class="form-label">Frecuencia de Mantenciones</label>
	     			<input type="text" name="frecuencia" id="frecuencia" value="{{ $garantia->frecuencia?? "" }}" tabindex="18" class="form-control">
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
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop