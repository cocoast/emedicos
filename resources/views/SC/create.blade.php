@extends('adminlte::page')

@section('title', 'Crear Solicitud de Compras')

@section('content_header')
    <h1>Nueva Solicitud de Compra</h1>
@stop

@section('content')

<form action="/sc" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row align-items-start">
        <div class="col">
            <label for="" class="form-label">Numero</label>
            <input id="numero" name="numero" type="text" tabindex="1" class="form-control">
        </div>
        <div class="col">
            <label for="" class="form-label">Fecha</label>
            <input id="fecha" name="fecha" type="date" tabindex="2" class="form-control">
        </div>
        <div class="col">
            <label for="" class="form-label">Tipo</label>
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
             <select class="form-control" name="referente" id="referente" tabindex="4">
                <option selected>Seleccione</option>
                <option value="Bastian Orlando Aedo Muñoz">Bastian Orlando Aedo Muñoz</option>
                <option value="Jorge Andres Astudillo Vergara">Jorge Andres Astudillo Vergara</option>
                <option value="Italo Luigi Marco Bavestrello Arevalo">Italo Luigi Marco Bavestrello Arevalo</option>
                <option value="Ana Luisa Carcamo Vasquez">Ana Luisa Carcamo Vasquez</option>
                <option value="Julio Felipe Enipane Velasquez">Julio Felipe Enipane Velasquez</option>
                <option value="Felipe David Fierro Fierro">Felipe David Fierro Fierro</option>
                <option value="Larry Alejandro Guerrero Barra">Larry Alejandro Guerrero Barra</option>
                <option value="David Andres Rumillanca  Villarroel">David Andres Rumillanca  Villarroel</option>
                <option value="David Alejandro Tereucan Sotomayor">David Alejandro Tereucan Sotomayor</option>
                <option value="Gabriel Esteban Vargas Igor">Gabriel Esteban Vargas Igor</option>
                <option value="Alvaro Simóm  Vargas  Maldonado">Alvaro Simóm  Vargas  Maldonado</option>
                <option value="Lorenzo Adrian Issac Vasquez Acuña">Lorenzo Adrian Issac Vasquez Acuña</option>
            </select>
        </div>
    </div>
    <div class="row align-items-start field_wrapper">
        <div class="row">
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
                <input type="text" name="field_Cantidad[]" class="form-control" value=""/>
            </div>
            <div class="col">
                <label for="" class="form-label">Tipo</label>
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
                <label for="" class="form-label">Neto</label>
                <input type="text" name="field_neto[]" class="form-control" value=""/>
            </div> 
        </div>
    </div>
        <div class="row">
            <div class="col">
                <a href="javascript:void(0);" class="add_button btn btn-success" title="Add field"><i class="bi bi-file-plus"></i>Agregar</a>
            </div>
                <div class="col">
                <a href="javascript:void(0);" class="del_button btn btn-danger" title="Del field"><i class="bi bi-subtract"></i>Quitar Ultimo</a>
            </div>
        </div>
     <div class="row align-items-start">
        <div class="col">
            <label for="" class="form-label">Servicio</label>
            <select class="form-control" name="servicio" id="servicio" tabindex="5"  >
                <option selected>Seleccione</option>
                @foreach($servicios as $id=>$nombre)
                <option value="{{$id}}">{{$nombre}} </option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="" class="form-label">Justificacion</label>
            <textarea name="justificacion" id="" cols="50" rows="2" tabindex="6" class="form-control"></textarea>
        </div>
    </div>
    
         <div class="row align-items-start">
        <div class="col">
            <label for="" class="form-label">Neto Total</label>
            <input id="neto" name="neto" type="text" tabindex="7" class="form-control">
        </div>
        <div class="col">
            <label for="" class="form-label">IVA Total</label>
            <input id="iva" name="iva" type="text" tabindex="8" class="form-control">
        </div>
        <div class="col">
            <label for="" class="form-label">Total</label>
            <input id="iva" name="iva" type="text" tabindex="9" class="form-control">
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
                <option value="David Andres Rumillanca  Villarroel">David Andres Rumillanca  Villarroel</option>
                <option value="David Alejandro Tereucan Sotomayor">David Alejandro Tereucan Sotomayor</option>
                <option value="Gabriel Esteban Vargas Igor">Gabriel Esteban Vargas Igor</option>
                <option value="Alvaro Simóm  Vargas  Maldonado">Alvaro Simóm  Vargas  Maldonado</option>
                <option value="Lorenzo Adrian Issac Vasquez Acuña">Lorenzo Adrian Issac Vasquez Acuña</option>
            </select>
        </div>
        <div class="col">
            <label for="" class="form-label">Subir Documento Firmado</label>
            <input type="file" class="form-control" name="archivo">
        </div>
    </div>
    
    <a href="/modelo" class="btn btn-secondary" tabindex="2">CANCELAR</a>
    <button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>

@stop
@section('css')
<!--BOOSTRAP ICONS-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

@stop

@section('js')
<!--JQUERY-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var delButton = $('.del_button'); //Delete Button
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = 
        '  <div class="row align-items-start field_wrapper child">            <div class="col">                <label for="" class="form-label">Producto</label>                <input type="text" name="field_producto[]" class="form-control" value=""/>            </div>            <div class="col">                <label for="" class="form-label">Caracteristicas Tecnicas</label>                <input type="text" name="field_detalle[]" class="form-control" value=""/>            </div>            <div class="col">                <label for="" class="form-label">Cantidad</label>                <input type="text" name="field_Cantidad[]" class="form-control" value=""/>            </div>            <div class="col">                <label for="" class="form-label">Neto</label>                <input type="text" name="field_neto[]" class="form-control" value=""/>            </div>   </div> '; //New input field html 
        var x = 1; //Initial field counter is 1
        $(addButton).click(function(){ //Once add button is clicked
            if(x < maxField){ //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        
        $(wrapper).on('click', '.del_button', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).parent('child').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
    </script>
@stop