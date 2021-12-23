@extends('adminlte::page')

@section('title', 'Convenios')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@stop
@section('content_header')
    <h1>Listado de Convenios</h1>
@stop

@section('content')
<div class="container-fluid">
 <table id="conveniostables" class="table table-responsive table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
      <th scope="col">#</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">LICITACION</th>
      <th scope="col">SOLICITUD</th>
      <th scope="col">RESOLUCION</th>
      <th scope="col">FECHA RESOLUCION</th>
      <th scope="col">FECHA INICIO</th>
      <th scope="col">FECHA FIN</th>
      <th scope="col">MESES</th>
      <th scope="col">FRECUENCIA DE PAGO</th>
      <th scope="col">TIPO DE CONVENIO</th>
      <th scope="col">PROVEEDOR</th>
      <th scope="col">FUNCIONES</th>
	</tr>
	</thead>
	<tbody>
		@foreach($convenios as $convenio)
		<tr>
      <th scope="row">{{$convenio->id}}</th>
      <td>{{$convenio->nombre}}</td>
      <td>{{$convenio->licitacion}}</td>
      <td>{{$convenio->solicitud}}</td>
      <td>{{$convenio->resolucion}}</td>
      <td>{{$convenio->fecharesolucion}}</td>
      <td>{{$convenio->fechaincio}}</td>
      <td>{{$convenio->fechafin}}</td>
      <td>{{$convenio->meses}}</td>
      <td>{{$convenio->frecuenciapago}}</td>
      <td>{{$convenio->tipoconvenio}}</td>
      <td>{{$convenio->Proveedor->nombre}}</td>
           <td>
      	<form action="{{route('convenio.destroy',$convenio->id)}}" method="POST">
      	<a class="btn btn-warning" href="/convenio/{{$convenio->id}}/edit "><i class="bi bi-pencil"></i></a>
        <a class="btn btn-info" href="/convenio/{{$convenio->id}}"><i class="bi bi-clipboard"></i></a>
      	@csrf
      	@method('DELETE')
      	<button class="btn btn-danger" type="submit" onClick="javascript: return confirm('¿Estas seguro?');"><i class="bi bi-trash"></i></button>
      	</form>
      </td>
    </tr>
    @endforeach
	</tbody>
</table>
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
    $('#conveniostables').DataTable({
    	 "lengthMenu":[[10,50,-1],[10,50,"Todos"]]
    });
} );
</script>
@stop