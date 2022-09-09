<?php

use Illuminate\Routing\RouteAction;

Route::get('/', 'HilosController@index')->name('Hilos');
Route::get('/ANM', 'HilosController@anime')->name('Anime');
Route::get('/ART', 'HilosController@arte')->name('Arte');
Route::get('/CNC', 'HilosController@ciencia')->name('Ciencia');
Route::get('/CIN', 'HilosController@cine')->name('Cine');
Route::get('/OFF', 'HilosController@general')->name('General');
Route::get('/HMR', 'HilosController@humor')->name('Humor');
Route::get('/MUS', 'HilosController@musica')->name('Musica');
Route::get('/NOT', 'HilosController@noticias')->name('Noticias');
Route::get('/PAR', 'HilosController@paranormal')->name('Paranormal');
Route::get('/POL', 'HilosController@politica')->name('Politica');
Route::get('/RAN', 'HilosController@random')->name('Random');
Route::get('/TEC', 'HilosController@tecnologia')->name('Tecnologia');
Route::get('/HOT', 'HilosController@sexy')->name('Sexy');
Route::get('/pagina/{pagina}', 'ActualizadorController@pagina')->name('pagina');
Route::post('Hcreacion', 'CreacionController@Hilo')->name('CreacionH');
Route::get('/Hilo/{id}', 'HiloDentroController@show')->name('HiloDentro');
Route::post('Ccreacion', 'CreacionController@Comentario')->name('CreacionC');
Route::get('/actualizar/{hilo}/{limite}', 'ActualizadorController@Seet')->name('ActualizadorC');
Route::get('/contar/{hilo}/', 'ActualizadorController@See')->name('ContadorC');
Route::get('/actualizarH/{limite}/', 'ActualizadorController@Seeth')->name('ActualizadorH');
Route::get('/contarH', 'ActualizadorController@Seethh')->name('ContadorH');
Route::view('login', 'login')->name('Login');
Route::post('okLogin', 'LoginController@login')->name('okLogin');
Route::get('/contarN/{noti}/', 'ActualizadorController@noti')->name('ActualizadorN');
Route::get('/notificaciones/{uid}/', 'NotiController@notificaciones')->name('Notificaciones');
Route::get('/leer/{noti}/', 'NotiController@leerNoti')->name('LeerNotificacion');
Route::view('/crear', 'CrearHilo')->name('CrearHilo');
Route::get('/fav/{id}/', 'HiloDentroController@fav')->name('Favorito');
Route::get('/ocu/{id}/', 'HiloDentroController@ocu')->name('Oculto');
Route::get('/favoritos', 'HilosController@favs')->name('Favoritos');
Route::get('/ocultos', 'HilosController@ocultos')->name('Ocultos');
Route::view('/denunciar', 'Denunciar')->name('denunciar');
Route::view('/denunciarr', 'Denunciarr')->name('denunciarr');
Route::post('/Gdenunciar', 'DenunciasController@comentario')->name('Gdenunciar');
Route::post('/Gdenunciarr', 'DenunciasController@hilo')->name('Gdenunciarr');
Route::get('/contarD', 'ActualizadorController@den')->name('ActualizadorD');
Route::get('/denuncias', 'DenunciasController@denuncias')->name('Denuncias');
Route::get('/leerD/{id}/', 'DenunciasController@leerDen')->name('LeerDenuncia');
Route::get('/task', 'ControladorTareas@index')->name('task');
Route::view('/mod/banear', 'Banear')->name('banear');
Route::post('/mod/Gbanear', 'ModController@banear')->name('Gbanear');
Route::get('/mod/borrarComentario/{id}', 'ModController@borrarComentario')->name('borrarComentario');
Route::get('/mod/resComentario/{id}', 'ModController@resComentario')->name('resComentario');
Route::get('/mod/borrarComentarioP/{id}', 'ModController@borrarComentarioP')->name('borrarComentarioP');
Route::get('/mod/borrarHilo/{id}', 'ModController@borrarHilo')->name('borrarHilo');
Route::get('/mod/resHilo/{id}', 'ModController@resHilo')->name('resHilo');
Route::get('/mod/borrarHiloP/{id}', 'ModController@borrarHiloP')->name('borrarHiloP');
Route::get('/mod/sticky/{id}', 'ModController@sticky')->name('sticky');
Route::get('/mod/recat/{cat}/{id}', 'ModController@recat')->name('recat');
Route::get('/admin', 'ModController@admin')->name('admin');
Route::get('/admin/cuentas', 'ModController@aCuentas')->name('aCuentas');
Route::get('/admin/cuentas/editar/{id}', 'ModController@aCuentasE')->name('aCuentasE');
Route::post('/admin/cuentas/Geditar', 'ModController@aCuentasEg')->name('aCuentasEg');
Route::get('/admin/cuentas/crear', 'ModController@aCuentasCrear')->name('aCuentasCrear');
Route::post('/admin/cuentas/GadmCrear', 'ModController@aCuentasCrearG')->name('aCuentasCrearG');
Route::get('/admin/baneados', 'ModController@baneados')->name('baneados');
Route::get('/admin/baneados/levantar/{id}', 'ModController@levantarBan')->name('levantarBan');
Route::get('/admin/mantenimiento', 'ModController@mantenimiento')->name('mantenimiento');
Route::post('/registro', 'LoginController@registro')->name('registro');
Route::view('/flood', 'flood')->name('flood');
Route::get('/config-clearx12', function() {
    Artisan::call('config:clear');
});
Route::get('/cache-clearx12', function() {
    Artisan::call('cache:clear');
});
Route::get('/view-clearx12', function() {
    Artisan::call('view:clear');
});
Route::get('/route-clearx12', function() {
    Artisan::call('route:clear');
});
Route::get('/view-cachex12', function() {
    Artisan::call('view:cache');
});
Route::get('/config-cachex12', function() {
    Artisan::call('config:cache');
});