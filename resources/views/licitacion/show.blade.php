@extends('adminlte::page')

@section('title', 'Licitaciones')

@section('content_top_nav_left')
<h2>{{ $licitacion->nombre }}</h2>

@stop
@section('content')
 
 <div class="timeline">
  <!-- Timeline time label -->
  <div class="time-label">
    <span class="bg-green">{{ date('d-m-Y',strtotime($licitacion->fecha_solicitud_compra)) }}</span>
  </div>
  <div>
  <!-- Before each timeline item corresponds to one icon on the left scale -->
    <i class="fas fa-envelope bg-blue"></i>
    <!-- Timeline item -->
    <div class="timeline-item">
   
      <!-- Header. Optional -->
      <h3 class="timeline-header">
        
        <button type="button" data-path="{{ route('servicioclinico.show',$licitacion->Servicio->id)  }}" class="btn btn-primary openBtn" > {{ $licitacion->Servicio->nombre}}</button>
    </h3>
      <!-- Body -->
      <div class="timeline-body">
        <a href="{{asset( $licitacion->file_solicitud_compra) }}" target="_blank">Solicitud N° {{ $licitacion->solicitud_compra }} - {{ $licitacion->Servicio->nombre }}</a>
      </div>
      <!-- Placement of additional controls. Optional -->
      <div class="timeline-footer">
      </div>
    </div>
  </div>


    @foreach ($licitacion->Estados as $estado)
    
  <!-- Timeline time label -->
  <div class="time-label">
    <span class="bg-green">{{ date('d-m-Y',strtotime($estado->pivot->created_at)) }} </span>
  </div>
  <div>
  <!-- Before each timeline item corresponds to one icon on the left scale -->
    @if ($estado->nombre=="Asignada")
       <i class="fas fa-chess-king"></i>
        @else
        <i class="fas fa-envelope bg-blue"></i>
    @endif
    <!-- Timeline item -->
    <div class="timeline-item">
   
      <!-- Header. Optional -->
      <h3 class="timeline-header" >
        <span class="bg-green"> {{ $estado->nombre }}</span>
    </h3>
      <!-- Body -->
      <div class="timeline-body">
        {{ $estado->pivot->comentario}}
      </div>
      <!-- Placement of additional controls. Optional -->
      <div class="timeline-footer">
      </div>
    </div>
  </div>

    @endforeach
</div>




<!-- Modal --> 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      
  </div>
</div>
</div>
@stop


@section('css')
<!--BOOSTRAP ICONS-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


@stop

@section('css')
<!--BOOSTRAP ICONS-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

@stop

@section('js')
<!--JQUERY-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script type="text/javascript">
 $('.openBtn').on('click',function(){
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});
</script>
@stop