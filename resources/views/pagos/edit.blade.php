@extends('ppa')

@section('title', 'Editar Pagos')

@section('content_header')
    <h1>Editar Pagos</h1>
@stop

@section('body')
    <form action="/pagos/{{$pago->id}}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mostrar Equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ui-front">

	<div class="mb-3">
		<label for="" class="form-label">Periodo</label>
		<input id="periodo" name="periodo" type="text" value="{{$pago->periodo}}"  readonly class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Numero/Año del Memo</label>
		<input id="memo" name="memo" type="text" value="{{$pago->memo}}"  class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">OC</label>
		<input id="oc" name="oc" type="text" value="{{$pago->oc}}"  class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Valor de la cuota </label>
		<input id="valor" name="valor" type="text" value="{{$pago->valor}}"  class="form-control">
		<label for="" class="form-label">Valor de la cuota Referencial es ${{$total}} </label>
	</div>
	@can('user.delete')
		<label for="" class="form-label">Estado</label>
		<input id="estado" name="estado" type="text" value="{{$pago->estado}}"  class="form-control">
	@endcan
	<div class="mb-3">
			<label>Adjunte Memo</label>
			<input type="file" class="form-control" name="documento">
	</div>

	
	

 </div>
      <div class="modal-footer">
      	<button  class="btn btn-primary">GUARDAR</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop