@extends('adminlte::page')

@section('title', 'Mostrar convenio')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@stop
@section('content_header')
    <h1>Detalles del Convenio: </h1>
    <input id="dt-title" value="{{$convenio->nombre}}" name="nombre" type="text" tabindex="1" class="form-control" readonly>
@stop

@section('content')
<div>
        @if (session()->has('message'))
            <div class="{{session('status')}} alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}
            </div>
        @endif  
    </div>
<div class="row align-items-start">
	<div class="col">
			<label for="" class="form-label">ID interno</label>
			<input id="ide" value="{{$convenio->id}}" name="ide" type="text" tabindex="1" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Licitacion ID</label>
			@if($convenio->link)
			<a href="{{ $convenio->link }}" target="_blank"><input id="licitacion" value="{{$convenio->licitacion}}" name="licitacion" type="text" tabindex="2" class="btn btn-success"readonly></a>
           
			@else
			<input id="licitacion" value="{{$convenio->licitacion}}" name="licitacion" type="text" tabindex="2" class="form-control"readonly>
			@endif
			
		</div>
		<div class="col">
			<label for="" class="form-label">Solicitud</label>
			<input id="solicitud" value="{{$convenio->solicitud}}" name="solicitud" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Resolucion</label>
			<input id="resolucion" value="{{$convenio->resolucion}}" name="resolucion" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha de Resolucion</label>
			<input id="fecharesolucion" value="{{$convenio->fecharesolucion}}" name="fecharesolucion" type="text" tabindex="3" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Valor Convenio+IVA</label>
			<input id="valor" value="{{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($convenio->valor)}}" name="valor" type="text" tabindex="3" class="form-control"readonly>
		</div>
	</div>
	<div class="row align-items-start">
		<div class="col">
			<label for="" class="form-label">Fecha Inicio</label>
			<input id="" value="{{date("d-m-Y", strtotime($convenio->fechaincio))}}" name="" type="text" tabindex="1" class="form-control" readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Fecha Fin</label>
			<input id="" value="{{date("d-m-Y", strtotime($convenio->fechafin))}}" name="" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Meses</label>
			<input id="" value="{{$convenio->meses}}" name="" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">frecuencia Pago</label>
			<input id="" value="
			@if($convenio->frecuenciapago==1) Mensual
            @elseif($convenio->frecuenciapago==3) Trimestral
        	@elseif($convenio->frecuenciapago==4) Cuatrimestral
	        @elseif($convenio->frecuenciapago==6) Semestral
	        @elseif($convenio->frecuenciapago==12) Anual
	        @elseif($convenio->frecuenciapago=="Manual") Manual
	        @endif
	        " name="" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Tipo de Convenio</label>
			<input id="" value="{{$convenio->tipoconvenio}}" name="" type="text" tabindex="2" class="form-control"readonly>
		</div>
		<div class="col">
			<label for="" class="form-label">Proveedor</label>
			<input id="" value="{{$convenio->Proveedor->nombre}}" name="" type="text" tabindex="2" class="form-control"readonly>
		</div>
	</div>
    <div class="row align-items-start">
        <div class="col">
    <h1 class="focus text-danger">Monto Disponible:$ <strong> {{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($convenio->valor-$gasto)}}</strong></h1>        
        </div>
<div class="col">
    <h1 class="focus text-info">Valor Equipos en Convenio:$ <strong> {{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($valorequipo)}}</strong></h1>
</div>
    </div>
	
    
	<ul class="nav nav-tabs">
    <li class="active"><a class="nav-link" data-toggle="tab" href="#home">Equipos</a></li>
    <li><a class="nav-link" data-toggle="tab" href="#menu1">Documentos</a></li>
    <li><a class="nav-link" data-toggle="tab" href="#menu2">Pagos Realizados</a></li>
    <li><a class="nav-link" data-toggle="tab" href="#menu3">Pagos Pendientes</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade active">
      <h3>Equipos</h3>
       @can('convenio.edit')
            <div class="row">
                
                <!-- Trigger the modal with a button -->
            <button type="button" data-path="{{route('equipoconvenio.create',$convenio->id) }}" class="btn btn-primary btn-sm EquipoBtn">Agregar Equipos al Convenio</button>
            </div>
            @endcan
            <table id="equipostables" class="table table-hover table-primary ">
                <thead>
                <th>Equipo</th>
                <th>Serie</th>
                <th>Fabricación</th>
                <th>Familia</th>
                <th>Modelo</th>
                <th>Incorporación</th>
                <th>Valor +IVA</th>
                <th>MP Disponibles</th>
                <th>MP Anual</th>
                <th>Mano Obra</th>
                <th>Respuestos</th>
                @can('convenio.edit')
                <th>Funciones</th>
                @endcan
                </thead>
                <tbody>
                    @foreach($equiposconvenios as $equipoconvenio)
                <tr>
                    <td>
                         <!-- Trigger the modal with a button -->
                    <button type="button" data-path="{{route('equipo.show', $equipoconvenio->Equipo->id) }}" class="btn btn-primary btn-sm EquipoBtn">
                        {{$equipoconvenio->Equipo->inventario}}</button>
                    </td>
                    <td>{{ $equipoconvenio->Equipo->serie }}</td>
                    <td>{{ $equipoconvenio->Equipo->fabricacion }}</td>
                    <td>{{$equipoconvenio->Equipo->Familia->nombre}}</td>
                    <td>{{$equipoconvenio->Equipo->Modelo->modelo}}</td>
                    <td>{{date("d-m-Y", strtotime($equipoconvenio->fechaincorporacion))}}</td>
                    <td>{{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($equipoconvenio->valor)}}</td>
                    <td>{{ $equipoconvenio->mp_disponible }}</td>
                    <td>{{$equipoconvenio->mp}}</td>
                    <td>{{$equipoconvenio->mc}}</td>
                    <td>{{$equipoconvenio->repuesto}}</td>
                    @can('convenio.edit')
                    <td>
                            <!-- Trigger the modal with a button -->
                            <button type="button" data-path="{{route('equipoconvenio.edit',$equipoconvenio->id) }}" class="btn btn-warning btn-sm EquipoBtn"><i class="bi bi-pencil"></i></button>
                    @endcan
                    @can('convenio.destroy')
                    <form action="{{route('equipoconvenio.destroy',$equipoconvenio->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit" onClick="javascript: return confirm('¿Estas seguro?');"><i class="bi bi-trash"></i></button>
                    </form> 
    
        @endcan

            </tr>
            @endforeach
                </tbody>
            </table>
           
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Documentos</h3>
      @can('convenio.edit')
      <!-- Trigger the modal with a button -->
    	 <button type="button" data-path="{{route('convenio.subir', $convenio->id) }}" class="btn btn-warning btn-sm EquipoBtn"> Agregar Archivo</button>
    	 @endcan
                <table class="table table-striped"  style="width: 100%;">
            <thead>
                <th>Nombre Documento</th>
                
                <th>Archivo</th>
            </thead>
            <tbody>
                @if($res!=null)
                @foreach($res as $item =>$value)
            <tr>
                
                <td>{{$value["Nombre"]}}</td>
                
                <td><a href="{{asset($value['direccion'])}}" target="_blank">archivo</a></td>
            </tr>
                @endforeach
                @else
                <td>Sin Registro</td>
                @endif
            </tbody>
        </table>
         
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Pagos Generados </h3>
            <table id="pagosGeneradostables" class="table table-hover table-success">
                <thead>
	                <th>Estado</th>
	                <th>Periodo</th>
	                <th>Memo</th>
	                <th>Fecha de corte</th>
	                <th>OC</th>
	                <th>Valor+IVA</th>
	                <th>Archivo</th>
	                @can('convenio.edit')
	                <th>Editar</th>
	                @endcan
                </thead>
                <tbody>
                    @foreach($pagosrealizados as $pagorealizado)
                    <tr>
                    <td>{{$pagorealizado->estado}}</td>
                    <td>{{$pagorealizado->periodo}}</td>
                    <td>{{$pagorealizado->memo}}</td>
                    <td >{{date("d-m-Y", strtotime($pagorealizado->fecha))}}</td>
                    <td>

                        @if($pagorealizado->oc!="ingresar"&&$pagorealizado->oc!=null&&$pagorealizado->oc!="")
                       
                            <a href="{{route('pagos.show', $pagorealizado->oc) }}" class="" target="_blank"> {{ $pagorealizado->oc }}</a>
                            
                            @else
                            {{ $pagorealizado->oc  }}
                        @endif
                    </td>
                    <td>{{NumberFormatter::create( 'es_CL', NumberFormatter::DECIMAL )->format($pagorealizado->valor)}}</td>
                    <td>@if($pagorealizado->link!=null)<a href="{{asset($pagorealizado->link)}}" target="_blank">archivo</a>  @endif</td>
                    @can('convenio.edit')
                    <td>
                        <a href="{{ route('pagos.pdf',$pagorealizado->id) }}" class="btn btn-warning" target="_blank"><i class="bi bi-clipboard-data"></i></a>
                        <!-- Trigger the modal with a button -->
                        <button type="button" data-path="{{route('pagos.edit', $pagorealizado->id) }}" class="btn btn-warning btn-sm EquipoBtn">
                       <i class="bi bi-pencil"></i></button>
                    </td>
                    @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Pagos Pendientes</h3>
      
             
            <table id="pagosPentables" class="table table-hover table-danger" >
                <thead>
                <th>Estado</th>
                <th>Periodo</th>
                <th>Memo</th>
                <th>Fecha de Corte</th>
                <th>OC</th>
                <th>Valor+IVA</th>
                @can('convenio.edit')
                <th>Generar</th>
                @endcan
                </thead>
                <tbody>
                    @foreach($pagospendientes as $pagopendiente)
                    <tr>
                    <td>{{$pagopendiente->estado}}</td>
                    <td>{{$pagopendiente->periodo}}</td>
                    <td>{{$pagopendiente->memo}}</td>
                    <td>{{date("d-m-Y", strtotime($pagopendiente->fecha))}}</td>
                    <td>{{$pagopendiente->oc}}</td>
                    <td>{{$pagopendiente->valor}}</td>
                   
                    <td>
                        
                        <a href="{{ route('pagos.pdf',$pagopendiente->id) }}" class="btn btn-warning" target="_blank"><i class="bi bi-clipboard-data"></i></a>
                        @can('convenio.edit')
                         <!-- Trigger the modal with a button -->
                    <button type="button" data-path="{{route('pagos.edit', $pagopendiente->id) }}" class="btn btn-success btn-sm EquipoBtn">
                        <i class="bi bi-check-square-fill"></i></button>
                        @endcan

                    </td>
                   
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @can('convenio.edit')

            @if($convenio->tipoconvenio=='Correctivo')
                <a class="btn btn-success" href="{{ route('pagos.create', $convenio->id) }}">Agregar Pago</a>
            @endif
            @endcan
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    	<div class="modal-content">
    	<!--Aqui Va la informacion del modal -->
  		</div>
	</div>
</div>


@stop

@section('css')
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">

@stop

@section('js')
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>



<script type="text/javascript">
	$(document).ready(function() {
    $('#equipostables').DataTable({
    	responsive:true,
    	"columnDefs": [{
        "targets": [1,2],
        "visible": false
        }],
     "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'pB>>",
        buttons :['excel','copy', { extend: 'pdfHtml5',
                orientation: 'landscape',title: function () { return $('#dt-title').val(); }}, 'print'],
    	"lengthMenu":[[3,10,-1],[3,10,"Todos"]],
    	
    	
        });
    } );
</script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#pagosPentables').DataTable({
    	 "lengthMenu":[[3,10,-1],[3,10,"Todos"]],
            
        });
    } );
</script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#pagosGeneradostables').DataTable({
        "order": [[ 1, "desc" ]],
    	responsive:true,
     "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'pB>>",
        buttons :['excel','copy', 'pdf', 'print'],
    	"lengthMenu":[[3,10,-1],[3,10,"Todos"]],          
        });
    });
</script>
<script type="text/javascript">
	$('#exampleModal').on('shown.bs.modal', function () {
 
})
</script>
<script>

$('.EquipoBtn').on('click',function(){
    $('.modal-content').load($(this).data('path'),function(){
        $('#myModal').modal({show:true});
        console.log($('.openBtn').data('path'));
    });
});

</script>
@stop

