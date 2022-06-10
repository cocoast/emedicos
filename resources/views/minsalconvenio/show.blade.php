@extends('ppa')

@section('title', 'Ingresar Convenio Seguimiento Minsal')

@section('content_header')
    <h1>Ingresar Convenio</h1>
@stop

@section('body')
<form action="{{route('minsalconvenio.store')}}" method="POST" enctype="multipart">
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar Nuevo Convenio perteneciente a {{ Auth()->user()->Dependence->dependencetable_type::find(Auth()->user()->Dependence->dependencetable_id)->nombre }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

	@csrf
	<input id="centro" name="centro" type="text" hidden value="{{ $centro->id }}" class="form-control" required>
	<div class="row align-items-start">
 		<div class="col">
			<label for="" class="form-label">Nombre del Convenio</label>
	     	<input id="nombre" name="nombre" type="text"   class="form-control" required>
		</div>
	</div>
 	<div class="row align-items-start">
 		<div class="col">
			<label for="" class="form-label">Resolucion Aprueba convenio</label>
	     	<input id="resolucion" name="resolucion" type="text"   class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha Resolucion Aprobatoria </label>
			<input id="fecha_resolucion" name="fecha_resolucion" type="date"  class="form-control">
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Año el cual Notifica</label>
			 <input type="number" min="2020" max="2099" step="1" value="2022" name="year" id="year" class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label">fecha Termino del Convenio</label>
	     	<input id="fecha_termino" name="fecha_termino" type="date"   class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label">Monto Anual del Convenio</label>
	     	<input id="monto_anual" name="monto_anual" type="number"  class="form-control" required>
		</div>
	</div>
		<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Glosa Presupuestaria</label>
			<select class="form-control" name="glosa" id="glosa" required>
				<option selected value="">Seleccione</option>
				<option value="Si">Si</option>
				<option value="No">No</option>
			</select>
		</div>
		<div class="col">
			<label for="" class="form-label">Subasignacion del Convenio</label>
			<select class="form-control" name="sigfe" id="sigfe" required >
				<option selected value="">Seleccione</option>
				@foreach($sigfes as $sigfe)
				<option value="{{ $sigfe->id }}">{{ $sigfe->codigo . ' - '.$sigfe->nombre }}</option>
				@endforeach
			</select>
		</div>
</div>


 </div>
<div class="modal-footer">
	<div class="col">
		<button  class="btn btn-primary" >GUARDAR</button>
	</div>
	<div class="col">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	</div>
</div>
</form>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.css') }}">
@stop

@section('js')
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
	
</script>
    	
@stop