@extends('adminlte::page')

@section('title', 'Convenios')

@section('content_header')
@section('content_top_nav_left')
<div class="text-center"><h3>Listado de Convenios</h3></div>
@endsection
<div class="row align-items-start">
   <div class="col w-25">
        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="bi bi-wallet2"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Convenios de Mantenimiento Activos ({{$preventivos["cantidad"]}})</span>
            <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($preventivos["pagado"])}}</span>
            <div class="progress">
                <div class="progress-bar" style="width: @if($preventivos["pagado"]==0) 0; @else{{  ($preventivos["pagado"]/$preventivos["total"])*100}}@endif%"></div>
            </div>
            <span class="progress-description">
              @if($preventivos["total"]==0) 0 @else {{ substr((  $preventivos["pagado"]/$preventivos["total"])*100,0,4) }} @endif% de: {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($preventivos["total"])}}
             Equipos: {{ $preventivos["equipos"] }}
            </span>
          </div>
        </div>
    </div>

    <div class="col w-25">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="bi bi-wallet2"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Convenios de Arriendo({{$arriendos["cantidad"]}})</span>
                <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($arriendos["pagado"])}}</span>
                <div class="progress">
                  <div class="progress-bar" style="width: @if($arriendos["pagado"]==0) 0; @else{{  ($arriendos["pagado"]/$arriendos["total"])*100}}@endif%"></div>
                </div>
                <span class="progress-description">
                @if ($arriendos["pagado"]==0) 0;  @else {{ substr(($arriendos["pagado"]/$arriendos["total"])*100,0,4) }}@endif % de: {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($arriendos["total"])}}
                Equipos: {{ $arriendos["equipos"] }}
                </span>
            </div>
        </div>
    </div>

    <div class="col w-25">           
        <div class="info-box bg-orange">
            <span class="info-box-icon"><i class="bi bi-wallet2"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Convenios Correctivos({{$correctivos["cantidad"]}})</span>
                <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($correctivos["pagado"])}}</span>
                <div class="progress">
                    <div class="progress-bar" style="width: @if($correctivos["pagado"]==0) 0; @else{{  ($correctivos["pagado"]/$correctivos["total"])*100}}@endif%"></div>
                </div>
                <span class="progress-description">
                @if ($correctivos["total"]==0) 0 @else {{ substr(($correctivos["pagado"]/$correctivos["total"])*100,0,4) }}% de un total de {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($correctivos["total"])}}@endif
                </span>
            </div>
        </div>
    </div>
</div>       
@stop
@section('content')
 <div class="container-fluid">
        <div class="row">
            <div class="col">
                <a href="{{route('convenios.seguimiento')}}" target="_blank" class="btn btn-warning " ><i class="bi bi-eyeglasses"></i> Seguimiento de OC </a>
            </div>
            <div class="col">
                <a href="{{route('convenios.seguimientomemos')}}" target="_blank" class="btn btn-warning " ><i class="bi bi-eyeglasses"></i> Seguimiento de Memos </a>
            </div>
            <div class="col">
                @can('convenio.create')
                <a href="{{route('convenio.create')}}" target="_blank" class="btn btn-primary"><i class="bi bi-file-plus"></i> Agregar Convenio</a>
                @endcan
            </div>
            <div class="col">
                <form action="{{ route('convenio.trazadoras') }}" method="get" class="row g-3">
                    @csrf
                    <div class="col-auto">
                        <label for="select" class="form-label"> Trazadoras</label>
                    <select name="year" id="year" class="form-control">
                        <option value="">Seleccione año</option>
                        <option value="2019"> 2019</option>
                        <option value="2020"> 2020</option>
                        <option value="2021"> 2021</option>
                        <option value="2022"> 2022</option>
                    </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm btn-primary"> Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<div class="container-fluid ">
  
 <table id="conveniostables" class="table table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
      <th scope="col">Estado</th>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Licitación</th>
      <th scope="col">Solicitud</th>
      <th scope="col">Resolución</th>
      <th scope="col">Fecha Resolución</th>
      <th scope="col">Año Vencimiento</th>
      <th scope="col">Inicio</th>
      <th scope="col">Fin</th>
      <th scope="col">Meses</th>
      <th scope="col">Frecuencia</th>
      <th scope="col">Valor</th>
      <th scope="col">Tipo </th>
      <th scope="col">Proveedor</th>
      <th>Equipos</th>
      @can('convenio.show')<th scope="col">Ver</th>@endcan
      @can('convenio.edit')<th scope="col">Editar</th>@endcan
      @can('convenio.destroy')<th scope="col">Eliminar</th>@endcan
      @can('convenio.baja')<th scope="col">Dar de Baja</th>@endcan
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
      <td>{{ date('Y',strtotime($convenio->fechafin)) }}</td>
      <td data-order="{{date("Ymd", strtotime($convenio->fechaincio))}}">{{date("d-m-Y", strtotime($convenio->fechaincio))}}</td>
      <td data-order="{{date("Ymd", strtotime($convenio->fechafin))}}">{{date("d-m-Y", strtotime($convenio->fechafin))}}</td>
      <td>{{$convenio->meses}}</td>
      <td>
        @if($convenio->frecuenciapago==1) Mensual
        @elseif($convenio->frecuenciapago==3) Cuatrimestral
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
    @can('convenio.show')
      <td>
        <a class="btn btn-info btn-sm" href="/convenio/{{$convenio->id}}"><i class="bi bi-eye"></i></a>
      </td>    
    @endcan
    @can('convenio.edit')
      <td>
        <a class="btn btn-warning btn-sm" href="/convenio/{{$convenio->id}}/edit "><i class="bi bi-pencil"></i></a>
     </td>     
    @endcan      
    @can('convenio.destroy')
        <td>
         <form action="{{route('convenio.destroy',$convenio->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" type="submit" onClick="javascript: return confirm('¿Estas seguro?');"><i class="bi bi-trash"></i></button>
         </form>  
      </td>
    @endcan
    @can('convenio.baja')
        <td> <a class="btn btn-secondary btn-sm" href="/convenio/{{$convenio->id}}/baja "><i class="bi bi-file-earmark-excel-fill"></i></a></td> 
    @endcan
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
                "targets": [ 0,1,4,5,6,7  ],
                "visible": false
            }],
    pageLength: 20,
    
});
   

</script>
@stop