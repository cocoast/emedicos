@extends('adminlte::page')

@section('title', 'Equipos')

@section('content_header')
    <h1>Listado de Equipos</h1>
@stop

@section('content')
<div class="container-fluid">
 <table id="equipostable" class="table table-striped table-hover mt-4" style="width:100%">
  <thead>
  <tr>
      
      <th scope="col">SERVICIO CLINICO</th>
      <th scope="col">INVENTARIO</th>
      <th scope="col">SERIE</th>
      <th scope="col">EQ</th>
      <th scope="col">FAMILIA</th>
      <th scope="col">SUBFAMILIA</th>
      <th scope="col">MARCA</th>
      <th scope="col">MODELO</th>
      <th scope="col">TIPO ACTIVO</th>
      <th scope="col">FUNCIONES</th>
  </tr>
  </thead>
  <tbody>
    @foreach($equipos as $equipo)
    <tr>
      
      <td>{{$equipo->ServicioClinico->nombre}}</td>
      <td>{{$equipo->inventario}}</td>
      <td>{{$equipo->serie}}</td>
      <td>{{$equipo->eq}}</td>
      <td>{{$equipo->Familia->nombre}}</td>
      <td>{{$equipo->SubFamilia->nombre}}</td>
      <td>{{$equipo->Marca->marca}}</td>
      <td>{{$equipo->Modelo->modelo}}</td>
      <td>{{$equipo->tipoactivo}}</td>
      <td width="10px">
        <a class="btn btn-warning" href="/equipo/{{$equipo->id}}/edit "><i class="bi bi-pencil"></i></a>
        <a class="btn btn-info" href="/equipo/{{$equipo->id}}"><i class="bi bi-clipboard"></i></a>
        <!-- <form action="{{route('equipo.destroy',$equipo->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit" onClick="javascript: return confirm('¿Estas seguro?');"><i class="bi bi-trash"></i></button>
        </form> -->
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@stop

@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/1.3.0/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-html5-1.6.5/sp-1.2.2/sl-1.3.1/datatables.min.css"/>

<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link href="https://nightly.datatables.net/select/css/select.dataTables.css?_=83ccd9fe32dc99a890e17a9f1bbde5a4.css" rel="stylesheet" type="text/css" />
<link href="https://nightly.datatables.net/searchpanes/css/searchPanes.dataTables.css?_=5c6e38dbaaf467e0d790080ff9947c2c.css" rel="stylesheet" type="text/css" />

 


@stop

@section('js')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/1.3.0/js/dataTables.searchPanes.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-html5-1.6.5/sp-1.2.2/sl-1.3.1/datatables.min.js"></script>
     


<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://nightly.datatables.net/select/js/dataTables.select.js?_=83ccd9fe32dc99a890e17a9f1bbde5a4"></script>
<script src="https://nightly.datatables.net/searchpanes/js/dataTables.searchPanes.js?_=5c6e38dbaaf467e0d790080ff9947c2c"></script>





<script type="text/javascript">
$(document).ready( function () {
  var table = $('#equipostable').DataTable({
    dom: 'PBfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ],
   searchPanes: {
            cascadePanes: true
        },
         

  });
    $('.dtsp-topRow').on('click', function() {
    $(this).next().toggleClass('hidePane')
        })
    });
</script>
@stop
