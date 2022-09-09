<?php
namespace App\Http\Controllers;

use App\Notificaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Usuario;
use App\Moderacion;
require (__DIR__.'/../../Global.php');


class ModController extends Controller
{
    public function admin()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 1) {
        return view('admin');
        }
    else
    {
    return false;
    }
}  

public function mantenimiento()
{
    $Moderacion = new Moderacion();
    if ($Moderacion->nivelMod() > 1) {
    return view('mantenimiento');
    }
else
{
return false;
}
}

public function baneados()
{
    $Moderacion = new Moderacion();
    if ($Moderacion->nivelMod() > 1) {
    $Baneados = DB::table('baneados')->get();
    return view('aBaneados', compact('Baneados'));
    }
else
{
return false;
}
}

public function levantarBan($id)
{
    $Moderacion = new Moderacion();
    if ($Moderacion->nivelMod() > 1) {
    DB::table('baneados')->where('id', $id)->delete();
    }
else
{
return false;
}
}

public function aCuentas()
{
    $Moderacion = new Moderacion();
    if ($Moderacion->nivelMod() > 1) {
    $Cuentas = DB::table('usuarios')->where('adm', '1')->get();
    return view('aCuentas', compact('Cuentas'));
    }
else
{
return false;
}
}

public function aCuentasE($id)
{
    $Moderacion = new Moderacion();
    if ($Moderacion->nivelMod() > 1) {

    $Cuenta = DB::table('usuarios')->where('id', $id)->get();
    return view('aCuentasE', compact('Cuenta'));
    }
else
{
return false;
}
}

public function aCuentasEg()
{
    $Moderacion = new Moderacion();
    if ($Moderacion->nivelMod() > 1) {
        $id = $_POST['id'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $nivel = $_POST['nivel'];

        DB::table('usuarios')
            ->where('id', $id)
            ->update(['usuario' => $usuario, 'clave' => $clave, 'nivel' => $nivel]);
    }
else
{
return false;
}
}

public function aCuentasCrear()
{
    $Moderacion = new Moderacion();
    if ($Moderacion->nivelMod() > 1) {

    return view('aCuentasCrear');
    }
else
{
return false;
}
}

public function aCuentasCrearG()
{
    $Moderacion = new Moderacion();
    if ($Moderacion->nivelMod() > 1) {
        $id = generateRandomStringN(12);
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $sesion = generateRandomStringN(18);
        $nivel = $_POST['nivel'];
        $adm = '1';

        DB::table('usuarios')
        ->insert(['id' => $id, 'usuario' => $usuario, 'clave' => $clave, 'sesion' => $sesion, 'nivel' => $nivel, 'adm' => $adm]);
    }
else
{
return false;
}
}

public function banear()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 0) {

        $Usuario = new Usuario();
        $motivo = $_POST['motivo'];
        $autor = $Usuario->idUsuario();
        $id = $_POST['idPP'];
        $fecha = time();
        $duracion = $_POST['duracion'];

    if($_POST['duracion'] != "----")
	{
		$caduca = ban_date2timestampG($duracion, $fecha);
	}
	else
	{
		$caduca = "2554463529";
	}

        $IP = DB::table('usuarios')->where('id', $id)->value('UIP');

        DB::table('baneados')->where('IP', $IP)->delete();

        DB::table('baneados')->insert([
            'id' => generateRandomStringN(9),
            'IP' => $IP,
            'fecha' => $fecha,
            'duracion' => $duracion,
            'finaliza' => $caduca,
            'motivo' => $motivo,
            'autor' => $autor
        ]);
                
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("mensajee" => "Correcto"));
        exit;
    }
    
    else
{
    return false;
}
}

public function borrarComentario($id)
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 0) {

        DB::table('comentarios')
            ->where('id', $id)
            ->update(['visible' => '0']);

            $hilo = DB::table('comentarios')
            ->where('id', $id)
            ->value('hilo');

            $idPC = "C".trim($hilo);
            $idPCM = "CM".trim($hilo);
            Cache::forget($idPC);
            Cache::forget($idPCM);
    }
    else
{
    return false;
}
}

public function resComentario($id)
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 0) {

        DB::table('comentarios')
            ->where('id', $id)
            ->update(['visible' => '1']);

            $hilo = DB::table('comentarios')
            ->where('id', $id)
            ->value('hilo');

            $idPC = "C".trim($hilo);
            $idPCM = "CM".trim($hilo);
            Cache::forget($idPC);
            Cache::forget($idPCM);
    }
    else
{
    return false;
}
}

public function borrarComentarioP($id)
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 1) {

        $comentario = DB::table('comentarios')->where('id', $id)->get();

        foreach ($comentario as $comentario) {
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
        $hilo = DB::table('comentarios')
        ->where('id', $id)
        ->value('hilo');
        DB::table('comentarios')->where('id', $id)->delete();

        $idPC = "C".trim($hilo);
        $idPCM = "CM".trim($hilo);
        Cache::forget($idPC);
        Cache::forget($idPCM);
    }
    else
{
    return false;
}
}

public function borrarHilo($id)
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 0) {

        DB::table('hilos')
            ->where('id', $id)
            ->update(['visible' => '0']);

            Cache::forget($id);
            $idPM = "M".trim($id);
            Cache::forget($idPM);
    }
    else
{
    return false;
}
}

public function resHilo($id)
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 0) {

        DB::table('hilos')
            ->where('id', $id)
            ->update(['visible' => '1']);

            Cache::forget($id);
            $idPM = "M".trim($id);
            Cache::forget($idPM);
    }
    else
{
    return false;
}
}

function borrarHiloP($id)
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 1) {

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
    else
{
    return false;
}
}

public function sticky($id)
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 0) {

        $hilo = DB::table('hilos')->where('id', $id)->value('sticky');

        if ($hilo > 0) {
        DB::table('hilos')
            ->where('id', $id)
            ->update(['sticky' => '0']);
        }
        else
        {
        DB::table('hilos')
            ->where('id', $id)
            ->update(['sticky' => '1']);
        }
        
        Cache::forget($id);
        $idPM = "M".trim($id);
        Cache::forget($idPM);
    }
    else
{
    return false;
}
}
public function recat($cat, $id)
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() > 0) {

        DB::table('hilos')
            ->where('id', $id)
            ->update(['categoria' => $cat]);
        
        Cache::forget($id);
        $idPM = "M".trim($id);
        Cache::forget($idPM);
    }
    else
{
    return false;
}
}
}