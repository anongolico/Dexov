<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
require (__DIR__.'/../../Global.php');

class ActualizadorController extends Controller
{
    public function pagina($pagina)
    {
        switch ($pagina) {
            case '1':
            $skip = "30";
            $take = "30";
            break;
            case '2':
            $skip = "60";
            $take = "30";
            break;
            case '3':
                $skip = "90";
                $take = "30";
                break;
            case '4':
                    $skip = "120";
                    $take = "30";
                    break;
            case '5':
                        $skip = "150";
                        $take = "30";
                        break;
         }

        $ActualizadorHilos = DB::table('hilos')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')->skip($skip)->take($take)->get();
        return view('ActualizadorHilos', compact('ActualizadorHilos'));
    }

    public function See($hilo)
    {
    $NumeroComentarios = DB::table('comentarios')->where('hilo', $hilo)->count();
    echo '<div id="Comentarios">'.$NumeroComentarios.'</div>';
    }

    public function Seet($hilo, $limite)
    {
        $ActualizadorComentarios = DB::table('comentarios')->where('hilo', $hilo)->select('id', 'contenido', 'fecha', 'imagen', 'autor', 'Video', 'VideoURL', 'VYT', 'color', 'visible', 'esGIF', 'tag', 'esOP')->orderByDesc('fecha')->limit($limite)->get();

        return view('ActualizadorComentarios', compact('ActualizadorComentarios'));
    }

    public function Seeth($limite)
    {
        $NumeroSticky = DB::table('hilos')->where('sticky', '1')->count();
        $limite = (int)$limite + (int)$NumeroSticky;
        $ActualizadorHilos = DB::table('hilos')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('fecha')->limit($limite)->get();
        return view('ActualizadorHilos', compact('ActualizadorHilos'));
    }

    public function Seethh()
    {
    $NumeroHilos = DB::table('hilos')->count();
    echo '<div id="Hilos">'.$NumeroHilos.'</div>';
    }

    public function noti($noti)
    {
    $NumeroNoti = DB::table('notificaciones')->where('receptor', $noti)->where('leida', 0)->count();
	if($NumeroNoti > 0)
    {
	$Notificaciones = "(".$NumeroNoti.")";
	}
    else
	{
	$Notificaciones = "";
	}
	echo '<div id="Notificaciones">'.$Notificaciones.'</div>';
    }

    public function den()
    {
    $NumeroDen = DB::table('denuncias')->count();
    echo '<div id="Den">'.$NumeroDen.'</div>';
    }
}