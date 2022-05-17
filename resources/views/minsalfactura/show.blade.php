@extends('ppa')

@section('title', 'Ver Pagos')

@section('body')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listo de Pagos Asociados a Convenio {{ $convenio->nombre }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
	

		<div class="card card-success">
		<div class="card-header">
		<h3 class="card-title ">Pagos Ingresados </h3>
		</div>
		<div class="card-body">
			<table id="realizados" class="table table-striped table-hover">
				<thead class="table-success">
					<tr>
						<th>Numero Factura</th>
						<th>Mes de Pago</th>
						<th>Monto</th>
					</tr>
				</thead>
				<tbody>
					@foreach($pagos as $pago)
					<tr>
						<td>{{$pago->numero}}</td>
						<td>{{ $pago->Fecha($pago->fecha) }}</td>
						<td>${{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pago->monto)}}</td>  
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
<!-- /.card-body -->
          

 	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
@stop

@section('css')


@stop

@section('js')


<script type="text/javascript">


</script>@stop