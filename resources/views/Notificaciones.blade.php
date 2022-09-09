@forelse ($Notificaciones->sortByDesc('fecha') as $Noti)
<a class="AlertW" href="/leer/{!! $Noti->id !!}">
    <div class="NotiPortada">
    <img src="/public/Subidas/Miniaturas/{!! app('App\Notificaciones')->notiportada($Noti->id) !!}" />
    <div class="NotiPortadaO"></div>
    </div>
    {!! app('App\Notificaciones')->notititulo($Noti->id) !!}
</a>
@empty
<div class="AlertW">No tenes notificaciones</div>
@endforelse