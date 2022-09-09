<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Usuario extends Model
{
    public function esUsuario()
    {
        global $Cookie;
        if(isset($_COOKIE['Usuario']))
        {
        $Cookie = $_COOKIE['Usuario'];

        global $idCache;

        $idCache = "k".trim($Cookie);

        $Valido = Cache::remember($idCache, '10800', function () {
            global $Cookie;
            $Validoo = DB::table('usuarios')
            ->where('sesion', $Cookie)->count();
            return $Validoo;
            });

        if($Valido > 0)
        {
                return true;
        }
        else
        {
                return false;
        }
    }
    else {
    return false;
    }
    }

    public function idUsuario()
    {
        global $Cookie;
        if(isset($_COOKIE['Usuario']))
        {
        $Cookie = $_COOKIE['Usuario'];

        global $idCache;

        $idCache = "kk".trim($Cookie);

        $Valido = Cache::remember($idCache, '10800', function () {
            global $Cookie;
            $Validoo = DB::table('usuarios')
            ->where('sesion', $Cookie)->count();
            return $Validoo;
            });

        if($Valido > 0)
        {
            $UsuarioIDd = DB::table('usuarios')
            ->where('sesion', $Cookie)->value('id');
            return $UsuarioIDd;

        }
        else
        {
                return "0";
        }
    }
    }

}