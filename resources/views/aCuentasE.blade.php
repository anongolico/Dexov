@extends('global')
@section('contenido')
<div class="admForm">

@foreach ($Cuenta as $Cuenta)
<form action="{{url('admin/cuentas/Geditar')}}" method="post"  id="formCuen" onsubmit="return General.enviarCuenta();">
    <input type="hidden" name="id" value="{{ $Cuenta->id }}" />
    <div class="TextCuen">Usuario:</div>
    <input type="text" autocomplete="off" spellcheck="false" value="{{ $Cuenta->usuario }}" class="CuenTB" name="usuario" maxlength="280" />
    <div class="TextCuen">Clave:</div>
    <input type="text" autocomplete="off" spellcheck="false" value="{{ $Cuenta->clave }}" class="CuenTB" name="clave" maxlength="280" />
    <div class="TextCuen">Nivel:</div>
    <input type="text" autocomplete="off" spellcheck="false" value="{{ $Cuenta->nivel }}" class="CuenTB" name="nivel" maxlength="280" />
    <input type="submit" class="CuenBoton" value="ACTUALIZAR" />
</form>
@endforeach
</div>
@endsection