@extends('ppa')
@section('title', 'Mostrar RTLS')
@section('content_header')
    <h1>Mostrar RTLS</h1>
@stop
@section('body')
<h4>RTLS</h4>
<div class="row align-items-start">
		<div class="col">
			<label>Ubicacion en tiempo Real </label> 
			<input type="text" name="blyott-ubicacion" value="{{$blyottloc ?? 'Sin Tag'}}" class="form-control" readonly>   			
		</div>
		<div class="col">
			<label>Temperatura Ambiente </label>
			<input type="text" name="blyott-temperatura" value="{{$blyotttemp ?? 'Sin Tag'}}" class="form-control" readonly> 
		</div>
</div> 
<div class="row align-items-start">
		<div class="text-center">
		<label>Ubicacion en tiempo Real </label> 
				@if($blyottloc=='H2 - UTAC ')
		<div class="container-sm">
			<img src="{{ asset('storage/rtls/uti/H2 - UTAC.png') }}	"  class="img-thumbnail" width="800"  alt="">
		</div>
		@elseif($blyottloc=='H2 - BODEGA  EEMM UTI')
		<div class="container-sm">
			<img src="{{ asset('storage/rtls/uti/H2 - BODEGA EEMM UTI.png') }}" width="800"  class="img-thumbnail" alt="">
		</div>
		@elseif($blyottloc=='H2 - UTI - 2')
		<div class="container-sm">
			<img src="{{ asset('storage/rtls/uti/H2 - UTI - 2.png') }}	" width="800" class="img-thumbnail" alt="">
		</div>
		@elseif($blyottloc=='H2 - UTI - 1')
		<div class="container-sm">
			<img src="{{ asset('storage/rtls/uti/H2 - UTI - 1.png') }}	" width="800" class="img-thumbnail" alt="">
		</div>
		@elseif($blyottloc=='H2-UTI-CARDIO')
		<div class="container-sm">
			<img src="{{ asset('storage/rtls/uti/H2-UTI-CARDIO.png') }}	" width="800" class="img-thumbnail" alt="">
		</div>

		@endif
		</div>
		

@stop
@section('js')
@stop