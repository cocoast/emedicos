@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Listado de Usuarios</h1>
@stop

@section('content')
 <h1>Vista Usuarios</h1>

<table id="userstable" class="table table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
     
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">FUNCIONES</th>
	</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
      	 <a class="btn btn-info" href="/user/{{$user->id}}/edit ">Editar Roles</a>
      </td>
    </tr>
    @endforeach
	</tbody>
</table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#userstable').DataTable({
    	 "lengthMenu":[[10,50,-1],[10,50,"Todos"]]
    });
} );
</script>
@stop