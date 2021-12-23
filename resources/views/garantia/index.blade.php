@extends('adminlte::page')

@section('title', 'Garantias')

@section('content_header')
    <h1>Listado de Garantias</h1>
@stop

@section('content')


<div class="container-fluid">
    <table id="garantiastable" class="table table-striped table-hover mt-4" style="width:100%">
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
                <th scope="col">Vencimiento Garantia </th>
                <th scope="col">Cantidad de MP </th>
                <th scope="col">Frecuencia </th>
           
               
            </tr>
        </thead>
        <tbody>
        @foreach($garantias as $garantia)
            <tr>
                <td>{{$garantia->Equipo->id}}</td>
                <td>{{$garantia->Equipo->ServicioClinico->nombre}}</td>
                <td>{{$garantia->Equipo->ServicioClinico->ubicacion}}</td>
                <td> 
            <!-- Trigger the modal with a button -->
                    <button type="button" data-path="{{route('equipo.show', $garantia->Equipo->id) }}" class="btn btn-primary btn-sm openBtn">
                        {{$garantia->Equipo->inventario}}</button>
                </td>
                <td>
         <!-- Trigger the modal with a button -->
                <button type="button" data-path="{{route('equipo.show', $garantia->Equipo->id) }}" class="btn btn-primary btn-sm openBtn">
                    {{$garantia->Equipo->serie}}</button>
                </td>
                <td>{{$garantia->Equipo->eq}}</td>
                <td>{{$garantia->Equipo->Familia->nombre}}</td>
                <td>{{$garantia->Equipo->SubFamilia->nombre}}</td>
                <td>{{$garantia->Equipo->Marca->marca}}</td>
                <td>{{$garantia->Equipo->Modelo->modelo}}</td>
                <td data-order="{{date("Ymd", strtotime($garantia->fin))}}">{{date("d-m-Y", strtotime($garantia->fin))}}</td>
                <td>{{ $garantia->mp }}</td>
                <td>cada {{ $garantia->frecuencia }} meses</td>     
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
        var table=$('#garantiastable').DataTable( {
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

 $('.openBtn').on('click',function(){
    $('.modal-body').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>
@stop