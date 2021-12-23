@extends('ppa')

@section('title', 'Ingresar Equipos al Convenio')

@section('content_header')
    <h1>Ingresar Equipos al Convenio</h1>
@stop

@section('body')
<form action="{{route('equipoconvenio.store')}}" method="POST">
	@csrf
 	<div class="row align-items-start">
 		<div class="col">
			<label for="" class="form-label">Inventario del Equipo</label>
			<input id="equipo" name="equipo" type="text" tabindex="1" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Incorporacion al Convenio</label>
			<input id="fechaincorporacion" name="fechaincorporacion" type="date" tabindex="2" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Valor del Equipo en el convenio</label>
			<input id="valor" name="valor" type="text" tabindex="3" class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Mantenimiento Preventivo</label>
			<select class="form-control" name="mp" id="mp" tabindex="4">
				<option selected>Seleccione</option>
				<option value="Sin">Sin Mantenciones</option>
				<option value="1">1 Mantención</option>
				<option value="2">2 Mantenciones</option>
				<option value="3">3 Mantenciones</option>
				<option value="4">4 Mantenciones</option>
				<option value="5">5 Mantenciones</option>
			</select>
		</div>
</div>
<br>
<div class="row align-items-start">
 		<div class="col">
			<label for="" class="form-label">Mano de Obra</label>
			<select class="form-control" name="mc" id="mc" tabindex="5">
				<option selected>Seleccione</option>
				<option value="Sin">Sin Mano de Obra</option>
				<option value="Full">Full Mano de Obra</option>
				<option value="1">1 Mano de Obra</option>
				<option value="2">2 Mano de Obra</option>
				<option value="3">3 Mano de Obra</option>
				<option value="4">4 Mano de Obra</option>
				<option value="5">5 Mano de Obra</option>
				<option value="6">6 Mano de Obra</option>
				<option value="7">7 Mano de Obra</option>
			
			</select>
		</div>
		<div class="col">
			<label for="" class="form-label">Repuestos</label>
			<select class="form-control" name="repuesto" id="repuesto" tabindex="6">
				<option selected>Seleccione</option>
				<option value="Sin">Sin repuestos</option>
				<option value="Parcial">Repuestos Parciales</option>
				<option value="Full">Full Repuestos</option>
			</select>
		</div>
		 <div class="col">
			<label for="" class="form-label"> Convenio</label>
			<input id="convenio" name="convenio"  type ="hidden" value="{{$convenios->id}}"type="text" class="form-control" readonly>
			<input id="nombreconvenio" name="nombreconvenio" value="{{$convenios->nombre}}"type="text"  class="form-control" readonly>
		</div> 
</div>
<br>
<div class="mb-3">
	<div class="row align-items-start mb-3">
		<div class="col">
		
	</div>
	<div class="col">
		<button  class="btn btn-primary" tabindex="16">GUARDAR</button>
	</div>
</div>

</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    
@stop