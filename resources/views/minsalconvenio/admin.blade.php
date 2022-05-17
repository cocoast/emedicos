@extends('adminlte::page')

@section('title', 'Convenios')

@section('content_top_nav_left')
<div class="text-center"><h3>Listado de Completo de Convenios</h3></div>
@endsection
@section('content')
<!-- Alertas -->
<div>
@if (session()->has('message'))
<div class="{{session('status')}} alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
{{ session('message') }}
@endif
</div>
<!---Fin de Alertas-->
</div>
<div class="row align-items-start">
  @foreach($sigfes as $sigfe)
  <div class="col">
    <!-- Apply any bg-* class to to the info-box to color it -->
    <div class="info-box bg-info">
      <span class="info-box-icon"><i class="bi bi-gear-wide"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{ $sigfe->nombre }}</span>
        <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($datos['pago_'.$sigfe->id]??0)}}</span>
        <!-- The progress section is optional -->
        <div class="progress">
          <div class="progress-bar" style="width: @if($datos[$sigfe->id]==0)0 @else{{ ($datos['pago_'.$sigfe->id] ?? 0)/($datos[$sigfe->id])*100 }}@endif%"></div>
        </div>
        <span class="progress-description">
        @if($datos[$sigfe->id]==0)0 @else {{ substr(($datos['pago_'.$sigfe->id] ?? 0)/($datos[$sigfe->id])*100,0,4) }} @endif % de un total de {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($datos[$sigfe->id])}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  @endforeach
</div>
<!---->

<div class="container-fluid ">
  
 <table id="conveniostables" class="table table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
      <th scope="col">#</th>
      <th scope="col">Servicio de Salud</th>
      <th scope="col">Institución</th>
      <th scope="col">Nombre</th>
      <th scope="col">Resolución Aprobatoria</th>
      <th scope="col">Fecha Resolución</th>
      <th scope="col">Año Notifica</th>
      <th scope="col">Termino del Convenio</th>
      <th scope="col">Monto Anual</th>
      <th scope="col">Subasignacion Sigfe</th>
      <th scope="col">Glosa</th>
      @can('minsal.convenio.show')<th scope="col">Pagos</th>@endcan
     
	</tr>
	</thead>
	<tbody>
		@foreach($convenios as $convenio)	      
    <tr>
      <td>{{ $convenio->id }}</td>
      <td>{{ $convenio->dependencetable->Ssalud->nombre ?? $convenio->dependencetable->nombre  }}</td>
      <td>{{ $convenio->dependencetable->nombre }}</td>
      <td>{{$convenio->nombre}}</td>
      <td>{{$convenio->resolucion}}</td>  
      <td data-order="{{date("Ymd", strtotime($convenio->fecha_resolucion))}}">{{date("d-m-Y", strtotime($convenio->fecha_resolucion))}}</td>
      <td>{{$convenio->ano}}</td>
      <td data-order="{{date("Ymd", strtotime($convenio->fecha_termino))}}">{{date("d-m-Y", strtotime($convenio->fecha_termino))}}</td>
      <td>${{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($convenio->monto_anual)}}</td>  
      <td>{{ $convenio->Sigfe->nombre }}</td>
      <td>{{$convenio->glosa}}</td>
    @can('minsal.convenio.show')
      <td>
        <!-- Trigger the modal with a button -->
            <button type="button" data-path="{{ route('minsalfactura.show',$convenio->id) }}" class="btn btn-info EquipoBtn"><i class="bi bi-wallet2"></i> </button>
      </td>    
      @endcan
   
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
<script type="text/javascript" src="js/jszip.min.js "></script>
<script type="text/javascript" src="js/pdfmake.min.js "></script>
<script type="text/javascript" src="js/vfs_fonts.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js "></script>




<script type="text/javascript">
  $('#conveniostables').DataTable( {
    "order": [[ 0, "asc" ]],
     buttons: [
        'excel'
    ],
    responsive: true,
    searchPanes:{
        layout: 'columns-5',
        initCollapsed: true,
        cascadePanes: true,
    },
    dom: 'PBfprtip', 
    pageLength: 20,
    
});
   

</script>
<script>

$('.EquipoBtn').on('click',function(){
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});

</script>
@stop