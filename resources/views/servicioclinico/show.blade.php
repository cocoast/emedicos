@extends('ppa')
@section('body')
  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mostrar Servicio {{ $servicio->nombre }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
		<div class="col">
			<label for="" class="form-label">Ubicación</label>
			<input id="solicitud" value="{{$servicio->ubicacion}}" name="solicitud" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Responsable</label>
			<input id="resolucion" value="{{$servicio->responsable}}" name="resolucion" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Correo del Responsable</label>
			<input id="fecharesolucion" value="{{$servicio->email_responsable}}" name="fecharesolucion" type="text" tabindex="3" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Anexo del Responsable</label>
			<input id="fecharesolucion" value="{{$servicio->anexo}}" name="fecharesolucion" type="text" tabindex="3" class="form-control"readonly>
		</div>
		
	</div>
 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
@stop

