
@extends('ppa')

@section('title', 'Add Categoria')

@section('content_header')
    <h1>Crear una Categoria</h1>
@stop

@section('body')
<form action="/categorialicitacion" method="POST">
	@csrf
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

	<div class="mb-3">
		<label for="" class="form-label">Nombre de la Categoria</label>
		<input id="nombre" name="nombre" type="text" tabindex="1" class="form-control">
	</div>
	
	

</div>
<div class="modal-footer">
	<button  class="btn btn-primary" tabindex="3">Guardar</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</form>
@stop

