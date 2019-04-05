@extends ('core.layout')

@section ('content')
	
    <div class="row">
        <div class="form-group col-md-10">
         	<h1 class="page-header">Gastos <small>(Planilla)</small></h1>
        </div>
        @if(@$permissionExpense->adiciona)
	        <div class="form-group col-md-2">
	            <a href="{{ route('planilla.gastos.create', ['fecha' => date('Y-m-d')]) }}" class="btn btn-success">Nueva gasto</a>
	        </div>
        @endif
    </div> 

	{{ Form::open(array('route' => 'planilla.gastos.index', 'method' => 'POST', 'id' => 'form-search-expense'), array('role' => 'form')) }}
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
		{{Form::button('Limpiar', array('class'=>'btn btn-primary', 'id' => 'button-clear-search-expenses' ));}} 	
	</div>
	<br/>
 	{{ Form::close() }}
	<div id="expenses">
		@include('core.worksheet.expenses.expenses')
	</div>

	<script type="text/javascript">		
		var expense = { 			
			search : function(){
				window.Misc.search('form-search-expense', 'expenses', '/planilla/gastos'); 
			},
			clearSearch : function(){
    			$('#nombre').val('')
    			$('#fecha').val('')
			}
		}

        $("#fecha").datepicker({changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd" });

		$("#form-search-expense").submit(function( event ) {  
			event.preventDefault()
			expense.search()	
		})

		$("#button-clear-search-expenses").click(function( event ) {  
			expense.clearSearch()
			expense.search()	
		})
	</script>
@stop