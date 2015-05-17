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
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label>Daño</label>
            <div>{{ $order->dano }}</div>
        </div> 
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label>Creación</label>
            <div>{{ $order->fecha_elaboro }}</div>
        </div>  
    </div>
@stop 