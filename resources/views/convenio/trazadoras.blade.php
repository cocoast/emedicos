 @extends('adminlte::page')

@section('title', 'trazadoras')

@section('content_header')
@section('content_top_nav_left')
<div class="row">
<div class="row">
  <div class="col">
    <h3>Gastos en Convenios durante el año {{ $year }}</h3>
  </div>
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

@endsection
@section('content')
<table id="gastostable" class="table table-striped">
  <thead>
    <th>#</th>
    <th>Mes</th>
    <th>Mantenimiento Preventivo</th>
    <th>Arriendos</th>
    <th>Arriendos Con donación</th>
    <th>Correctivo</th>
    <th>Total</th>
  </thead>
<tbody>
  @for ($i = 1; $i <13 ; $i++)
   <tr>
    <td>{{ $i }}</td>
    <th>{{ $meses[$i-1] }}</th>
    <td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($preventivo[$i]) }}</td>
    <td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($arriendo[$i]) }}</td>
    <td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($donacion[$i]) }}</td>
    <td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($correctivo[$i]) }}</td>
    <td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($preventivo[$i]+$arriendo[$i]+$donacion[$i]+$correctivo[$i])}}</td>
    @php
      $mp+=$preventivo[$i];
      $arr+=$arriendo[$i];
      $don+=$donacion[$i];
      $mc+=$correctivo[$i];
      $total+=$preventivo[$i]+$arriendo[$i]+$donacion[$i]+$correctivo[$i];
    @endphp
  </tr>

   @endfor
   <tr class="table-danger">
    <td>13</td>
     <th>Total Anual</th>
     <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($mp) }}</td>
     <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($arr) }}</td>
     <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($don) }}</td>
     <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($mc) }}</td>
     <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($total) }}</td>
   </tr>
</tbody>
</table>
<h4>Detalle de Gasto por Convenio</h4>
<br>

<table class="table table-striped table-hover" id="gasto">
  <thead>
    <th>Convenio</th>
    <th>ID Mercado Publico</th>
    <th>Tipo de Convenio</th>
    <th>Proveedor</th>
    <th>Enero</th>
    <th>Febrero</th>
    <th>Marzo</th>
    <th>Abril</th>
    <Th>Mayo</Th>
    <th>Junio</th>
    <th>Julio</th>
    <th>Agosto</th>
    <th>Septiembre</th>
    <th>Octubre</th>
    <th>Noviembre</th>
    <th>Diciembre</th>
  </thead>
  <tbody>
      @foreach ($convenios as $convenio)
      <tr>
        <td><a href="{{ route('convenio.show',$convenio->id) }}">{{ $convenio->nombre }}</a></td>
        <td>{{ $convenio->licitacion }}</td>
        <td>{{ $convenio->tipoconvenio }}</td>
        <td>{{ $convenio->Proveedor->nombre }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][1]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][2]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][3]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][4]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][5]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][6]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][7]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][8]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][9]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][10]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][11]) }}</td>
        <td>{{  NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagos[$convenio->id][12]) }}</td>

        
        

      </tr>
    @endforeach
  </tbody>

</table>

<a href="{{ route('convenio.index') }}" class="btn btn-primary"> Atras</a>
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
    let table = $('#gastostable').DataTable({
         dom: 'Bfrtip',
        buttons: ['excel'],  
        responsive: true,
        pageLength: 25,
    });
     let tabla = $('#gasto').DataTable({
         dom: 'Bfrtip',
        buttons: ['excel'],  
        responsive: true,
        pageLength: 10,
    });
});
   
$('.openBtn').on('click',function(){
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>
@stop