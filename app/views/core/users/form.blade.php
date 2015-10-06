@extends ('core/layout')

<?php
    if ($user->exists):
        $form_data = array('route' => array('usuarios.update', $user->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'usuarios.store', 'method' => 'POST');
        $action    = 'Crear';
    endif;
?>

@section ('title') {{ $action }} usuario @stop

@section ('content')

  <h1 class="page-header">{{ $action }} usuario</h1>

  <div class="row">
    <div class="form-group col-md-4">
        <a href="{{ route('usuarios.index') }}" class="btn btn-info">Lista de usuarios</a>
    </div>
  </div>    
  
  @include ('errors', array('errors' => $errors))

    {{ Form::model($user, $form_data, array('role' => 'form')) }}
        <div class="row">
          <div class="form-group col-md-4">
            {{ Form::label('nombre', 'Nombre completo') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Ingresa nombre y apellido', 'class' => 'form-control')) }}        
          </div>
          <div class="form-group col-md-4">
            {{ Form::label('email', 'Dirección de E-mail') }}
            {{ Form::text('email', null, array('placeholder' => 'Ingresa E-mail', 'class' => 'form-control')) }}
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-4">
            {{ Form::label('rol', 'Rol') }}
            {{ Form::select('rol', array('' => 'Seleccione') + $roles ,null, array('class' => 'form-control')) }}
          </div>
          <div class="form-group col-md-4">
            {{ Form::label('activo', 'Estado') }}
            {{ Form::select('activo', array('1' => 'Activo', '0' => 'Inactivo'),null, array('class' => 'form-control')) }}
          </div>  
        </div>
        <div class="row">      
          <div class="form-group col-md-4">
            {{ Form::label('password', 'Contraseña') }}
            {{ Form::password('password', array('class' => 'form-control')) }}
          </div>
          <div class="form-group col-md-4">
            {{ Form::label('password_confirmation', 'Confirmar contraseña') }}
            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
          </div>
        </div> 

        <div class="row">      
            <div class="form-group col-md-1">
                {{ Form::label('medico', 'Medico') }}
                {{ Form::checkbox('medico', 'check', null, null, ['id' => 'medico']) }}
            </div>
            <div class="form-group col-md-3" id="div_cedula" style="display:@if($user->medico) block @else none @endif">           
                {{ Form::label('cedula', 'Cédula') }}
                {{ Form::text('cedula', null, array('placeholder' => 'Ingrese cédula de ciudadania', 'class' => 'form-control', 'maxlength' => '15')) }}        
            </div>
            <div class="form-group col-md-3" id="div_registro" style="display:@if($user->medico) block @else none @endif">
                {{ Form::label('registro', 'Numero de registro') }}
                {{ Form::text('registro', null, array('placeholder' => 'Numero de registro', 'class' => 'form-control')) }}
            </div>
            <div class="form-group col-md-2" id="div_firma" style="display:@if($user->medico) block @else none @endif">
                {{ Form::label('firma', 'Firma') }}
                {{ Form::select('firma', [1 => 'Si', 0 => 'No'], null, array('class' => 'form-control')) }}
            </div>                       
        </div>
        {{ Form::button($action . ' usuario', array('type' => 'submit', 'class' => 'btn btn-success')) }}        
    {{ Form::close() }}

    <script type="text/javascript">
        $(function() {

            $("#medico").on('click', function() { 
                if ($('#medico').is(":checked")) { 
                    $('#div_registro').show();
                    $('#div_cedula').show();
                    $('#div_firma').show();
                }else{
                    $("#div_registro").hide();
                    $("#div_cedula").hide();
                    $("#div_firma").hide();
                } 
            });
            
            if ($('#medico').is(":checked")) { 
                $('#div_registro').show();
                $('#div_cedula').show();
                $('#div_firma').show();
            }else{
                $("#div_registro").hide();
                $("#div_cedula").hide();
                $("#div_firma").hide();
            }
        });
    </script>
@stop