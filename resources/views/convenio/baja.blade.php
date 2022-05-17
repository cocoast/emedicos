@extends('adminlte::page')

@section('title', 'Editar Equipo')

@section('content_header')
    <h1>Baja Convenio</h1>
@stop

@section('content')
    <form action="/convenio/{{$convenio->id}}/darbaja" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<div class="row align-items-start">
 		<div class="col">
			<label for="" class="form-label">Nombre Convenio</label>
			<input id="nombre" name="nombre" value="{{$convenio->nombre}}" type="text" tabindex="1" class="form-control">
		</div>
		</div>
		<div class="row">		
		<div class="mb-3">		
			<div class="row align-items-start">
				<div class="col">
					<label for="" class="form-label">Ultimo Pago Realizado</label>
						<select class="form-control" name="pago" id="pago">
							@foreach($pagos as $pago)
							<option value="{{$pago->id}}">{{'Periodo '.$pago->periodo.' Fecha de corte '.date('d-m-Y',strtotime($pago->fecha))}}</option>
						@endforeach
					</select>
				</div>
		
			</div>
		</div>
	</div>
	<div class="row">	
		<div class="mb-3">
			<div class="row align-items-startmb-3">
				<div class="col">
					<label>Adjunte Archivos</label>
					<input type="file" class="form-control" name="documento">
				</div>
			</div>
		</div>
	</div>
	<div class="row">
			<div class="row align-items-start mb-3">
				<div class="col">
				<a href="/convenio" class="btn btn-secondary">CANCELAR</a>
				</div>
			<div class="col">
				<button  class="btn btn-primary" tabindex="16">GUARDAR</button>
			</div>
		</div>
</form>




@stop

@section('css')
	<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.css') }}">
 
@stop

@section('js')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.js') }}"></script>
@stop