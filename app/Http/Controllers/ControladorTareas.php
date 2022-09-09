<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Moderacion;
use Artisan;
require (__DIR__.'/../../Global.php');

class ControladorTareas extends Controller
{
public function run_task()
{
    $Ahora = time();
    $Moderacion = new Moderacion();

    $EjecutadaH = Cache::remember('TareaHilos', '300', function () {
        $EjecutadaHH = DB::table('tareas')->where('nombre', 'borrarHilos')->value('ejecutada');
        return $EjecutadaHH;
    });
    $EjecutadaC = Cache::remember('TareaCache', '350', function () {
        $EjecutadaCC = DB::table('tareas')->where('nombre', 'borrarCache')->value('ejecutada');
        return $EjecutadaCC;
    });
    $EjecutadaB = Cache::remember('TareaBaneos', '15', function () {
        $EjecutadaBB = DB::table('tareas')->where('nombre', 'levantarBaneos')->value('ejecutada');
        return $EjecutadaBB;
    });
    $EjecutadaN = Cache::remember('TareaNotis', '400', function () {
        $EjecutadaNN = DB::table('tareas')->where('nombre', 'borrarNotificaciones')->value('ejecutada');
        return $EjecutadaNN;
    });
    $EjecutadaU = Cache::remember('TareaUsuarios', '450', function () {
        $EjecutadaUU = DB::table('tareas')->where('nombre', 'borrarUsuarios')->value('ejecutada');
        return $EjecutadaUU;
    });

    //Baneos
    if(($Ahora - $EjecutadaB) >= 60)
	{  
    DB::table('baneados')->where('finaliza', '<', $Ahora)->delete();

    DB::table('tareas')
            ->where('nombre', 'levantarBaneos')
            ->update(['ejecutada' => $Ahora]);
    }

    //Hilos
    if(($Ahora - $EjecutadaH) >= 43200)
	{  
    $FechaM = ($Ahora - (14*24*60*60));

    $hilos = DB::table('hilos')->where('ucomentario', '<', $FechaM)->get();

    foreach ($hilos as $hilo) {
        $Moderacion->borrarHiloPP($hilo->id);
    }

    DB::table('tareas')
            ->where('nombre', 'borrarHilos')
            ->update(['ejecutada' => $Ahora]);
    }

    //Cache
    if(($Ahora - $EjecutadaC) >= 86400)
	{      
    DB::table('tareas')
    ->where('nombre', 'borrarCache')
    ->update(['ejecutada' => $Ahora]);
    
    Artisan::call('cache:clear');
    }

    //Notificaciones
    if(($Ahora - $EjecutadaN) >= 45500)
	{      
    $FechaM = ($Ahora - (14*24*60*60));

    DB::table('notificaciones')->where('fecha', '<', $FechaM)->delete();

    DB::table('tareas')
    ->where('nombre', 'borrarNotificaciones')
    ->update(['ejecutada' => $Ahora]);
    }

    //Usuarios
    if(($Ahora - $EjecutadaU) >= 48700)
	{      
    $FechaM = ($Ahora - (14*24*60*60));

    DB::table('usuarios')->where('ultimoPost', '<', $FechaM)->delete();

    DB::table('tareas')
    ->where('nombre', 'borrarUsuarios')
    ->update(['ejecutada' => $Ahora]);
    }
}

public function index()
{
    header("Content-type: image/gif");
	header("Expires: Sat, 1 Jan 2000 01:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	echo base64_decode("R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==");

$this->run_task();
}
}