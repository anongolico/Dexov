@extends('global')
@section('contenido')
<div class="admForm">

<form action="{{url('admin/cuentas/GadmCrear')}}" method="post"  id="formCuen" onsubmit="return General.enviarCuenta();">
    <div class="TextCuen">Usuario:</div>
    <input type="text" autocomplete="off" spellcheck="false"  class="CuenTB" name="usuario" maxlength="280" />
    <div class="TextCuen">Clave:</div>
    <input type="text" autocomplete="off" spellcheck="false" class="CuenTB" name="clave" maxlength="280" />
    <div class="TextCuen">Nivel:</div>
    <input type="text" autocomplete="off" spellcheck="false" class="CuenTB" name="nivel" maxlength="280" />
    <input type="submit" class="CuenBoton" value="CREAR" />
</form>

</div>
@endsection