@extends('adminlte::page')

@section('title', 'Establecimientos de Salud')

@section('content_header')
<div>
    @if (session()->has('message'))
    <div class="{{session('status')}} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('message') }}
    </div>
    @endif 
    
@stop

@section('content')
    @section('content_top_nav_left')
    <div class="text-center"><h3>Listado de Establecimientos de Salud</h3></div>
    @endsection  
@can('centrosalud.create')
    <div class="col">
        <a href="{{route('centrosalud.create') }}" class="btn btn-primary"> <i class="bi bi-file-plus"> Agregar</i></a>
    </div>
@endcan

<table id="centrosaludstable" class="table table-striped table-hover mt-4" style="width:100%">
    <thead>
        <tr>
            <th scope="col">Centro</th>
            <th scope="col"> Servicio</th>
            @can('centrosalud.edit')<th scope="col">editar</th> @endcan
            @can('centrosalud.destroy')<th scope="col">Eliminar</th> @endcan
        </tr>
    </thead>
    <tbody>
        @foreach($centros as $centrosalud)
            <tr>
                <td><a href="{{ route('centrosalud.show',$centrosalud->id) }}">{{$centrosalud->nombre}}</a></td>
                <td>{{ $centrosalud->Ssalud->nombre }}</td>
                @can('centrosalud.edit')<td>
                        <a href="{{route('centrosalud.edit',$centrosalud->id) }}" class="btn btn-warning btn-sm openBtn"><i class="bi bi-pencil"></i></a>
                </td>@endcan
                @can('centrosalud.destroy')<td>
                        <form action="{{route('centrosalud.destroy',$centrosalud->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onClick="javascript: return confirm('¿Estas seguro?');"><i class="bi bi-trash"></i></button>
                        </form>
                    
                @endcan </td>
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
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
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
    $('#centrosaludstable').DataTable( {
        dom: 'Bfrtip',
        buttons: ['excel'],
        "lengthMenu":[[10,50,-1],[10,50,"Todos"]]
    });
} );

$('.openBtn').on('click',function(){
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>
@stop