@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Clientes</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('clientes.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>    

  	<div class="row">
        <div class="form-group col-md-4">
        	<label>Nit</label>
            <div>{{ $customer->nit }}</div> 
        </div>
        <div class="form-group col-md-7">
            <label>Nombre</label>
            <div>{{ $customer->nombre }}</div> 
        </div>
    </div>	

    <div class="row">
        <div class="form-group col-md-4">
            <label>Dirección</label>
            <div>{{ $customer->direccion }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Ciudad</label>
            <div>{{ $city->nombre }}</div> 
        </div>
        <div class="form-group col-md-4">
            <label>Teléfono</label>
            <div>{{ $customer->telefono }}</div> 
        </div>
    </div> 

    <div class="row">
        <div class="form-group col-md-4">
            <label>Dirección de E-mail</label>
            <div>{{ $customer->email }}</div> 
        </div>
    </div> 

    @if(count($addresses) > 0) 
    <div class="row">
        <div class="form-group col-md-12">
            <table id="table-employees" class="table table-striped" align="center">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Persona</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th>Ciudad</th>     
                        <th>Teléfono</th>
                    </tr>   
                </thead>                
                <tbody>
                    @foreach ($addresses as $address)
                        <tr>
                            <td>{{ $address->nombre }}</td>
                            <td>{{ $address->persona }}</td>
                            <td>{{ $address->direccion }}</td>
                            <td>{{ CustomerAddress::$states[$address->activo] }}</td>
                            <td>{{ $address->ciudad_nombre }}</td>
                            <td>{{ $address->telefono }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
    </div> 
    @endif 

    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('clientes.edit', $customer->id) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
@stop 