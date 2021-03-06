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
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Filtros de la Tabla</h3>
    <div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-sm btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body" id="searchpanes">
    <!-- Aqui va la info-->
  </div>
  <!-- /.card-body -->
</div>  
<!-- /.card -->

<div class="table-responsive">
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
          <th scope="col">@can('modelo.edit')FUNCIONES @endcan</th>
    	</tr>
    	</thead>
    	<tbody>
    		@foreach($planificados as $mp)
    		    <tr>
                    <td>{{$mp->Equipo->id}}@can('convenio.edit') <a class="btn btn-warning" href="/planifica/{{$mp->id}}/edit "><i class="bi bi-pencil"></i></a> @endcan</td>
                    <td>{{ $mp->Equipo->ServicioClinico->nombre }}</td>
                    <td><a href="{{route('equipo.show', $mp->Equipo->id) }}" class="btn btn-primary" target="_blank">{{$mp->Equipo->inventario}}</a></td>
                    <td><a href="{{route('equipo.show', $mp->Equipo->id) }}" class="btn btn-primary"  target="_blank"> {{ $mp->Equipo->serie }}</a></td>
                    <td>{{ $mp->Equipo->Marca->marca }}</td>
                    <td>{{ $mp->Equipo->Modelo->modelo }}</td>
                    <td data-order="{{date("n", strtotime($mp->fechacorte))-1  }}">{{ $meses[date("n", strtotime($mp->fechacorte))-1] }}</td>
                    <td>@if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif</td>
                    <td>{{ $mp->Proveedor->nombre }}</td>
                    <td>{{ $mp->tipomp }}</td>
                    <td>@if($mp->fechaprogramacion!=""){{ strftime("%W", strtotime($mp->fechaprogramacion)) }}@endif</td>
                    <td>
                    @can('modelo.edit')
                    <button class="btn btn-secondary openBtn" data-path="{{ route('mp.programacion.add',$mp->id) }}">Programar</button>

                    @endcan</td>
                  
                </tr>
            @endforeach
    	</tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <!--Aqui Va la informacion del modal -->
        </div>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
  $(document).ready(function() {
    let table = $('#planificatable').DataTable({
         dom: 'Bfrtip',
         order: [[6, 'asc']],
        buttons: ['excel'],  
        responsive: true,
        searchPanes:{
            layout: 'columns-5',
            initCollapsed: true,
            cascadePanes: true,
        },  
          pageLength: 25,
    });
     
    new $.fn.dataTable.SearchPanes(table, {});  
    table.searchPanes.container().prependTo("#searchpanes");
    table.searchPanes.resizePanes();
});
   
$('.openBtn').on('click',function(){
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>
@stop