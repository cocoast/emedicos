@extends('ppa')

@section('title', 'Add Servicio de Salud')

@section('content_header')
    <h1>Crear una Servicio de Salud</h1>
@stop

@section('body')
<form action="/centrosalud" method="POST" enctype="multipart/form-data">
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Servicio de Salud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

	@csrf
	
 	<div class="col align-items-start">
		<label for="" class="form-label">Nombre centro de Salud</label>
		<input id="nombre" name="nombre" type="text"  class="form-control" required >
	</div>
<div class="modal-footer">
	<button  class="btn btn-primary" >GUARDAR</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</form>
@stop
