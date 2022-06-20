
@extends('adminlte::page')

@section('title', 'Editar Planificacion MP')

@section('content_header')
    <h1>Programar Equipo </h1>
@stop

@section('content')
 <form action="{{ route('mp.planificamp',$planifica->id) }}" method="POST" enctype="multipart/form-data">
	@csrf

 	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label" >Proveedor</label>
     		<input id="proveedor" name="proveedor" type="text" value="{{ $planifica->Proveedor->id." - ".$planifica->Proveedor->nombre }}" class="form-control" required >
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha Planificada</label>
			<input type="date" name="fecha" id="fecha" value="{{ $planifica->fechacorte }}" class="form-control"  >
		</div>
		<div class="col">
			<label for="" class="form-label">Tipo de Mantencion</label>
			<select class="form-control" name="tipo" id="tipo" >
	         	<option value="{{ $planifica->tipomp }}">{{ $planifica->tipomp }}</option>
		        <option value="Garantia">Garantia</option>
		        <option value="Convenio">Convenio</option>
		        <option value="Interna">Interna</option>
		        <option value="Compra de Servicio">Compra de Servicio</option>
     		</select>		
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Equipo</label>
			<input type="text" name="equipo" id="equipo" value="Inventario: {{ $planifica->Equipo->inventario }} Serie: {{ $planifica->Equipo->serie }} Modelo: {{ $planifica->Equipo->Modelo->modelo }} Familia: {{ $planifica->Equipo->Familia->nombre }}" class="form-control" readonly >
		</div>
	</div>
	<div class="row">
		<div class="col">
			<a href="/planifica" class="btn btn-secondary" >CANCELAR</a>
			<button  class="btn btn-primary">GUARDAR</button>
		</div>
	</div>
</form>
@stop
@section('css')
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.css') }}">

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
	$('#proveedor').autocomplete({
		source: function (request, response){
			$.ajax({
				url: "{{ route('search.proveedor') }}",
				dataType: 'json',
				data:{
					term: request.term
				},
				success: function(data){
					response(data)
				}
			});
		}
	});
</script>
@stop
