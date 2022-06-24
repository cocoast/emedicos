
@extends('ppa')

@section('title', 'Cambiar Estado')

@section('content_header')
    <h1>Cambiar Estado Licitacion</h1>
@stop

@section('body')
<form action="{{ route('licitacion.cambio.estado',$licitacion->id) }}" method="POST">
	@csrf
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generar Licitacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body ui-front">
	<div class="row">
		<div class="col">
			<label for="" class="form-label" > Seleccione Estado</label>
			<select name="estado" id="estado" class="form-control" onchange="publica()">
				<option value="">Seleccione</option>
				@foreach ($estados as $estado)
					<option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
				@endforeach
			</select>
		</div>
		<div class="col">
			<label for="" class="form-label">Comentario</label>
			<input id="comentario" name="comentario" type="text" class="form-control" required>
			<small id="presupuestoHelp" class="form-text text-muted">Ingrese Comentario</small>
		</div>
	</div>
	<div class="row" >
		<div class="col" id="idmp">
			
		</div>
		<div class="col" id="linkmp"></div>

	</div>
</div>
<div class="modal-footer">
	<button  class="btn btn-primary" tabindex="3">Guardar</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
  <script>
  	function publica(){
  		estado=document.getElementById('estado').value;
  		
  		if(estado=="3"){
  			const idmp=document.createElement("input");
  			const lidmp=document.createElement("label");
  			const linkmp=document.createElement("input");
  			const llinkmp=document.createElement("label");

  			lidmp.setAttribute('class','form-label');
  			lidmp.textContent="Ingrese ID de Mercado Publico";
  			idmp.setAttribute('type',"text");
  			idmp.setAttribute('class',"form-control");
  			idmp.setAttribute('name',"idmp");

  			llinkmp.setAttribute('class','form-label');
  			llinkmp.textContent="Ingrese Link de Mercado Publico";
  			linkmp.setAttribute('type',"text");
  			linkmp.setAttribute('class',"form-control");
  			linkmp.setAttribute('name',"linkmp");
  			
  			document.getElementById("idmp").appendChild(lidmp);
  			document.getElementById("idmp").appendChild(idmp);

  			document.getElementById("linkmp").appendChild(llinkmp);
  			document.getElementById("linkmp").appendChild(linkmp);
  		}

  	}
  </script>
@stop