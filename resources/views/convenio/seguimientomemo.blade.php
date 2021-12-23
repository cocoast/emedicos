@extends('adminlte::page')

@section('title', 'Memos Sin Solicitud de Compra')

@section('content_header')
<img class="img-fluid" src="/img/cabezera-1.png">
    <h1>Sub-Departamento de Equipos Medicos</h1>
@stop

@section('content') 
<div class="row">
  
    <div class="col" >
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title ">Pagos Realizados Sin MEMO (archivo) </h3>
            </div>
            <div class="card-body">
                      <table id="realizados" class="table table-striped table-hover">
                            <thead class="table-warning">
                                <tr>
                                    <th>ID Convenio</th>
                                    <th>Convenio</th>
                                    <th>Licitacion</th>
                                    <th>Cuota</th>
                                    <th>Fecha de Corte</th>
                                    <th>Memo</th>
                                    <th>OC</th>
                                    <th>Fecha Ultima Actualizacion</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($realizados as $realizado)
                                <tr>
                             <td>{{ $realizado->Convenio->id }}</td>
                             <td><a href="/convenio/{{$realizado->Convenio->id}}"> {{$realizado->Convenio->nombre}}</a> </td>
                             <td>{{$realizado->Convenio->licitacion}}</td>
                             <td><a href="/pagos/{{$realizado->id}}/edit">{{$realizado->periodo}}</a></td>
                             <td>{{date("d-m-Y", strtotime($realizado->fecha))}}</td>
                             <td>{{$realizado->memo}}</td>
                             <td>{{$realizado->oc}}</td>
                             <td data-order="{{ date("Ymd", strtotime($realizado->updated_at)) }}">{{date("d-m-Y", strtotime($realizado->updated_at))}}</td>
                            <td><a class="btn btn-warning btn-sm" href="/pagos/{{$realizado->id}}/edit "><i class="bi bi-pencil"></i></a></td>     
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
            </div>
            <!-- /.card-body -->
          
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
    $('#realizados').DataTable( {
        "order": [[ 6, "asc" ]],
        dom: 'Bfrtip',
        buttons: ['excel','pdf'],
        "lengthMenu":[[20,50,-1],[20,50,"Todos"]],
        "columnDefs": [            
            {
                "targets": [ 0 ],
                "visible": false
            }],
    });
} );
</script>
@stop