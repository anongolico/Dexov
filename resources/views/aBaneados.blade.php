@extends('global')

@section('contenido')
<div class="Main">
<div class="AdmPT">PANEL DE ADMINISTRACION</div>
<div class="Cuentas">
@foreach ($Baneados as $Baneado)
@php
$Finaliza = date('d/m/Y H:i:s', $Baneado->finaliza);
@endphp
<div class="Cuenta">
    <div class="CuentaU">ID: {!! $Baneado->id !!}</div>
    <div class="CuentaU">Motivo: {!! $Baneado->motivo !!}</div>
    <div class="CuentaU">Finaliza: {!! $Finaliza !!}</div>
    <div class="CuentaU">Autor: {!! $Baneado->autor !!}</div>
    <a class="CuentaEd" href="/admin/baneados/levantar/{!! $Baneado->id !!}">levantar</a>
</div>
@endforeach
</div>
</div>
@endsection