@extends('global')

@section('contenido')
<div class="Main">
<div class="AdmPT">PANEL DE ADMINISTRACION</div>
<div class="AdmPMenu">
    <a href="/admin/cuentas"><div class="AdmPMenuO">CUENTAS</div></a>
    <a href="/admin/baneados"><div class="AdmPMenuO">BANEADOS</div></a>
    <a href="/admin/mantenimiento"><div class="AdmPMenuO">MANTENIMIENTO</div></a>
</div>
</div>
@endsection