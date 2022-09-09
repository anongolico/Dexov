@forelse ($Denuncias->sortByDesc('fecha') as $Den)
<a class="AlertW" href="/leerD/{!! $Den->id !!}">
    {!! $Den->motivo !!}
</a>
@empty
<div class="AlertW">No hay denuncias</div>
@endforelse