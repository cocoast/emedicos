@extends('adminlte::page')

@section('title', 'Equipos')

@section('content_header')
    <h1>Listado de Solicitudes de Compra Año: {{ $fecha->format('Y') }}</h1>
@stop

@section('content')

@stop
@section('css')
<!--BOOSTRAP ICONS-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

@stop

@section('js')
<!--JQUERY-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
@stop 