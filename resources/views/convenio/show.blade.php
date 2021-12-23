@extends('adminlte::page')

@section('title', 'Mostrar convenio')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@stop
@section('content_header')
    <h1>Detalles del Convenio: </h1>
    <input id="nombre" value="{{$convenio->nombre}}" name="nombre" type="text" tabindex="1" class="form-control" readonly>
@stop

@section('content')
<div>
        @if (session()->has('message'))
            <div class="{{session('status')}} alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}
            </div>
        @endif  
    </div>
<div class="row align-items-start">
	<div class="col">
			<label for="" class="form-label">ID interno</label>
			<input id="ide" value="{{$convenio->id}}" name="ide" type="text" tabindex="1" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Licitacion ID</label>
			@if($convenio->link)
			<a href="{{ $convenio->link }}" target="_blank"><input id="licitacion" value="{{$convenio->licitacion}}" name="licitacion" type="text" tabindex="2" class="btn btn-success"readonly></a>
			@else
			<input id="licitacion" value="{{$convenio->licitacion}}" name="licitacion" type="text" tabindex="2" class="form-control"readonly>
			@endif
			
		</div>
		<div class="col">
			<label for="" class="form-label">Solicitud</label>
			<input id="solicitud" value="{{$convenio->solicitud}}" name="solicitud" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Resolucion</label>
			<input id="resolucion" value="{{$convenio->resolucion}}" name="resolucion" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Resolucion</label>
			<input id="fecharesolucion" value="{{$convenio->fecharesolucion}}" name="fecharesolucion" type="text" tabindex="3" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Valor Convenio+IVA</label>
			<input id="valor" value="{{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($convenio->valor)}}" name="valor" type="text" tabindex="3" class="form-control"readonly>
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Fecha Inicio</label>
			<input id="" value="{{date("d-m-Y", strtotime($convenio->fechaincio))}}" name="" type="text" tabindex="1" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha Fin</label>
			<input id="" value="{{date("d-m-Y", strtotime($convenio->fechafin))}}" name="" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Meses</label>
			<input id="" value="{{$convenio->meses}}" name="" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">frecuencia Pago</label>
			<input id="" value="
			@if($convenio->frecuenciapago==1) Mensual
        	@elseif($convenio->frecuenciapago==4) Trimestral
	        @elseif($convenio->frecuenciapago==6) Semestral
	        @elseif($convenio->frecuenciapago==12) Anual
	        @elseif($convenio->frecuenciapago=="Manual") Manual
	        @endif
	        " name="" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Tipo de Convenio</label>
			<input id="" value="{{$convenio->tipoconvenio}}" name="" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Proveedor</label>
			<input id="" value="{{$convenio->Proveedor->nombre}}" name="" type="text" tabindex="2" class="form-control"readonly>
		</div>
	</div>
	
	<div class="row align-items-start ">
		<div class="col">
			<h1 class="focus text-danger">Monto Disponible:$ <strong> {{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($convenio->valor-$gasto)}}</strong></h1>
			<br>
			<h2>Equipo dentro del Convenio</h2>
			<table id="equipostables" class="table table-hover table-primary ">
				<thead>
				<th>Equipo</th>
				<th>Familia</th>
				<th>Modelo</th>
				<th>Incorporación</th>
				<th>Valor +IVA</th>
				<th>MP Anual</th>
				<th>Mano Anual</th>
				<th>Respuestos</th>
				@can('convenio.edit')
				<th>Funciones</th>
				@endcan
				</thead>
				<tbody>
					@foreach($equiposconvenios as $equipoconvenio)
				<tr>
					<td><a href="/equipo/{{$equipoconvenio->Equipo->id}}"> {{$equipoconvenio->Equipo->inventario}}</a></td>
					<td>{{$equipoconvenio->Equipo->Familia->nombre}}</td>
					<td>{{$equipoconvenio->Equipo->Modelo->modelo}}</td>
					<td>{{date("d-m-Y", strtotime($equipoconvenio->fechaincorporacion))}}</td>
					<td>{{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($equipoconvenio->valor)}}</td>
					<td>{{$equipoconvenio->mp}}</td>
					<td>{{$equipoconvenio->mc}}</td>
					<td>{{$equipoconvenio->repuesto}}</td>
					@can('convenio.edit')
					<td>
							<!-- Trigger the modal with a button -->
							<button type="button" data-path="{{route('equipoconvenio.edit',$convenio->id) }}" class="btn btn-warning btn-sm EditEquipoBtn"><i class="bi bi-pencil"></i></button>
					@endcan
					@can('convenio.destroy')
      	 			<form action="{{route('equipoconvenio.destroy',$equipoconvenio->id)}}" method="POST">
      				@csrf
      				@method('DELETE')
      				<button class="btn btn-sm btn-danger" type="submit" onClick="javascript: return confirm('¿Estas seguro?');"><i class="bi bi-trash"></i></button>
      				</form> 
    
        @endcan

			</tr>
			@endforeach
				</tbody>
			</table>
			@can('convenio.edit')
			<div class="row">
				
				<!-- Trigger the modal with a button -->
							<button type="button" data-path="{{route('equipoconvenio.create',$convenio->id) }}" class="btn btn-primary btn-sm EquipoBtn">Agregar Equipos al Convenio</button>
			</div>
			@endcan
			<div class="row">
				<table class="table table-striped"  style="width: 100%;">
    		<thead>
    			<th>Tipo Documento</th>
    			
    			<th>Archivo</th>
    		</thead>
     		<tbody>
     			@if($res!=null)
  				@foreach($res as $item =>$value)
   			<tr>
   				
  				<td>{{$value["Nombre"]}}</td>
  				
  				<td><a href="{{asset($value['direccion'])}}" target="_blank">archivo</a></td>
  			</tr>
   				@endforeach
   				@else
   				<td>Sin Registro</td>
   				@endif
   			</tbody>
   		</table>
			</div>
		</div>
		<div class="col" >
			
			<h2>Pagos Generados </h2>
			<table id="pagosGentables"class="table table-hover table-success">
				<thead>
				<th>Estado</th>
				<th>Periodo</th>
				<th>Memo</th>
				<th>Fecha de corte</th>
				<th>OC</th>
				<th>Valor+IVA</th>
				<th>Archivo</th>
				@can('convenio.edit')
				<th>Editar</th>
				@endcan
				</thead>
				<tbody>
					@foreach($pagosrealizados as $pagorealizado)
					<tr>
					<td>{{$pagorealizado->estado}}</td>
					<td>{{$pagorealizado->periodo}}</td>
					<td>{{$pagorealizado->memo}}</td>
					<td>{{date("d-m-Y", strtotime($pagorealizado->fecha))}}</td>
					<td>
						@if($pagorealizado->oc!="ingresar")
						<!-- Trigger the modal with a button -->
							<button type="button" data-path="{{route('pagos.show', $pagorealizado->oc) }}" class="btn btn-primary btn-sm openBtn">{{ $pagorealizado->oc }}</button>
							
							@else
							{{ $pagorealizado->oc }}
						@endif
					</td>
					<td>{{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagorealizado->valor)}}</td>
					<td>@if($pagorealizado->link!=null)<a href="{{asset($pagorealizado->link)}}" target="_blank">archivo</a>  @endif</td>
					@can('convenio.edit')
					<td>
						<!-- Trigger the modal with a button -->
						<button type="button" data-path="{{route('pagos.edit', $pagorealizado->id) }}" class="btn btn-warning btn-sm PagoBtn">
                       <i class="bi bi-pencil"></i></button>
					</td>
					@endcan
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="row">
				
				<div class="col" >

				<h2>Pagos Pendientes</h2>
			<table id="pagosPentables" class="table table-hover table-danger" >
				<thead>
				<th>Estado</th>
				<th>Periodo</th>
				<th>Memo</th>
				<th>Fecha de Corte</th>
				<th>OC</th>
				<th>Valor+IVA</th>
				@can('convenio.edit')
				<th>Generar</th>
				@endcan
				</thead>
				<tbody>
					@foreach($pagospendientes as $pagopendiente)
					<tr>
					<td>{{$pagopendiente->estado}}</td>
					<td>{{$pagopendiente->periodo}}</td>
					<td>{{$pagopendiente->memo}}</td>
					<td>{{date("d-m-Y", strtotime($pagopendiente->fecha))}}</td>
					<td>{{$pagopendiente->oc}}</td>
					<td>{{$pagopendiente->valor}}</td>
					@can('convenio.edit')
					<td>
						 <!-- Trigger the modal with a button -->
                    <button type="button" data-path="{{route('pagos.edit', $pagopendiente->id) }}" class="btn btn-success btn-sm editPagoBtn">
                        <i class="bi bi-check-square-fill"></i></button>


					</td>
					@endcan
					</tr>
					@endforeach
				</tbody>
			</table>
			@can('convenio.edit')
			<?php
			if($convenio->tipoconvenio=='Correctivo')
			echo('<a class="btn btn-success" href="'.route('pagos.create', $convenio->id).'">Agregar Pago</a>');
			?>
			@endcan
		</div>
			</div>
		</div>	
	</div>

</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mostrar OC</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mostrar Equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
@stop

@section('js')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
    $('#equipostables').DataTable({
    	responsive:true,
     "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'pB>>",
         	buttons :['excel','copy', 'pdf', 'print'],
    	 "lengthMenu":[[3,10,-1],[3,10,"Todos"]],
        });
    } );
</script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#pagosPentables').DataTable({
    	 "lengthMenu":[[3,10,-1],[3,10,"Todos"]],
            
        });
    } );
</script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#pagosGentables').DataTable({
    	"order": [[ 1, "desc" ]],
     "dom":  "<'row'<'col-sm-12 col-md-7'B>"
     +"<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>",
         	buttons :['excelHtml5','copy', 'pdf', 'print'],            
        "scrollY":        "250px",
        "scrollCollapse": true,
        "paging":         false,
        "info":false,
        });
    });
</script>
<script type="text/javascript">
	$('#exampleModal').on('shown.bs.modal', function () {
 
})
</script>
<script>
$('.openBtn').on('click',function(){
    $('.modal-body').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
$('.editPagoBtn').on('click',function(){
    $('.modal-body').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
$('.PagoBtn').on('click',function(){
    $('.modal-body').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
$('.EquipoBtn').on('click',function(){
    $('.modal-body').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
$('.EditEquipoBtn').on('click',function(){
    $('.modal-body').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>
@stop

