@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Editar de Roles</h1>
@stop

@section('content')
 <h1>Editar Roles</h1>

<form action="/role/{{$rol->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="" class="form-label">Nombre de la clase</label>
        <input id="clase" name="clase" type="text" value="{{$rol->name}}" tabindex="1" class="form-control">
    </div>
       <div class="row">
            <div class="col">
                <h2>Roles Asignados</h2>
                @foreach($permissions as $permision)
                    @if($rol->hasPermissionTo($permision->name))
                        <div class="row align-items-start" >
                            <div class="col">
                                <input type="checkbox" name="permisos[]" value="{{$permision->id}}" checked>
                                <label>{{$permision->name}}</label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col">
                <h2>Roles para Asignar</h2>
                @foreach($permissions as $permision)
                    @if(!$rol->hasPermissionTo($permision->name))
                        <div class="row align-items-start" >
                            <div class="col">
                                <input type="checkbox" name="permisos[]" value="{{$permision->id}}" >
                                <label>{{$permision->name}}</label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        <div class="col">
            <div class="row align-items-start" >
                <div class="col">
                   <a href="/role" class="btn btn-secondary" tabindex="2">CANCELAR</a>
                    <button  class="btn btn-primary" tabindex="3">GUARDAR</button>
                </div>
            </div>
        </div>
    </div>
</form>

@stop

@section('css')

@stop

@section('js')
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>


</script>
@stop