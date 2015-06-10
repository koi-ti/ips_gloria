<?php

class Report {
    public static function getPermission($module)
    {
        return Permission::where('rol',Auth::user()->rol)->where('modulo',Module::getModule($module))->first();
    }
}