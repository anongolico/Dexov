<div class="formCerrar" onclick="General.formCerrar()">x</div>
<div class="Errores"></div>
<form id="formCrear" action="{{url('Hcreacion')}}" method="post" enctype="multipart/form-data" id="formCrear" onsubmit="return General.Crear();">
<input type="text" class="TBTema" placeholder="Titulo" autocomplete="off" name="titulo" spellcheck="false" value="" tabindex="1" />
<select name="categoria" class="STema">
  <option selected disabled>Categoria</option>
  <option value="1">Anime</option>
  <option value="2">Arte</option>
  <option value="3">Ciencia</option>
  <option value="4">Cine y television</option>
  <option value="5">General</option>
  <option value="6">Humor</option>
  <option value="7">Musica</option>
  <option value="8">Noticias</option>
  <option value="9">Paranormal</option>
  <option value="10">Politica</option>
  <option value="11">Random</option>
  <option value="12">Tecnologia</option>
  <option value="13">Sexy</option>
</select>
<div class="ModalYTt">
<div class="YTBTt">Link del video</div>
<div id="YTBLinkt">
<input type="text" autocomplete="off" id="TBYoutubet" name="youtube" spellcheck="false" />
<div id="BTNOk">ACEPTAR</div>
</div>
</div>
<div class="PControlest">
<div class="PControlesFt">
<input type="file" name="imagen" class="IMGPOSTt" id="fileT" />
<label for="fileT"><div class="IFit"></div><img id="IMGPt" src="#" /></label>
<input type="file" name="media" id="filext" class="IMGPOSTt" />
<label for="filext"><div class="IFMit"></div></label>
<input id="filexx" class="IMGPOSTt" onclick="General.ModalYTt()" />
<label for="filexx"><div class="IFYit"></div></label>
</div>
</div>
<textarea class="TATema" spellcheck="false" placeholder="Contenido" name="contenido" id="messageT" rows="20" cols="10" tabindex="2"></textarea>
<div class="BotonTF" style="background: transparent;"></div>
<input type="submit" class="BotonT" name="submit" id="formCrearSubmit" value="PUBLICAR" tabindex="4" accesskey="s" />
@if (app('App\Moderacion')->nivelMod() > 0)
<input type="checkbox" name="tag" class="tagCBt" value="" />
@endif
<div class="cargaT"></div>
</form>
<script type="text/javascript" src="/public/js/jquery.nice-select.min.js?ver=2005"></script>
<script type="text/javascript" src="/public/js/select.js?ver=2005"></script>
<link rel="stylesheet" type="text/css" href="/public/css/nice-select.css?ver=2005" />