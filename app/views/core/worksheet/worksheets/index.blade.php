@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
         	<h1 class="page-header">Planillas <small>(Planilla)</small></h1>
        </div>
        @if(@$permission->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('planilla.planillas.create', ['date' => date('Y-m-d')]) }}" class="btn btn-success">Nueva planilla</a>
	        </div>
        @endif
    </div> 

	{{ Form::open(array('route' => 'planilla.planillas.index', 'method' => 'POST', 'id' => 'form-search-worksheet'), array('role' => 'form')) }}
	<div class="row">	
        <div class="form-group col-md-4"></div>
        <div class="form-group col-md-4">
            {{ Form::label('fecha', 'Fecha') }}
            <div class="input-append date"> 
                {{ Form::text('fecha', null, array('placeholder' => 'yyyy-mm-dd', 'class' => 'form-control')) }}        
            </div>
        </div>
        <div class="form-group col-md-4"></div>        
 	</div> 	
 	<div class="row" align="center">
		<button type="submit" class="btn btn-primary">Buscar</button>
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-worksheet' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="worksheets">
		@include('core.worksheet.worksheets.worksheets')
	</div>

	<script type="text/javascript">		
		var worksheet = { 			
			search : function(){
				window.Misc.search('form-search-worksheet', 'worksheets', '/planilla/planillas'); 
			},
			clearSearch : function(){
    			$('#fecha').val('')
			}
		}

        $("#fecha").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });

		$("#form-search-worksheet").submit(function( event ) {  
			event.preventDefault()
			worksheet.search()	
		})

		$("#button-clear-search-worksheet").click(function( event ) {  
			worksheet.clearSearch()
			worksheet.search()	
		})
	</script>
@stop