@extends('ppa')

@section('title', 'Add Modelo')

@section('content_header')
    <h1>Crear Modelo</h1>
@stop

@section('body')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Modelo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
	<form action="/modelo" method="POST">
		@csrf
		<div class="mb-3">
			<label for="" class="form-label">Nombre del Modelo</label>
			<input id="modelo" name="modelo" type="text" tabindex="1" class="form-control">
		</div>
		<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
	</form>
</div> 

<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

@stop

@section('css')
    
@stop

@section('js')
    
@stop