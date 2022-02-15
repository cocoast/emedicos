@extends('adminlte::page')

@section('title', 'Convenios')

@section('content_header')
    <h1>Listado de Convenios</h1>
@stop

@section('content')
<div class="container-fluid">
 <table id="conveniostables" class="table table-responsive table-striped table-hover " >
	<thead>
	<tr>
      <th scope="col">#</th>
      <th scope="col">Inventario </th>
      <th scope="col">Serie</th>
      <th scope="col">N° RES</th>


	</tr>
	</thead>
	<tbody>
		@foreach($equipos as $equipo)
        @if(date('Y',strtotime($equipo->Convenio->fechafin))>date('Y',strtotime('2021-01-01')))
		<tr>
      <th scope="row">{{$equipo->Equipo->id}}</th>
      <td>{{$equipo->Equipo->inventario}}</td>
      <td>{{$equipo->Equipo->serie}}</td>
      <td>{{ $equipo->Convenio->resolucion }}</td>
    </tr>
    @endif
    @endforeach
	</tbody>
</table>
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
<script type="text/javascript" src="js/jszip.min.js "></script>
<script type="text/javascript" src="js/pdfmake.min.js "></script>
<script type="text/javascript" src="js/vfs_fonts.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js "></script>


<script >
	 $(document).ready(function() {
   $('#conveniostables').DataTable( {
        buttons: ['excel'],
        responsive: true,
        dom: 'Bfprtip', 
        pageLength: 10
        });
});
</script>
@stop