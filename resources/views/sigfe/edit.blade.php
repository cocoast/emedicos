
@extends('ppa')

@section('title', 'Add Sigfe')

@section('content_header')
    <h1>Editar un Sigfe</h1>
@stop

@section('body')
<div class="modal-body">
    <form action="/sigfe/{{$sigfe->id}}" method="POST">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Nombre del Sigfe</label>
		<input id="nombre" name="nombre" type="text" value="{{$sigfe->nombre}}"  class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Codigo del Sigfe</label>
		<input id="codigo" name="codigo" type="text" value="{{$sigfe->codigo}}"  class="form-control">
	</div>
	<a href="/sigfe" class="btn btn-secondary" tabindex="2">CANCELAR</a>
	<button  class="btn btn-primary" >GUARDAR</button>
</form>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

@stop

