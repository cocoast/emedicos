@extends('adminlte::page')

@section('title', 'Licitaciones')

@section('content_header')
<div class="text-center">
    <div class="col ">
        <h2>Convenio de Insumos para Paracetamol</h2>
    </div>
</div>

  
@stop
@section('content')
 
<!-- Main node for this component -->
<div class="timeline">
    <!-- Timeline time label -->
    <div class="time-label">
        <span class="bg-green">10 de enero 2022</span>
    </div>
    <div>
        <!-- Before each timeline item corresponds to one icon on the left scale -->
        <i class="fas fa-envelope bg-blue"></i>
        <!-- Timeline item -->
        <div class="timeline-item">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i> 10-01-2022 12:05</span>
            <!-- Header. Optional -->
            <h3 class="timeline-header"><a href="#">Recepcionada</a> Solicitud 178 Pabellón</h3>
        </div>
    </div>
    <div>
        <!-- Before each timeline item corresponds to one icon on the left scale -->
        <i class="fas fa-pen bg-info"></i>
        <!-- Timeline item -->
        <div class="timeline-item">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i>11-01-2022 13:45</span>
            <!-- Header. Optional -->
            <h3 class="timeline-header"><a href="#">Bases Administrativas</a></h3>
        </div>
    </div>
    <div>
        <!-- Before each timeline item corresponds to one icon on the left scale -->
        <i class="fas fa-wrench bg-yellow"></i>
        <!-- Timeline item -->
        <div class="timeline-item">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i>12-01-2022 13:45</span>
            <!-- Header. Optional -->
            <h3 class="timeline-header"><a href="#">Bases Tecnicas</a></h3>
        </div>
    </div>
    <div>
        <!-- Before each timeline item corresponds to one icon on the left scale -->
        <i class="fas fa-eye bg-green"></i>
        <!-- Timeline item -->
        <div class="timeline-item">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i>12-02-2022 13:45</span>
            <!-- Header. Optional -->
            <h3 class="timeline-header"><a href="#">Revision de Bases</a></h3>
        </div>
    </div>
    <div>
        <!-- Before each timeline item corresponds to one icon on the left scale -->
        <i class="fas fa-check bg-green"></i>
        <!-- Timeline item -->
        <div class="timeline-item">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i>15-03-2022 13:45</span>
            <!-- Header. Optional -->
            <h3 class="timeline-header"><a href="#">Resolucion de Bases</a></h3>
             <!-- Body -->
            <div class="timeline-body">
                Resolucion N° 345 del  15-03-2022
          </div>
        </div>
    </div>

  <!-- The last icon means the story is complete -->
  <div>
    <i class="fas fa-clock bg-gray"></i>
  </div>
</div>
<a href="" class="btn btn-info"> <i class="bi bi-chat-dots-fill"></i> Siguiente Etapa</a>
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
    "order": [[ 4, "asc" ]],
     buttons: [
        'excel'
    ],
    responsive: true,
    searchPanes:{
        layout: 'columns',
        initCollapsed: true,
        cascadePanes: true,
    },
    dom: 'PBfprtip', 
    pageLength: 20,
    
});
   

</script>
@stop