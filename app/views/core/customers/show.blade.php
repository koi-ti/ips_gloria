@extends ('core.layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
             <h1 class="page-header">Pacientes</h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('pacientes.index') }}" class="btn btn-info">Regresar</a>
        </div>
    </div>    

   	<div class="row">
        <div class="form-group col-md-3">
        	<label>Cédula</label>
            <div>{{ $customer->cedula }}</div> 
        </div>
        <div class="form-group col-md-6">
            <label>Nombre</label>
            <div>{{ $customer->nombre }}</div> 
        </div>  
        <div class="form-group col-md-3">
            <div class="short-div">
                <img src="{{ $customer->imagen ? URL::asset($customer->imagen) : URL::asset('images/default-avatar.png') }}" class="img-responsive" width="100" height="auto">       
            </div>
        </div>         
    </div>	

    <div class="row">
        <div class="form-group col-md-3">
            <label>Fecha nacimiento</label>
            <div>{{ $customer->fecha_nacimiento }}</div> 
        </div>
        <div class="form-group col-md-3">           
            {{ Form::label('edad', 'Edad') }}
            <div><span class="label label-primary" id="div_edad"></span></div>           
        </div> 
        <div class="form-group col-md-3">
            <label>Lugar nacimiento</label>
            <div>{{ $customer->lugar_nacimiento }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Nacionalidad</label>
            <div>{{ $customer->nacionalidad }}</div> 
        </div>
    </div>  

    <div class="row">
        <div class="form-group col-md-3">
            <label>Escolaridad</label>
            <div>{{ $customer->escolaridad }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Profesión</label>
            <div>{{ $customer->profesion }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Oficio</label>
            <div>{{ $customer->oficio }}</div> 
        </div>
    </div> 

    <div class="row">
        <div class="form-group col-md-3">
            <label>Estado civil</label>
            <div>{{ Customer::$maritalstatus[$customer->estadocivil] }}</div> 
        </div>
        <div class="form-group col-md-3">
            <label>Sexo</label>
            <div>{{ Customer::$sex[$customer->sexo] }}</div> 
        </div>
    </div> 

    <div class="row">
        <div class="form-group col-md-5">
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

    @if(@$permission->modifica)
    <div class="row">
        <div class="form-group col-md-4">
            <a href="{{ route('pacientes.edit', $customer->id) }}" class="btn btn-success">Editar</a>        
        </div>
    </div>
    @endif

    <script type="text/javascript">
        $(function() {
            window.Misc.calcularEdad('{{ $customer->fecha_nacimiento }}');
        });
    </script>
@stop 