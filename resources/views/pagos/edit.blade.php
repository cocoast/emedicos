@extends('ppa')

@section('title', 'Editar Pagos')

@section('content_header')
    <h1>Editar Pagos</h1>
@stop

@section('body')
    <form action="/pagos/{{$pago->id}}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="mb-3">
		<label for="" class="form-label">Periodo</label>
		<input id="periodo" name="periodo" type="text" value="{{$pago->periodo}}"  readonly class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Numero/Año del Memo</label>
		<input id="memo" name="memo" type="text" value="{{$pago->memo}}" tabindex="1" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">OC</label>
		<input id="oc" name="oc" type="text" value="{{$pago->oc}}" tabindex="2" class="form-control">
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Valor de la cuota </label>
		<input id="valor" name="valor" type="text" value="{{$pago->valor}}" tabindex="3" class="form-control">
		<label for="" class="form-label">Valor de la cuota Referencial es ${{$total}} </label>
	</div>
	<div class="mb-3">
			<label>Adjunte Memo</label>
			<input type="file" class="form-control" name="documento">
	</div>

	
	<button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop