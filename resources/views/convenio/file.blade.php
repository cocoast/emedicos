@extends('ppa')

@section('title', 'Mostrar Equipo')

@section('content_header')
    <h1>Agregar Archivo</h1>
@stop

@section('body')
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
	  	 <form action="/convenio/{{$convenio->id}}/archivo" method="POST" enctype="multipart/form-data">
	  	 	@csrf

		  	<div class="mb-3">
				<div class="row align-items-startmb-3">
					<div class="col">
					<label for="" class="form-label" >Seleccione tipo de arhivo</label>
			     	<select class="form-control" name="archivo" id="archivo" tabindex="11">
				         <option value="null">Seleccion que archivo subira</option>
				         <option value="Resolucion+Contrato">Resolucion+Contrato</option>
				         <option value="Anexo de Contrato">Anexo de Contrato</option>
				         <option value="Resolucion">Resolucion</option>
				         <option value="Contrato">Contrato</option>
				         <option value="Bases">Bases</option>
				         <option value="Anexo Tecnico">Anexo Tecnico</option>
				         <option value="Anexo Economico">Anexo Economico</option>
				         <option value="Oferta Economica">Oferta Economica</option>
				         <option value="Certificado de Garantia">Certificado de Garantia</option>
						 <option value="Presentacion Oferente">Presentacion Oferente</option>
			     	</select>
				</div>
				<div class="col">
					<label>Adjunte Archivos</label>
					<input type="file" class="form-control" name="documento">
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