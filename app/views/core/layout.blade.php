<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>IPS :: Software</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alertify.core.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alertify.default.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('bootstrap/css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
    
    <!-- Custom styles koi-ti -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <script src="{{ asset('js/ie-emulation-modes-warning.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::to('/') }}">IPS :: Salud Ocupacional</a>

        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>{{ HTML::link('/', Auth::user()->nombre) }}</li>
            <li>{{ HTML::link('/logout', 'Cerrar sesión') }}</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">      
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-list">
                <li><label class="tree-toggler nav-header">Salud Ocupacional</label>
                    <ul class="nav nav-list nav-sidebar tree" style="{{ !in_array(Request::segment(1), ['usuarios', 'roles', 'ciudades', 'pacientes', 'empresas', 'certificados', 'reportes']) ? 'display: none;' : '' }}">
                        <li class="{{ Request::segment(1) == 'usuarios' ? 'active' : '' }}">{{ HTML::linkRoute('usuarios.index', 'Usuarios') }}</li>
                        <li class="{{ Request::segment(1) == 'roles' ? 'active' : '' }}">{{ HTML::linkRoute('roles.index', 'Roles') }}</li>
                        <li class="{{ Request::segment(1) == 'ciudades' ? 'active' : '' }}">{{ HTML::linkRoute('ciudades.index', 'Ciudades') }}</li>
                        <li class="{{ Request::segment(1) == 'pacientes' ? 'active' : '' }}">{{ HTML::linkRoute('pacientes.index', 'Pacientes') }}</li>
                        <li class="{{ Request::segment(1) == 'empresas' ? 'active' : '' }}">{{ HTML::linkRoute('empresas.index', 'Empresas') }}</li>
                        <li class="{{ Request::segment(1) == 'certificados' ? 'active' : '' }}">{{ HTML::linkRoute('certificados.index', 'Certificados') }}</li>
                        <li class="{{ Request::segment(1) == 'reportes' ? 'active' : '' }}">{{ HTML::linkRoute('reportes.index', 'Reportes') }}</li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li><label class="tree-toggler nav-header">Planilla</label>
                    <ul class="nav nav-list nav-sidebar tree" style="{{ !in_array(Request::segment(1), ['planilla']) ? 'display: none;' : '' }}">
                        <li class="{{ Request::segment(2) == 'pacientes' ? 'active' : '' }}">{{ HTML::linkRoute('planilla.pacientes.index', 'Pacientes') }}</li>
                        <li class="{{ Request::segment(2) == 'servicios' ? 'active' : '' }}">{{ HTML::linkRoute('planilla.servicios.index', 'Servicios') }}</li>
                        <li class="{{ Request::segment(2) == 'examen' ? 'active' : '' }}">{{ HTML::linkRoute('planilla.examen.index', 'Exámen') }}</li>
                        <li class="{{ Request::segment(2) == 'farmacia' ? 'active' : '' }}">{{ HTML::linkRoute('planilla.farmacia.index', 'Farmacia') }}</li>
                        <li class="{{ Request::segment(2) == 'gastos' ? 'active' : '' }}">{{ HTML::linkRoute('planilla.gastos.create', 'Gastos', ['fecha' => date('Y-m-d')]) }}</li>
                        <li class="{{ Request::segment(2) == 'planillas' ? 'active' : '' }}">{{ HTML::linkRoute('planilla.planillas.create', 'Planilla', ['fecha' => date('Y-m-d')]) }}</li>
                        <li class="{{ Request::segment(2) == 'reportes' ? 'active' : '' }}">{{ HTML::linkRoute('planilla.reportes.index', 'Reportes') }}</li>
                    </ul>
                </li>
            </ul>
        </div>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- Loading app -->
          <div id="loading-app" class="modal fade" role="dialog" aria-hidden="true"></div>
          <!-- Error app -->
          <div id="error-app" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Cerrar</span></button>
                    <h4 class="modal-title">Error :: IPS</h4>
                </div>
                <div class="modal-body">
                  <div id="error-app-label" class="alert alert-danger"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- Content app -->          
          @yield('content')             
        </div>
      </div>  
    </div>
    
    <script>window.document.url = "{{ URL::to('/') }}";</script> 
    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/docs.min.js') }}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
    <script src="{{ asset('js/alertify.min.js') }}"></script>
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('util/list.js') }}"></script>
  </body>
</html>