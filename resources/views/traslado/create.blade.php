@extends('adminlte::page')

@section('title', 'Edit Baja')

@section('content_header')
    <h1>Editar una Baja</h1>
@stop

@section('content')





<div class="field_wrapper">
	<div class="row">
	<div class="col">
		<label for="" class="form-label">Cantidad</label>
		<input type="text" name="field_cantidad[]" value=""/>
	</div>
	<div class="col">
		<label for="" class="form-label">Accesorio</label>
		<input type="text" name="field_name[]" value=""/>
	</div>
	<div class="col">
		<label for="" class="form-label">Marca</label>
		<input type="text" name="field_marca[]" value=""/>
	</div>
	<div class="col">
		<label for="" class="form-label">Modelo</label>
		<input type="text" name="field_modelo[]" value=""/>
	</div>
	<div class="col">
		<label for="" class="form-label">Serie</label>
		<input type="text" name="field_serie[]" value=""/>
	</div>
        <a href="javascript:void(0);" class="add_button" title="Add field"><i class="bi bi-file-plus"></i>Agregar</a>
        </div>
    </div>
</div>
<a href="/proveedor" class="btn btn-secondary" >CANCELAR</a>
	<button  class="btn btn-primary" >GUARDAR</button>
</form> 
@stop


@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@stop
@section('js')
  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  	<script type="text/javascript">
	$(document).ready(function(){
	    var maxField = 10; //Input fields increment limitation
	    var addButton = $('.add_button'); //Add button selector
	    var wrapper = $('.field_wrapper'); //Input field wrapper
	    var fieldHTML = 
	    '<div class="row"><div class="col"><label for="" class="form-label">Cantidad</label><input type="text" name="field_cantidad[]" value=""/></div><div class="col"><label for="" class="form-label">Accesorio</label><input type="text" name="field_name[]" value=""/></div>			<div class="col"><label for="" class="form-label">Marca</label><input type="text" name="field_marca[]" value=""/></div>			<div class="col"><label for="" class="form-label">Modelo</label><input type="text" name="field_modelo[]" value=""/></div>			<div class="col"><label for="" class="form-label">Serie</label><input type="text" name="field_serie[]" value=""/></div></div> '; //New input field html 
	    var x = 1; //Initial field counter is 1
	    $(addButton).click(function(){ //Once add button is clicked
	        if(x < maxField){ //Check maximum number of input fields
	            x++; //Increment field counter
	            $(wrapper).append(fieldHTML); // Add field html
	        }
	    });
	    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
	        e.preventDefault();
	        $(this).parent('div').remove(); //Remove field html
	        x--; //Decrement field counter
	    });
	});
	</script>
@stop