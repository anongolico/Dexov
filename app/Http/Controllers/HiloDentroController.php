<?php

namespace App\Http\Controllers;

use App\HiloDentro;
use Illuminate\Http\Request;
use App\Usuario;
use App\Moderacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HiloDentroController extends Controller
{
    public function show($id)
    {
        global $idP;
        global $idPC;
        $idP = $id;
        $idPM = "M".trim($id);
        $idPC = "C".trim($id);
        $idPCM = "CM".trim($id);
        $idPCC = "CC".trim($id);

        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $HiloAbierto = Cache::remember($idP, '86400', function () {
            global $idP;
            return HiloDentro::HiloCont($idP);
        });
        }
        else {
        $HiloAbierto = Cache::remember($idPM, '86400', function () {
            global $idP;
            return HiloDentro::HiloContM($idP);
        });
        }

        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Comentarios = Cache::remember($idPC, '5', function () {
            global $idP;
            return HiloDentro::HiloCom($idP);
        });
        }
        else {
        $Comentarios = Cache::remember($idPCM, '5', function () {
            global $idP;
            return HiloDentro::HiloComM($idP);
        });
        }

        $CantidadC = Cache::remember($idPCC, '5', function () {
            global $idP;
            $CantidadCx = DB::table('comentarios')->where('hilo',$idP)->count();
            return $CantidadCx;
        });

        if ($HiloAbierto->count()) {
         return view('HiloAbierto', compact('HiloAbierto','Comentarios','CantidadC'));
        }
        else
        {
            header('Location: /');
            exit;
    }
    }

    public function existe($id)
    {
        $existe = DB::table('hilos')->where('id', $id)->count();
        if ($existe > 0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function fav($id)
    {
        if ($this->existe($id) > 0) {
        $Usuario = new Usuario();
        $UID = $Usuario->idUsuario();

        $favs = DB::table('usuarios')->where('id', $UID)
        ->value('favoritos');

        $favoritos = explode (",", $favs);

        if (($key = array_search($id, $favoritos)) !== false) {
        unset($favoritos[$key]);
        $favoritosx = array_unique($favoritos);
        $IDTHInsert = implode(',',$favoritosx);
	    $IDTHInsertx = ltrim($IDTHInsert,',');

        DB::table('usuarios')
        ->where('id', $UID)
        ->update(['favoritos' => $IDTHInsertx]);

        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("favorito" => "quitado"));
        }
        else
        {
            $favoritos[] = $id;
            $favoritosx = array_unique($favoritos);
            $IDTHInsert = implode(',',$favoritosx);
            $IDTHInsertx = ltrim($IDTHInsert,',');
    
            DB::table('usuarios')
            ->where('id', $UID)
            ->update(['favoritos' => $IDTHInsertx]);

            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("favorito" => "agregado"));
        }
    }
    }

    public function ocu($id)
    {
        if ($this->existe($id) > 0) {
        $Usuario = new Usuario();
        $UID = $Usuario->idUsuario();

        $favs = DB::table('usuarios')->where('id', $UID)
        ->value('ocultos');

        $favoritos = explode (",", $favs);

        if (($key = array_search($id, $favoritos)) !== false) {
        unset($favoritos[$key]);
        $favoritosx = array_unique($favoritos);
        $IDTHInsert = implode(',',$favoritosx);
	    $IDTHInsertx = ltrim($IDTHInsert,',');

        DB::table('usuarios')
        ->where('id', $UID)
        ->update(['ocultos' => $IDTHInsertx]);

        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("favorito" => "quitado"));
        }
        else
        {
            $favoritos[] = $id;
            $favoritosx = array_unique($favoritos);
            $IDTHInsert = implode(',',$favoritosx);
            $IDTHInsertx = ltrim($IDTHInsert,',');
    
            DB::table('usuarios')
            ->where('id', $UID)
            ->update(['ocultos' => $IDTHInsertx]);

            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("favorito" => "agregado"));
        }
    }
    }
}