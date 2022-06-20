
@extends('ppa')


@section('body')

 <form action="{{ route('mp.programamp',$planifica->id) }}" method="POST" enctype="multipart/form-data">
 	@csrf
	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Programacion </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
 	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Fecha Planificada</label>
			<input type="date" name="fecha" id="fecha" value="{{ $planifica->fechacorte }}" class="form-control" readonly >
		</div>
		<div class="col">
			<label for="" class="form-label">Tipo de Mantencion</label>
			<select class="form-control" name="tipo" id="tipo" tabindex="1">
	         <option value="{{ $planifica->tipomp }}">{{ $planifica->tipomp }}</option>
	         <option value="Garantia">Garantia</option>
	         <option value="Convenio">Convenio</option>
	         <option value="Interna">Interna</option>
	         <option value="Compra de Servicio">Compra de Servicio</option>
     	</select>
			
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Equipo</label>
			<input type="text" name="equipo" id="equipo" value="Inventario: {{ $planifica->Equipo->inventario }} Serie: {{ $planifica->Equipo->serie }} Modelo: {{ $planifica->Equipo->Modelo->modelo }} Familia: {{ $planifica->Equipo->Familia->nombre }}" class="form-control" readonly >
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Programacion</label>
			<input type="date" name="programacion" id="programacion" @if($planifica->fechaprogramacion)value="{{ date('Y-m-d',strtotime($planifica->fechaprogramacion))  }}"@else value=""@endif class="form-control" >
		</div>
		
	</div>
	<div class="row align-items-start">
	<div class="col">
					<label>Adjunte Mantencion Preventiva</label>
					<input  name="documento" type="file" class="form-control">
				</div>
				</div>
			</div>
	<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</div>	
</form>
@stop

