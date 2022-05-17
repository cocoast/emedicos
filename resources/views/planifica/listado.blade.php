@extends('adminlte::page')

@section('title', 'Programacion')

@section('content_header')
    <h1>Detalle de Programacion {{ $year }}</h1>
@stop

@section('content')

<div>
    @if (session()->has('message'))
    <div class="{{session('status')}} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('message') }}
    </div>
    @endif
@can('modelo.create')
<div class="d-flex justify-content-between">
<div class="justify-content-start"><a href="/planifica/create/" class="btn btn-success">Ingresar Equipos a la Planificación</a></div>
<div class="justify-content-start"><a href="/planifica/programa/" class="btn btn-secondary">Programar en lote</a></div>

@endcan
    <div class="justify-content-end"> <a href="/planifica/minsal/" class="btn btn-primary"> Vista Minsal</a></div>
    <div class="justify-content-end"><a href="/planifica/" class="btn btn-success flex-end"> Carta Gantt</a></div>
</div>



<table id="planificatable" class="table table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
      <th scope="col">ID Equipo</th>
      <th scope="col">Servicio</th>
      <th scope="col">Inventario</th>
      <th scope="col">Serie</th>
      <th scope="col">Marca</th>
      <th scope="col">Modelo</th>
      <th scope="col">Fecha Planificada</th>
      <th scope="col">Fecha Programada</th>
      <th scope="col">Responsable</th>
      <th scope="col">Tipo de MP</th>
      <th scope="col">Semana Programada</th>
      <th scope="col">Plan de Mantenimiento</th>


      <th scope="col">@can('modelo.edit')FUNCIONES @endcan</th>
	</tr>
	</thead>
	<tbody>
		@foreach($planificados as $mp)
		  @if(empty($mp->Equipo->Bajas[0]))
        <tr>
      <th scope="row">{{$mp->Equipo->id}}@can('convenio.edit') <a class="btn btn-warning" href="/planifica/{{$mp->id}}/edit "><i class="bi bi-pencil"></i></a> @endcan</th>
      <td>{{ $mp->Equipo->ServicioClinico->nombre }}</td>
      <td><a href="{{route('equipo.show', $mp->Equipo->id) }}" class="btn btn-primary" target="_blank">{{$mp->Equipo->inventario}}</a></td>
      <td><a href="{{route('equipo.show', $mp->Equipo->id) }}" class="btn btn-primary"  target="_blank"> {{ $mp->Equipo->serie }}</a></td>
      <td>{{ $mp->Equipo->Marca->marca }}</td>
      <td>{{ $mp->Equipo->Modelo->modelo }}</td>
      <td data-order="{{ date("Ymd", strtotime($mp->fechacorte)) }}">@php setlocale(LC_TIME, "spanish"); echo strftime("%B", strtotime(date("d-m-Y", strtotime($mp->fechacorte)))); @endphp</td>
      <td>@if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif</td>
      <td>{{ $mp->Proveedor->nombre }}</td>
      <td>{{ $mp->tipomp }}</td>
      <td>@if($mp->fechaprogramacion!=""){{ strftime("%W", strtotime(date("d-m-Y", strtotime($mp->fechaprogramacion)))) }}@endif</td>
      <td>@if(date('Y',strtotime($mp->Equipo->fecha_adquisicion))< $year) SI @else NO @endif </td>
      <td>
        @can('modelo.edit')
      	<a class="btn btn-info" href="/planifica/{{$mp->id}}/edit ">Programar</a>
      	@csrf
        @endcan
      </td>
    </tr>
    @endif
    @endforeach
	</tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
    <!--Aqui Va la informacion del modal -->
  </div>
</div>
@stop

@section('css')
<!--BOOSTRAP ICONS-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<!--DATATABLE-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css ">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/1.4.0/css/searchPanes.dataTables.min.css ">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css ">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css ">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css ">

@stop

@section('js')
<!--JQUERY-->
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<!--DATATABLE-->

<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/1.4.0/js/dataTables.searchPanes.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js "></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js "></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js "></script>





<script type="text/javascript">
  $('#planificatable').DataTable( {
     buttons: [
        'excel'
    ],
    responsive: true,
    searchPanes:{
        layout: 'columns-5',
        initCollapsed: true,
        cascadePanes: true,
    },
    dom: 'PBfprtip', 
    "columnDefs": [            
            {
                "targets": [  ],
                "visible": false
            }],
    pageLength: 20,
    'order':[6,'asc']
});
   
$('.openBtn').on('click',function(){
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>
@stop