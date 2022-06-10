@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@can('equipos.medicos')
@section('content_top_nav_left')


<div class="text-center"> 
    <h3>Resumen Año {{ date('Y') }}</h3>
</div>
@endsection
 @section('content_top_nav_right')
 @endsection
<div class="row align-items-start">
    <input id="dash" name="dash" type="search" class="form-control"  placeholder="Ingrese caracteres para buscar">
</div>

<div class="row align-items-start">
   <div class="col w-25">
        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="bi bi-wallet2"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Convenios de Mantenimiento Activos ({{$preventivo["cantidad"]}})</span>
            <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($preventivo["pagado"])}}</span>
            <div class="progress">
                <div class="progress-bar" style="width: @if($preventivo["pagado"]==0) 0; @else{{  ($preventivo["pagado"]/$preventivo["total"])*100}}@endif%"></div>
            </div>
            <span class="progress-description">
              @if($preventivo["total"]==0) 0 @else {{ substr((  $preventivo["pagado"]/$preventivo["total"])*100,0,4) }} @endif% de: {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($preventivo["total"])}}
             Equipos: {{ $preventivo["equipos"] }}
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
    
<div class="row align-items-start ">
    <div class="col w-25">
        <canvas id="myChart"></canvas>
    </div>
    <div class="col w-25">
        <canvas id="myGar"></canvas>
    </div>
    <div class="col w-25">
        <canvas id="myMan"></canvas>
    </div>
</div>
{{-- <div class="row">
    
    <div class="col w-25">
        <div id="mpeemm" style="height: 370px; width: 100%;"></div>
    </div> 
</div>--}}
<div class="row">
<!-- Tarjeta de PAgos Realizados -->
    <div class="col w-25" >
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title ">Ultimos Pagos</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="badge badge-success">Importante</span>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped table-hover h6">
                    <thead class="table-success">
                        <tr>
                            <th>Convenio</th>
                            <th>Cuota</th>
                            <th>Fecha de Corte</th>
                            <th>Total</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($realizados as $realizado)
                        <tr>
                            <td><a href="/convenio/{{$realizado->Convenio->id}}"> {{$realizado->Convenio->nombre}}</a> </td>
                            <td>{{$realizado->periodo}}</td>
                            <td data-order="{{date("Ymd", strtotime($realizado->fecha))}}">{{date("d-m-Y", strtotime($realizado->fecha))}}</td>
                            <td>{{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($realizado->valor)}}</td>
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
                <h3 class="card-title ">Pagos Por Vencer</h3>
                <div class="card-tools">
                <span class="badge badge-success">Importante</span>
                </div>
            </div>
        <!-- /.card-header -->
            <div class="card-body h6">
                <table id="vencer" class="table table-striped table-hover h6 ">
                    <thead class="table-warning">
                        <tr>
                            <th>Convenio</th>
                            <th>Cuota</th>
                            <th>Fecha de Corte</th>
                            <th>Vencimiento</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($porvencer as $realizado)
                    <tr>
                        <td><a href="/convenio/{{$realizado->Convenio->id}}"> {{$realizado->Convenio->nombre}}</a> </td>
                        <td>{{$realizado->periodo}}</td>
                        <td data-order="{{date("Ymd", strtotime($realizado->fecha))}}">{{date("d-m-Y", strtotime($realizado->fecha))}}</td>
                        <td>{{$hoy->diff(new DateTime($realizado->fecha))->format('%R%a días')}}</td>
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
                <h3 class="card-title ">Pagos Vencidos</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="badge badge-success">Muy Importante</span>
                </div>
            <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="vencido" class="table table-striped table-hover">
                    <thead class="table-danger">
                        <tr>
                            <th>Convenio</th>
                            <th>Cuota</th>
                            <th>Fecha de Corte</th>
                            <th>Atraso</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vencido as $realizado)
                        <tr>
                            <td><a href="/convenio/{{$realizado->Convenio->id}}"> {{$realizado->Convenio->nombre}}</a>   </td>
                            <td>{{$realizado->periodo}}</td>
                            <td data-order="{{date("Ymd", strtotime($realizado->fecha))}}">{{date("d-m-Y", strtotime($realizado->fecha))}}</td>
                            <td>{{$hoy->diff(new DateTime($realizado->fecha))->format('%R%a días')}}</td>
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
@endcan
<!-- -->
@can('licitaciones')
     
@endcan


   
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
    
    $('#vencer').DataTable( {
        "scrollY":        "350px",
        "scrollCollapse": true,
        "paging":         false,
        "ordering": false,
        "searching": false,
        "info":false,
    } );
    $('#vencido').DataTable( {
        "scrollY":        "350px",
        "scrollCollapse": true,
        "paging":         false,
        "ordering": false,
        "searching": false,
        "info":false,
    } );



} );
   
</script>
<script type="text/javascript">
    //Graficos
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Critico', 'Relevante', 'Sin EQ'],
        datasets: [{
            label: 'Equipos Medicos',
            data: @json($data),
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 3,
            options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Equipos Medicos',
      }
    }
  }
        }]
        
    },
    options:{
            responsive:true,
            title:{
                display:true,
                text:'Equipos Medicos'
            },
        },
    

});


var ctx = document.getElementById('myGar');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Con Garantias ', 'Sin Garantias'],
        datasets: [{
            label: 'Garantias y Convenios',
            data: @json($garantias),
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                
            ],
            hoverOffset: 3
        }]
    },
    options:{
            responsive:true,
            title:{
                display:true,
                text:'Garantias y Convenios'
            },
        },
    

});

var ctx = document.getElementById('myMan');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Enero', 'Febrero','Marzo','Abril', 'Mayo', 'Junio','Julio', 'Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        datasets: [{
            label: 'Plan de Mantenimiento ',
            data: @json($mp),
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(156,87,107)',
                'rgb(51,212,55)',
                'rgb(255,71,236)',
                'rgb(252, 255, 51)',   
                'rgb(54, 255, 51)',
                'rgb(255,193,51)',
                'rgb(51, 255, 193)',
                 'rgb(255,87,51)',
                'rgb(12,57,127)',
                'rgb(255, 99, 132)',


                
            ],
            hoverOffset: 3
        }]
    },

    

});



</script>

{{-- <script>
window.onload = function () {
var mantenciones=@json($mantenciones);
var datos=JSON.parse(mantenciones);
console.log(datos);
console.log(datos[1.1]);
var chart = new CanvasJS.Chart("mpeemm", {
    exportEnabled: true,
    animationEnabled: true,
    title:{
        text: "Plan de Mantenimiento"
    },
    subtitles: [{
        text: "Año 2022"
    }], 
    axisX: {
        title: "Meses"
    },
    axisY: {
        title: "Planificado - Ejecutado",
       
        includeZero: true
    },
    
    toolTip: {
        shared: true,
        content: toolTipFormatter
    },
    legend: {
        cursor: "pointer",
        itemclick: toggleDataSeries
    },
    data: [{
        type: "bar",
        name: "Planificado",
        showInLegend: true,      
        yValueFormatString: "#,##0.# mantenciones",
        dataPoints: [
            { label: "Enero"    ,   y: datos[1.1] },
            { label: "Febrero"  ,   y: datos[2.1] },
            { label: "Marzo"    ,   y: datos[3.1] },
            { label: "Abril"    ,   y: datos[4.1] },
            { label: "Mayo"     ,   y: datos[5.1] },
            { label: "Junio"    ,   y: datos[6.1] },
            { label: "Julio"    ,   y: datos[7.1] },
            { label: "Agosto"   ,   y: datos[8.1] },
            { label: "Septiembre",  y: datos[9.1] },
            { label: "Octubre"  ,   y: datos[10.1] },
            { label: "Noviembre",   y: datos[11.1] },
            { label: "Diciembre",   y: datos[12.1] },
        ]
    },     
        
    {
        type: "bar",
        name: "Ejecutado",
        axisYType: "secondary",
        showInLegend: true,
        yValueFormatString: "#,##0.# mantenciones",
        dataPoints: [
            { label: "Enero"    ,   y: datos[1.2] },
            { label: "Febrero"  ,   y: datos[2.2] },
            { label: "Marzo"    ,   y: datos[3.2] },
            { label: "Abril"    ,   y: datos[4.2] },
            { label: "Mayo"     ,   y: datos[5.2] },
            { label: "Junio"    ,   y: datos[6.2] },
            { label: "Julio"    ,   y: datos[7.2] },
            { label: "Agosto"   ,   y: datos[8.2] },
            { label: "Septiembre",  y: datos[9.2] },
            { label: "Octubre"  ,   y: datos[10.2] },
            { label: "Noviembre",   y: datos[11.2] },
            { label: "Diciembre",   y: datos[12.2] },
        ]
    }]
});
chart.render();

function toolTipFormatter(e) {
    var str = "";
    var total = 0 ;
    var str3;
    var str2 ;
    for (var i = 0; i < e.entries.length; i++){
        var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
        total = e.entries[i].dataPoint.y + total;
        str = str.concat(str1);
    }
    str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
    str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
    return (str2.concat(str)).concat(str3);
}

function toggleDataSeries(e) {
    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    }
    else {
        e.dataSeries.visible = true;
    }
    chart.render();
}

}
</script> --}}
<script>
    $('#dash').autocomplete({
            source: function (request, response){
                $.ajax({
                    url: "{{ route('search.dashboard') }}",    
                    dataType: 'json',
                    data:{
                        term: request.term
                    },
                    success: function(data){
                        response( data )
                    }
                });
            }
        });
</script>

  @stop