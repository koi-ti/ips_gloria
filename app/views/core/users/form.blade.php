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
    {{ Form::button($action . ' usuario', array('type' => 'submit', 'class' => 'btn btn-success')) }}        
  {{ Form::close() }}
@stop