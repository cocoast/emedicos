@extends('ppa')

@section('title', 'Editar Garantia')

@section('content_header')
    <h1>Editar Garantia</h1>
@stop


@section('body')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Garantia Equipo {{ $garantia->Equipo->Familia->nombre }}-{{ $garantia->Equipo->inventario }}-{{ $garantia->Equipo->Marca->marca }} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
    <form action="/garantia/{{$garantia->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="row align-items-start">
		
			<div class="row align-items-start">
				<div class="col">
					<label for="" class="form-label">Fecha de Inicio</label>
	     			<input type="date" name="init"  id="init" value="{{ $garantia->inicio??"" }}" tabindex="16" class="form-control">
	 			</div>
	 			<div class="col">
					<label for="" class="form-label">Fecha de Vencimiento</label>
	     			<input type="date" name="fin"  id="fin" value="{{ $garantia->fin??"" }}" tabindex="16" class="form-control">
	 			</div>
	 			<div class="col">
	     			<label for="" class="form-label">Cantidad de Mantenciones Disponibles</label>
	     			<input type="text" name="mp" id="mp" value="{{ $garantia->mp_disponible?? "" }}" tabindex="17" class="form-control">
				</div>
				<div class="col">
	     			<label for="" class="form-label">Frecuencia de Mantenciones Meses</label>
	     			<input type="text" name="frecuencia" id="frecuencia" value="{{ $garantia->frecuencia?? "" }}" tabindex="18" class="form-control">
				</div>
				<div class="col">
	     			<label for="" class="form-label">Mantenciones Anuales</label>
	     			<input type="text" name="mpa" id="mpa" value="{{ $garantia->mp?? "" }}" tabindex="18" class="form-control">
				</div>
			</div>
	</div>
	<button class="btn btn-primary">Modificar</button>
</form>
</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
	@stop
