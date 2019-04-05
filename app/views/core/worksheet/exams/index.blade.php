@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Exámen <small>(Planilla)</small></h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('planilla.examen.create') }}" class="btn btn-success">Nueva exámen</a>
	        </div>
        @endif
    </div> 

	{{ Form::open(array('route' => 'planilla.examen.index', 'method' => 'POST', 'id' => 'form-search-exams'), array('role' => 'form')) }}
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
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-exams' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="exams">
		@include('core.worksheet.exams.exams')
	</div>

	<script type="text/javascript">		
		var exam = { 			
			search : function(){
				window.Misc.search('form-search-exams', 'exams', '/planilla/examen'); 
			},
			clearSearch : function(){
    			$('#nombre').val('')
			}
		}

		$("#form-search-exams").submit(function( event ) {  
			event.preventDefault()
			exam.search()	
		})

		$("#button-clear-search-exams").click(function( event ) {  
			exam.clearSearch()
			exam.search()	
		})
	</script>
@stop