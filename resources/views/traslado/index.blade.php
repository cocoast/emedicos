@extends('adminlte::page')

@section('title', 'Traslados Internos')

@section('content_header')
    <h1>Listado de Traslados</h1>
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
@can('equipo.create')
<a href="{{route('traslado.create') }}" class="btn btn-primary"> Generar Traslado</a>
@endcan
<div class="container-fluid">
    <table id="trasladostable" class="table table-striped table-hover mt-4" style="width:100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Numero</th>
                <th scope="col">Fecha</th>
                <th scope="col">Servicio Clinico Origen</th>
                <th scope="col">Servicio Clinico Destino</th>
                <th scope="col">Inventario</th>
                <th scope="col">Serie</th>
                <th scope="col">Familia</th>
                <th scope="col">Sub-Familia</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Documento</th>
                @can('convenio.destroy')<th scope="col">Eliminar</th>@endcan
               
            </tr>
        </thead>
        <tbody>
        @foreach($traslados as $traslado)
            <tr>
                <td>{{ $traslado->id}} @can('convenio.edit') <a class="btn btn-warning" href="/traslado/{{$traslado->id}}/edit "><i class="bi bi-pencil"></i></a> @endcan</td>
                <td><a href="{{route('traslado.show', $traslado->id) }}" target="_blank" class="btn btn-primary"> {{ $traslado->numero }}</a></td>
                <td data-order="{{date("Ymd", strtotime($traslado->fecha))}}">{{date("d-m-Y", strtotime($traslado->fecha))}}</td>
                <td>{{$traslado->Actual->nombre}}</td>
                <td>{{$traslado->Destino->nombre}}</td>

                <td><!-- Trigger the modal with a button <--></-->
                    <button type="button" data-path="{{route('equipo.show', $traslado->Equipo->id) }}" class="btn btn-primary btn-sm openBtn">
                        {{ $traslado->Equipo->inventario }}</button>

                    
                </td>
                <td>{{ $traslado->Equipo->serie }}</td>
                <td>{{ $traslado->Equipo->Familia->nombre }}</td>
                <td>{{ $traslado->Equipo->SubFamilia->nombre }}</td>
                <td>{{ $traslado->Equipo->Marca->marca }}</td>
                <td>{{ $traslado->Equipo->Modelo->modelo }}</td>
                
                <td>
                    @if($traslado->archivo)
                        <a href="{{ $traslado->archivo }}" target="_blank" class="btn btn-primary"> Acta</a>
                        @else
                        @can('equipo.create')
                    <button type="button" data-path="{{route('traslado.subir', $traslado->id) }}" class="btn btn-warning btn-sm openBtn">
                        Subir Archivo</button>
                        @endcan
                       @endif
                        
                 @can('convenio.destroy')<td><form action="{{route('traslado.destroy',$traslado->id)}}" method="POST">
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
        var table=$('#trasladostable').DataTable( {
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
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>

@stop