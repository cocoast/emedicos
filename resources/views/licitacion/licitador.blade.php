@extends('adminlte::page')

@section('title', 'Licitaciones')

@section('content_top_nav_left')
<h2>Listado Licitaciones</h2>

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

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Filtros de la Tabla</h3>
    <div class="card-tools">
      <!-- Collapse Button <--></-->            
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
<div class="container-fluid ">
 <table id="licitaciontable" class="table table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
        <th>ID</th>
        <th scope="col">Estado</th>
        <th scope="col">Licitador</th>
        <th scope="col">Nombre</th>
        <th scope="col">ID Mercado Publico</th>
        <th scope="col">Servicio Demandante</th>
        <th scope="col">Presupuesto</th>
        <th scope="col">Categoria</th>
        <th scope="col">Cambio Estado</th>
	</tr>
	</thead>
	<tbody>
		@foreach($licitaciones as $licitacion)
        <tr>
      <td scope="row"><a href="licitacion/{{ $licitacion->id }}">{{$licitacion->id}}</a></td>
      <td>{{ $licitacion->Estados->last()->nombre }}</td>
      <td>{{ $licitacion->Licitador->name }}</td>
      <td>{{ $licitacion->nombre }}</td>
      <td>{{ $licitacion->id_mercadopublico }}</td>
      <td>{{ $licitacion->Servicio->nombre }}</td>
      <td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($licitacion->presupuesto) }}</td>
      <td>{{ $licitacion->Categoria->nombre }}</td>
      <td>
            <!-- Trigger the modal with a button -->
        <button type="button" data-path="{{route('licitacion.estados',$licitacion->id) }}" class="btn btn-info btn-sm openBtn">Actualizar Estado</button>
    </tr>
    @endforeach
	</tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
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
    let table = $('#licitaciontable').DataTable({
         dom: 'Bfrtip',
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