@php
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
<div id="NPosts">
@foreach ($ActualizadorComentarios->sortByDesc('fecha') as $Comentario)
@php
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
<div class="PComentario" id="pid{{ $Comentario->id }}">
<div class="PHeader">
<div class="PFecha">{{ time_elapsed_string($Comentario->fecha) }}</div>
</div>
<div class="PAvatar" style="background: {{ $Color }};">ANON</div>{!! $esOP !!}{!! $tag !!}<div class="PAutor" style="cursor: pointer;" onclick="General.Responder('{{ $Comentario->id }}')">#{{ $Comentario->id }}</div><div class="PBoton">
<div style="cursor: pointer;" class="PBotonDI" onclick="General.ComentarioM('{{ $Comentario->id }}')"></div>
<div class="PCMenu" id="MenuM{{ $Comentario->id }}">
    <div class="PCMenuO" onclick="General.Denunciar('{{ $Comentario->id }}')">DENUNCIAR</div>
    @if (app('App\Moderacion')->nivelMod() > 0)
    <div class="PCMenuOM" onclick="General.Borrar('{{ $Comentario->id }}')">BORRAR</div>
    @if (app('App\Moderacion')->nivelMod() > 1)
    <div class="PCMenuOM" onclick="General.BorrarP('{{ $Comentario->id }}')">BORRAR P.</div>
    @endif
    <div class="PCMenuOM" onclick="General.Banear('{{ $Comentario->autor }}')">BANEAR</div>
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
{!! app('App\HiloDentro')->Responde($Comentario->id,1) !!}
</div>
<div class="PTexto">{!! $Comentario->contenido !!}</div>
</div>
{!! app('App\HiloDentro')->RespuestasN($Comentario->id) !!}
{!! app('App\HiloDentro')->Respuestas($Comentario->id) !!}
</div>
</div>
@endforeach
</div>