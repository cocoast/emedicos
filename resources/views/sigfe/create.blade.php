
@extends('ppa')

@section('title', 'Add Sigfe')

@section('content_header')
    <h1>Crear Sigfe</h1>
@stop

@section('body')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Sigfe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
<form action="/sigfe" method="POST">
	@csrf
	<div class="mb-3">
		<label for="" class="form-label">Nombre del Sigfe</label>
		<input id="nombre" name="nombre" type="text"  class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Codigo Sigfe</label>
		<input id="codigo" name="codigo" type="text"  class="form-control">
	</div>
	<button  class="btn btn-primary"> GUARDAR</button>
</form>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

@stop

