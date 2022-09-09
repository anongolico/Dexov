<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notificaciones extends Model
{
    static function notificaciones($uid)
    {
        DB::table('notificaciones')->where('receptor', $uid)->update(array('leida' => '1'));

        $Notificaciones = DB::table('notificaciones')->where('receptor', $uid)->select('id', 'clase', 'hilo', 'comentario', 'leida', 'fecha')->get();

        return $Notificaciones;
    }
    
    public function notititulo($noti)
    {
        $Titulo = DB::table('notificaciones')->where('id', $noti)->value('clase');

        switch ($Titulo) {
            case 1:
                $Titulo = "COMENTARON TU HILO";
                break;
            case 2:
                $Titulo = "RESPONDIERON TU COMENTARIO";
                break;
        }

        return $Titulo;
    }

    public function notiportada($noti)
    {
        $HiloNoti = DB::table('notificaciones')->where('id', $noti)->value('hilo');

        $Portada = DB::table('hilos')->where('id', $HiloNoti)->value('imagen');

        return $Portada;
    }
}