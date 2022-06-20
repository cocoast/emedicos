@extends('adminlte::page')

@section('title', 'Planificacion')

@section('content_top_nav_left')

    <h1>Planificacion de Mantenimientos {{$year }}</h1>
@stop

@section('content')

<div>
    @if (session()->has('message'))
    <div class="{{session('status')}} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('message') }}
    </div>
   @endif 
<div class="row">
    <form action="{{ route('mp.historico') }}" method="get" class="row g-3">
        @csrf
        <div class="col-auto">
            <select name="year" id="year" class="form-control">
            <option value="">Seleccione año</option>
            <option value="2019"> 2019</option>
            <option value="2020"> 2020</option>
            <option value="2021"> 2021</option>
            <option value="2022"> 2022</option>
        </select>

        </div>
        <div class="col-auto">
        <button type="submit" class="btn btn-primary"> Buscar</button>
        </div>
    </form>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Filtros de la Tabla</h3>
    <div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
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
<table id="planificatable" class="table table-hover table-bordered" >
    <thead>
        <tr>
          <th scope="col">EQ</th>
          <th scope="col">Servicio</th>
          <th scope="col">Inventario</th>
          <th scope="col">Serie</th>
          <th scope="col">Marca</th>
          <th scope="col">Modelo</th>
          <th scope="col">Familia</th>
          <th scope="col">SubFamilia</th>
          <th class="table-bordered">Ene</th>
          <th class="table-bordered">Feb</th>
          <th class="table-bordered">Mar</th>
          <th class="table-bordered">Abr</th>
          <th class="table-bordered">May</th>
          <th class="table-bordered">Jun</th>
          <th class="table-bordered">Jul</th>
          <th class="table-bordered">Ago</th>
          <th class="table-bordered">Sep</th>
          <th class="table-bordered">Oct</th>
          <th class="table-bordered">Nov</th>
          <th class="table-bordered">Dic</th> 
        </tr>
    </thead>
    <tbody>
       @foreach($equipos as $equipo)
        <tr>
            <td>{{ $equipo->eq }}</td>
            <td> {{ $equipo->ServicioClinico->nombre }}</td>
            <td> {{ $equipo->inventario}}</td>
            <td> {{ $equipo->serie }}</td>
            <td> {{ $equipo->Marca->marca}}</td>
            <td> {{ $equipo->Modelo->modelo}}</td>
            <td>{{ $equipo->Familia->nombre }}</td>
            <td>{{ $equipo->SubFamilia->nombre }}</td>
            <td>{{ $datos[$equipo->id]["01"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["02"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["03"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["04"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["05"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["06"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["07"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["08"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["09"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["10"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["11"] ??""  }}</td>
            <td>{{ $datos[$equipo->id]["12"] ??""  }}</td>
                        
        </tr>
        
       
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      
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