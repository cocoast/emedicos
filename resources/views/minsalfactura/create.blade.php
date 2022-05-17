@extends('ppa')

@section('title', 'Add Pagos')


@section('body')
 <form action="{{ route('minsalfactura.store') }}" method="POST" >
	@csrf

<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   
	<div class="mb-3">
		<label for="" class="form-label">Numero de Factura</label>
		<input id="numero" name="numero" type="text"  class="form-control" required >
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Fecha de Factura</label>
		<input id="fecha" name="fecha" type="date"   class="form-control" required>
	</div>
	<div class="mb-3">
		<label for="" class="form-label">Monto (Definir Si NETO O Total)</label>
		<input id="monto" name="monto" type="number"  class="form-control" required> 
	</div>
	<div class="mb-3">
		
		<input id="minsalconvenio" name="minsalconvenio" type="text" value="{{$convenio->id}}" hidden class="form-control">
		
	</div>
	
	

 </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  class="btn btn-primary" onClick="javascript: return confirm('¿Estas seguro?');" >GUARDAR</button>
      </div>
      </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop