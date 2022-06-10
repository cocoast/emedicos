@extends('adminlte::page')

@section('title', 'Licitaciones')

@section('content_header')
<div class="text-center">
    <div class="col ">
        <h2>Listado Licitaciones de {{ Auth::user()->name }}</h2>
    </div>
</div>
<!-- Trigger the modal with a button -->
<button type="button" data-path="{{route('licitacion.create') }}" class="btn btn-primary openBtn"><i class="bi bi-file-plus"></i> Generar</button>
@stop
@section('content')
 

<div class="container-fluid ">
  
 <table id="licitaciontable" class="table table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
        <th>ID</th>
        <th scope="col">Estado</th>
        <th scope="col">Nombre</th>
        <th scope="col">ID Mercado Publico</th>
        <th scope="col">Servicio Demandante</th>
        <th scope="col">Presupuesto</th>
        <th scope="col">Vigencia</th>
        <th scope="col">Categoria</th>
        @can('licitacion.edit')<th scope="col">Edit</th>@endcan
        @can('licitacion.destroy')<th scope="col">Del</th>@endcan
	</tr>
	</thead>
	<tbody>
		@foreach($licitaciones as $licitacion)
        <tr>
      <th></th>
      <th scope="row">{{$licitacion->id}}</th>
      <td>{{ $licitacion->nombre }}</td>
      <td>{{ $licitacion->id_mercadopublico }}</td>
      <td>{{ $licitacion->ServicioClinico->nombre }}</td>
      <td>{{ $licitacion->presupuesto }}</td>
      <td>{{ $licitacion->vigencia }}</td>
      <td>{{ $licitacion->Categoria->nombre }}</td>
      <td>@can('estadolicitacion.edit')
         <!-- Trigger the modal with a button -->
        <button type="button" data-path="{{route('lciitacion.edit',$licitacion->id ) }}" class="btn btn-info btn-sm openBtn"><i class="bi bi-pencil"></i> Editar</button>
      </td>
      <td>
        <form action="{{route('licitacion.destroy',$licitacion->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit" onClick="javascript: return confirm('¿Estas seguro?');"><i class="bi bi-trash"></i>Eliminar</button>
        </form>
        @endcan
      </td>
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
  $('#licitaciontable').DataTable( {
    "order": [[ 4, "asc" ]],
     buttons: [
        'excel'
    ],
    responsive: true,
    searchPanes:{
        layout: 'columns',
        initCollapsed: true,
        cascadePanes: true,
    },
    dom: 'PBfprtip', 
    pageLength: 20,
    
});
   
 $('.openBtn').on('click',function(){
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>
@stop