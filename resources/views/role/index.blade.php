@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Listado de Roles</h1>
@stop

@section('content')
 <h1>Vista Roles</h1>
 <div>
    @if (session()->has('message'))
    <div class="{{session('status')}} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('message') }}
    </div>
    @endif  
</div>
 <!-- Trigger the modal with a button -->
 <div class="p-4">
<button type="button" data-path="{{route('role.create') }}" class="btn btn-primary btn-sm openBtn">Crear Nuevo</button>     
 </div>

<table id="rolestable" class="table table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
      <th scope="col">#</th>
      <th scope="col">ROLE</th>
      <th scope="col">FUNCIONES</th>
	</tr>
	</thead>
	<tbody>
		@foreach($roles as $rol)
		<tr>
      <th scope="row">{{$rol->id}}</th>
      <td>{{$rol->name}}</td>
      <td>
      	
      	<a class="btn btn-info" href="/role/{{$rol->id}}/edit ">EDITAR</a>
      	
      </td>
    </tr>
    @endforeach
	</tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
    </div>
  </div>
</div>
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
    $('#rolestable').DataTable({
    	 "lengthMenu":[[5,10,50,-1],[5,10,50,"Todos"]]
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