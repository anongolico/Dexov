<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Usuario;

class HiloDentro extends Model
{
    static function HiloCont($id)
    {
        $HiloAbierto = DB::table('hilos')->where('id', $id)->where('visible', '1')->select('id', 'titulo', 'contenido', 'imagen', 'fecha', 'sticky', 'autor', 'Video', 'VideoURL', 'VYT', 'esGIF', 'visible', 'tag', 'usuario')->get();
        
        return $HiloAbierto;
    }

    static function HiloContM($id)
    {
        $HiloAbierto = DB::table('hilos')->where('id', $id)->select('id', 'titulo', 'contenido', 'imagen', 'fecha', 'sticky', 'autor', 'Video', 'VideoURL', 'VYT', 'esGIF', 'visible', 'tag', 'usuario')->get();
        
        return $HiloAbierto;
    }

    static function HiloCom($hilo)
    {
        $Comentarios = DB::table('comentarios')->where('hilo', $hilo)->where('visible', '1')->select('id', 'contenido', 'fecha', 'imagen', 'autor', 'Video', 'VideoURL', 'VYT', 'color', 'visible', 'esGIF', 'esOP', 'tag')->get();
        
        return $Comentarios;
    }

    static function HiloComM($hilo)
    {
        $Comentarios = DB::table('comentarios')->where('hilo', $hilo)->select('id', 'contenido', 'fecha', 'imagen', 'autor', 'Video', 'VideoURL', 'VYT', 'color', 'visible', 'esGIF', 'esOP', 'tag')->get();
        
        return $Comentarios;
    }

    static function Respuestas($comentario)
    {
        $Respuestas = DB::table('comentarios')->where('responde', $comentario)->select('id', 'fecha')->orderByDesc('fecha')->get();

        foreach ($Respuestas as $Respuesta) {
        $Com = "'";
        echo '<a onclick="General.CMostrarM('.$Com.$Respuesta->id.$Com.','.$Com.$comentario.$Com.');" onmouseover="General.CMostrar('.$Com.$Respuesta->id.$Com.','.$Com.$comentario.$Com.');" onmouseleave="General.COcultar('.$Respuesta->id.');" class="ComentarioCL" id="MostrarCC" href="javascript:void(0);">#'.$Respuesta->id.'</a>';       
        }
    }

    static function RespuestasN($comentario)
    {
        $Com = "'";

        $idCachee = "CoR".trim($comentario);

        if (Cache::has($idCachee)) {
        echo '<div class="Respuestas">';   
        }
        else
        {
        $Respuestas = DB::table('comentarios')->where('responde', $comentario)->count();
        if ($Respuestas > 0) {
        Cache::put($idCachee, '1');
        echo '<div class="Respuestas">';       
        }
        else {
        echo '<div class="Respuestas" style="display: none;">';       
        }
    }
    }

    static function Responde($comentario, $comentarioR)
    {
        $Com = "'";

        global $comentarioo;
        $comentarioo = $comentario;

        $idCache = "Co".trim($comentario);


        $Respuestas = Cache::remember($idCache, '86400', function () {
        global $comentarioo;
        $Respuestass = DB::table('comentarios')->where('id', $comentarioo)->select('id', 'responde')->get();
        return $Respuestass;
        });
        
        
        foreach ($Respuestas as $Respuesta) {
        if ($Respuesta->responde > 0) {
        if ($comentarioR == 0) {
        echo '<a onclick="General.CMostrarM('.$Com.$Respuesta->responde.$Com.','.$Com.$comentario.$Com.');" onmouseover="General.CMostrar('.$Com.$Respuesta->responde.$Com.','.$Com.$comentario.$Com.');" onmouseleave="General.COcultar('.$Com.$Respuesta->responde.$Com.');" class="MostrarCCx" href="javascript:void(0);">#'.$Respuesta->responde.'</a>';
    } 
    else  
    {
    echo '<a onclick="General.CMostrarM('.$Com.$Respuesta->responde.$Com.','.$Com.$comentario.$Com.');" onmouseover="General.CMostrar('.$Com.$Respuesta->responde.$Com.','.$Com.$comentario.$Com.');" onmouseleave="General.COcultar('.$Com.$Respuesta->responde.$Com.');" class="MostrarCCx" href="javascript:void(0);">#'.$Respuesta->responde.'</a>';
    echo '<a onclick="General.CMostrarM('.$Com.$Respuesta->responde.$Com.','.$Com.$comentario.$Com.');" onmouseover="General.CMostrar('.$Com.$Respuesta->responde.$Com.','.$Com.$comentario.$Com.');" onmouseleave="General.COcultar('.$Com.$Respuesta->responde.$Com.');" class="MostrarCCxx" href="javascript:void(0);">#'.$Respuesta->responde.'</a>';    
    }
    }
    }
    }

    static function RespondeN($comentario)
    {
        global $comentarioo;
        $comentarioo = $comentario;

        $idCache = "Coo".trim($comentario);

        $Respuestas = Cache::remember($idCache, '86400', function () {
        global $comentarioo;
        $Respuestass = DB::table('comentarios')->where('id', $comentarioo)->where('responde','>',0)->count();
        return $Respuestass;
        });

        if ($Respuestas > 0) {
        echo '<div class="Respuesta">';       
        }
        else {
        echo '<div class="Respuesta" style="display: none;">';       
        }
    }

    public function esFav($id)
    {
        $Usuario = new Usuario;
        $UID = $Usuario->idUsuario();
        $Hilo = $id;
        $query = DB::table('usuarios')->where('id', $UID)
        ->whereRaw('FIND_IN_SET("'.$Hilo.'", favoritos)')
        ->count();

        return $query;
    }

    public function esOcu($id)
    {
        $Usuario = new Usuario;
        $UID = $Usuario->idUsuario();
        $Hilo = $id;
        $query = DB::table('usuarios')->where('id', $UID)
        ->whereRaw('FIND_IN_SET("'.$Hilo.'", ocultos)')
        ->count();

        return $query;
    }
}