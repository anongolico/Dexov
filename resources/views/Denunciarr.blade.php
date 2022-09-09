<form action="{{url('Gdenunciarr')}}" method="post"  id="formDen" onsubmit="return General.enviarDenunciaa();">
    <div class="ErroresD"></div>
    <input type="text" autocomplete="off" spellcheck="false" class="DTextBox" name="motivo" placeholder="Motivo..." maxlength="280" />
    <input type="hidden" name="idP" id="idP" value="" />
    <input type="submit" class="DBoton" value="DENUNCIAR" />
    </form>