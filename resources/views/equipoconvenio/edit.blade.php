@extends('ppa')

@section('title', 'Editar Equipos al Convenio')

@section('content_header')
    <h1>Editar Equipos al Convenio</h1>
@stop

@section('body')
   <form action="/equipoconvenio/{{$equipoconvenio->id}}" method="POST">
	@csrf
	@method('PUT')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Equipos al Convenio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 

 	<div class="row align-items-start">
 		<div class="col">
			<label for="" class="form-label">ID</label>
			<input id="equipo" name="equipo" value="{{$equipoconvenio->id}}" type="text" readonly class="form-control">
		</div>
 		<div class="col">
			<label for="" class="form-label">Inventario del Equipo</label>
			<input id="equipo" name="equipo" value="{{$equipoconvenio->Equipo->inventario}}" type="text"  class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Incorporacion </label>
			<input id="fechaincorporacion" name="fechaincorporacion" value="{{$equipoconvenio->fechaincorporacion}}" type="date"  class="form-control">
		</div>
		</div>
		<div class="row">
		<div class="col">
			<label for="" class="form-label">Valor en el convenio</label>
			<input id="valor" name="valor" value="{{$equipoconvenio->valor}}" type="text"  class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Mantenciones Preventivas Disponibles</label>
			<input id="disponible" name="disponible" type="text" value="{{ $equipoconvenio->mp_disponible }}"  class="form-control">
		</div>
		<div class="col">
			<label for="" class="form-label">Mantenimiento Preventivo</label>
			<select class="form-control" name="mp" id="mp" >
				<option value="{{$equipoconvenio->mp}}">{{$equipoconvenio->mp}}</option>
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
			<select class="form-control" name="mc" id="mc" >
				<option value="{{$equipoconvenio->mc}}">{{$equipoconvenio->mc}}</option>
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
			<select class="form-control" name="repuesto" id="repuesto" >
				<option value="{{$equipoconvenio->repuesto}}">{{$equipoconvenio->repuesto}}</option>
				<option value="Sin">Sin repuestos</option>
				<option value="Parcial">Repuestos Parciales</option>
				<option value="Full">Full Repuestos</option>
			</select>
		</div>
		</div>
		<div class="row">
		<div class="col">
			<label for="" class="form-label">Seleccione Convenio</label>
			<input id="convenioname" name="convenioname" value="{{$equipoconvenio->Convenio->nombre}}" type="text"  class="form-control" readonly>
			<input id="convenio" name="convenio" value="{{$equipoconvenio->convenio}}" type="text"  class="form-control" hidden>
			
		</div>
</div>

 </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary" ">GUARDAR</button>
      </div>
      </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop