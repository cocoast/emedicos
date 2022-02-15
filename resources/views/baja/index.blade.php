@extends('adminlte::page')

@section('title', 'Bajas')

@section('content_header')
    <h1>Listado Solicitudes de Bajas</h1>
@stop

@section('content')
@can('equipo.create')
{{-- <a href="/baja/create/">Agregar</a> --}}
<button type="button" class="btn btn-primary" data-toggle="modal" id="add" data-target="#addModal">
  Agregar Baja
</button>
@endcan

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/baja" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Numero Baja/ Año Baja</label>
        <input id="baja" name="baja" type="text" tabindex="1" class="form-control">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Fecha de la Baja</label>
        <input id="fecha" name="fecha" type="date" tabindex="2" class="form-control">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Equipo</label>
        <input id="equipo" name="equipo" type="text" tabindex="3" placeholder="Ingrese Inventario o Serie" class="form-control">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Archivo de la Baja</label>
        <input id="documento" name="documento" type="file" tabindex="4" class="form-control">
    </div>
    <button  class="btn btn-primary" >GUARDAR</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
    <table id="bajastable" class="table table-striped table-hover mt-4" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Solicitud de Baja</th>
                <th scope="col">Fecha</th>
                <th scope="col">Servicio Clinico</th>
                <th scope="col">Piso</th>
                <th scope="col">Inventario</th>
                <th scope="col">Serie</th>
                <th scope="col">EQ</th>
                <th scope="col">Familia</th>
                <th scope="col">Sub-Familia</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Archivador</th>
                <th scope="col">Documento</th>
                @can('convenio.destroy')<th scope="col">Eliminar</th>@endcan
               
            </tr>
        </thead>
        <tbody>
        @foreach($bajas as $baja)
            <tr>
                <td>{{ $baja->id}} @can('convenio.edit') <a class="btn btn-warning" href="/baja/{{$baja->id}}/edit "><i class="bi bi-pencil"></i></a> @endcan</td>
                <td>{{ $baja->baja }}</td>
                <td data-order="{{date("Ymd", strtotime($baja->fecha))}}">{{date("d-m-Y", strtotime($baja->fecha))}}</td>
                <td>{{$baja->Equipo->ServicioClinico->nombre}}</td>
                <td>{{$baja->Equipo->ServicioClinico->ubicacion}}</td>
                <td> 
            <!-- Trigger the modal with a button -->
                    <button type="button" data-path="{{route('equipo.show', $baja->Equipo->id) }}" class="btn btn-primary btn-sm openBtn">{{$baja->Equipo->inventario}}</button> 
                </td>
                <td>
         <!-- Trigger the modal with a button -->
                <button type="button" data-path="{{route('equipo.show', $baja->Equipo->id) }}" class="btn btn-primary btn-sm openBtn">{{$baja->Equipo->serie}}</button>
                </td>
                <td>{{$baja->Equipo->eq}}</td>
                <td>{{$baja->Equipo->Familia->nombre}}</td>
                <td>{{$baja->Equipo->SubFamilia->nombre}}</td>
                <td>{{$baja->Equipo->Marca->marca}}</td>
                <td>{{$baja->Equipo->Modelo->modelo}}</td>
                <td>{{$baja->Equipo->archivador}}</td>    
                <td><a href="{{ $baja->documento }}" class="btn btn-primary" target="_blank">Sol Baja</a></td>
                   @can('convenio.destroy')<td><form action="{{route('baja.destroy',$baja->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                     <button class="btn btn-danger" type="submit" onClick="javascript: return confirm('¿Estas seguro?');"><i class="bi bi-trash"></i></button>
                    </form> 
                </td>@endcan
            </tr>
        @endforeach
        </tbody>
    </table>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!--DATATABLE-->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js "></script>
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
        var table=$('#bajastable').DataTable( {
        buttons: ['excel'],
        responsive: true,
        searchPanes:{
            layout: 'columns-5',
            initCollapsed: true,
            cascadePanes: true,
        },
        dom: 'PBfprtip', 
        pageLength: 20
        });

} );


</script>
<script>
   $('.openBtn').on('click',function(){
    $('.modal-body').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
   $('.add').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
@stop