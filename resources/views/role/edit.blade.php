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
    
        @foreach($permissions as $permision)
        <div class="mb-3">
            @if($rol->hasPermissionTo($permision->name))
            
            <input type="checkbox" name="permisos[]" value="{{$permision->id}}" checked>
            @else
            
             <input type="checkbox" name="permisos[]" value="{{$permision->id}}" >
             @endif
        <label>{{$permision->name}}</label>
        
        </div>
        @endforeach

    

    <a href="/role" class="btn btn-secondary" tabindex="2">CANCELAR</a>
    <button  class="btn btn-primary" tabindex="3">GUARDAR</button>
</form>

@stop

@section('css')

@stop

@section('js')
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>


</script>
@stop