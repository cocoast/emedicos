@extends('adminlte::page')

@section('title', 'Planificacion Formato Minsal')

@section('content_header')
    <h1>Planificacion Formato Minsal {{$year }}</h1>
@stop

@section('content')

<div>
    @if (session()->has('message'))
    <div class="{{session('status')}} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('message') }}
    </div>
    @endif
@can('modelo.create')
<a href="/planifica/create/" class="btn btn-secondary">Agregar</a>
<a href="/planifica/programa/" class="btn btn-secondary">Programar en lote</a>

@endcan
<a href="/planifica/listado/" class="btn btn-primary"> Programación</a>
<a href="/planifica/" class="btn btn-primary"> Planificación</a>




<table id="planificatable" class="table table-striped table-hover mt-4" >
    <thead>
        <tr>
          
          <th scope="col">Servicio</th>
          <th scope="col">Clase</th>
          <th scope="col">Sub Clase</th>
          <th scope="col">EQ</th>
          <th scope="col">Familia</th>
          <th scope="col">Sub Familia</th>
          <th scope="col">Marca</th>
          <th scope="col">Modelo</th>
          <th scope="col">Serie</th>
          <th scope="col">Inventario</th>
          <th scope="col">Valor</th>
          <th scope="col">Año de Instalacion</th>
          <th scope="col">Vida útil</th>
          <th scope="col">Vida Residual</th>
          <th scope="col">Propio/Arriendo/Comodato</th>
          <th class="table-bordered">Enero</th>
          <th class="table-bordered">Febrero</th>
          <th class="table-bordered">Marzo</th>
          <th class="table-bordered">Abril</th>
          <th class="table-bordered">Mayo</th>
          <th class="table-bordered">Junio</th>
          <th class="table-bordered">Julio</th>
          <th class="table-bordered">Agosto</th>
          <th class="table-bordered">Septiembre</th>
          <th class="table-bordered">Octubre</th>
          <th class="table-bordered">Noviembre</th>
          <th class="table-bordered">Diciembre</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($equipos as $equipo)
        @if (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->count()>0)
        <tr>    
            
            <td><a href="/servicioclinico/{{$equipo->ServicioClinico->id}}">{{ $equipo->ServicioClinico->nombre }}</a></td>
            <td>{{ $equipo->Clase->nombre }}</td>
            <td>{{ $equipo->SubClase->nombre }}</td>
            <td>{{ $equipo->eq }}</td>
            <td>{{ $equipo->Familia->nombre }}</td>
            <td>{{ $equipo->SubFamilia->nombre }} </td>
            <td>{{ $equipo->Marca->marca }}</td> 
            <td>{{ $equipo->Modelo->modelo }}</td>
            <td><a href="/equipo/{{$equipo->id}}">{{ $equipo->serie }}</a></td>
            <td><a href="/equipo/{{$equipo->id}}">{{ $equipo->inventario }}</a></td>
            <td>{{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($equipo->valor)}}</td>
            <td>{{$equipo->fecha_adquisicion}}</td>
            <td>{{ $equipo->SubFamilia->vidautil }}</td>
            @if($equipo->fabricacion!='0'&&$equipo->SubFamilia->vidautil-($year-$equipo->fabricacion)<0)
                <td data-order="{{$equipo->SubFamilia->vidautil-($year-$equipo->fabricacion)}}" style="color:red;">{{$equipo->SubFamilia->vidautil-($year-$equipo->fabricacion)}}</td>
                @elseif($equipo->fabricacion!='0'&&$equipo->SubFamilia->vidautil-($year-$equipo->fabricacion)>=0)
                <td data-order="{{$equipo->SubFamilia->vidautil-($year-$equipo->fabricacion)}}">{{$equipo->SubFamilia->vidautil-($year-$equipo->fabricacion)}}</td>
                @else
                <td>Falta Información</td>
                @endif
            <td>{{$equipo->tipoactivo}}</td>
            
        
           <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==1 )     @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==2 )  @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif   @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==3 )   @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif  @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==4 )   @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif  @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==5 )   @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif  @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==6 )  @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif   @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==7 ) @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif    @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==8 )  @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif   @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==9 )  @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif   @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==10 )   @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif    @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==11 )  @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif   @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
             <td class="table-bordered"> 
            @foreach (App\Models\Planificamp::whereYear('fechacorte',$year)->where('equipo',$equipo->id)->orderby('fechacorte','ASC')->get() as $mp)
            @if(date("m", strtotime($mp->fechacorte))==12 )  @if($mp->fechaprogramacion!=""){{ date("d-m-Y", strtotime($mp->fechaprogramacion)) }}@endif   @if($mp->tipomp=="Convenio" ||$mp->tipomp=="Compra de Servicio"||$mp->tipomp=="Garantia") Externa @else {{ $mp->tipomp }} @endif  @endif
            @endforeach
            </td>
        </tr>   
        @endif
        @endforeach
    </tbody>
</table>

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
  $('#planificatable').DataTable( {
     buttons: [
        'excel'
    ],
    
    searchPanes:{
        layout: 'columns-5',
        initCollapsed: true,
        cascadePanes: true,
    },
    dom: 'PBfprtip', 
    "columnDefs": [            
            {
                "targets": [  ],
                "visible": false
            }],
    pageLength: 20
});
   

</script>
@stop