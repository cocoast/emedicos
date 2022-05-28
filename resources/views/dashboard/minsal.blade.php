@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_top_nav_left')<div class="text-center"> <h3>Resumen Año {{ date('Y') }}</h3></div>@endsection
@section('content')
<h3>Minsal Seguimiento de Gastos</h3>
<div class="row align-items-start">
  @foreach(App\Models\Sigfe::all() as $sigfe)
  <div class="col">
    <!-- Apply any bg-* class to to the info-box to color it -->
    <div class="info-box bg-info">
      <span class="info-box-icon"><i class="bi bi-gear-wide"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">{{ $sigfe->nombre}} {{ $sigfe->codigo}}</span>
        <span class="info-box-number">Pagado {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($mp['pago_'.$sigfe->id]??0)}}</span>
        <!-- The progress section is optional -->
        <div class="progress">
          <div class="progress-bar" style="width: @if($mp[$sigfe->id]==0)0 @else{{ ($mp['pago_'.$sigfe->id] ?? 0)/($mp[$sigfe->id])*100 }}@endif%"></div>
        </div>
        <span class="progress-description">
        @if($mp[$sigfe->id]==0)0 @else {{ substr(($mp['pago_'.$sigfe->id] ?? 0)/($mp[$sigfe->id])*100,0,4) }} @endif % de un total de {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($mp[$sigfe->id])}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  @endforeach
@endsection


@section('css')
 <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.css') }}">
<!--BOOSTRAP ICONS-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

<!-- Bootstrap 4 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

@stop

@section('js')
<!-- JQuery-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.js') }}"></script>


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