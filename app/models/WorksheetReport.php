<?php

class WorksheetReport extends Eloquent {

    public static function getPermission($module)
    {
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule($module))->first();
    }

    public static function getVentasFarmacia() 
    {
        $query = WorksheetHasPharmacy::query();  
        $query->join('farmacia', 'planilla_farmacia.farmacia', '=', 'farmacia.id');
        $query->join('planilla', 'planilla_farmacia.planilla', '=', 'planilla.id');
        $query->where('planilla.fecha', '=', Input::get('fecha_inicial_farmacia'));
        return $query->get();   
    }

    public static function getGastosFarmacia() 
    {
        $query = WorksheetExpense::query();  
        $query->select(DB::raw('sum(gasto.valor) as gastos'));
        $query->join('servicio', 'gasto.servicio', '=', 'servicio.id');
        $query->where('gasto.fecha', '=', Input::get('fecha_inicial_farmacia'));
        $query->where('servicio.farmacia', '=', true);
        return $query->first();   
    }

    public static function getVentasExamenes() 
    {
        $query = WorksheetHasExam::query();  
        $query->join('examen', 'planilla_examen.examen', '=', 'examen.id');
        $query->join('planilla', 'planilla_examen.planilla', '=', 'planilla.id');
        $query->where('planilla.fecha', '=', Input::get('fecha_inicial_examenes'));
        return $query->get();   
    }

    public static function getGastosExamenes() 
    {
        $query = WorksheetExpense::query();  
        $query->select(DB::raw('sum(gasto.valor) as gastos'));
        $query->join('servicio', 'gasto.servicio', '=', 'servicio.id');
        $query->where('gasto.fecha', '=', Input::get('fecha_inicial_examenes'));
        $query->where('servicio.examen', '=', true);
        return $query->first();   
    }

    public static function getServiciosResumen() 
    {
        $query = Worksheet::query();  
        $query->select('servicio.nombre', DB::raw('sum( (planilla.valor * planilla.porcentaje / 100) ) as porcentaje'), DB::raw('count(planilla.servicio) as cantidad'), DB::raw('sum(planilla.valor) as valor'), DB::raw('sum(planilla.descuento) as descuento'));
        $query->join('servicio', 'planilla.servicio', '=', 'servicio.id');
        $query->where('planilla.fecha', '=', Input::get('fecha_resumen'));
        $query->groupBy('servicio.nombre');
        return $query->get();
    }

    public static function getGastosExamenResumen() 
    {
        $query = WorksheetExpense::query();  
        $query->select(DB::raw('sum(gasto.valor) as valor'));
        $query->join('servicio', 'gasto.servicio', '=', 'servicio.id');
        $query->where('gasto.fecha', '=', Input::get('fecha_resumen'));
        $query->where('servicio.examen', '=', true);
        return $query->first();
    }

    public static function getGastosFarmaciaResumen() 
    {
        $query = WorksheetExpense::query();  
        $query->select(DB::raw('sum(gasto.valor) as valor'));
        $query->join('servicio', 'gasto.servicio', '=', 'servicio.id');
        $query->where('gasto.fecha', '=', Input::get('fecha_resumen'));
        $query->where('servicio.farmacia', '=', true);
        return $query->first();
    }

    public static function getGastosGeneralesResumen() 
    {
        $query = WorksheetExpense::query();  
        $query->select(DB::raw('sum(gasto.valor) as valor'));
        $query->leftJoin('servicio', 'gasto.servicio', '=', 'servicio.id');
        $query->where('gasto.fecha', '=', Input::get('fecha_resumen'));
        $query->where(function($query) {
            $query->where('servicio.farmacia', '=', false)
                ->where('servicio.examen', '=', false)
                ->orWhereRaw('gasto.servicio is null');
        });
        return $query->first();
    }
}