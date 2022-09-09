<form action="{{url('mod/Gbanear')}}" method="post"  id="formBan" onsubmit="return General.enviarBan();">
    <select name="duracion" class="DSelect">
        <option value="1-0-0-0">1 Hora</option>
        <option value="2-0-0-0">2 Horas</option>
        <option value="3-0-0-0">3 Horas</option>
        <option value="12-0-0-0">12 Horas</option>
        <option value="0-1-0-0">1 Dia</option>
        <option value="0-2-0-0">2 Dias</option>
        <option value="0-3-0-0">3 Dias</option>
        <option value="0-3-0-0">3 Dias</option>
        <option value="0-7-0-0">1 Semana</option>
        <option value="0-0-1-0">1 Mes</option>
        <option value="----">Permanente</option>
      </select>
    <input type="text" autocomplete="off" spellcheck="false" class="DTextBox" name="motivo" placeholder="Motivo..." maxlength="280" />
    <input type="hidden" name="idPP" id="idPP" value="" />
    <input type="submit" class="DBoton" value="BANEAR" />
    </form>
<script type="text/javascript" src="/public/js/jquery.nice-select.min.js?ver=2002"></script>
<script type="text/javascript" src="/public/js/selectR.js?ver=2002"></script>
<link rel="stylesheet" type="text/css" href="/public/css/nice-selectR.css?ver=2002" />