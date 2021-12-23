@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<img class="img-fluid" src="/img/cabezera-1.png">
    <h1>Sub-Departamento de Equipos Medicos</h1>
@stop

@section('content') 
<div class="row">
  
    <div class="col" >
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title ">Ultimos Pagos Realizados</h3>
            </div>
            <div class="card-body">
                  <table id="realizados" class="table table-striped table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>Convenio</th>
                                <th>Cuota</th>
                                <th>Fecha de Corte</th>
                                <th>Memo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($realizados as $realizado)
                            <tr>
                         <td><a href="/convenio/{{$realizado->Convenio->id}}"> {{$realizado->Convenio->nombre}}</a> </td>
                         <td>{{$realizado->periodo}}</td>
                         <td>{{$realizado->fecha}}</td>
                         <td>{{$realizado->memo}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <!-- /.card-body -->
          
        </div>
<!-- /.card -->
    </div>
    <div class="col">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title ">Pagos Por Vencer</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="badge badge-success">Importante</span>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                  <table id="vencer" class="table table-striped table-hover">
                        <thead class="table-warning">
                            <tr>
                                <th>Convenio</th>
                                <th>Cuota</th>
                                <th>Fecha de Corte</th>
                                <th>Vencimiento</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($porvencer as $realizado)
                            <tr>
                         <td><a href="/convenio/{{$realizado->Convenio->id}}"> {{$realizado->Convenio->nombre}}</a> </td>
                         <td>{{$realizado->periodo}}</td>
                         <td>{{$realizado->fecha}}</td>
                        <td>{{$hoy->diff(new DateTime($realizado->fecha))->format('%R%a días')}}</td>
                        
                         
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <!-- /.card-body -->
        </div>
<!-- /.card -->
    </div>
    <div class="col">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title ">Pagos Vencidos</h3>
                <div class="card-tools">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="badge badge-primary">MUY IMPORTANTE</span>
                </div>
            <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <table id="vencido" class="table table-striped table-hover">
                        <thead class="table-danger">
                            <tr>
                                <th>Convenio</th>
                                <th>Cuota</th>
                                <th>Fecha de Corte</th>
                                <th>Atraso</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vencido as $realizado)
                            <tr>
                         <td><a href="/convenio/{{$realizado->Convenio->id}}"> {{$realizado->Convenio->nombre}}</a>   </td>
                         <td>{{$realizado->periodo}}</td>
                         <td>{{$realizado->fecha}}</td>
                        <td>{{$hoy->diff(new DateTime($realizado->fecha))->format('%R%a días')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <!-- /.card-body -->
            
        </div>
<!-- /.card -->
    </div>
</div>
<h1>Equipos Caracteristicas</h1>
 <div class="row align-items-start">
<div class="col" id="container" ></div>
<div class="col" id="container2" ></div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>