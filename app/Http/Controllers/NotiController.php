<?php

namespace App\Http\Controllers;

use App\Notificaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
require (__DIR__.'/../../Global.php');

class NotiController extends Controller
{
    public function notificaciones($uid)
    {   
        $Notificaciones = Notificaciones::notificaciones($uid);

        return view('Notificaciones', compact('Notificaciones'));
    }

    public function leerNoti($noti)
    { 
        $Titulo = DB::table('notificaciones')->where('id', $noti)->value('hilo');
        $Comentario = DB::table('notificaciones')->where('id', $noti)->value('comentario');

        $NotiLink = '/Hilo/'.$Titulo.'#pid'.$Comentario.'';

        DB::table('notificaciones')->where('id', $noti)->delete();

        header("Location: $NotiLink");
        die();
    }
}