
@extends('ppa')
 
@section('body')

<h1>Traslado de Equipos</h1>
<form action="/traslado" method="POST">
	@csrf
<div class="modal-header ">
	<h5 class="modal-title" id="exampleModalLabel">Agregar Programacion </h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body ui-front">
 	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Fecha</label>
			<input id="fecha" name="fecha" type="date"  class="form-control" required>
		</div>
		<div class="col">
			<label for="" class="form-label">Numero</label>
			<input id="numero" name="numero" type="text" value="{{ $numero }}"  class="form-control" readonly >
		</div>
	</div>
	<div class="mb-3">
		<div class="row align-items-start">
			<div class="col">
			<label for="" class="form-label">Servicio Clinico Actual</label>
	     		<input id="actual" name="actual" type="text"   class="form-control" required>
				</div>
			<div class="col">
				<label for="" class="form-label">Servicio Clinico Destino</label>
	     		<input id="destino" name="destino" type="text"   class="form-control" required>
			</div>
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Equipo</label>
	     	<input id="equipo" name="equipo" type="text"   class="form-control" required>
		</div>
	</div>
	
	<div class="container">
		<h5>Perifericos del Equipo</h5>
		<div class="row" >
			<div class="col-6">
				<label for="" class="form-label">Nombre</label>
			</div>
			<div class="col">
				<label for="" class="form-label">Marca</label>
			</div>
			<div class="col">
				<label for="" class="form-label">Modelo</label>
			</div>
			<div class="col">
				<label for="" class="form-label">Serie</label>
			</div>
			<div class="col">
				<label for="" class="form-label">Quitar</label>
			</div>
		</div>
	</div>
	<div class="container field_wrapper">
		
	</div>
		
		<div class="row">
        <div class="col">
            <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field"><i class="bi bi-file-plus"></i>Agregar Perifericos</a>
        </div>
    </div>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	<button  class="btn btn-primary" type="submit">GUARDAR</button>
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
    	
    	
    	$('#actual').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.servicio') }}",	
    				dataType: 'json',
    				data:{
    					term: request.term
    				},
    				success: function(data){
    					response(data)
    				}
    			});
    		}
    	});
    	$('#destino').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.servicio') }}",	
    				dataType: 'json',
    				data:{
    					term: request.term
    				},
    				success: function(data){
    					response(data)
    				}
    			});
    		}
    	});
    	$('#equipo').autocomplete({
    		source: function (request, response){
    			$.ajax({
    				url: "{{ route('search.equipo') }}",	
    				dataType: 'json',
    				data:{
    					term: request.term
    				},
    				success: function(data){
    					response(data)
    				}
    			});
    		}
    	});
    	

    </script> 
<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 5; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector

        var wrapper = $('.field_wrapper'); //Input field wrapper

        //var neto = $('#neto');

        var fieldHTML =
            ` <div class="row ">
               	<div class="col-6">
									<input id="" name="perifericos[]" maxlength="30" type="text"   class="form-control" >
								</div>
								<div class="col">
									<input id="" name="marcas[]" type="text"   class="form-control" >
								</div>
								<div class="col">
									<input id="" name="modelos[]" type="text"   class="form-control" >
								</div>
								<div class="col">
									<input id="" name="series[]" type="text"   class="form-control" >
								</div> 
								<div class="col">                
                    <a href="javascript:void(0);" class="remove_button btn btn-danger" title="Del field"><i class="bi bi-x-lg"></i></a>
                </div>                 
            </div> <br>`; //New input field html 
        var x = 1; //Initial field counter is 1
        $(addButton).click(function() { //Once add button is clicked
            if (x < maxField) { //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });

        $(wrapper).on('click', '.remove_button', function(e) { //Once remove button is clicked
            e.preventDefault();
            $(this).parent().parent().remove(); //Remove field html
            x--; //Decrement field counter

        });
    });
</script>
@stop