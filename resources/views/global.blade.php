<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('titulo')</title>
<link rel="stylesheet" type="text/css" href="/public/css/app.css?ver=2718" />
@yield('thread')
</head>
<body>
<div class="Header">
<div class="Logo" onclick="location.href='/'"></div>
<div id="Noti" style="display: none;"></div>
<div id="Den" style="display: none;"></div>
@if (app('App\Usuario')->esUsuario())
<div class="USOPC">
@if (app('App\Moderacion')->nivelMod() > 0)
<div class="BotonUSOPC" id="BotonDen" onclick="General.DenC()">
<div id="NotiDen"></div>
<div id="DenC" class="DenC">
</div>
</div>
@endif
<div class="BotonUSOPC" id="BotonNoti" onclick="General.NotiC()">
<div id="NotiNU"></div>
<div id="NotiC" class="NotiC"></div>
</div>
<div class="BotonUSOPC" onclick="General.MenuL()">
<div class="DesplegarC"></div>
</div>
<div class="Crear" onclick="General.Nuevo()">
<div class="CrearI"></div>
</div>
</div>
@else
<div class="USOPC">
    <div class="BotonUSOPC" onclick="General.ModalREG()">
    <div class="DesplegarC"></div>
    </div>
    <div class="Crear" onclick="General.ModalREG()">
    <div class="CrearI"></div>
    </div>
</div>

<div class="ModalReg">
    <form action="/registro" method="post" id="registration_form">
    
    <div class="ModalRegT">Al registrarte y empezar a participar del sitio, aceptas las siguientes reglas:</div>
    <div class="ModalRegConds">
    <div class="ModalRegCond">-Esta totalmente prohibido publicar material ilegal o promover la publicacion del mismo</div>
    <div class="ModalRegCond">-Esta totalmente prohibido publicar datos personales sin el consentimiento del titular</div>
    <div class="ModalRegCond">-Se prohibe absolutamente la apologia de cualquier tipo de delito</div>
    <div class="ModalRegCond">-NO esta permitido hacer SPAM</div>
    <div class="ModalRegS">El incumplimiento de cualquiera de estas reglas tendra como consecuencia el baneo y la prohibicion de usar el sitio</div>
    </div>
    <input type="submit" class="ModalRegB" name="regsubmit" value="ACEPTAR" />
    </form>
    </div>


@endif
</div>
<div class="Main">
<div id="NotiM" style="display: none;">TENES NOTIFICACIONES NUEVAS!</div>
@yield('contenido')
<div class="ModalBackN"></div>
<div class="ModalBackNN"></div>
<div class="ModalBackNN2"></div>
<div class="ModalBackNNN"></div>
<div class="ModalN"></div>
<div class="CargandoNr"></div>
<div class="ModalD">
<div class="CargandoGr"></div>
</div>
<div class="ModalB">
<div class="CargandoGr"></div>
</div>
<div class="ModalT"></div>

<div class="MenuLateral">
    <a href="/favoritos"><div class="OPCMenuLateral">VER MIS FAVORITOS</div></a>
    <a href="/ocultos"><div class="OPCMenuLateral">VER MIS OCULTOS</div></a>
    <div class="OPCMenuLateralC">CATEGORIAS</div>
    <div class="OPCMenuLateralCH">
        <a href="ANM"><div class="OPCMenuLateralCHC">Anime</div></a>
        <a href="ART"><div class="OPCMenuLateralCHC">Arte</div></a>
        <a href="CNC"><div class="OPCMenuLateralCHC">Ciencia</div></a>
        <a href="CIN"><div class="OPCMenuLateralCHC">Cine y Television</div></a>
        <a href="OFF"><div class="OPCMenuLateralCHC">General</div></a>
    <a href="HMR"><div class="OPCMenuLateralCHC">Humor</div></a>
    <a href="MUS"><div class="OPCMenuLateralCHC">Musica</div></a>
    <a href="NOT"><div class="OPCMenuLateralCHC">Noticias</div></a>
    <a href="PAR"><div class="OPCMenuLateralCHC">Paranormal</div></a>
    <a href="POL"><div class="OPCMenuLateralCHC">Politica</div></a>
    <a href="RAN"><div class="OPCMenuLateralCHC">Random</div></a>
    <a href="TEC"><div class="OPCMenuLateralCHC">Tecnologia</div></a>
    <a href="HOT"><div class="OPCMenuLateralCHC">Sexy</div></a>
    </div>
    </div>

<div class="ModalR"></div>
<div class="CargandoGr"></div>
<div class="CargandoDr"></div>
</div>
<img style="position: absolute; top: -1000px;" src="/public/IMG/CargandoNr.svg" width="10" height="10" alt="" />
<img style="position: absolute; top: -1000px;" src="/public/IMG/CargandoGr.svg" width="10" height="10" alt="" />
<img style="position: absolute; top: -1000px;" src="/public/IMG/CargandoC.svg" width="10" height="10" alt="" />
<img style="position: absolute; top: -1000px;" src="/public/IMG/Cargando.svg" width="10" height="10" alt="" />
<img style="position: absolute; top: -1000px;" src="/public/IMG/CargandoCr.svg" width="10" height="10" alt="" />
<img style="position: absolute; top: -1000px;" src="/public/IMG/CargandoDr.svg" width="10" height="10" alt="" />
<img style="display: none;" src="/task" width="1" height="1" alt="" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js?ver=2512"></script>
<script type="text/javascript" src="/public/js/jquery.nice-select.min.js?ver=2512"></script>
<script type="text/javascript" src="/public/js/app.js?ver=2512"></script>
    <script type="text/javascript">
    var usuario = '{{ app('App\Usuario')->idUsuario() }}';
    var nivel = '{{ app('App\Moderacion')->nivelMod() }}';
    </script>
@yield('jsHilo')
</body>
</html>