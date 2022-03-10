@extends('adminlte::page')

@section('title', 'Crear Solicitud de Compras')

@section('content_header')
<h1>Nueva Solicitud de Compra</h1>
@stop

@section('content')

<form action="/sc" method="POST" enctype="multipart/form-data">
    @csrf
    <div class=" row ">
        <div class="col">
            <label for="" class="form-label">Numero</label>
            <input id="numero" name="numero" type="text" tabindex="1" class="form-control">
        </div>
        <div class="col">
            <label for="" class="form-label">Fecha</label>
            <input id="fecha" name="fecha" type="date" tabindex="2" class="form-control">
        </div>
        <div class="col">
            <label for="" class="form-label">Servicio Clinico </label>
            <input id="servicioclinico" name="servicioclinico" tabindex="6" type="text" class="form-control" required>
        </div>
    </div>
    <div class="row align-items-start">
        <div class="col">
            <label for="" class="form-label">Tipo Solicitud</label>
            <select class="form-control" name="tipo" id="tipo" tabindex="3">
                <option selected>Seleccione</option>
                <option value="Compra Extraordinaria">Compra Extraordinaria</option>
                <option value="Incorporacion">Incorporacion</option>
                <option value="Ampliacion">Ampliacion</option>
                <option value="Sustiucion">Sustiucion</option>
                <option value="Renovacion Licitacion">Renovacion Licitacion</option>
                <option value="Licitacion">Licitacion</option>
            </select>
        </div>
        <div class="col">
            <label for="" class="form-label">Referente</label>
            <input type="text" class="form-control" readonly value="{{ auth()->user()->name }}">
        </div>
    </div>

    <div>
        <p></p>
        <label for="" class="form-label">Listado Accesorios</label>
    </div>
    <div class="row align-items-end field_wrapper" id="accesorios">

    </div>
    <div class="row">
        <div class="col">
            <a href="javascript:void(0);" class="add_button btn btn-success" title="Add field"><i class="bi bi-file-plus"></i>Agregar</a>
        </div>
    </div>
    <div class="row align-items-start">

        <div class="col">
            <label for="" class="form-label">Justificacion</label>
            <textarea name="justificacion" id="" cols="50" rows="2" tabindex="6" class="form-control"></textarea>
        </div>
    </div>

    <div class="row align-items-start">
        <div class="col">
            <label for="" class="form-label">Neto Total</label>
            <input id="neto" name="neto" type="text" tabindex="7" class="form-control" readonly>
        </div>
        <div class="col">
            <label for="" class="form-label">Descuento al Neto (%)</label>
            <input id="dctoglob" name="dctoglob" type="text" tabindex="7" class="form-control" value="0">
        </div>

        <div class="col">
            <label for="" class="form-label">Neto Total Descontado</label>
            <input id="netodcto" name="netodcto" type="text" tabindex="7" class="form-control" readonly>
        </div>

        <div class="col">
            <label for="" class="form-label">IVA Total</label>
            <input id="iva" name="iva" type="text" tabindex="8" class="form-control" readonly>
        </div>
        <div class="col">
            <label for="" class="form-label">Total</label>
            <input id="totalcniva" name="iva" type="text" tabindex="9" class="form-control" readonly>
        </div>
    </div>
    <div class="row align-items-start">
        <div class="col">
            <label for="" class="form-label">Informe Tecnico</label>
            <input id="informe" name="informe" type="text" tabindex="9" class="form-control">
        </div>
        <div class="col">
            <label for="" class="form-label">Referente Tecnico</label>
            <select class="form-control" name="referente" id="referente" tabindex="4">
                <option selected>Seleccione</option>
                <option value="Bastian Orlando Aedo Muñoz">Bastian Orlando Aedo Muñoz</option>
                <option value="Jorge Andres Astudillo Vergara">Jorge Andres Astudillo Vergara</option>
                <option value="Italo Luigi Marco Bavestrello Arevalo">Italo Luigi Marco Bavestrello Arevalo</option>
                <option value="Ana Luisa Carcamo Vasquez">Ana Luisa Carcamo Vasquez</option>
                <option value="Julio Felipe Enipane Velasquez">Julio Felipe Enipane Velasquez</option>
                <option value="Felipe David Fierro Fierro">Felipe David Fierro Fierro</option>
                <option value="Larry Alejandro Guerrero Barra">Larry Alejandro Guerrero Barra</option>
                <option value="David Andres Rumillanca  Villarroel">David Andres Rumillanca Villarroel</option>
                <option value="David Alejandro Tereucan Sotomayor">David Alejandro Tereucan Sotomayor</option>
                <option value="Gabriel Esteban Vargas Igor">Gabriel Esteban Vargas Igor</option>
                <option value="Alvaro Simóm  Vargas  Maldonado">Alvaro Simóm Vargas Maldonado</option>
                <option value="Lorenzo Adrian Issac Vasquez Acuña">Lorenzo Adrian Issac Vasquez Acuña</option>
            </select>
        </div>

        <div class="col">
            <label for="" class="form-label">Subir Documento Firmado</label>
            <input type="file" class="form-control" name="archivo">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <a href="/modelo" class="btn btn-secondary" tabindex="2">CANCELAR</a>
            <button class="btn btn-primary" tabindex="3">GUARDAR</button>
        </div>
    </div>
</form>

@stop
@section('css')
<!--BOOSTRAP ICONS-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.css') }}">
@stop



@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ asset('vendor/jquery-ui/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
    $('#servicioclinico').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('search.servicio') }}",
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data)
                }
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector

        var wrapper = $('.field_wrapper'); //Input field wrapper

        //var neto = $('#neto');

        var fieldHTML =
            ` <div class="row align-items-end field_wrapper child data_row">
                <div class="col">
                <label for="" class="form-label">Tipo Producto</label>
                <select name="field_tipo[]" id="" class="form-control">
                    <option value="preventivo">Preventivo</option>
                    <option value="correctivo">Correctivo</option>
                    <option value="repuesto">Repuesto</option>
                    <option value="convenio">Convenio</option>
                    <option value="insumo">Insumo</option>
                    <option value="accesorio">Accesorio</option>
                </select>
            </div>
           
                <div class="col">                
                    <label for="" class="form-label">Producto</label>                
                    <input type="text" name="field_producto[]" class="form-control" value=""/>            
                </div>            
                <div class="col">                
                    <label for="" class="form-label">Caracteristicas Tecnicas</label>                
                    <input type="text" name="field_detalle[]" class="form-control" value=""/>            
                </div>            
                <div class="col">                
                    <label for="" class="form-label">Cantidad</label>                
                    <input type="text" name="field_Cantidad[]" class="form-control cant" value="1"/>            
                </div> 
                         
                <div class="col">                
                    <label for="" class="form-label">Neto Unitario</label>                
                    <input type="text" name="field_neto[]" class="form-control price_unit" value=""/>            
                </div>
                <div class="col">                
                    <label for="" class="form-label">Descuento Producto (%)</label>                
                    <input type="text" name="field_dcto[]" class="form-control dcto_prod" value="0"/>            
                </div>  
                <div class="col">                
                    <label for="" class="form-label">Subtotal Neto</label>                
                    <input type="text" name="field_neto[]" class="form-control price" value="" readonly/>            
                </div>
                <div class="col">                
                    <a href="javascript:void(0);" class="remove_button btn btn-danger" title="Del field"><i class="bi bi-x-lg"></i></a>
                </div>   
            </div> `; //New input field html 
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

        $(wrapper).on('input click', '.data_row', function() {

            // Actualiza los precios cuando se edita el precio unitario
            var total_neto = 0;
            var total_iva = 0;
            var total_coniva = 0;
            var total_netodcto = 0;

            $("#accesorios .row").each(function() {
                var getCant = $(this).find(".cant").val();
                var getValue = $(this).find(".price_unit").val().replace(/[$.]+/g, "");
                var getDscto = $(this).find(".dcto_prod").val().replace(/[%]+/g, "");

                if ($.isNumeric(getValue)) {

                    if ($.isNumeric(getCant)) {
                        var Value = parseFloat(getValue);
                        var Cant = parseFloat(getCant);
                        var Dcto = parseFloat(getDscto);
                        var product_total = Cant * Value * (1 - (Dcto / 100));

                        total_neto += product_total;

                        $(this).find(".price").val(new Intl.NumberFormat('es-CL', {
                            style: 'currency',
                            currency: 'CLP',
                        }).format(product_total));

                        $(this).find(".price_unit").val(new Intl.NumberFormat('es-CL', {
                            style: 'currency',
                            currency: 'CLP',
                        }).format(Value));

                        $(this).find(".dcto_prod").val(getDscto + "%");

                    }
                }

            });


            var dctoglob = $("#dctoglob").val().replace(/[%]+/g, "");

            total_netodcto = total_neto * (1 - (parseFloat(dctoglob) / 100));
            total_iva = total_netodcto * 0.19
            total_coniva = total_netodcto + total_iva


            $("#neto").val(new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
            }).format(total_neto));

            $("#netodcto").val(new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
            }).format(total_netodcto));

            $("#iva").val(new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
            }).format(total_iva));
            $("#totalcniva").val(new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
            }).format(total_coniva));

            $("#dctoglob").val(dctoglob + "%");

        });

        $("#dctoglob").on('input', function() {

            var getTotalNeto = $("#neto").val().replace(/[$.]+/g, "");
            var total_neto = parseFloat(getTotalNeto);

            var dctoglob = $("#dctoglob").val().replace(/[%]+/g, "");


            var total_netodcto = total_neto * (1 - (parseFloat(dctoglob) / 100));
            var total_iva = total_netodcto * 0.19
            var total_coniva = total_netodcto + total_iva


            $("#netodcto").val(new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
            }).format(total_netodcto));

            $("#iva").val(new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
            }).format(total_iva));

            $("#totalcniva").val(new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
            }).format(total_coniva));

            $("#dctoglob").val(dctoglob + "%");

        });

    });
</script>

@stop