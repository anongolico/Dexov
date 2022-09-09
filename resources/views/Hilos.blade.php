@extends('index')
@section('Hilos')
<div id="Clase" class="{!! $Clase !!}"></div>
<div id="textH" style="display: none;"></div>
<div id="textHH" style="display: none;">{!! $Cantidad !!}</div>
<div class="ListaHR" onclick="General.RecargarH()">CARGAR <div id="textHHH"></div> NUEVOS</div>
@foreach ($Hilos as $Hilo)
@php
$Creado = $Hilo->fecha;
$Ahora = time();

$TagCat = '<div class="TagCat">'.$Hilo->categoria.'</div>';

if($Hilo->visible != 0)
	    {  
		$Borrado = "";
		}
		else
	    {  
		$Borrado = "Borrado";
		}
if(($Ahora - $Creado) <= 1800)
	    {  
		$TagNuevo = '<div class="TagNuevo">Nuevo</div>';
		}
		else
	    {  
		$TagNuevo = '';
		}
if($Hilo->Video > 0 OR $Hilo->VYT != "")
	    {  
		$TagVideo = '<div class="TagVideo">Vid</div>';
		}
		else
	    {  
		$TagVideo = '';
		}
if($Hilo->sticky != 0)
	    {  
		$TagSticky = '<div class="TagSticky">Sticky</div>';
		$TagNuevo = '';
		}
		else
	    {  
		$TagSticky = '';
		}  
if($Hilo->Video > 0)
		{
		$Video = "<div class='HiloVideo'></div>";
		$BackIMG = "";
		}
		else
		{
		$Video = "";
		$BackIMG = "background: url(public/Subidas/Miniaturas/$Hilo->imagen);";
		}
    $Hilo->titulo = trim(strip_tags($Hilo->titulo));
    $Hilo->titulo = preg_replace("#&(?!\#[0-9]+;)#si", "", $Hilo->titulo); 
	$Hilo->titulo = str_replace("&#", "", $Hilo->titulo); 
	$Hilo->titulo = preg_replace('/([^-\p{L}\x00-\x7F]+)/u', '', $Hilo->titulo);
    $Hilo->titulo = preg_replace("/([\r\n]{4,}|[\n]{2,}|[\r]{2,})/", "\n\n", $Hilo->titulo);
    $Hilo->titulo = nl2br($Hilo->titulo);
@endphp
@if($Hilo->sticky == 1)
<a class="Hiloxx {{ $Borrado }}" id="sticky" style="{{ $BackIMG }}" href="Hilo/{{ $Hilo->id }}">
<div class="HiloO" id="{{ $Hilo->id }}"></div>
<div class="HiloOO"></div>
<div class="HiloOOO"></div>
<div class="TTags">
{!! $TagSticky !!}{!! $TagCat !!}{!! $TagVideo !!}{!! $TagNuevo !!}
</div>
<div class="TagComentarios">
<div class="TagComentariosI"></div>
<div class="TagComentariosT">{!! $Hilo->comentarios !!}</div>
</div>
<div class="HiloTitulo">{!! $Hilo->titulo !!}</div>
{!! $Video !!}
</a>
@else
<a class="Hilo {{ $Borrado }}" style="{{ $BackIMG }}" href="Hilo/{{ $Hilo->id }}">
<div class="HiloO" id="{{ $Hilo->id }}"></div>
<div class="HiloOO"></div>
<div class="HiloOOO"></div>
<div class="TTags">
{!! $TagSticky !!}{!! $TagCat !!}{!! $TagVideo !!}{!! $TagNuevo !!}
</div>
<div class="TagComentarios">
<div class="TagComentariosI"></div>
<div class="TagComentariosT">{!! $Hilo->comentarios !!}</div>
</div>
<div class="HiloTitulo">{!! $Hilo->titulo !!}</div>
{!! $Video !!}
</a>
@endif
@endforeach
@endsection