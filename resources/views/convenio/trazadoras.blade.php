 @extends('adminlte::page')

@section('title', 'Convenios')

@section('content_header')
@section('content_top_nav_left')
<div class="text-center"><h3>Listado de Convenios</h3></div>
@endsection

<div class="col">
               <!-- Apply any bg-* class to to the info-box to color it -->
<div class="info-box bg-red">
  <span class="info-box-icon"><i class="bi bi-gear-wide"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Pago Enero</span>
    <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($datos['enero'])}}</span>
    <!-- The progress section is optional -->
    
  </div>
  <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>

<div class="col">
               <!-- Apply any bg-* class to to the info-box to color it -->
<div class="info-box bg-red">
  <span class="info-box-icon"><i class="bi bi-gear-wide"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Pago Febrero</span>
    <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($datos['febrero'])}}</span>
    <!-- The progress section is optional -->
    
  </div>
  <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>

<div class="col">
               <!-- Apply any bg-* class to to the info-box to color it -->
<div class="info-box bg-red">
  <span class="info-box-icon"><i class="bi bi-gear-wide"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Pago Marzo</span>
    <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($datos['marzo'])}}</span>
    <!-- The progress section is optional -->
    
  </div>
  <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<div class="col">
               <!-- Apply any bg-* class to to the info-box to color it -->
<div class="info-box bg-red">
  <span class="info-box-icon"><i class="bi bi-gear-wide"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Total Primer Trimestre</span>
    <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($datos['primer'])}}</span>
    <!-- The progress section is optional -->
    
  </div>
  <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
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