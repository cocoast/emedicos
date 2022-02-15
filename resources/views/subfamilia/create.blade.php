
@extends('ppa')

@section('title', 'Add SubFamilias')

@section('content_header')
    <h1>Crear una SubFamilias</h1>
@stop

@section('body')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar SubFamilia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class='modal-body'>
<form action="/subfamilia" method="POST">
	@csrf
	<div class="mb-3">
		<label for="" class="form-label">Nombre de la Sub-Familia</label>
		<input id="subfamilia" name="subfamilia" type="text" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Vida Util</label>
		<input id="vidautil" name="vidautil" type="text" tabindex="2" class="form-control">
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