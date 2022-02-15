@extends('ppa')

@section('title', 'Roles')

@section('content_header')
    <h1>Crear de Roles</h1>
@stop

@section('body')


<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Nuevo Role</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
    <form action="/role" method="POST">
    @csrf
        <div class="mb-3">
            <label for="" class="form-label">Nombre del Role</label>
            <input id="clase" name="clase" type="text"  tabindex="1" class="form-control">
        </div>  
        <a href="/role" class="btn btn-secondary" tabindex="2">CANCELAR</a>
        <button  class="btn btn-primary" tabindex="3">GUARDAR</button>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

@stop

@section('css')

@stop

@section('js')
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>


</script>
@stop