
@extends('ppa')

@section('title', 'Add SubClase')

@section('content_header')
    <h1>Crear una SubClase</h1>
@stop

@section('body')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar SubClase</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class = "modal-body">
 <form action="/subclase" method="POST">
	@csrf
	<div class="mb-3">
		<label for="" class="form-label">Nombre de la SubClase</label>
		<input id="subclase" name="subclase" type="text" tabindex="1" class="form-control">
	</div>
	
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
</div> 

<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    
@stop