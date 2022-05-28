@extends('adminlte::page')

@section('title', 'Equipos')
@section('content')
@section('content_top_nav_left')
<div class="text-center"><h3>Listado de Equipos</h3></div>
@endsection     
<div>
    @if (session()->has('message'))
    <div class="{{session('status')}} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('message') }}
    </div>  
    @endif  
</div>
@can('equipo.create')
    <a href="{{route('equipo.create')}}" class="btn btn-primary btn-sm">Agregar Equipo</a>
@endcan


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


 
 <table id="equipostable" class="table table-condensed table-hover mt-4" style="width:100%;font-size: 0.75vw; ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Servicio Clinico</th>
                <th scope="col">Piso</th>
                <th scope="col">Inventario</th>
                <th scope="col">Serie</th>
                <th scope="col">EQ</th>
                <th scope="col">Familia</th>
                <th scope="col">Sub-Familia</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Fabricación</th>
                <th scope="col">Tipo de Activo</th>
                <th scope="col">Valor</th>
                <th scope="col">Adquisición</th>
                <th scope="col">Archivador</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($equipos as $equipo)
        @if($equipo->Baja)
            <tr style="max-height: 5px;" class="table-danger" >
                @else 
                <tr style="max-height: 5px;"  >
                    @endif
                <td>{{$equipo->id}} 
                   <br>
                 <!-- Trigger the modal with a button -->
                     <button type="button" data-path="{{route('equipo.subir', $equipo->id) }}" alt="Carga de Archivos" class="btn btn-success  openBtn">
                      <i class="bi bi-cloud-plus"></i></button> 
                   </td>
                <td>{{$equipo->ServicioClinico->nombre}}</td>
                <td>{{$equipo->ServicioClinico->ubicacion}}</td>
                <td> <a href="{{route('equipo.show', $equipo->id) }}" class="btn btn-primary btn-sm" target="_blank">{{ $equipo->inventario }}</a></td>
                <td><a href="{{route('equipo.show', $equipo->id) }}" class="btn btn-primary btn-sm" target="_blank">{{ $equipo->serie }}</td>
                <td>{{$equipo->eq}}</td>
                <td>{{$equipo->Familia->nombre}}</td>
                <td>{{$equipo->SubFamilia->nombre}}</td>
                <td>{{$equipo->Marca->marca}}</td>
                <td>{{$equipo->Modelo->modelo}}</td>
                <td>{{$equipo->fabricacion}}</td>
                <td>{{$equipo->tipoactivo}}</td>
                <td data-order="{{ $equipo->valor }}">{{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($equipo->valor)}}</td>
                <td>{{$equipo->fecha_adquisicion}}</td>
                <td>{{$equipo->archivador}}</td>        
                <td width="10px">
                <a href="{{route('equipo.rtls', $equipo->id) }}" target="_blank" class="btn btn-secondary"><i class="bi bi-geo-alt"></i></a>
                    @can('equipo.edit')
                        <a class="btn btn-warning btn-sm" href="/equipo/{{$equipo->id}}/edit "><i class="bi bi-pencil"></i></a>
                    @endcan
                    @can('equipo.destroy')
                        <form action="{{route('equipo.destroy',$equipo->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit" onClick="javascript: return confirm('¿Estas seguro?');"><i class="bi bi-trash"></i></button>
                        </form> 
                    @endcan  
                                
                </td>
            </tr>
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

<link rel="stylesheet" href="/css/app.css">



<!--BOOSTRAP ICONS-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<!--DATATABLE-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css ">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/1.4.0/css/searchPanes.dataTables.min.css ">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css ">



@stop

@section('js')
<!--JQUERY-->
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<!--DATATABLE-->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/1.4.0/js/dataTables.searchPanes.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js "></script>
<script type="text/javascript" src="js/jszip.min.js "></script>

<script type="text/javascript" src="js/vfs_fonts.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js "></script>



<script type="text/javascript">
   $(document).ready(function() {
    let table = $('#equipostable').DataTable({
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
<script>
$('.openRtls').on('click',function(){

    $('.modal-body').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});



</script>
@stop