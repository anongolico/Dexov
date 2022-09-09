<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hilos extends Model
{
    static function ListadeHilos()
    {
        $ListaHilos = DB::table('hilos')->where('visible', '1')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeHilosM()
    {
        $ListaHilos = DB::table('hilos')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeAnime()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'ANM')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeAnimeM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'ANM')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeArte()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'ART')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeArteM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'ART')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeCiencia()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'CNC')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeCienciaM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'CNC')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeCine()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'CIN')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeCineM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'CIN')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeGeneral()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'OFF')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeGeneralM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'OFF')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeHumor()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'HMR')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeHumorM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'HMR')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeMusica()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'MUS')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeMusicaM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'MUS')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeNoticias()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'NOT')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeNoticiasM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'NOT')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }    

    static function ListadeParanormal()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'PAR')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeParanormalM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'PAR')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadePolitica()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'POL')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadePoliticaM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'POL')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeRandom()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'RAN')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeRandomM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'RAN')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeTecnologia()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'TEC')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeTecnologiaM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'TEC')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeSexy()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'HOT')->where('visible', '1')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeSexyM()
    {
        $ListaHilos = DB::table('hilos')->where('categoria', 'HOT')->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->orderByDesc('sticky')->orderByDesc('ucomentario')
        ->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeHilosF($id)
    {
        $ListaFavs = DB::table('usuarios')->where('id', $id)->value('favoritos');

        $ListaFavs = explode (",", $ListaFavs);
        
        $ListaHilos = DB::table('hilos')->where('visible', '1')->orderByDesc('sticky')->orderByDesc('ucomentario')->whereIn('id', ($ListaFavs))
        ->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->limit('30')->get();

        return $ListaHilos;
    }

    static function ListadeHilosO($id)
    {
        $ListaOcu = DB::table('usuarios')->where('id', $id)->value('ocultos');

        $ListaOcu = explode (",", $ListaOcu);

        $ListaHilos = DB::table('hilos')->where('visible', '1')->orderByDesc('sticky')->orderByDesc('ucomentario')->whereIn('id', ($ListaOcu))
        ->select('id', 'titulo', 'imagen', 'fecha', 'sticky', 'ucomentario', 'Video', 'VYT', 'categoria', 'comentarios', 'visible')->limit('30')->get();

        return $ListaHilos;
    }
    
}