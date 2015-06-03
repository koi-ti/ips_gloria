@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Ordenes de servicio</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('ordenes.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>  

  	<div class="row">
        <div class="form-group col-md-3">
        	<label>Cliente</label>
            <div>{{ $order->cliente_nit }}</div> 
        </div>
        <div class="form-group col-md-6">
            <label>Nombre</label>
            <div>{{ $order->cliente_nombre }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Dirección</label>
            <div>{{ $order->cliente_direccion_nombre }}</div>   
        </div>
    </div>	
	<div class="row">
        <div class="form-group col-md-6">
            <label>Técnico</label>
            <div>{{ $order->tecnico_nombre }}</div>
        </div> 
        <div class="form-group col-md-3">
            <label>Factura</label>
            <div>{{ $order->factura ? 'SI' : 'NO' }}</div>
        </div> 
        @if($order->cerrada)
            <div class="form-group col-md-3">
                <label>Estado</label>
                <div style="background-color: #FA5858; color:#FFFFFF">CERRADA</div>
            </div> 
        @endif      
    </div>
    <div class="row">
        <div class="form-group col-md-9">
            <label>Daño</label>
            <div>{{ $order->dano }}</div>
        </div>
        <div class="form-group col-md-3">
            <label>Llamo</label>
            <div>{{ $order->llamo }}</div>
        </div> 
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label>Creación</label>
            <div>{{ $order->fecha_elaboro }}</div>
        </div>  
    </div>

    @if(count($visits) > 0) 
    <div class="row">
        <div class="form-group col-md-12">
            <table id="table-employees" class="table table-striped" align="center">
                <thead>
                    <tr>
                        <th>Técnico</th>
                        <th>Fecha inicial</th>
                        <th>Fecha final</th>
                        <th>Observaciones</th>
                        <th>Pendientes</th> 
                    </tr>   
                </thead>                
                <tbody>
                    @foreach ($visits as $visit)
                        <tr>
                            <td>{{ $visit->tecnico_nombre }}</td>
                            <td>{{ $visit->fecha_inicio }}</td>
                            <td>{{ $visit->fecha_final }}</td>
                            <td>{{ $visit->observaciones }}</td>
                            <td>{{ $visit->pendientes }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
    </div> 
    @endif

    @if(@$permission->modifica)
        @if(!$order->cerrada)
        <div class="row">
            <div class="form-group col-md-4">
                <a href="{{ route('ordenes.edit', $order->id) }}" class="btn btn-success">Editar</a>        
            </div>
        </div>
        @endif
    @endif
@stop 