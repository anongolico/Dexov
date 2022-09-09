var General = {
    init: function() {
        return "undefined" != typeof RecargHab && null !== RecargHab || (RecargHab = ""), "undefined" != typeof RecargHabT && null !== RecargHabT || (RecargHabT = ""),
        "undefined" != typeof pagina && null !== pagina || (pagina = 1), !0
    },
    MenuL: function() {
        $(".MenuLateral").is(":hidden") ? ($(".MenuLateral").show(), $(".MenuLateral").animate({
            right: "0"
        }, 200)) : ($(".MenuLateral").animate({
            right: "-300"
        }, 200), $(".MenuLateral").hide(250))
    },
    Banear: function(e) {
        $(".ModalBackNN").fadeIn(50), $(".CargandoDr").fadeIn(100), $(".ModalB").removeClass("Exito"), $(".ModalB").removeClass("Fracaso"), $(".ModalB").empty(), General.ModalBan("/mod/banear", e), $(".PCMenu").hide(), $(".ModalBackNNN").hide()
    },
    Favorito: function(e) {
        return $.ajax({
            type: "GET",
            data: '',
            url: "/fav/" + e,
            async: true,
            dataType: "html",
            complete: function(e) {
                General.Fav(e)
            }
        }), !1
    },
    Fav: function(e) {
        var o = JSON.parse(e.responseText);
        if ("agregado" === o.favorito) {
            var t = '<div class="DTitulo">AGREGADO A FAVORITOS</div>';
            $(".ModalR").addClass("Exito"), $(".ModalR").empty(200), $(t).appendTo(".ModalR"), $(".ModalR").fadeIn(300), $(".ModalR").fadeOut(600), $("#TBotonFI").attr('id', 'TBotonFIa')
        }
        if ("quitado" === o.favorito) {
            t = '<div class="DTitulo">QUITADO DE FAVORITOS</div>';
            $(".ModalR").addClass("Exito"), $(".ModalR").empty(200), $(t).appendTo(".ModalR"), $(".ModalR").fadeIn(300), $(".ModalR").fadeOut(600), $("#TBotonFIa").attr('id', 'TBotonFI')
        }
    },
    Oculto: function(e) {
        return $.ajax({
            type: "GET",
            data: '',
            url: "/ocu/" + e,
            async: true,
            dataType: "html",
            complete: function(e) {
                General.Ocu(e)
            }
        }), !1
    },
    Ocu: function(e) {
        var o = JSON.parse(e.responseText);
        if ("agregado" === o.favorito) {
            var t = '<div class="DTitulo">AGREGADO A OCULTOS</div>';
            $(".ModalR").addClass("Exito"), $(".ModalR").empty(200), $(t).appendTo(".ModalR"), $(".ModalR").fadeIn(300), $(".ModalR").fadeOut(600), $("#TBotonOI").attr('id', 'TBotonOIa')
        }
        if ("quitado" === o.favorito) {
            t = '<div class="DTitulo">QUITADO DE OCULTOS</div>';
            $(".ModalR").addClass("Exito"), $(".ModalR").empty(200), $(t).appendTo(".ModalR"), $(".ModalR").fadeIn(300), $(".ModalR").fadeOut(600), $("#TBotonOIa").attr('id', 'TBotonOI')
        }
    },
    enviarDenunciaa: function(e) {
        $(".DBoton").addClass("pocoVisible")
        var a = $("#formDen").serialize();
        return $.ajax({
            type: "POST",
            url: "/Gdenunciarr",
            async: true,
            data: a,
            dataType: "html",
            complete: function(e, a) {
                General.DenunciaHecha(e, a)
            }
        }), !1
    },
    enviarDenuncia: function(e) {
        $(".DBoton").addClass("pocoVisible")
        var a = $("#formDen").serialize();
        return $.ajax({
            type: "POST",
            url: "/Gdenunciar",
            async: true,
            data: a,
            dataType: "html",
            complete: function(e, a) {
                General.DenunciaHecha(e, a)
            }
        }), !1
    },
    DenunciaHecha: function(e, a) {
        var o = JSON.parse(e.responseText);
        if ("Correcto" === o.mensajee) {
            var t = '<div class="DTitulo">DENUNCIA ENVIADA</div>';
            $(".ModalR").addClass("Exito"), $(".ModalBackN").hide(), $(".ModalR").empty(200), $(t).appendTo(".ModalR"), $(".ModalR").fadeOut(500), $(".ModalBackNN").hide(), $(".ModalBackNN2").hide()
        }
        if ("Flood" === o.mensajee) {
            t = '<div class="DTitulo">FLOOD</div>';
            $(".ModalR").addClass("Fracaso"), $(".ModalBackN").hide(), $(".ModalR").empty(200), $(t).appendTo(".ModalR"), $(".ModalR").fadeOut(500), $(".ModalBackNN").hide(), $(".ModalBackNN2").hide()
        }
        if (!o.mensajee) {
            $(".ErroresD").empty();
            var n = o.erroresD;
            $("<div>" + n + "</div>").appendTo(".ErroresD"), $(".ErroresD").fadeIn(100);
            $(".DBoton").removeClass("pocoVisible")
        }
    },
    enviarBan: function(e) {
        $(".DBoton").addClass("pocoVisible")
        var a = $("#formBan").serialize();
        return $.ajax({
            type: "POST",
            url: "/mod/Gbanear",
            async: true,
            data: a,
            dataType: "html",
            complete: function(e, a) {
                General.BanHecho(e, a)
            }
        }), !1
    },
    BanHecho: function(e, a) {
        var o = JSON.parse(e.responseText);
        if ("Correcto" === o.mensajee) {
            var t = '<div class="DTitulo">USUARIO BANEADO</div>';
            $(".ModalB").addClass("Exito"), $(".ModalBackN").hide(), $(".ModalB").empty(200), $(t).appendTo(".ModalB"), $(".ModalB").fadeOut(500), $(".ModalBackNN").hide(), $(".ModalBackNN2").hide()
        }
    },
    BorrarCa: function(cat, id) {
        return $.ajax({
                type: "GET",
                data: '',
                url: "/mod/recat/" + cat + "/" + id,
                async: true,
                complete: function() {
                    location.reload();
                }
            }), !1
        },
    TSticky: function(e) {
        return $.ajax({
                type: "GET",
                data: '',
                url: "/mod/sticky/" + e,
                async: true,
                complete: function() {
                    location.reload();
                }
            }), !1
        },
    TBorrarP: function(e) {
            return $.ajax({
                    type: "GET",
                    data: '',
                    url: "/mod/borrarHiloP/" + e,
                    async: true,
                    complete: function() {
                        location.reload();
                    }
                }), !1
            },
    TBorrar: function(e) {
        return $.ajax({
                type: "GET",
                data: '',
                url: "/mod/borrarHilo/" + e,
                async: true,
                complete: function() {
                    $("#TBorRes"+e).attr("onclick","General.TRestaurar('"+e+"')");
                    $("#TBorResI"+e).addClass("TBotonMBIa");
                }
            }), !1
        },
    TRestaurar: function(e) {
            return $.ajax({
                    type: "GET",
                    data: '',
                    url: "/mod/resHilo/" + e,
                    async: true,
                    complete: function() {
                        $("#TBorRes"+e).attr("onclick","General.TBorrar('"+e+"')");
                        $("#TBorResI"+e).removeClass("TBotonMBIa");
                    }
                }), !1
            },
    Borrar: function(e) {
    return $.ajax({
            type: "GET",
            data: '',
            url: "/mod/borrarComentario/" + e,
            async: true,
            complete: function() {
                $("#pid"+e).addClass("PBorrado");
                $("#BorRes"+e).attr("onclick","General.Restaurar('"+e+"')");
                $("#BorRes"+e).text("RESTAURAR");
                $(".PCMenu").hide();
                $(".ModalBackNNN").hide();
            }
        }), !1
    },
    Restaurar: function(e) {
        return $.ajax({
                type: "GET",
                data: '',
                url: "/mod/resComentario/" + e,
                async: true,
                complete: function() {
                    $("#pid"+e).removeClass("PBorrado");
                    $("#BorRes"+e).attr("onclick","General.Borrar('"+e+"')");
                    $("#BorRes"+e).text("BORRAR");
                    $(".PCMenu").hide();
                    $(".ModalBackNNN").hide();
                }
            }), !1
    },
    BorrarP: function(e) {
        return $.ajax({
                type: "GET",
                data: '',
                url: "/mod/borrarComentarioP/" + e,
                async: true,
                complete: function() {
                    $("#pid"+e).remove();
                    $(".PCMenu").hide();
                    $(".ModalBackNNN").hide();
                }
            }), !1
        },
    Crear: function(e) {
        var a = $("#formCrear")[0],
            o = new FormData(a);
        return $.ajax({
            url: "/Hcreacion",
            type: "POST",
            async: true,
            processData: !1,
            contentType: !1,
            data: o,
            dataType: "html",
            complete: function(e, a) {
                General.Creado(e, a)
            }
        }), !1
    },
    Creado: function(e, a) {
        console.log(e.responseText);
        var o = JSON.parse(e.responseText);
        if ("OK" === o.errores) {
            var t = o.link;
            window.location.href = "/Hilo/" + t
        }
        else {
            $(".Errores").empty();
            var n = o.errores;
            $("<div>" + n + "</div>").appendTo(".Errores"), $(".Errores").fadeIn(100), $(".cargaT").fadeOut(50), $(".BotonT").fadeIn(100)
        }
    },
    CMostrarM: function(e, a) {
        if (window.innerWidth < 1023) {
        var o = document.getElementsByClassName("RESC");
        $(o).remove()
        $("#pid" + e).clone().prop("id", "T020120120M").prop("class", "RESC").appendTo("#pid" + a).animate({"opacity":"show",top:"50%"},100);
$('.RESC').addClass('T020120120MM');
$('.RESC').find('.Respuestas').addClass('RespuestasM');
$('.RESC').find('.PFecha').remove();
$(".ModalBackNN").show();
$(".ModalBackNN").click(function() {
$(".ModalBackNN").hide(), $(".RESC").remove()
})}
else {
    window.location.href = "#pid" + e;
     }
    },
    RMostrarM: function(e, a) {
        if (window.innerWidth < 1023) {
        var o = document.getElementsByClassName("RESC");
        $(o).remove()
        $("#pid" + e).clone().prop("id", "T020120120M").prop("class", "RESC").appendTo(".ResF").animate({"opacity":"show",top:"50%"},100);
$('.RESC').find('.PTexto').addClass('PTextoo');
$('.RESC').find('.Respuestas').addClass('RespuestasM');
$('.RESC').find('.PFecha').remove();
$(".ModalBackNN").show();
$(".ModalBackNN").click(function() {
$(".ModalBackNN").hide(), $(".RESC").remove()
})}
else {
    window.location.href = "#pid" + e;
     }
    },
    CMostrar: function(e, a) {
        window.innerWidth > 1023 && $("#pid" + e).clone().prop("id", "T020120120").prop("class", "RESC").appendTo("#pid" + a).animate({"opacity":"show",top:"50%"},150);
    },
    COcultar: function(e, a) {
        if (window.innerWidth > 1023) {
            var o = document.getElementsByClassName("RESC");
            $(o).remove()
        }
    },
    RMostrar: function(e, a) {
        window.innerWidth > 1023 && $("#pid" + e).clone().prop("id", "T020120120x").prop("class", "RESC").appendTo(".ResF").animate({"opacity":"show",top:"0"},150);
    },
    ModOPC: function() {
        $(".ModOPCt").is(":hidden") ? $(".ModOPCt").show(100) : $(".ModOPCt").hide(100)
    },
    HiloOver: function(e) {
        $("#" + e).addClass("HiloOverOver", {
            duration: 500
        })
    },
    HiloROver: function(e) {
        $("#" + e).removeClass("HiloOverOver", {
            duration: 500
        })
    },
    IOver: function() {
        $(".HHiloIO").addClass("HiloOverOver", {
            duration: 500
        })
    },
    IROver: function() {
        $(".HHiloIO").removeClass("HiloOverOver", {
            duration: 500
        })
    },
    ComentarioM: function(e) {
        $("#MenuM" + e).show(100), $(".ModalBackNNN").show(), $(".ModalBackNNN").click(function() {
            $(".ModalBackNNN").hide(), $(".PCMenu").hide()
        })
    },
    RecatM: function(e) {
        $("#MenuMT").show(100), $(".ModalBackNNN").show(), $(".ModalBackNNN").click(function() {
            $(".ModalBackNNN").hide(), $(".PCMMenu").hide()
        })
    },
    VYT: function(e) {
        var a = '<iframe class="YTVideo" src="https://www.youtube.com/embed/' + e + '"></iframe>';
        $(".HHiloIM").remove(), $(".YTIct").remove(), $(".VideoYT").append(a)
    },
    VYTc: function(e, a) {
        var o = '<iframe class="YTVideoc" src="https://www.youtube.com/embed/' + e + '"></iframe>';
        $("#HV" + a).remove(), $("#YT" + a).append(o)
    },
    VIDc: function(e, a) {
        var o = '<div class="VideoContenedor" style="cursor: pointer;"><video class="VideoDDc" preload="metadata" controls><source src="/' + e + '#t=0.1" /></video></div>';
        $("#HVV" + a).remove(), $("#YT" + a).append(o)
    },
    Responder: function(e) {
        var comm = "'";
        $(".Respondiendo").empty(), $('<div class="Respondiendo">EN RESPUESTA A: <a onclick="General.RMostrarM('+comm + e + comm+');"  onmouseover="General.RMostrar('+comm + e + comm+');" onmouseleave="General.COcultar();" class="RespondiendoT" href="javascript:void(0);">#' + e + "</a></div>").prependTo(".ResF"), $("#cita").val(e), window.innerWidth > 1023 ? $("html, body").animate({
            scrollTop: 0
        }, "fast") : $("html, body").animate({
            scrollTop: $(".Respondiendo").offset().top - 58
        }, "fast")
    },
    NotiC: function() {
        $("#Noti").empty(), $(".ModalN").empty(), $(".ModalBackN").slideToggle(.1), $(".ModalN").slideToggle(.1), $(".CargandoNr").fadeIn(100), General.ModalNoti("/notificaciones/" + usuario), $(".CargandoNr").fadeOut(100), $("#NotiNU").text(""), $("#NotiC").removeClass("Act"), $("#NotiM").hide(), document.title = titulo
    },
    DenC: function () {
        $(".ModalD").empty(), $(".ModalBackN").slideToggle(.1), $(".ModalD").slideToggle(.1), $(".CargandoNr").fadeIn(100), General.ModalDenM("/denuncias"), $(".CargandoNr").fadeOut(100);
    },
    Denunciar: function(e) {
        $(".ModalBackNN").fadeIn(50), $(".CargandoDr").fadeIn(100), $(".ModalR").removeClass("Exito"), $(".ModalR").removeClass("Fracaso"), $(".ModalR").empty(), General.ModalDEN("/denunciar", e), $(".PCMenu").hide(), $(".ModalBackNNN").hide()
    },
    Denunciarr: function(e) {
        $(".ModalBackNN").fadeIn(50), $(".CargandoDr").fadeIn(100), $(".ModalR").removeClass("Exito"), $(".ModalR").removeClass("Fracaso"), $(".ModalR").empty(), General.ModalDEN("/denunciarr", e), $(".PCMenu").hide(), $(".ModalBackNNN").hide()
    },
    Nuevo: function() {
        $(".ModalT").empty(), $(".ModalBackNN").fadeIn(50), $(".CargandoGr").fadeIn(100), General.ModalCrear("/crear")
    },
    ModalREG: function() {
        $(".ModalReg").show(100), $(".ModalBackNNN").show(), $(".ModalBackNNN").click(function() {
            $(".ModalBackNNN").hide(), $(".ModalReg").hide()
        })
    },
    ModalNoti: function(e) {
        $.get(e, function(e) {
            $(".ModalN").empty(), $(e).appendTo(".ModalN")
        }), $(".ModalBackN").click(function() {
            $(".ModalBackN").hide(), $(".ModalN").hide()
        })
    },
    ModalBan: function(e, a) {
        $.get(e, function(e) {
            $(e).appendTo(".ModalB"), $(".ModalB").fadeIn(50), $('#idPP').val(a), $(".ModalBackNN2").slideToggle(.1);
        }), 
        $(".CargandoDr").fadeOut(50);
        $(".ModalBackNN2").click(function () {
            $(".ModalBackNN2").hide(), $(".ModalBackNN").hide(), $(".ModalB").hide(), $(".ModalB").empty();
        });
    },
    ModalDenM: function(e) {
        $.get(e, function(e) {
            $(".ModalD").empty(), $(e).appendTo(".ModalD")
        }), $(".ModalBackN").click(function() {
            $(".ModalBackN").hide(), $(".ModalD").hide()
        })
    },
    ModalDEN: function (e, a) {
        $.get(e, function (e) {
            $(e).appendTo(".ModalR"), $(".ModalR").fadeIn(50), $('#idP').val(a), $(".ModalBackNN2").slideToggle(.1);
        }),
            $(".CargandoDr").fadeOut(50);
            $(".ModalBackNN2").click(function () {
                $(".ModalBackNN2").hide(), $(".ModalBackNN").hide(), $(".ModalR").hide(), $(".ModalR").empty();
            });
    },
    ModalCrear: function(e) {
        $.get(e, function(e) {
            $(e).appendTo(".ModalT"), $(".Errores").hide(), $(".ModalT").fadeIn(50), $(".ModalBackNN2").slideToggle(.1);
        }), 
        $(".CargandoGr").fadeOut(50);
        $(".ModalBackNN2").click(function () {
            $(".ModalBackNN2").hide(), $(".ModalBackNN").hide(), $(".ModalT").hide(), $(".ModalT").empty();
        });
    },
    formCerrar: function() {
        $(".ModalBackNN").hide(), $(".ModalBackNN2").hide(), $(".ModalT").hide(), $(".ModalT").empty()
    },
    ModalYT: function() {
        $("#YTBLink").appendTo(".ModalYT").show(10), $(".ModalBackN").fadeIn(200), $(".ModalYT").fadeIn(200), $("#BTNOk").click(function() {
            $(".ModalBackN").hide(), $(".ModalYT").hide()
        }), $(".ModalBackN").click(function() {
            $(".ModalBackN").hide(), $(".ModalYT").hide()
        })
    },
    ModalYTt: function() {
        $("#YTBLinkt").appendTo(".ModalYTt").show(10), $(".ModalBackN").fadeIn(200), $(".ModalYTt").fadeIn(200), $("#BTNOk").click(function() {
            $(".ModalBackN").hide(), $(".ModalYTt").hide()
        }), $(".ModalBackN").click(function() {
            $(".ModalBackN").hide(), $(".ModalYTt").hide()
        })
    }
},
titulo = (" " + document.title);
function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";               

    document.cookie = name + "=" + value + expires + "; path=/";
};
function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}
$(document).ready(function () {
    if($('#Clase').is('.Clase1')){
    setTimeout(function () {
        var e = $("#textHH").text();
        if (e > 30) {
        $("#CargarMas").show();
        }
        }, 10);
    $("#CargarMas").on('click', function () {
        $("#CargarMas").hide();
        if (getCookie('pagina') == 1) {
        $.get('/pagina/1', function(e) {
            var ex = $("#textHH").text();
            var x = $(e).filter(".Hilox");
            $('#ListaH').append(x);  
            $(x).fadeIn(500);
            setTimeout(function () {
                createCookie('pagina', '2');
                if (ex > 60) {
                    $("#CargarMas").show(100);
                    }
            }, 10);
          });
        }
        if (getCookie('pagina') == 2) {
            $.get('/pagina/2', function(e) {
                var ex = $("#textHH").text();
                var x = $(e).filter(".Hilox");
                $('#ListaH').append(x);  
                $(x).fadeIn(500);
                setTimeout(function () {
                    createCookie('pagina', '3');
                    if (ex > 90) {
                        $("#CargarMas").show(100);
                        }
                }, 10);
              });
        }
        if (getCookie('pagina') == 3) {
            $.get('/pagina/3', function(e) {
                var ex = $("#textHH").text();
                var x = $(e).filter(".Hilox");
                $('#ListaH').append(x);  
                $(x).fadeIn(500);
                setTimeout(function () {
                    createCookie('pagina', '4');
                    if (ex > 120) {
                        $("#CargarMas").show(100);
                        }
                }, 10);
              });
        }
        if (getCookie('pagina') == 4) {
            $.get('/pagina/4', function(e) {
                var ex = $("#textHH").text();
                var x = $(e).filter(".Hilox");
                $('#ListaH').append(x);  
                $(x).fadeIn(500);
                setTimeout(function () {
                    createCookie('pagina', '5');
                    if (ex > 150) {
                        $("#CargarMas").show(100);
                        }
                }, 10);
              });
        }
        if (getCookie('pagina') == 5) {
            $.get('/pagina/5', function(e) {
                var ex = $("#textHH").text();
                var x = $(e).filter(".Hilox");
                $('#ListaH').append(x);  
                $(x).fadeIn(500);
                setTimeout(function () {
                    createCookie('pagina', '6');
                }, 10);
              });
        }
    });}
    createCookie('pagina', '1');
    if (usuario > '1') {
        $("#Noti").load("/contarN/" + usuario + " #Notificaciones"),
        setTimeout(function () {
            var e = $("#Noti").text();
            if (e.length > 0) {
                $("#NotiC").addClass("Act");
                var a = $("#Noti").text().replace("(", "").replace(")", "");
                $("#NotiNU").text(a), $("#NotiM").show();
            }
            document.title = e + titulo;
        }, 500),
        setInterval(function () {
            $("#Noti").load("/contarN/" + usuario + " #Notificaciones");
            var e = $("#Noti").text();
            if (e.length > 0) {
                $("#NotiC").addClass("Act");
                var a = $("#Noti").text().replace("(", "").replace(")", "");
                $("#NotiNU").text(a), $("#NotiM").show();
            } else {
                $("#NotiC").removeClass("Act");
                a = $("#Noti").text().replace("(", "").replace(")", "");
                $("#NotiNU").text(a), $("#NotiM").hide();
            }
            document.title = e + titulo;
        }, 3000)
        };
    if (nivel != '0') {
        $("#Den").load("/contarD #Den"),
        setTimeout(function () {
            $("#Den").text() != 0 && $("#DenC").addClass("Act");
        }, 500),
        setInterval(function () {
            $("#Den").load("/contarD #Den");
        }, 3000),
        setInterval(function () {
            $("#Den").text() != 0 ? $("#DenC").addClass("Act") : $("#DenC").removeClass("Act");
        }, 3000)
    };
    $("#TBYoutube").bind("input", function () {
        $(".IFYi").addClass("rojito");
    }),
        $("#TBYoutubet").bind("input", function () {
            $(".IFYit").addClass("rojito");
        }),
        $("select").niceSelect(),
        $("#filex").change(function () {
            $(".IFMi").addClass("rojito");
        }),
        $("#filext").change(function () {
            $(".IFMit").addClass("rojito");
        }),
        $(".BotonT").click(function () {
            $(this).fadeOut(50), $(".cargaT").fadeIn(100);
        }),
        $(".BotonRES").click(function () {
            $(this).fadeOut(50), $(".cargaC").fadeIn(100);
        }),
        window.intervalo = setInterval(function () {
            var e = $("#textH").text() - $("#textHH").text();
            e > 0 && ($("#textHHH").empty(), $("#textHHH").append(e), $(".ListaHR").addClass("display"), (RecargHabT = 1));
            $("#textH").load("/contarH #Hilos");
        }, 2000);
}),
General.RecargarH = function() {
if (!(RecargHabT > 0)) return !1;
clearInterval(window.intervalo);
var e = $("#textHHH").text();
$.get("/actualizarH/" + e, function(e) {
    var x = $(e).filter(".Hiloxx");
    var a = $(e).filter(".Hilox");
    $('.Hiloxx').each(function() {
    $(this).remove();
    }),
    $("#ListaH").prepend(a);
    $(a).fadeIn(300);
    $("#ListaH").prepend(x);
}), $("#textHH").load("/contarH #Hilos"), $("#textHHH").empty(), $(".ListaHR").removeClass("display"), RecargHabT = 0;
window.intervalo = setInterval(function () {
    var e = $("#textH").text() - $("#textHH").text();
    e > 0 && ($("#textHHH").empty(), $("#textHHH").append(e), $(".ListaHR").addClass("display"), (RecargHabT = 1));
    $("#textH").load("/contarH #Hilos");
}, 2000);
};
jQuery, General.init();