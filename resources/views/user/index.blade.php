@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Listado de Usuarios</h1>
@stop

@section('content')
 <div>
    @if (session()->has('message'))
    <div class="{{session('status')}} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('message') }}
    </div>
    @endif
 <!-- Trigger the modal with a button -->
<button type="button" data-path="{{route('user.create') }}" class="btn btn-primary btn-sm openBtn">
                    Agregar Usuarios</button>

<table id="userstable" class="table table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
     
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Dependencia</th>
      <th scope="col">Editar Roles</th>
      @can('user.delete')<th scope="col">Eliminar</th>@endcan
	</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
    <th scope="row">{{$user->id}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td><a class="btn btn-info" href="{{ route('user.dependencia',$user->id) }}">@if($user->Dependence){{ $user->Dependence->dependencetable_type::find($user->Dependence->dependencetable_id)->nombre }}@endif</a></td>
        <td><a class="btn btn-info" href="/user/{{$user->id}}/edit ">Roles</a></td>
        <td>@can('user.delete')
            <form action="{{route('user.delete',$user->id)}}" method="POST">
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
    $('#userstable').DataTable( {
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