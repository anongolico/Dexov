<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Usuario;
use App\Moderacion;
require (__DIR__.'/../../Global.php');

class DenunciasController extends Controller
{
    public function denuncias()
    {   
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 0) {
        $Denuncias = DB::table('denuncias')->select('id', 'motivo', 'fecha')->get();

        return view('Denuncias', compact('Denuncias'));
    }
    else
    {
        return false;
    }
    }

    public function hilo()
    {
        $Usuario = new Usuario();
        $autorC = $Usuario->esUsuario();
        if($autorC)
		{
        $motivo = $_POST['motivo'];
        $autor = $Usuario->idUsuario();
        $error = 0;

        $hilo = $_POST['idP'];

        $fecha = time();

        $largoC = strlen($motivo);

        if($largoC == 0)
		{       
        $error = 1;
        @header("Content-type: application/json; charset=utf-8");
		echo json_encode(array("erroresD" => "Tenes que escribir algo"));
        exit;
		}

        //Flood
        
        $IPC = getUserIP();

        $ultimaAccion = ultimaAccionD($IPC);

        if($fecha-$ultimaAccion <= '9')
        {
        $error = 1;
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("mensajee" => "Flood"));
        exit;
        }

        $multiDenuncia = DB::table('denuncias')
        ->where('IP', $IPC)->where('hilo', $hilo)->where('comentario', '')
        ->count();

        if($multiDenuncia > '0')
        {
        $error = 1;
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("mensajee" => "Flood"));
        exit;
        }

        if($error > 0)
		{       
        exit;
        }
        else
		{       
        DB::table('denuncias')->insert([
            'id' => generateRandomStringN(12),
            'denunciante' => $autor,
            'hilo' => $hilo,
            'comentario' => '',
            'motivo' => $motivo,
            'fecha' => $fecha,
            'IP' => $IPC
        ]);

        DB::table('usuarios')
            ->where('id', $autor)
            ->update(['ultimaDen' => $fecha]);

            $autoMod = DB::table('denuncias')
            ->where('hilo', $hilo)->where('comentario', '')
            ->count();
        
            if($autoMod > 2)
            {       
                DB::table('hilos')
                ->where('id', $hilo)
                ->update(['visible' => '0']);
            }

            Cache::forget($hilo);
            $idPM = "M".trim($hilo);
            Cache::forget($idPM);
        
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("mensajee" => "Correcto"));
        exit;
        }
    }
    else
    {
        return false;
    }
    }

    public function comentario()
    {
        $Usuario = new Usuario();
        $autorC = $Usuario->esUsuario();
        if($autorC)
		{
        $motivo = $_POST['motivo'];
        $autor = $Usuario->idUsuario();
        $error = 0;

        $comentario = $_POST['idP'];
        
        $hilo = DB::table('comentarios')
        ->where('id', $comentario)
        ->value('hilo');

        $fecha = time();

        $largoC = strlen($motivo);

        if($largoC == 0)
		{       
        $error = 1;
        @header("Content-type: application/json; charset=utf-8");
		echo json_encode(array("erroresD" => "Tenes que escribir algo"));
        exit;
		}

        //Flood
        
        $IPC = getUserIP();

        $ultimaAccion = ultimaAccionD($IPC);

        if($fecha-$ultimaAccion <= '9')
        {
        $error = 1;
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("mensajee" => "Flood"));
        exit;
        }

        $multiDenuncia = DB::table('denuncias')
        ->where('IP', $IPC)->where('comentario', $comentario)
        ->count();

        if($multiDenuncia > '0')
        {
        $error = 1;
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("mensajee" => "Flood"));
        exit;
        }

        if($error > 0)
		{       
        exit;
        }
        else
		{   
        DB::table('denuncias')->insert([
            'id' => generateRandomStringN(12),
            'denunciante' => $autor,
            'hilo' => $hilo,
            'comentario' => $comentario,
            'motivo' => $motivo,
            'fecha' => $fecha,
            'IP' => $IPC
        ]);

        DB::table('usuarios')
            ->where('id', $autor)
            ->update(['ultimaDen' => $fecha]);

        $autoMod = DB::table('denuncias')
            ->where('comentario', $comentario)
            ->count();
        
            if($autoMod > 2)
            {       
                DB::table('comentarios')
                ->where('id', $comentario)
                ->update(['visible' => '0']);
            }

            $idPC = "C".trim($hilo);
            $idPCM = "CM".trim($hilo);
            Cache::forget($idPC);
            Cache::forget($idPCM);
            
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("mensajee" => "Correcto"));
        exit;
    }
    }
    else
    { 
        return false;
    }
    }

    public function leerDen($id)
    { 
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 0) {
        $Titulo = DB::table('denuncias')->where('id', $id)->value('hilo');
        $Comentario = DB::table('denuncias')->where('id', $id)->value('comentario');

        $NotiLink = '/Hilo/'.$Titulo.'#pid'.$Comentario.'';

        DB::table('denuncias')->where('id', $id)->delete();

        header("Location: $NotiLink");
        die();
    }
    else
    {
        return false;
    }
    }
}