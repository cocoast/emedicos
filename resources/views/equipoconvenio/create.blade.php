@extends('ppa')

@section('title', 'Ingresar Equipos al Convenio')

@section('content_header')
    <h1>Ingresar Equipos al Convenio</h1>
@stop

@section('body')
<form action="{{route('equipoconvenio.store')}}" method="POST">
		@csrf
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mostrar Equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


 	<div class="row align-items-start">
 		<div class="col">
			<label for="" class="form-label">Equipo</label>
	     	<input id="equipo" name="equipo" type="text"   class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Incorporacion al Convenio</label>
			<input id="fechaincorporacion" name="fechaincorporacion" type="date"  class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label">Valor del Equipo en el convenio</label>
			<input id="valor" name="valor" type="text"  class="form-control" required>
		</div>
		</div>
		<div class="row">
		<div class="col">
			<label for="" class="form-label">Mantenciones Preventivas Disponibles</label>
			<input id="disponible" name="disponible" type="text"  class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label">Mantenimiento Preventivo</label>
			<select class="form-control" name="mp" id="mp" required>
				<option selected value="">Seleccione</option>
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
			<select class="form-control" name="mc" id="mc" required>
				<option selected value="">Seleccione</option>
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
			<select class="form-control" name="repuesto" id="repuesto" required>
				<option selected value="">Seleccione</option>
				<option value="Sin">Sin repuestos</option>
				<option value="Parcial">Repuestos Parciales</option>
				<option value="Full">Full Repuestos</option>
			</select>
		</div>
		</div>
		<div class="row">
		 <div class="col">
			<label for="" class="form-label"> Convenio</label>
			<input id="convenio" name="convenio"  type ="hidden" value="{{$convenios->id}}"type="text" class="form-control" readonly>
			<input id="nombreconvenio" name="nombreconvenio" value="{{$convenios->nombre}}"type="text"  class="form-control" readonly >
		</div> 
</div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary" >GUARDAR</button>
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
	
</script>
    	
@stop