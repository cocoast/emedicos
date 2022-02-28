@extends('ppa')

@section('title', 'Agregar Archivos del Equipo')

@section('content_header')
    <h1>Agregar Archivo</h1>
@stop

@section('body')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
	  	 <form action="/equipo/{{$equipo->id}}/archivo" method="POST" enctype="multipart/form-data">
	  	 	@csrf

		  	<div class="mb-3">
		  		<div class="row">
		  			<div class="col">
		  				<label class="form-label"> Fecha del documento</label>
		  				<input type="date" name="fecha" class="form-control">
		  			</div>
		  		</div>
				<div class="row align-items-startmb-3">
					<div class="col">
					<label for="" class="form-label" >Seleccione tipo de arhivo</label>
			     	<select class="form-control" name="archivo" id="archivo" tabindex="11">
				         <option value="null">Seleccion que archivo subira</option>
				         <option value="MP">Mantencion Preventiva</option>
				         <option value="MC">Mantencion Correctiva</option>
				         <option value="Acta">Acta de Recepción</option>
			     	</select>
				</div>
				<div class="col">
					<label>Adjunte Archivos</label>
					<input  name="documento" type="file" class="form-control">
				</div>
				<button class="btn btn-primary">Enviar</button>
			</div>
		</div>
    </form>    
 	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
@stop

@section('css')


@stop

@section('js')


<script type="text/javascript">


</script>@stop