@extends ('core/layout')

@section ('content')
    <div class="row">
        <div class="form-group col-md-10">
            <h1 class="page-header">Gastos <small>(Planilla)</small></h1>
        </div>
        <div class="form-group col-md-2">
            <a href="{{ route('planilla.gastos.index') }}" class="btn btn-info">Ver lista de gastos</a>
        </div>
    </div>  

    {{ Form::open(array('route' => 'planilla.gastos.index', 'method' => 'POST', 'id' => 'form-search-expenses-daily'), array('role' => 'form')) }}    
        <div class="row">
            <div class="form-group col-md-1"></div>
            <div class="form-group col-md-6">
                <h3 class="page-header">Gastos para el día: <small>{{ $date }}</small></h3>
            </div>
            <div class="form-group col-md-1"></div>
        </div>
        {{ Form::hidden('fecha', $date) }}        
    {{ Form::close() }}
    
    <div id="expenses-daily">
        @include('core.worksheet.expenses.expensesitem')
    </div>

    @if(@$permissionExpense->adiciona && $date == date('Y-m-d'))
        <div class="row">
            <div class="form-group col-md-2 text-right">
                <button type="button" class="btn btn-success" id="button-register-expense">Registrar gasto</button>
            </div>
        </div>
    @endif

    {{-- Modal create and edit expense --}}
    @include('core.worksheet.expenses.modalform')
@stop