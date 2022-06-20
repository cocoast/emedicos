@extends('ppa')
@section('body')
  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mostrar Mantencion </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
		<div class="col">
			<label for="" class="form-label">Equipo</label>
			<input id="solicitud" value="{{$mp->Equipo->inventario}}" name="solicitud" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Planificación</label>
			<input id="resolucion" value="{{date('d-m-Y',strtotime($mp->fechacorte))}}" name="resolucion" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">fecha Programación</label>
			<input id="fecharesolucion" value="{{$mp->fechaprogramacion}}" name="fecharesolucion" type="text" tabindex="3" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Tipo Mantenimiento</label>
			<input id="fecharesolucion" value="{{$mp->tipomp}}" name="fecharesolucion" type="text" tabindex="3" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Link de la Mantencion</label>
			@if($mp->Equipo->eq=="Critico")
				@if($mp->Equipo->inventario!='?')
					@if($mp->fechaprogramacion)
						<a href="{{ asset('/storage/2.1/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->inventario.'/'.$mp->Equipo->inventario.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">Archivo</a>
					@endif
					@else
						@if($mp->fechaprogramacion)
						<a href="{{ asset('/storage/2.1/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->serie.'/'.$mp->Equipo->serie.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">Archivo</a>
						@endif
				@endif
				@elseif($mp->Equipo->eq=="Relevante")
					@if($mp->Equipo->inventario!='?')
					@if($mp->fechaprogramacion)
						<a href="{{ asset('/storage/2.2/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->inventario.'/'.$mp->Equipo->inventario.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">Archivo</a>
						@endif
						@else
						@if($mp->fechaprogramacion)
						<a href="{{ asset('/storage/2.2/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->serie.'/'.$mp->Equipo->serie.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">Archivo</a>
						@endif
					@endif
				@elseif($mp->Equipo->eq=="Sin")
					@if($mp->Equipo->inventario!='?')
					@if($mp->fechaprogramacion)
						<a href="{{ asset('/storage/Sin/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->inventario.'/'.$mp->Equipo->inventario.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">Archivo</a>
						@endif
						@else
						@if($mp->fechaprogramacion)
						<a href="{{ asset('/storage/Sin/'.$mp->Equipo->Familia->nombre.'/'.$mp->Equipo->SubFamilia->nombre.'/'.$mp->Equipo->serie.'/'.$mp->Equipo->serie.'_'.date('Y',strtotime($mp->fechaprogramacion)).'_MP_'.date('m',strtotime($mp->fechaprogramacion)).'_'.date('d',strtotime($mp->fechaprogramacion)).'.pdf') }}" target="_blank">Archivo</a>
						@endif
					@endif	
			@endif
		</div>
	</div>
 <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
@stop

