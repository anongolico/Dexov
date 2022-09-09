@extends('global')
@section('contenido')
<div class="ContH">
@foreach ($HiloAbierto as $Hilo)
@php
switch ($Hilo->tag) {
       case '0':
       $tag = '';
       break;
	   case '1':
       $tag = '<div class="HiloAutorTag"><div class="HiloAutorTagN">'.$Hilo->usuario.'</div><div class="HiloAutorTagTag">MOD</div></div>';
       break;
       case '2':
       $tag = '<div class="HiloAutorTag"><div class="HiloAutorTagN">'.$Hilo->usuario.'</div><div class="HiloAutorTagTag">ADMIN</div></div>';
       break;
    }
@endphp
<div class="PCMMenu" id="MenuMT">
    <div class="PCMenuOM" onclick="General.BorrarCa('ANM', '{{ $Hilo->id }}')">Anime</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('ART', '{{ $Hilo->id }}')">Arte</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('CNC', '{{ $Hilo->id }}')">Ciencia</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('CIN', '{{ $Hilo->id }}' )">Cine y Television</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('OFF', '{{ $Hilo->id }}')">General</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('HMR', '{{ $Hilo->id }}')">Humor</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('MUS', '{{ $Hilo->id }}')">Musica</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('NOT', '{{ $Hilo->id }}')">Noticias</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('PAR', '{{ $Hilo->id }}')">Paranormal</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('POL', '{{ $Hilo->id }}')">Politica</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('RAN', '{{ $Hilo->id }}')">Random</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('TEC', '{{ $Hilo->id }}')">Tecnologia</div>
    <div class="PCMenuOM" onclick="General.BorrarCa('HOT', '{{ $Hilo->id }}')">Sexy</div>
</div>
@section('titulo'){{ $Hilo->titulo }}@endsection
<div class="HHilo">
<div class="HHiloS">
<div class="HHiloSC">
@if (app('App\Usuario')->esUsuario())
<div title="Denunciar tema" class="TBoton" style="cursor: pointer;" onclick="General.Denunciarr('{{ $Hilo->id }}')">
<div class="TBotonDI"></div>
</div>
@if (app('App\HiloDentro')->esFav($Hilo->id) < 1)
<div title="Agregar/quitar tema de favoritos" class="TBoton" style="cursor: pointer;" onclick="General.Favorito('{{ $Hilo->id }}');">
<div id="TBotonFI"></div>
</div>
@else
<div title="Agregar/quitar tema de favoritos" class="TBoton" style="cursor: pointer;" onclick="General.Favorito('{{ $Hilo->id }}');">
<div id="TBotonFIa"></div>
</div>
@endif
@if (app('App\HiloDentro')->esOcu($Hilo->id) < 1)
<div title="Ocultar/mostrar tema" class="TBoton" style="cursor: pointer;" onclick="General.Oculto('{{ $Hilo->id }}');">
<div id="TBotonOI"></div>
</div>
@else
<div title="Ocultar/mostrar tema" class="TBoton" style="cursor: pointer;" onclick="General.Oculto('{{ $Hilo->id }}');">
<div id="TBotonOIa"></div>
</div>
@endif
@if (app('App\Moderacion')->nivelMod() > 0)
<div title="Moderacion" class="TBoton" style="cursor: pointer;" onclick="General.ModOPC()">
<div class="TBotonOPCI"></div>
</div>
<div class="ModOPCt">
<div style="cursor: pointer;" onclick="General.Banear('{{ $Hilo->autor }}')" class="TBoton"><div class="TBotonMBBI"></div></div>  
@if ($Hilo->visible > 0)
<div style="cursor: pointer;" id="TBorRes{{ $Hilo->id }}" onclick="General.TBorrar('{{ $Hilo->id }}')" class="TBoton" id="BorrarT"><div class="TBotonMBI" id="TBorResI{{ $Hilo->id }}"></div></div>
@else
<div style="cursor: pointer;" id="TBorRes{{ $Hilo->id }}" onclick="General.TRestaurar('{{ $Hilo->id }}')" class="TBoton" id="BorrarT"><div class="TBotonMBI TBotonMBIa" id="TBorResI{{ $Hilo->id }}"></div></div>
@endif
<div style="cursor: pointer;" onclick="General.RecatM()" class="TBoton"><div class="TBotonMMI"></div></div>
@if ($Hilo->sticky > 0)
<div style="cursor: pointer;" onclick="General.TSticky('{{ $Hilo->id }}')" id="StickyTT" class="TBoton"><div id="StickyT" class="TBotonMSI TBotonMBIa"></div></div>
@else
<div style="cursor: pointer;" onclick="General.TSticky('{{ $Hilo->id }}')" id="StickyTT" class="TBoton"><div id="StickyT" class="TBotonMSI"></div></div>
@endif
@if (app('App\Moderacion')->nivelMod() > 1)
<div style="cursor: pointer;" onclick="General.TBorrarP('{{ $Hilo->id }}')" class="TBoton"><div class="TBotonMBPI"></div></div>
@endif
</div>
@endif
@else
<div title="Denunciar tema" class="TBoton" style="cursor: pointer;" onclick="General.ModalREG()">
    <div class="TBotonDI"></div>
    </div>
<div title="Agregar/quitar tema de favoritos" class="TBoton" style="cursor: pointer;" onclick="General.ModalREG()">
    <div id="TBotonFI"></div>
    </div>
    <div title="Ocultar/mostrar tema" class="TBoton" style="cursor: pointer;" onclick="General.ModalREG()">
        <div id="TBotonOI"></div>
        </div>
@endif

    @php
    $Oculto = "";
    function time_elapsed_string($ptime)
{
    $etime = time() - $ptime;
    if ($etime < 1)
    {
        return '0 segundos';
    }
    $a = array( 365 * 24 * 60 * 60  =>  'año',
                 30 * 24 * 60 * 60  =>  'mes',
                      24 * 60 * 60  =>  'dia',
                           60 * 60  =>  'hora',
                                60  =>  'minuto',
                                 1  =>  'segundo'
                );
    $a_plural = array( 'año'   => 'años',
                       'mes'  => 'meses',
                       'dia'    => 'dias',
                       'hora'   => 'horas',
                       'minuto' => 'minutos',
                       'segundo' => 'segundos'
                );
    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return 'Hace ' . $r . ' ' . ($r > 1 ? $a_plural[$str] : $str);
        }
    }
}    
    @endphp
<div class="TFecha">{{ time_elapsed_string($Hilo->fecha) }}</div>
</div>
</div>      
<div class="HHiloCont">
    {!! $tag !!}
    @if($Hilo->VideoURL != NULL)
    @php
    $ThreadVideo = $Hilo->VideoURL;
    $Oculto = "Oculto";
    $videoN = "<video class='VideoDD' preload='metadata' controls>
    <source src='/$ThreadVideo#t=0.1' />
    </video>";
    @endphp
    {!! $videoN !!} 
    @endif 
@if($Hilo->VYT == NULL)
<a target="_blank" href="/public/Subidas/{{ $Hilo->imagen }}" id="ImagenH" class="HHiloIM {{ $Oculto }}">
<div class="HHiloIMM" style="background: url(/public/Subidas/Miniaturas/{{ $Hilo->imagen }})"></div>
<div class="HiloO3"></div>
@if($Hilo->esGIF == 0)
<div class="HHiloIMMM" style="background: url(/public/Subidas/Miniaturas/{{ $Hilo->imagen }})"></div>
@else
<div class="HHiloIMMM" style="background: url(/public/Subidas/{{ $Hilo->imagen }})"></div>
@endif
<div class="HiloO2"></div>
</a>
@else
<a onclick="General.VYT('{{ $Hilo->VYT }}')" id="ImagenH" class="HHiloIM {{ $Oculto }}">
    <div class="HHiloIMM" style="background: url(/public/Subidas/Miniaturas/{{ $Hilo->imagen }})"></div>
    <div class="HiloO3"></div>
    <div class="HHiloIMMM" style="background: url(/public/Subidas/Miniaturas/{{ $Hilo->imagen }})"></div>
    <div class="YTIct"></div>
    <div class="HiloO2"></div>
</a>
<div class="VideoYT"></div>
@endif
<div class="HHiloC">
    @php
    $Hilo->titulo = trim(strip_tags($Hilo->titulo));
    $Hilo->titulo = preg_replace("#&(?!\#[0-9]+;)#si", "", $Hilo->titulo); 
	$Hilo->titulo = str_replace("&#", "", $Hilo->titulo); 
	$Hilo->titulo = preg_replace('/([^-\p{L}\x00-\x7F]+)/u', '', $Hilo->titulo);
    $Hilo->titulo = preg_replace("/([\r\n]{4,}|[\n]{2,}|[\r]{2,})/", "\n\n", $Hilo->titulo);
    $Hilo->titulo = nl2br($Hilo->titulo);
    @endphp
    <div class="HHiloCT">{!! $Hilo->titulo !!}</div>
    @php
    $Hilo->contenido = trim(strip_tags($Hilo->contenido));
    $Hilo->contenido = str_replace($Hilo->contenido,"$Hilo->contenido\n",$Hilo->contenido);
    $pattern = "#>(.*?)\n(\r\n?|\n?)#si";
    $replace = "<span style='color: #28B463;'>>$1\n</span>";
    $Hilo->contenido = preg_replace($pattern,$replace,$Hilo->contenido);
    $pattern = "#>www.([\S]+?)#Uis";
	$replace = "<a target='_blank' href='http://$1'>>www.$1</a>";
	$Hilo->contenido = preg_replace($pattern,$replace,$Hilo->contenido);
    $pattern = "#>http://([\S]+?)#Uis";
	$replace = "<a target='_blank' href='http://$1'>>$1</a>";
	$Hilo->contenido = preg_replace($pattern,$replace,$Hilo->contenido);
    $pattern = "#>https://([\S]+?)#Uis";
	$replace = "<a target='_blank' href='http://$1'>>$1</a>";
	$Hilo->contenido = preg_replace($pattern,$replace,$Hilo->contenido);
    $Hilo->contenido = preg_replace("#&(?!\#[0-9]+;)#si", "", $Hilo->contenido); 
	$Hilo->contenido = str_replace("&#", "", $Hilo->contenido); 
	$Hilo->contenido = preg_replace('/([^-\p{L}\x00-\x7F]+)/u', '', $Hilo->contenido);
    $Hilo->contenido = preg_replace("/([\r\n]{4,}|[\n]{2,}|[\r]{2,})/", "\n\n", $Hilo->contenido);
    $Hilo->contenido = nl2br($Hilo->contenido);
    @endphp
    <div class="HHiloCM">{!! $Hilo->contenido !!}</div>
</div>
</div>
</div>
@endforeach
<div class="HComentarios">
<div class="ResF">
<form action="{{url('Ccreacion')}}" method="post" enctype="multipart/form-data" id="formRes">
<input type="hidden" name="hilo" value="{{ $Hilo->id }}" />
<input type="hidden" name="cita" id="cita" value="" />
<div class="ModalYT">
<div class="YTBT">Link del video</div>
<div id="YTBLink"><input autocomplete="off" type="text" id="TBYoutube" name="youtube" spellcheck="false" />
<div id="BTNOk">ACEPTAR</div>
</div>
</div>
@if (app('App\Usuario')->esUsuario())
<textarea class="Mensaje" id="message" spellcheck="false" tabindex="1" name="contenido"></textarea>
@else
<textarea class="Mensaje" id="message" spellcheck="false" tabindex="1" onclick="General.ModalREG()" name="contenido"></textarea>
@endif
<div class="PControles">
<div class="PControlesF">
<input type="file" name="imagen" class="IMGPOST" id="file" />
<label for="file">
<div class="IFi"></div>
<img id="IMGP" src="#" />
</label>
<input type="file" name="media" id="filex" class="IMGPOST" />
<label for="filex">
<div class="IFMi"></div>
</label>
<input id="filexx" class="IMGPOST" onclick="General.ModalYT()" />
<label for="filexx">
<div class="IFYi"></div>
</label>	
</div>
<div class="BotonRESF" style="background: transparent;"></div>
<input type="submit" class="BotonRES" value="COMENTAR" tabindex="2" accesskey="s" id="formResSubmit" />      
<div class="cargaC"></div>
<div class="BotonRESx" id="countdown" value="COMENTAR" tabindex="2" accesskey="s"></div>
<div class="BotonRESx ZI6" id="countdownS" value="COMENTAR" tabindex="2" accesskey="s">0:10</div>
@if (app('App\Moderacion')->nivelMod() > 0)
<input type="checkbox" name="tag" class="tagCB" value="" />
@endif
</div>
</form>
</div>
<div class="CSeparador">
<div class="CSeparadorR" onclick="General.Recargar()">CARGAR <div id="textCCC"></div> 
<div id="textC" style="display: none;"></div> NUEVOS</div>
<div class="CargandoCr"></div>
<div class="CSeparadorT">COMENTARIOS <div id="textCC" style="display: none;">{!! $CantidadC !!}</div>
</div>
</div>
<div id="HComentariosC">
@foreach ($Comentarios->sortByDesc('fecha') as $Comentario)
@php
if($Comentario->visible != 0)
	    {  
		$Borrado = "";
		}
		else
	    {  
		$Borrado = "PBorrado";
		}
switch ($Comentario->color) {
       case '1':
       $Color = "#1F618D";
       break;
	   case '2':
       $Color = "#B03A2E";
       break;
	   case '3':
       $Color = "#239B56";
       break;
	   case '4':
       $Color = "#B7950B";
       break;
    }
    switch ($Comentario->esOP) {
       case '0':
       $esOP = '';
       break;
	   case '1':
       $esOP = '<div class="TagOP">OP</div>';
       break;
    }
    switch ($Comentario->tag) {
       case '0':
       $tag = '<div class="PAutor">ANON</div>';
       break;
	   case '1':
       $tag = '<div class="PAutorD">MOD</div>';
       break;
       case '2':
       $tag = '<div class="PAutorD">ADMIN</div>';
       break;
    }
@endphp
<div class="PComentario {{ $Borrado }}" id="pid{{ $Comentario->id }}">
<div class="PHeader">
<div class="PFecha">{{ time_elapsed_string($Comentario->fecha) }}</div>
</div>
<div class="PAvatar" style="background: {{ $Color }};">ANON</div>{!! $esOP !!}{!! $tag !!}<div class="PAutor" style="cursor: pointer;" onclick="General.Responder('{{ $Comentario->id }}')">#{{ $Comentario->id }}</div><div class="PBoton">
@if (app('App\Usuario')->esUsuario())
<div style="cursor: pointer;" class="PBotonDI" onclick="General.ComentarioM('{{ $Comentario->id }}')"></div><div class="PCMenu" id="MenuM{{ $Comentario->id }}">
<div class="PCMenuO" onclick="General.Denunciar('{{ $Comentario->id }}')">DENUNCIAR</div>
@if (app('App\Moderacion')->nivelMod() > 0)
@if ($Comentario->visible > 0)
<div class="PCMenuOM" id="BorRes{{ $Comentario->id }}" onclick="General.Borrar('{{ $Comentario->id }}')">BORRAR</div>
@else
<div class="PCMenuOM" id="BorRes{{ $Comentario->id }}" onclick="General.Restaurar('{{ $Comentario->id }}')">RESTAURAR</div>
@endif
@if (app('App\Moderacion')->nivelMod() > 1)
<div class="PCMenuOM" onclick="General.BorrarP('{{ $Comentario->id }}')">BORRAR P.</div>
@endif
<div class="PCMenuOM" onclick="General.Banear('{{ $Comentario->autor }}')">BANEAR</div>
@endif
@else
<div style="cursor: pointer;" class="PBotonDI" onclick="General.ComentarioM('{{ $Comentario->id }}')"></div><div class="PCMenu" id="MenuM{{ $Comentario->id }}">
<div class="PCMenuO" onclick="General.ModalREG()">DENUNCIAR</div>
@endif
</div>
</div>
<div class="ComCont">
@php
    $Comentario->contenido = trim(strip_tags($Comentario->contenido));
    $Comentario->contenido = str_replace($Comentario->contenido,"$Comentario->contenido\n",$Comentario->contenido);
    $pattern = "#>(.*?)\n(\r\n?|\n?)#si";
    $replace = "<span style='color: #28B463;'>>$1\n</span>";
    $Comentario->contenido = preg_replace($pattern,$replace,$Comentario->contenido);
    $pattern = "#>www.([\S]+?)#Uis";
	$replace = "<a target='_blank' href='http://$1'>>www.$1</a>";
	$Comentario->contenido = preg_replace($pattern,$replace,$Comentario->contenido);
    $pattern = "#>http://([\S]+?)#Uis";
	$replace = "<a target='_blank' href='http://$1'>>$1</a>";
	$Comentario->contenido = preg_replace($pattern,$replace,$Comentario->contenido);
    $pattern = "#>https://([\S]+?)#Uis";
	$replace = "<a target='_blank' href='http://$1'>>$1</a>";
	$Comentario->contenido = preg_replace($pattern,$replace,$Comentario->contenido);
    $Comentario->contenido = preg_replace("#&(?!\#[0-9]+;)#si", "", $Comentario->contenido); 
	$Comentario->contenido = str_replace("&#", "", $Comentario->contenido); 
	$Comentario->contenido = preg_replace('/([^-\p{L}\x00-\x7F]+)/u', '', $Comentario->contenido);
    $Comentario->contenido = preg_replace("/([\r\n]{4,}|[\n]{2,}|[\r]{2,})/", "\n\n", $Comentario->contenido);
    $Comentario->contenido = nl2br($Comentario->contenido);
    if(($Comentario->imagen == ""))
    {    
    $Oculto = "Oculto";
	}
	else
    {   
	$Oculto = "";
	}
    if(($Comentario->VYT != ""))
    {    
    $comm = "'";
    $portadaYT =  '/public/Subidas/Miniaturas/'.$Comentario->imagen;
    $videoYT = '<a id="HV'.$Comentario->id.'" class="HHiloIMc" style="background-image: url('.$comm.$portadaYT.$comm.')" onclick="General.VYTc('.$comm.$Comentario->VYT.$comm.','.$comm.$Comentario->id.$comm.')"><div class="YTIc"></div><div class="HiloO2"></div></a>';
    $Oculto = "Oculto";
	}
    else
    {    
    $videoYT = '';
	}
    if(($Comentario->VideoURL != ""))
    {    
    $comm = "'";
    $ThreadVideo = $Comentario->VideoURL;
    $videoN = '<a onclick="General.VIDc('.$comm.$Comentario->VideoURL.$comm.','.$comm.$Comentario->id.$comm.')" target="_blank" id="HVV'.$Comentario->id.'" class="HHiloIMc VVC"></a>';
    $Oculto = "Oculto";
	}
    else
    {    
    $videoN = '';
	}
@endphp
{!! $videoYT !!}
{!! $videoN !!}
@if($Comentario->esGIF == 0)
<a target="_blank" href="/public/Subidas/{{ $Comentario->imagen }}" id="H{{ $Comentario->id }}" class="HHiloIMc {{ $Oculto }}" style="background-image: url('/public/Subidas/Miniaturas/{{ $Comentario->imagen }}')">
@else
<a target="_blank" href="/public/Subidas/{{ $Comentario->imagen }}" id="H{{ $Comentario->id }}" class="HHiloIMc {{ $Oculto }}" style="background-image: url('/public/Subidas/{{ $Comentario->imagen }}')">
@endif
<div class="HiloO2"></div>
</a>
<div id="YT{{ $Comentario->id }}"></div>
{!! app('App\HiloDentro')->RespondeN($Comentario->id) !!}
{!! app('App\HiloDentro')->Responde($Comentario->id,0) !!}
</div>
<div class="PTexto">{!! $Comentario->contenido !!}</div>
</div>
{!! app('App\HiloDentro')->RespuestasN($Comentario->id) !!}
{!! app('App\HiloDentro')->Respuestas($Comentario->id) !!}
</div>
</div>
@endforeach
</div>
</div>
</div>
@endsection
@section('jsHilo')
<script type="text/javascript">
    var TID = '{{ $Hilo->id }}';
    var TBorrado = 0;
    var TSticky = 0;
</script>
<script type="text/javascript" src="/public/js/thread.js?ver=2118"></script>
@endsection