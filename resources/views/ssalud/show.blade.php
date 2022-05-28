@extends('adminlte::page')

@section('title', 'Servicio de Salud')

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
<div class="text-center"><h3>Listado de Establecimientos de Salud del {{ $servicio->nombre }}</h3></div>
@endsection  
<div class="row align-items-start">
  @foreach(App\Models\Sigfe::all() as $sigfe)
  <div class="col">
    <!-- Apply any bg-* class to to the info-box to color it -->
    <div class="info-box bg-info">
      <span class="info-box-icon"><i class="bi bi-gear-wide"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{ $sigfe->nombre}} {{ $sigfe->codigo}}</span>
        <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($mp['pago_'.$sigfe->id]??0)}}</span>
        <!-- The progress section is optional -->
        <div class="progress">
          <div class="progress-bar" style="width: @if($mp[$sigfe->id]==0) 0 @else{{ ($mp['pago_'.$sigfe->id] ?? 0)/($mp[$sigfe->id])*100 }}@endif%"></div>
        </div>
        <span class="progress-description">
        @if($mp[$sigfe->id]==0)0 @else {{ substr(($mp['pago_'.$sigfe->id] ?? 0)/($mp[$sigfe->id])*100,0,4) }} @endif % de un total de {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($mp[$sigfe->id])}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  @endforeach
</div>
<div class="col">
@can('centrosalud.create')
<a href="{{route('centrosalud.create') }}" class="btn btn-primary"> <i class="bi bi-file-plus"> Agregar Establecimientos de Salud</i></a>
@endcan
</div>
<div class="col">
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
      <td>
        @can('centrosalud.edit')
        <a href="{{route('centrosalud.edit',$centrosalud->id) }}" class="btn btn-warning btn-sm openBtn"><i class="bi bi-pencil"></i></a>
        @endcan
    </td>
    <td>
        @can('centrosalud.destroy')
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
</div>

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