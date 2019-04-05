@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Farmacia <small>(Planilla)</small></h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('planilla.farmacia.create') }}" class="btn btn-success">Nueva registro</a>
	        </div>
        @endif
    </div> 

	{{ Form::open(array('route' => 'planilla.farmacia.index', 'method' => 'POST', 'id' => 'form-search-pharmacies'), array('role' => 'form')) }}
	<div class="row">	
	   	<div class="form-group col-md-3"></div>
	   	<div class="form-group col-md-6">           
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Ingrese nombre', 'class' => 'form-control', 'maxlength' => '50')) }}        
        </div>
	   	<div class="form-group col-md-3"></div>
 	</div> 	
 	<div class="row" align="center">
		<button type="submit" class="btn btn-primary">Buscar</button>
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-pharmacies' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="pharmacies">
		@include('core.worksheet.pharmacies.pharmacies')
	</div>

	<script type="text/javascript">		
		var exam = { 			
			search : function(){
				window.Misc.search('form-search-pharmacies', 'pharmacies', '/planilla/farmacia'); 
			},
			clearSearch : function(){
    			$('#nombre').val('')
			}
		}

		$("#form-search-pharmacies").submit(function( event ) {  
			event.preventDefault()
			exam.search()	
		})

		$("#button-clear-search-pharmacies").click(function( event ) {  
			exam.clearSearch()
			exam.search()	
		})
	</script>
@stop