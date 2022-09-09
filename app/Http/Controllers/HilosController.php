<?php

namespace App\Http\Controllers;

use App\Hilos;
use App\Moderacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use App\Usuario;

class HilosController extends Controller
{
    public function index()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('Hilos', '5', function () {
            return Hilos::ListadeHilos();
        });
        }
        else
        {
        $Hilos = Cache::remember('HilosM', '5', function () {
            return Hilos::ListadeHilosM();
        });
        }
        
        $Cantidad = Cache::remember('Cantidad', '5', function () {
            $CantidadH = DB::table('hilos')->count();
            return $CantidadH;
        });

        $Clase = "Clase1";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function anime()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('anime', '5', function () {
            return Hilos::ListadeAnime();
        });
        }
        else
        {
        $Hilos = Cache::remember('animeM', '5', function () {
            return Hilos::ListadeAnimeM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }
    
    public function arte()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('arte', '5', function () {
            return Hilos::ListadeArte();
        });
        }
        else
        {
        $Hilos = Cache::remember('arteM', '5', function () {
            return Hilos::ListadeArteM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function ciencia()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('ciencia', '5', function () {
            return Hilos::ListadeCiencia();
        });
        }
        else
        {
        $Hilos = Cache::remember('cienciaM', '5', function () {
            return Hilos::ListadeCienciaM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function cine()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('cine', '5', function () {
            return Hilos::ListadeCine();
        });
        }
        else
        {
        $Hilos = Cache::remember('cineM', '5', function () {
            return Hilos::ListadeCineM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function general()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('general', '5', function () {
            return Hilos::ListadeGeneral();
        });
        }
        else
        {
        $Hilos = Cache::remember('generalM', '5', function () {
            return Hilos::ListadeGeneralM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function humor()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('humor', '5', function () {
            return Hilos::ListadeHumor();
        });
        }
        else
        {
        $Hilos = Cache::remember('humorM', '5', function () {
            return Hilos::ListadeHumorM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function musica()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('musica', '5', function () {
            return Hilos::ListadeMusica();
        });
        }
        else
        {
        $Hilos = Cache::remember('musicaM', '5', function () {
            return Hilos::ListadeMusicaM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function noticias()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('noticias', '5', function () {
            return Hilos::ListadeNoticias();
        });
        }
        else
        {
        $Hilos = Cache::remember('noticiasM', '5', function () {
            return Hilos::ListadeNoticiasM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function paranormal()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('paranormal', '5', function () {
            return Hilos::ListadeParanormal();
        });
        }
        else
        {
        $Hilos = Cache::remember('paranormalM', '5', function () {
            return Hilos::ListadeParanormalM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function politica()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('politica', '5', function () {
            return Hilos::ListadePolitica();
        });
        }
        else
        {
        $Hilos = Cache::remember('politicaM', '5', function () {
            return Hilos::ListadePoliticaM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function random()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('random', '5', function () {
            return Hilos::ListadeRandom();
        });
        }
        else
        {
        $Hilos = Cache::remember('randomM', '5', function () {
            return Hilos::ListadeRandomM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function tecnologia()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('tecnologia', '5', function () {
            return Hilos::ListadeTecnologia();
        });
        }
        else
        {
        $Hilos = Cache::remember('tecnologiaM', '5', function () {
            return Hilos::ListadeTecnologiaM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function sexy()
    {
        $Moderacion = new Moderacion();
        if ($Moderacion->nivelMod() < 1) {
        $Hilos = Cache::remember('sexy', '5', function () {
            return Hilos::ListadeSexy();
        });
        }
        else
        {
        $Hilos = Cache::remember('sexyM', '5', function () {
            return Hilos::ListadeSexyM();
        });
        }
        
        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function favs()
    {
        $Usuario = new Usuario;
        $id = $Usuario->idUsuario();
        $Hilos = Hilos::ListadeHilosF($id);

        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }

    public function ocultos()
    {
        $Usuario = new Usuario;
        $id = $Usuario->idUsuario();
        $Hilos = Hilos::ListadeHilosO($id);

        $Cantidad = '999999999';

        $Clase = "Clase2";

        return view('Hilos', compact('Hilos', 'Cantidad', 'Clase'));
    }
}