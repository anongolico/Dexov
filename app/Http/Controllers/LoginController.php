<?php

namespace App\Http\Controllers;

use App\Hilos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
require (__DIR__.'/../../Global.php');

class LoginController extends Controller
{
    public function registro()
    {
        $id = generateRandomStringN(12);
        $usuario = generateRandomString(12);
        $clave = generateRandomString(12);
        $sesion = generateRandomStringN(18);
        $nivel = '0';
        $adm = '0';
        $fecha = time();
        $IP = getUserIP();
        $error = 0;
        
        $ultimaAccion = ultimoRegistro($IP);

        if($fecha-$ultimaAccion <= '9')
                {
                $error = 1;
                header('Location: /flood');
                exit;
        }

        if($error < 1)
        {
            DB::table('usuarios')->insert([
                'id' => $id,
                'usuario' => $usuario,
                'clave' => $clave,
                'sesion' => $sesion,
                'nivel' => $nivel,
                'adm' => $adm,
                'UIP' => $IP,
                'fecha' => $fecha
            ]);
            $Cookie = DB::table('usuarios')
            ->where('usuario', $usuario)->where('clave', $clave)
            ->value('sesion');
            setcookie("Usuario", $Cookie, time()+(60 * 60 * 24 * 365));

            header('Location: /');
            exit;
        }
    }

    public function login()
    {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        $Valido = DB::table('usuarios')
            ->where('usuario', $usuario)->where('clave', $clave)
            ->count();
        
        
        if($Valido > 0)
        {
            $Cookie = DB::table('usuarios')
            ->where('usuario', $usuario)->where('clave', $clave)
            ->value('sesion');
            setcookie("Usuario", $Cookie, time()+(60 * 60 * 24 * 365));
        }
        else
        {
        }
    }
}