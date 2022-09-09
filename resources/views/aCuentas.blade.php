@extends('global')

@section('contenido')
<div class="Main">
<div class="AdmPT">PANEL DE ADMINISTRACION</div>
<div class="AdmPMenu">
    <a href="/admin/cuentas/crear"><div class="AdmPMenuO">CREAR CUENTA</div></a>
</div>
<div class="Cuentas">
@foreach ($Cuentas as $Cuenta)
<div class="Cuenta">
    <div class="CuentaU">{{ $Cuenta->usuario }}</div>
    <a class="CuentaEd" href="/admin/cuentas/editar/{{ $Cuenta->id }}">editar</a>
</div>
@endforeach
</div>
</div>
@endsection