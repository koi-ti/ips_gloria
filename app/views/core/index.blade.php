@extends('core/layout')

@section('content')

<h1 class="page-header">Bienvenido</h1>
<h4>{{ Auth::user()->nombre }}</h4>
<span class="text-muted">{{ Auth::user()->email }}</span>

@stop