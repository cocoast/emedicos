@extends('adminlte::page')

@section('title', 'Convenios')

@section('content_header')
<div class="d-flex justify-content-center">
    <div class="col">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <p> <strong> Presupuesto Anual Total:</strong> {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format(($totalanualpreventivo+$totalanualarriendo))}}</p>
            </div>
        </div>        
    </div>
    <div class="col ">
        <h2>Listado de Convenios de EEMM</h2>
    </div>
    <div class="col">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <p><strong>Presupuesto Anual Total Ejecutado:</strong> {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format(($totalpagado+$totalpagadoarriendo+$tcorrec))}}</p>
            </div>
        </div>       
    </div>
</div>
   <div class="row align-items-start">
    <div class="col">
               <!-- Apply any bg-* class to to the info-box to color it -->
<div class="info-box bg-red">
  <span class="info-box-icon"><i class="bi bi-gear-wide"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Convenios de Mantenimiento ({{$conmantt}})</span>
    <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($totalpagado)}}</span>
    <!-- The progress section is optional -->
    <div class="progress">
      <div class="progress-bar" style="width: {{ ($totalpagado/$totalanualpreventivo)*100 }}%"></div>
    </div>
    <span class="progress-description">
     {{ substr(($totalpagado/$totalanualpreventivo)*100,0,4) }}% de un total de {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($totalanualpreventivo)}}
    </span>
  </div>
  <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<div class="col">
                   <!-- Apply any bg-* class to to the info-box to color it -->
<div class="info-box bg-green">
  <span class="info-box-icon"><i class="bi bi-wallet2"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Convenios de Arriendo ({{$arr}})</span>
    <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($totalpagadoarriendo)}}</span>
    <!-- The progress section is optional -->
    <div class="progress">
      <div class="progress-bar" style="width: {{ ($totalpagadoarriendo/$totalanualarriendo)*100 }}%"></div>
    </div>
    <span class="progress-description">
     {{ substr(($totalpagadoarriendo/$totalanualarriendo)*100,0,4) }}% de un total de {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($totalanualarriendo)}}
    </span>
  </div>
  <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<div class="col">
                   <!-- Apply any bg-* class to to the info-box to color it -->
<div class="info-box bg-orange">
  <span class="info-box-icon"><i class="bi bi-plug"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Convenios  Correctivo ({{$correc}})</span>
    <span class="info-box-number">Utilizado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($tcorrec)}}</span>
    <span class="progress-description">
     
    </span>
  </div>
  <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
    </div>

   <div class="container-fluid">
        <div class="row">
            <div class="col">
                <a href="{{route('convenios.seguimiento')}}" class="btn btn-warning btn-sm" ><i class="bi bi-eyeglasses"></i> Seguimiento de OC </a>
            </div>
            <div class="col">
                <a href="{{route('convenios.seguimientomemos')}}" class="btn btn-warning btn-sm" ><i class="bi bi-eyeglasses"></i> Seguimiento de Memos </a>
            </div>
            <div class="col">
                @can('convenio.create')
                <a href="{{route('convenio.create')}}" class="btn btn-primary btn-sm"><i class="bi bi-file-plus"></i> Agregar Convenio</a>
                @endcan
            </div>
            
        </div>
    </div>
@stop
@section('content')
 

<div class="container-fluid ">
  
 <table id="conveniostables" class="table table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
      <th scope="col">Estado</th>
      <th scope="col">ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">LICITACION</th>
      <th scope="col">SOLICITUD</th>
      <th scope="col">RESOLUCION</th>
      <th scope="col">FECHA RESOLUCION</th>
      <th scope="col">INICIO</th>
      <th scope="col">FIN</th>
      <th scope="col">MESES</th>
      <th scope="col">FRECUENCIA</th>
      <th scope="col">VALOR</th>
      <th scope="col">TIPO </th>
      <th scope="col">PROVEEDOR</th>
      <th>Cantidad</th>
      <th scope="col">FUNCIONES</th>
	</tr>
	</thead>
	<tbody>
		@foreach($convenios as $convenio)
            @if(strtotime($convenio->fechafin)<strtotime($hoy))
		      <tr class="table-danger">
                    <td style="display: none;">Vencido</td>
                @elseif (strtotime($convenio->fechafin)<strtotime("+6 months"))
                    <tr class="table-warning">
                        <td style="display: none;">Vigencia Menor a 6 meses </td>
                        @else
                         <tr>
                            <td style="display: none;"> Vigente</td>
            @endif
      <td>{{ $convenio->id }}</td>
      <td><a href="{{ route('convenio.show',$convenio->id) }}">{{$convenio->nombre}}</a> </td>
      <td>@if($convenio->link)<a href="{{ $convenio->link }}" target="_blank">{{$convenio->licitacion}}</a>@else{{$convenio->licitacion}} @endif </td>
      <td>{{$convenio->solicitud}}</td>
      <td>{{$convenio->resolucion}}</td>
      <td>{{$convenio->fecharesolucion}}</td>
      <td data-order="{{date("Ymd", strtotime($convenio->fechaincio))}}">{{date("d-m-Y", strtotime($convenio->fechaincio))}}</td>
      <td data-order="{{date("Ymd", strtotime($convenio->fechafin))}}">{{date("d-m-Y", strtotime($convenio->fechafin))}}</td>
      <td>{{$convenio->meses}}</td>
      <td>
        @if($convenio->frecuenciapago==1) Mensual
        @elseif($convenio->frecuenciapago==4) Trimestral
        @elseif($convenio->frecuenciapago==6) Semestral
        @elseif($convenio->frecuenciapago==12) Anual
        @elseif($convenio->frecuenciapago=="Manual") Manual
        @endif

    </td>
      <td>${{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($convenio->valor)}}</td>
      <td>{{$convenio->tipoconvenio}}</td>
      <td>{{$convenio->Proveedor->nombre}}</td>
      <td>{{ $convenio->EquipoConvenio->count() }}</td>
           <td>
      @can('convenio.edit')
            <a class="btn btn-warning btn-sm" href="/convenio/{{$convenio->id}}/edit "><i class="bi bi-pencil"></i></a>
      @endcan
      @can('convenio.show')
        <a class="btn btn-info btn-sm" href="/convenio/{{$convenio->id}}"><i class="bi bi-eye"></i></a>
    @endcan
    @can('convenio.destroy')
      	 <form action="{{route('convenio.destroy',$convenio->id)}}" method="POST">
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
    "order": [[ 7, "asc" ]],
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
    "columnDefs": [            
            {
                "targets": [ 0,1,4,5,6   ],
                "visible": false
            }],
    pageLength: 20,
    
});
   

</script>
@stop