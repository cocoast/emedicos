@extends('adminlte::page')

@section('title', 'Licitaciones')

@section('content_header')
<div class="text-center">
    <div class="col ">
        <h2>Listado Licitaciones de {{ Auth::user()->name }}</h2>
    </div>
</div>

<div class="d-flex">
    <div class="col info-box">
        <span class="info-box-icon bg-info"><i class="bi bi-collection"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Licitaciones Recepcionadas</span>
            <span class="info-box-number">105</span>
            <div class="progress">
                <div class="progress-bar bg-info" style="width: 100%"></div>
            </div>
            <span class="progress-description">30% durante el ultimo mes</span>
        </div>
    </div>
    <div class="col info-box bg-success">
        <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Adjudicadas</span>
            <span class="info-box-number">41</span>
            <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description">Durante el Año 2022</span>
        </div>
    </div>
    <div class="col info-box bg-gradient-warning">
        <span class="info-box-icon"><i class="bi bi-wrench"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Bases Tecnicas</span>
            <span class="info-box-number">25</span>
            <div class="progress">
                <div class="progress-bar" style="width: 23%"></div>
            </div>
            <span class="progress-description">15% lleva mas de 7 días</span>
        </div>
    </div>
    <div class="col info-box bg-info">
        <span class="info-box-icon bg-info"><i class="bi bi-alarm-fill"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Licitaciones Publicadas</span>
            <span class="info-box-number">10</span>
            <div class="progress">
                <div class="progress-bar " style="width: 10%"></div>
            </div>
            <span class="progress-description">50% durante el ultimo mes</span>
        </div>
    </div>

</div>
<div class="d-flex">
    <div class="col">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <p> <strong> Monto Anual Licitado:</strong> {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format((158001544))}}</p>
            </div>
        </div>        
    </div>
     <div class="col">
        <div class="card text-white bg-secondary mb-3">
            <div class="card-body">
                <p> <strong> Algo que  Necesiten ver globalmente:</strong> {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format((158001544))}}</p>
            </div>
        </div>
    </div>
        <div class="col">
        <div class="card text-white bg-dark mb-3">
            <div class="card-body">
                <p> <strong> Algo que  Necesiten ver globalmente:</strong> {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format((158001544))}}</p>
            </div>
        </div>        
    </div>
</div>
  
@stop
@section('content')
 

<div class="container-fluid ">
  
 <table id="conveniostables" class="table table-striped table-hover mt-4" style="width:100%">
	<thead>
	<tr>
        <th>ID</th>
      <th scope="col">Estado</th>
      <th scope="col">Nombre</th>
      <th scope="col">ID Licitación</th>
      <th scope="col">N° Resolucion Bases</th>
      <th scope="col">Fecha Resolucion</th>
      <th scope="col"> Servicio Demandante</th>
      <th scope="col">N° Solicitud</th>
      <th scope="col">Categoria</th>
      <th scope="col">Tipo</th>
      <th scope="col">Res Adjudicación</th>
      <th scope="col">Fecha Adjudicación</th>
      <th scope="col">Edit</th>
      <th scope="col">Del</th>
	</tr>
	</thead>
	<tbody>
		<tr>
            <td>2</td>
          <td>Recepcionado</td>
          <td>Convenio de Insumos  Pabellón</td>
          <td>1053539-189-LP22</td>
          <td>- </td>
          <td>-</td>
          <td>Pabellón</td>
          <td>78</td>
          <td> Insumos</td>
          <td>LP</td>
          <td>-</td>
          <td>-</td>
          <td><a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>      
        </tr>
        <tr>
            <td>1</td>
          <td>Recepcionado</td>
          <td>Convenio de Algo para algo</td>
          <td>1053539-9-LP22</td>
          <td>- </td>
          <td>-</td>
          <td>Laboratorio</td>
          <td>78</td>
          <td> Medicamentos</td>
          <td>LP</td>
          <td>-</td>
          <td>-</td>
          <td><a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>      
        </tr>
        <tr>
          <td>3</td>
          <td>Recepcionado</td>
          <td><a href="licitaciones/demo">Convenio de Insumos para Paracetamol</a></td>
          <td>1053539-1189-LP22</td>
          <td>- </td>
          <td>-</td>
          <td>Pabellón</td>
          <td>178</td>
          <td> Insumos</td>
          <td>LP</td>
          <td>-</td>
          <td>-</td>
          <td><a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>      
        </tr>
        <tr class="table-danger">
            <td>4</td>
          <td>Resolucion Adjudicación</td>
          <td>Convenio de XXXX</td>
          <td>1053539-250-LP22</td>
          <td>984 </td>
          <td>25-02-2022</td>
          <td>Equipos Médicos</td>
          <td>85</td>
          <td> Equipos</td>
          <td>LR</td>
          <td>-</td>
          <td>-</td>
          <td><a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>      
        </tr>
        <tr>
            <td>5</td>
          <td>Recepcionado</td>
          <td>Insumos para Pabellón</td>
          <td>1053539-189-LP22</td>
          <td>- </td>
          <td>-</td>
          <td>Pabellón</td>
          <td>78</td>
          <td> Insumos</td>
          <td>LP</td>
          <td>-</td>
          <td>-</td>
          <td><a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>      
        </tr>
        <tr class="table-info">
        <td>6</td> 
          <td>Publicado</td>
          <td>Convenio de Insumos para </td>
          <td>1053539-149-LP22</td>
          <td>- </td>
          <td>-</td>
          <td>Pabellón</td>
          <td>75</td>
          <td> Insumos</td>
          <td>LP</td>
          <td>548</td>
          <td>23-06-2022</td>
          <td><a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>      
        </tr>
        <tr class="table-success">
            <td>7</td>
          <td>Adjudicado</td>
          <td>Paracetamol para todes</td>
          <td>1053539-230-LP22</td>
          <td>167 </td>
          <td>25-02-2022</td>
          <td>CAE Oftalmología</td>
          <td>85</td>
          <td> Equipos</td>
          <td>LR</td>
          <td>1548</td>
          <td>13-05-2022</td>
          <td><a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>      
        </tr>
        <tr class="table-warning">
            <td>8</td>
          <td>Bases Tecnicas</td>
          <td>Ibuprofeno para los de arriba</td>
          <td>1053539-210-LP22</td>
          <td>158 </td>
          <td>25-02-2022</td>
          <td>Farmacia</td>
          <td>25</td>
          <td> Equipos</td>
          <td>LR</td>
          <td>1548</td>
          <td>13-05-2022</td>
          <td><a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>      
        </tr>
        <tr>
            <td>9</td>
          <td>Bases Administrativas</td>
          <td>Convenio  Insumos para Alguien</td>
          <td>-</td>
          <td>- </td>
          <td>-</td>
          <td>Algo</td>
          <td>20</td>
          <td> Arriendo</td>
          <td>LQ</td>
          <td>-</td>
          <td>-</td>
          <td><a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>      
        </tr>
        <tr>
            <td>10</td>
          <td>Bases Administrativas</td>
          <td>Convenio de  para Alguien</td>
          <td>-</td>
          <td>- </td>
          <td>-</td>
          <td>Algo</td>
          <td>30</td>
          <td>Compra Servicios</td>
          <td>LQ</td>
          <td>-</td>
          <td>-</td>
          <td><a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>      
        </tr>
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