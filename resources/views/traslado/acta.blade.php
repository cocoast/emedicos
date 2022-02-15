@extends('ppa')

@section('title', 'Acta de Traslado')

@section('content_header')

    <h3>ACTA DE TRASLADO DE EQUIPO MEDICO</h3>

@stop

@section('body')

   <div class="container" id="widget">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-start"><img id="ministerio" src="{{ asset('img/ministerio.png') }}" width="150" alt="Logo"></div>
            <div class="d-flex justify-content-center "><h3 class="p-4">ACTA DE TRASLADO DE EQUIPO MEDICO</h3></div>
            <div class="d-flex justify-content-end"><img src="{{ asset('img/hpm.png') }}" width="120" height="100" alt=""></div>
        </div>
        <div class="p-2 d-flex justify-content-center">
            <div class="row border border-dark">
                <div class="col border border-dark" style="background-color:#aaa"><h5><strong>Numero de Acta:</strong></h5></div>
                <div class="col border border-dark"><h4>{{ $traslado->numero }}</h4></div>
                <div class="col border border-dark" style="background-color:#aaa"><h5><strong>Fecha de Acta:</strong></h5></div>
                <div class="col border border-dark"><h4>{{date("d-m-Y", strtotime($traslado->fecha))}}</h4></div>
            </div>
        </div>
        <div class="p-2 d-flex justify-content-center">
        <table class=" table border border-dark table-sm" style="width: 80%;" >
            <thead>
                <th class="border border-dark" colspan="3"> Servicio Actual</th>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-dark"> CR Actual</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Actual->cr }}</td>
                </tr>
                <tr>
                    <td class="border border-dark">Nombre del servicio Actual</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Actual->nombre }}</td>
                </tr>
                <tr>
                    <td class="border border-dark"> Ubicacion del servicio Actual</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Actual->ubicacion }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="p-2 d-flex justify-content-center">
        <table class=" table border border-dark table-sm" style="width: 80%;" >
            <thead>
                <th class="border border-dark" colspan="3"> Servicio Destino</th>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-dark"> CR Destino</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Destino->cr }}</td>
                </tr>
                <tr>
                    <td class="border border-dark">Nombre del servicio Destino</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Destino->nombre }}</td>
                </tr>
                <tr>
                    <td class="border border-dark"> Ubicacion del servicio Destino</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Destino->ubicacion }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="p-2 d-flex justify-content-center">
        <table class=" table border border-dark table-sm" style="width: 80%;" >
            <thead>
                <th class="border border-dark" colspan="3"> Datos del Equipo</th>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-dark"> Nombre</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Equipo->Familia->nombre }}</td>
                </tr>
                <tr>
                    <td class="border border-dark">N° de Inventario</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Equipo->inventario }}</td>
                </tr>
                <tr>
                    <td class="border border-dark"> Marca</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Equipo->Marca->marca }}</td>
                </tr>
                <tr>
                    <td class="border border-dark"> Modelo</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Equipo->Modelo->modelo }}</td>
                </tr>
                <tr>
                    <td class="border border-dark"> Serie</td>
                    <td class="border border-dark">:</td>
                    <td class="border border-dark">{{ $traslado->Equipo->serie }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="p-2 d-flex justify-content-center">
        <table class=" table border border-dark table-sm" style="width: 80%;" >
            <thead>
                <tr>
                <th class="border border-dark" colspan="4"> Accesorios del Equipo</th>
                </tr>
                <tr>
                    <th class="border border-dark">Nombre</th>
                    <th class="border border-dark">Marca</th>
                    <th class="border border-dark">Modelo</th>
                    <th class="border border-dark">Serie</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-dark"><p></p></td>
                    <td class="border border-dark"><p></p></td>
                    <td class="border border-dark"><p></p></td>                    
                    <td class="border border-dark"><p></p></td>
                </tr>
                <tr>
                    <td class="border border-dark"><p></p></td>
                    <td class="border border-dark"><p></p></td>
                    <td class="border border-dark"><p></p></td>                    
                    <td class="border border-dark"><p></p></td>
                </tr>
                <tr>
                    <td class="border border-dark"><p></p></td>
                    <td class="border border-dark"><p></p></td>
                    <td class="border border-dark"><p></p></td>                    
                    <td class="border border-dark"><p></p></td>
                </tr>
                
            </tbody>
        </table>
    </div>
         <div class="p-2 d-flex justify-content-center">
        <table class="border border-dark" width="80%">
            <thead>
                <tr><th colspan="4"><strong>SERVICIO ACTUAL</strong></th></tr>
                <tr>
                <th >Cargo (Jefe / Supervisor / Designado)</th>
                <th >Nombre</th>
                <th >RUT</th>
                <th >Firma</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td >____________________________</td>
                    <td >____________________________</td>
                    <td >____________________________</td>
                    <td >____________________________</td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="p-2 d-flex justify-content-center">
       <table class="border border-dark" width="80%">
            <thead>
                <tr><th colspan="4"><strong>SERVICIO DESTINO</strong></th></tr>
                <tr>
                <th >Cargo (Jefe / Supervisor / Designado)</th>
                <th >Nombre</th>
                <th >RUT</th>
                <th >Firma</th>
                </tr>
            </thead>
            <tbody class="p-4">
                <tr>
                    <td >____________________________</td>
                    <td >____________________________</td>
                    <td >____________________________</td>
                    <td >____________________________</td>
                </tr>
            </tbody>
        </table>
        </div>
        
    </div>
    
 

@stop  
@section('css')
<link rel="stylesheet" href="/css/bootstrap-print.min.css" media="print">
@stop
@section('js')
<script src="{{ asset('js/html2canvas.js') }}">    </script>
<script type="text/javascript">
 $(document).ready(function(){
    $('#btnSave').on('click',function(){
        html2canvas(document.getElementById('#widget')).then(function(canvas){
            var anchorTag=document.createElement("a");
            document.body.appendChild(anchorTag);
            anchorTag.download="img.jpg";
            anchorTag.href='_blank';
            anchorTag.click();
        });
    });
 });

</script>
@stop 
