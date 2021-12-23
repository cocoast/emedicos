@extends('ppa')
@section('body')
 @if($oc!="no")   
<div class="row align-items-start">
	<div class="col">
		<label> <strong>Rut: {{ $oc["Comprador"]["RutUnidad"] }}</strong></label> 
		<br>
		<label> <strong>Direccion <br> Demamdante: </strong> {{ $oc["Comprador"]["DireccionUnidad"] }}</label> 
		<br>
		<label ><strong>Teléfono: </strong> {{ $oc["Comprador"]["FonoContacto"] }}</label>

	</div>
	<div class="col">
		<label> Demandante: {{ $oc["Comprador"]["NombreUnidad"] }}</label> 
		<br>
		<label > Unidad de Compra: {{ $oc["Comprador"]["NombreUnidad"] }}</label>
		<br>
		<label > Fecha Envio OC: {{ date("d-m-Y", strtotime($oc["Fechas"]["FechaEnvio"]))}}</label>
		<br>
		<label > Estado: {{ $oc["Estado"] }}</label>
	</div>
</div>
<h1>Orden de Compra N°: {{ $oc["Codigo"] }}</h1> 
<div class="card row align-items-start">
	
	<br>
	<div class="col">
		<label > SEÑOR (ES): {{ $oc["Proveedor"]["Nombre"] }}</label>
		<br>
		<label >RUT: {{ $oc["Proveedor"]["RutSucursal"] }}</label>
	</div>
</div>
<div class="card row align-items-start">
	<div class="col">
		<label>Nombre Orden de Compra: {{ $oc["Nombre"] }}</label>
		<br>
		<label>Fecha Entrega Productos: </label>
		<br>
		<label>Direccion de envio Factura: Los aromos 65 Puerto Montt Region de los Lagos </label>
		<br>
		<label>Direccion de Despacho: </label>
		<br>
		<label>Metodo de Despacho:  
			@if($oc["TipoDespacho"]==7) Despachar a Dirección de envío.
			@elseif($oc["TipoDespacho"]==9)Despachar según programa adjuntado.
			@elseif($oc["TipoDespacho"]==12)Otra Forma de Despacho, Ver Instruc.
			@elseif($oc["TipoDespacho"]==14)Retiramos de su bodega.
			@elseif($oc["TipoDespacho"]==20)Despacho por courier o encomienda aérea.
			@elseif($oc["TipoDespacho"]==21)Despacho por courier o encomienda terrestre.
			@elseif($oc["TipoDespacho"]==22)A convenir
			@endif

		</label>
		<br>
		<label> Forma de Pago: 
			@if($oc["FormaPago"]==1) 15 días contra la recepción de la factura.
			@elseif($oc["FormaPago"]==2) 30 días contra la recepción de la factura.
			@elseif($oc["FormaPago"]==39) Otra forma de pago.
			@elseif($oc["FormaPago"]==46) 50 días contra la recepción de la factura.
			@elseif($oc["FormaPago"]==47) 60 días contra la recepción de la factura.
			@elseif($oc["FormaPago"]==48) 45 días contra la recepción de la factura.
			@endif


		</label>
		
	</div>
</div>
<div class="card row align-items-start" >
	<table>
		<thead>
			<th>Código</th>
			<th>Producto</th>
			<th>Cantidad / Unidad</th>
			<th>Especificaciones Comprador</th>
			<th>Especificaciones Proveedor</th>
			<th>Precio Unitario</th>
			<th>Descuento</th>
			<th>Cargos</th>
			<th>Valor Total</th>
		</thead>
		<tbody>
			@foreach ($oc["Items"]["Listado"] as $var)
			<tr>
				<td>{{ $var["CodigoProducto"] }}</td>
				<td>{{ $var["Producto"] }}</td>
				<td>{{ $var["Cantidad"] }}</td>
				<td>{{ $var["EspecificacionComprador"] }}</td>
				<td>{{ $var["EspecificacionProveedor"] }}</td>
				<td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($var["PrecioNeto"]) }}</td>
				<td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($var["TotalDescuentos"]) }}</td>
				<td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($var["TotalCargos"]) }}</td>
				<td>{{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($var["Total"]) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="row align-items-start">
	<div class="col">
		<label for=""> Descripcion:</label>
		<br>	
		<label for="">{{ $oc["Descripcion"]}}</label>

	</div>
	<div class="card col">
		<div class="row">
			<div class="col">
				<label >Neto:   </label>
				<br>
				<label >Dcto. </label>
				<br>
				<label >Cargos </label>
				<br>
				<label >Subtotal  </label>
				<br>
				<label >19% IVA  </label>
				<br>
				<label >Total  </label>
			</div>
		<div class="col">
			<label for=""> $</label>
			<br>
			<label for=""> $</label>
			<br>
			<label for=""> $</label>
			<br>
			<label for=""> $</label>
			<br>
			<label for=""> $</label>
			<br>
			<label for=""> $</label>
			
		</div>
		<div class="col">
			<label > {{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format( $oc["TotalNeto"] )}}</label>
			<br>
			<label for="">{{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($oc["Descuentos"]) }}</label>
			<br>
			<label for=""> {{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($oc["Cargos"]) }}</label>	
				<br>
			<label for="">{{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($oc["TotalNeto"]) }} </label>
			<br>
			<label for="">{{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($oc["Impuestos"]) }}</label>
			<br>
			<label for="">{{ NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($oc["Total"]) }}</label>
		</div>
	</div>
</div>
</div>
@else
<h1>OC No encontrada en Mercado Publico</h1>
@endif
@stop