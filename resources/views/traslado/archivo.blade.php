@extends('ppa')

@section('title', 'Subir Acta')

@section('content_header')

    <h3>Validar Acta</h3>

@stop

@section('body')
  <form action="/traslado/archivo" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subir Acta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
  
        <input type="text" hidden class="form-control" name="id" value="{{ $traslado->id }}">
        <div class="row align-items-start">
            <div class="col">
                <label for="" class="form-label">Nombre del Equipo</label>
                <input id="fecha" name="fecha" type="text"  value="{{ $traslado->Equipo->Familia->nombre }}" class="form-control" readonly>
            </div>
             <div class="col">
                <label for="" class="form-label">Marca/Modelo</label>
                <input id="numero" name="numero" type="text" value="{{ $traslado->Equipo->Marca->marca.'/'.$traslado->Equipo->Modelo->modelo }}"  class="form-control" readonly >
            </div>
            <div class="col">
                <label for="" class="form-label">Inventario</label>
                <input id="numero" name="numero" type="text" value="{{ $traslado->Equipo->inventario }}"  class="form-control" readonly >
            </div>
            <div class="col">
                <label for="" class="form-label">Serie</label>
                <input id="numero" name="numero" type="text" value="{{ $traslado->Equipo->serie }}"  class="form-control" readonly >
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col">
                <label for="" class="form-label">Fecha del Acta</label>
                <input id="fecha" name="fecha" type="date"  value="{{ $traslado->fecha }}" class="form-control" readonly>
            </div>
            <div class="col">
                <label for="" class="form-label">Numero del Acta</label>
                <input id="numero" name="numero" type="text" value="{{ $traslado->numero }}"  class="form-control" readonly >
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col">
                <label for="" class="form-label">Servicio Actual</label>
                <input id="fecha" name="fecha" type="text"  value="{{ $traslado->Actual->nombre }}" class="form-control" readonly>
            </div>
            <div class="col">
                <label for="" class="form-label">Servicio Destino</label>
                <input id="numero" name="numero" type="text" value="{{ $traslado->Destino->nombre }}"  class="form-control" readonly >
            </div>
        </div>
        
        <div class="row align-items-start">
            <div class="col">
                <label for="" class="form-label">Archivo del Traslado</label>
                <input id="documento" name="documento" type="file"  class="form-control">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button  class="btn btn-primary" >GUARDAR</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div> </form>
@stop