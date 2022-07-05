@extends('adminlte::page')

@section('title', 'Ejecucion MP')

@section('content_top_nav_left')
    <h1>Ejecucion de Mantenimiento Preventivo {{date('Y') }}</h1>
@stop

@section('content')

<div>
    @if (session()->has('message'))
    <div class="{{session('status')}} alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('message') }}
    </div>
   @endif 

<br>

<div class="table-responsive-sm">
<table id="planificatable" class="table table-hover table-striped " >
    <thead>
        <tr>
          <th>Item</th>
          <th>Enero</th>
          <th>Febrero</th>
          <th>Marzo</th>
          <th>Abril</th>
          <th>Mayo</th>
          <th>Junio</th>
          <th>Julio</th>
          <th>Agosto</th>
          <th>Septiembre</th>
          <th>Octubre</th>
          <th>Noviembre</th>
          <th>Diciembre</th>
        </tr>
    </thead>
    <tbody>
        <tbody>
            <tr class="table-primary">
            <td>Mantenimientos Internos Planificados </td>
            <td>{{ $ejecucion['enero']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['febrero']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['marzo']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['abril']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['mayo']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['junio']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['julio']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['agosto']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['septiembre']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['octubre']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['noviembre']['interno_planificado'] }}</td>
            <td>{{ $ejecucion['diciembre']['interno_planificado'] }}</td>
            </tr>
            <tr>
            <td>Mantenimientos Internos Ejecutado </td>
            <td>{{ $ejecucion['enero']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['febrero']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['marzo']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['abril']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['mayo']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['junio']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['julio']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['agosto']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['septiembre']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['octubre']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['noviembre']['interno_ejecutado'] }}</td>
            <td>{{ $ejecucion['diciembre']['interno_ejecutado'] }}</td>
            </tr>
            <tr class="table-primary">
            <td>Mantenimientos Externo Planificados </td>
            <td>{{ $ejecucion['enero']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['febrero']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['marzo']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['abril']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['mayo']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['junio']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['julio']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['agosto']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['septiembre']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['octubre']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['noviembre']['externo_planificado'] }}</td>
            <td>{{ $ejecucion['diciembre']['externo_planificado'] }}</td>
            </tr>
            <tr>
            <td>Mantenimientos Externo Ejecutado </td>
            <td>{{ $ejecucion['enero']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['febrero']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['marzo']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['abril']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['mayo']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['junio']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['julio']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['agosto']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['septiembre']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['octubre']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['noviembre']['externo_ejecutado'] }}</td>
            <td>{{ $ejecucion['diciembre']['externo_ejecutado'] }}</td>
            </tr>
            <tr>
                <th>Total Planificado</th>
                <th>{{ $ejecucion['enero']['externo_planificado']+$ejecucion['enero']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['febrero']['externo_planificado']+$ejecucion['febrero']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['marzo']['externo_planificado']+$ejecucion['marzo']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['abril']['externo_planificado']+$ejecucion['abril']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['mayo']['externo_planificado']+$ejecucion['mayo']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['junio']['externo_planificado']+$ejecucion['junio']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['julio']['externo_planificado']+$ejecucion['julio']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['agosto']['externo_planificado']+$ejecucion['agosto']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['septiembre']['externo_planificado']+$ejecucion['septiembre']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['octubre']['externo_planificado']+$ejecucion['octubre']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['noviembre']['externo_planificado']+$ejecucion['noviembre']['interno_planificado'] }}</th>
                <th>{{ $ejecucion['diciembre']['externo_planificado']+$ejecucion['diciembre']['interno_planificado'] }}</th>
            </tr>
             <tr class="table-success">
                <th >Total Planificado Criticos</th>
                <th>{{ $ejecucion['enero']['2.1'] }}</th>
                <th>{{ $ejecucion['febrero']['2.1'] }}</th>
                <th>{{ $ejecucion['marzo']['2.1'] }}</th>
                <th>{{ $ejecucion['abril']['2.1'] }}</th>
                <th>{{ $ejecucion['mayo']['2.1'] }}</th>
                <th>{{ $ejecucion['junio']['2.1'] }}</th>
                <th>{{ $ejecucion['julio']['2.1']}}</th>
                <th>{{ $ejecucion['agosto']['2.1'] }}</th>
                <th>{{ $ejecucion['septiembre']['2.1'] }}</th>
                <th>{{ $ejecucion['octubre']['2.1']}}</th>
                <th>{{ $ejecucion['noviembre']['2.1']}}</th>
                <th>{{ $ejecucion['diciembre']['2.1'] }}</th>
            </tr>
            <tr class="table-success">
                <th >Total Planificado Relevantes</th>
                <th>{{ $ejecucion['enero']['2.2'] }}</th>
                <th>{{ $ejecucion['febrero']['2.2'] }}</th>
                <th>{{ $ejecucion['marzo']['2.2'] }}</th>
                <th>{{ $ejecucion['abril']['2.2'] }}</th>
                <th>{{ $ejecucion['mayo']['2.2'] }}</th>
                <th>{{ $ejecucion['junio']['2.2'] }}</th>
                <th>{{ $ejecucion['julio']['2.2']}}</th>
                <th>{{ $ejecucion['agosto']['2.2'] }}</th>
                <th>{{ $ejecucion['septiembre']['2.2'] }}</th>
                <th>{{ $ejecucion['octubre']['2.2']}}</th>
                <th>{{ $ejecucion['noviembre']['2.2']}}</th>
                <th>{{ $ejecucion['diciembre']['2.2'] }}</th>
            </tr>
             <tr>
                <th>% Cumplimiento</th>
                <th>{{substr((($ejecucion['enero']['externo_ejecutado']+$ejecucion['enero']['interno_ejecutado'])/ ($ejecucion['enero']['externo_planificado']+$ejecucion['enero']['interno_planificado']))*100,0,4)  }}%</th>
               <th>{{substr((($ejecucion['febrero']['externo_ejecutado']+$ejecucion['febrero']['interno_ejecutado'])/ ($ejecucion['febrero']['externo_planificado']+$ejecucion['febrero']['interno_planificado']))*100,0,4)  }}%</th>
               <th>{{substr((($ejecucion['marzo']['externo_ejecutado']+$ejecucion['marzo']['interno_ejecutado'])/ ($ejecucion['marzo']['externo_planificado']+$ejecucion['marzo']['interno_planificado']))*100,0,4)  }}%</th>
               <th>{{substr((($ejecucion['abril']['externo_ejecutado']+$ejecucion['abril']['interno_ejecutado'])/ ($ejecucion['abril']['externo_planificado']+$ejecucion['abril']['interno_planificado']))*100,0,4)  }}%</th>
                <th>{{substr((($ejecucion['mayo']['externo_ejecutado']+$ejecucion['mayo']['interno_ejecutado'])/ ($ejecucion['mayo']['externo_planificado']+$ejecucion['mayo']['interno_planificado']))*100,0,4)  }}%</th>
                <th>{{substr((($ejecucion['junio']['externo_ejecutado']+$ejecucion['junio']['interno_ejecutado'])/ ($ejecucion['junio']['externo_planificado']+$ejecucion['junio']['interno_planificado']))*100,0,4)  }}%</th>
                <th>{{substr((($ejecucion['julio']['externo_ejecutado']+$ejecucion['julio']['interno_ejecutado'])/ ($ejecucion['julio']['externo_planificado']+$ejecucion['julio']['interno_planificado']))*100,0,4)  }}%</th>
                <th>{{substr((($ejecucion['agosto']['externo_ejecutado']+$ejecucion['agosto']['interno_ejecutado'])/ ($ejecucion['agosto']['externo_planificado']+$ejecucion['agosto']['interno_planificado']))*100,0,4)  }}%</th>
                <th>{{substr((($ejecucion['septiembre']['externo_ejecutado']+$ejecucion['septiembre']['interno_ejecutado'])/ ($ejecucion['septiembre']['externo_planificado']+$ejecucion['septiembre']['interno_planificado']))*100,0,4)  }}%</th>
                <th>{{substr((($ejecucion['octubre']['externo_ejecutado']+$ejecucion['octubre']['interno_ejecutado'])/ ($ejecucion['octubre']['externo_planificado']+$ejecucion['octubre']['interno_planificado']))*100,0,4)  }}%</th>
                <th>{{substr((($ejecucion['noviembre']['externo_ejecutado']+$ejecucion['noviembre']['interno_ejecutado'])/ ($ejecucion['noviembre']['externo_planificado']+$ejecucion['noviembre']['interno_planificado']))*100,0,4)  }}%</th>
                <th>@if($ejecucion['diciembre']['externo_planificado']+$ejecucion['diciembre']['interno_planificado']!=0){{substr((($ejecucion['diciembre']['externo_ejecutado']+$ejecucion['diciembre']['interno_ejecutado'])/ ($ejecucion['diciembre']['externo_planificado']+$ejecucion['diciembre']['interno_planificado']))*100,0,4)  }} @else 0 @endif%</th>
            </tr>
        </tbody>
      
    </tbody>
</table>

<div class="row">
<!-- Tarjeta de PAgos Realizados -->
    <div class="col w-25" >
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title ">Ultimas Mantenciones Subidas</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="badge badge-success">Importante</span>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <table id="subidotable" class="table table-striped table-hover">
                    <thead class="table-success">
                        <tr>
                            <th>Equipo</th>
                            <th>Familia</th>
                            <th>EQ</th>
                            <th>Ejecutado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subidas as $mp)
                            <tr>
                                <td>
                                    @if($mp->Equipo->eq=="Critico")
                @if($mp->Equipo->inventario!='?')
                    @if($mp->fechaprogramacion)
                        <a href="{{ asset('/storage/2.1/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->inventario.'/'.$mp->Equipo->inventario.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">@if($mp->Equipo->inventario!='?'){{ $mp->Equipo->inventario  }}@else {{ $mp->Equipo->serie }}@endif</a>
                    @endif
                    @else
                        @if($mp->fechaprogramacion)
                        <a href="{{ asset('/storage/2.1/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->serie.'/'.$mp->Equipo->serie.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">@if($mp->Equipo->inventario!='?'){{ $mp->Equipo->inventario  }}@else {{ $mp->Equipo->serie }}@endif</a>
                        @endif
                @endif
                @elseif($mp->Equipo->eq=="Relevante")
                    @if($mp->Equipo->inventario!='?')
                    @if($mp->fechaprogramacion)
                        <a href="{{ asset('/storage/2.2/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->inventario.'/'.$mp->Equipo->inventario.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">@if($mp->Equipo->inventario!='?'){{ $mp->Equipo->inventario  }}@else {{ $mp->Equipo->serie }}@endif</a>
                        @endif
                        @else
                        @if($mp->fechaprogramacion)
                        <a href="{{ asset('/storage/2.2/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->serie.'/'.$mp->Equipo->serie.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">@if($mp->Equipo->inventario!='?'){{ $mp->Equipo->inventario  }}@else {{ $mp->Equipo->serie }}@endif</a>
                        @endif
                    @endif
                @elseif($mp->Equipo->eq=="Sin")
                    @if($mp->Equipo->inventario!='?')
                    @if($mp->fechaprogramacion)
                        <a href="{{ asset('/storage/Sin/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->inventario.'/'.$mp->Equipo->inventario.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">@if($mp->Equipo->inventario!='?'){{ $mp->Equipo->inventario  }}@else {{ $mp->Equipo->serie }}@endif</a>
                        @endif
                        @else
                        @if($mp->fechaprogramacion)
                        <a href="{{ asset('/storage/Sin/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->serie.'/'.$mp->Equipo->serie.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">@if($mp->Equipo->inventario!='?'){{ $mp->Equipo->inventario  }}@else {{ $mp->Equipo->serie }}@endif</a>
                        @endif
                    @endif  
            @endif
                                </td>
                                <td>{{ $mp->Equipo->Familia->nombre }}</td>
                                <td>{{ $mp->Equipo->eq }}</td>
                                <td>{{ date('d-m-Y',strtotime($mp->fechaprogramacion)) }}</td>
                            </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <!-- /.card-body --> 
        </div>
<!-- /.card -->
    </div>

    <!-- Tarjeta de PAgos Por vencer -->
    <div class="col w-25">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title ">Mantenimientos Por Vencer</h3>
                <div class="card-tools">
                <span class="badge badge-success">Importante</span>
                </div>
            </div>
        <!-- /.card-header -->
            <div class="card-body h6">
                <table id="vencertable" class="table table-striped table-hover">
                    <thead class="table-warning">
                        <tr>
                            <th>Equipo</th>
                            <th>Familia</th>
                            <th>EQ</th>
                            <th>Planificado</th>
                            <th>tipo MP</th>
                     
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($porvencer as $mp)
                            <tr>
                                <td>@if($mp->Equipo->inventario!='?'){{ $mp->Equipo->inventario  }}@else {{ $mp->Equipo->serie }}@endif</td>
                                <td>{{ $mp->Equipo->Familia->nombre }}</td>
                                <td>{{ $mp->Equipo->eq }}</td>
                                <td>{{ $meses[date('n',strtotime($mp->fechacorte))-1] }}</td>
                                <td>{{ $mp->tipomp }}</td>
                               
                            </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        <!-- /.card-body -->
        </div>
    <!-- /.card -->
    </div>

    <!-- Tarjeta de PAgos Vencidos -->

    <div class="col w-25">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title ">Mantenimientos Planificados NO Ejecutados</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="badge badge-success">Muy Importante</span>
                </div>
            <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="vencidotable" class="table table-striped table-hover">
                    <thead class="table-danger">
                        <tr>
                            <th>Equipo</th>
                            <th>Familia</th>
                            <th>EQ</th>
                            <th>Planificado</th>
                            <th>Tipo MP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vencido as $mp)
                            <tr>
                                <td><button class="btn btn-sm btn-primary openBtn" data-path="{{ route('mp.programacion.add',$mp->id) }}">@if($mp->Equipo->inventario!='?'){{ $mp->Equipo->inventario  }}@else {{ $mp->Equipo->serie }}@endif</button></td>
                                <td>{{ $mp->Equipo->Familia->nombre }}</td>
                                <td>{{ $mp->Equipo->eq }}</td>
                                <td>{{ $meses[date('n',strtotime($mp->fechacorte))-1]  }}</td>
                                <td>{{ $mp->tipomp }}</td>
                            </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        <!-- /.card-body -->
        </div>
<!-- /.card -->
    </div>


</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      
  </div>
</div>
@stop

@section('css')
 <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.css') }}">
<!--BOOSTRAP ICONS-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

<!--DATATABLE-->


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css ">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/1.4.0/css/searchPanes.dataTables.min.css ">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css ">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css ">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css ">
<!-- Bootstrap 4 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@stop

@section('js')

<!--Canvas JS -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!-- JQuery-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.js') }}"></script>

<!--DATATABLE-->

<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<!--Chartjs  -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
 
<script type="text/javascript">
   $(document).ready(function() {
    
    $('#vencertable').DataTable( {
        "scrollY":        "350px",
        "scrollCollapse": true,
        "paging":         false,
        "ordering": false,
        "searching": false,
        "info":false,
    } );
    $('#vencidotable').DataTable( {
        "scrollY":        "350px",
        "scrollCollapse": true,
        "paging":         false,
        "ordering": false,
        "searching": false,
        "info":false,
    } );
     $('#subidotable').DataTable( {
        "scrollY":        "350px",
        "scrollCollapse": true,
        "paging":         false,
        "ordering": false,
        "searching": false,
        "info":false,
    } );
} );
   $('.openBtn').on('click',function(){
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>
@stop

