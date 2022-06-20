@extends('ppa')
@section('body')
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Mostrar Equipo</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
    <div class="row">
      <div class="col">
        <div class="row align-items-start" >
          <div class="col">
            <label for="" class="form-label">ID Equipo</label>
            <input id="inventario" name="inventario" type="text" value="{{$equipo->id}}" class="form-control"  readonly>
          </div>
          <div class="col">
            <label for="" class="form-label">Inventario Equipo</label>
            <input id="inventario" name="inventario" type="text" value="{{$equipo->inventario}}" class="form-control"  readonly>
          </div>
          <div class="col">
            <label for="" class="form-label">Serie</label>
            <input id="serie" name="serie" type="text"  value="{{$equipo->serie}}" class="form-control" readonly>
          </div>
        </div>
      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label">Marca</label>
          <input type="text" name="marca" id="marca" value="{{$equipo->Marca->marca}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">Modelo</label>
          <input type="text" name="modelo" id="modelo" value="{{$equipo->Modelo->modelo}}"  class="form-control" readonly>
        </div>
      </div>
      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label">Familia del Equipo</label>
          <input type="text" name="familia" id="familia" value="{{$equipo->Familia->nombre}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">SubFamilia del Equipo</label>
          <input type="text" name="subfamilia" id="subfamilia" value="{{$equipo->SubFamilia->nombre}}"  class="form-control" readonly>
        </div>
      </div>

      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label">Fecha de Acta de Recepción</label>
          <input id="fecha_adquisicion" name="fecha_adquisicion" type="text" value="{{$equipo->fecha_adquisicion}}" class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">EQ</label>
          <input type="text" name="eq" id="eq" value="{{$equipo->eq}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">Año de Fabricación</label>
          <input id="fabricacion" name="fabricacion" type="text"  value="{{$equipo->fabricacion}}" class="form-control" readonly>
        </div>
      </div>
      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label">Clase del Equipo</label>
          <input type="text" name="clase" id="clase" value="{{$equipo->Clase->nombre}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">SubClase del Equipo</label>
          <input type="text" name="subclase" id="subclase" value="{{$equipo->SubClase->nombre}}"  class="form-control" readonly>
        </div>
      </div>    
      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label">Valor del Equipo IVA Incluido</label>
          <input id="valor" name="valor" type="text" value="{{NumberFormatter::create( 'es_CL', NumberFormatter::CURRENCY )->format($equipo->valor)}}" class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">Tipo Activo</label>
          <input type="text" name="tipoactivo" id="tipoactivo" value="{{$equipo->tipoactivo}}"  class="form-control" readonly>
        </div>
      </div>
      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label">Archivador</label>
          <input id="archivador" name="archivador" value="{{$equipo->archivador}}" type="text" class="form-control" readonly>
        </div>
        <div class="col">
          <label>Vida util Residual</label>
          <input type="text" value="{{$equipo->SubFamilia->vidautil-($year-$equipo->fabricacion)}}" class="form-control" readonly>
        </div>
      </div>

      <h4>Datos del Servicio Clinico</h4>
      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label">Servicio Clinico Responsable</label>
          <input type="text" name="servicioclinico" id="servicioclinico" value="{{$equipo->ServicioClinico->nombre}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">Supervisor Servicio clinico</label>
          <input type="text" name="servicioclinico" id="servicioclinico" value="{{$equipo->ServicioClinico->responsable}}"  class="form-control" readonly>
        </div>
      </div>
      <h4>Adquirido a:</h4>
      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label" >Proveedor Adquisición </label>
          <input type="text" name="proveedor" id="proveedor" value="{{$equipo->Proveedor->nombre}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label" >Direccion Proveedor</label>
          <input type="text" name="proveedor" id="proveedor" value="{{$equipo->Proveedor->direccion}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label" >Rut Proveedor</label>
          <input type="text" name="proveedor" id="proveedor" value="{{$equipo->Proveedor->rut}}"  class="form-control" readonly>
        </div>
      </div>
      </div>
    <div class="col">
      @if($garantia!=null) 
        @if (date("Y", strtotime($garantia->fin))>=$year )
        <h4>Garantia</h4>   
        <div class="row align-items-start">
        <div class="col">
        <label>Fecha Vencimiento Garantia</label>
        <input type="text" name="fechafin" value="{{date("d-m-Y", strtotime($garantia->fin))}}" class="form-control" readonly>
        </div>
        <div class="col">
        <label>Mantenciones por Garantia</label>
        <input type="text" name="mp" value="{{$garantia->mp}} en el total del periodo" class="form-control" readonly>
        </div>
        <div class="col">
        <label>Frecuencia de MP por garantia</label>
        <input type="text" name="frecuencia" value="Cada {{$garantia->frecuencia}} meses" class="form-control" readonly>
        </div>
        </div>
        @else
          <div class="row align-items-start">
          <div class="col">
          <label>Garantia</label>
          <input type="text" name="" value="Sin Garantia vigente" class="form-control" readonly>
          </div>
          </div>
        @endif

      @else
        <div class="row align-items-start">
        <div class="col">
        <label>Garantia</label>
        <input type="text" name="" value="Sin Garantia vigente" class="form-control" readonly>
        </div>
        </div>
      @endif
    @if($ec!="Sin Convenio")
      <h4>Convenio</h4>
      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label">Convenio</label>
          <input type="text" name="convenio" id="convenio" value="{{$convenio->nombre}}"  class="form-control" readonly>
          <a href="/convenio/{{$convenio->id}}">ver mas sobre el convenio...</a>  
        </div>
        <div class="col">
          <label for="" class="form-label">Termino</label>
          <input type="text" name="ffin" id="ffin" value="{{$convenio->fechafin}}" class="form-control" readonly>
        </div>
      </div>  
      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label">Mantenciones Preventivas</label>
          <input type="text" name="mp" id="mp" value="{{$ec->mp}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">Mano de Obra</label>
          <input type="text" name="mc" id="mc" value="{{$ec->mc}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">Repuestos</label>
          <input type="text" name="repuesto" id="repuesto" value="{{$ec->repuesto}}"  class="form-control" readonly>
        </div>
      </div>
      <h4>Datos Proveedor Convenio</h4>
      <div class="row align-items-start">
        <div class="col">
          <label for="" class="form-label">Proveedor del Convenio</label>
          <input type="text" name="repuesto" id="repuesto" value="{{$convenio->Proveedor->nombre}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">Direccion Proveedor del Convenio</label>
          <input type="text" name="repuesto" id="repuesto" value="{{$convenio->Proveedor->direccion}}"  class="form-control" readonly>
        </div>
        <div class="col">
          <label for="" class="form-label">Correo Proveedor del Convenio</label>
          <input type="text" name="repuesto" id="repuesto" value="{{$convenio->Proveedor->email}}"  class="form-control" readonly>
        </div>
      </div>
      @else

      <div class="row align-items-start">
        <div class="col">
          <label>Convenio</label>
          <input type="text" name="" value="Sin Convenio Vigente" class="form-control" readonly>
        </div>
      </div>
    @endif
    <br>
    <div class="row align-items-start">
      <div class="col">
        <table class="table table-striped"  id="papeles" >
          <thead>
            <th>Año</th>
            <th>Tipo Documento</th>
            <th>Mes</th>
            <th>Archivo</th>
          </thead>
          <tbody>
            @if($res!=null)
              <?php foreach ($res as $key => $row) { 
                $aux[$key] = $row['Nombre'];} 
                ?>
                @foreach($res as $item =>$value)
                <tr>
                <?php $nombre=explode("/",$value["Nombre"])[5]?>  
                <td>{{explode("_", $nombre)[1]}} </td>
                @if(substr(explode("_", $nombre)[2],0,2)=="MP")
                <td>Mantencion Preventiva </td>
                @elseif(substr(explode("_", $nombre)[2],0,2)=="MC")
                <td>Mantencion Correctiva </td>
                @else
                <td>{{explode("_", $nombre)[2]}}</td>
                @endif
                <td>{{explode(".",explode("_", $nombre)[3])[0]}}</td>
                <td><a href="{{asset($value['Nombre'])}}" target="_blank">archivo</a></td>
                </tr>
              @endforeach
              @else
            <tr>
            <td>Sin Registro</td>
            </tr>
            @endif
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <a href="{{ route('equipo.pdf',$equipo->id) }}" class="btn btn-primary" target="_blank"> Acta</a>
</div>


@stop


