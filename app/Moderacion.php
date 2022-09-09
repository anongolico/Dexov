<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Moderacion extends Model
{
    public function nivelMod()
    {
        if(!empty($_COOKIE['Usuario']))
        {
        global $id;

        $id = $_COOKIE['Usuario'];

            $Nivel = Cache::remember($id.'d', '10800', function () {
                global $id;
                $Niveld = DB::table('usuarios')
                ->where('sesion', $id)->value('nivel');
                return $Niveld;
                });
            return $Nivel;
    }
    else
    {
    return 0;
    }
}

function borrarHiloPP($id)
    {
        $hilo = DB::table('hilos')->where('id', $id)->get();

        foreach ($hilo as $hilo) {
        if (!empty($hilo->VYT)) {
            unlink('public/Subidas/Miniaturas/'.$hilo->imagen);
        }
        elseif(!empty($hilo->VideoURL)) {
            unlink($hilo->VideoURL);
            }
        else
        {
            unlink('public/Subidas/'.$hilo->imagen);
            unlink('public/Subidas/Miniaturas/'.$hilo->imagen);
        }
        }

        $comentarios = DB::table('comentarios')->where('hilo', $id)->get();

        foreach ($comentarios as $comentario) {
            if (!empty($comentario->imagen)) {
            if (!empty($comentario->VYT)) {
            unlink('public/Subidas/Miniaturas/'.$comentario->imagen);
        }
        else
            {
                unlink('public/Subidas/'.$comentario->imagen);
                unlink('public/Subidas/Miniaturas/'.$comentario->imagen);
            }
        }
        if(!empty($comentario->VideoURL)) {
            unlink($comentario->VideoURL);
        }
        }

        DB::table('comentarios')->where('hilo', $id)->delete();
        DB::table('hilos')->where('id', $id)->delete();

        Cache::forget($id);
        $idPM = "M".trim($id);
        Cache::forget($idPM);
    }
}