var Thread={init:function(){$(function(){Thread.initQuickReply()})},initQuickReply:function(){$("#formRes").length&&$("#formResSubmit").on("click",function(a){return Thread.quickReply(a)})},quickReply:function(a){if(a.stopPropagation(),this.quick_replying)return!1;var b=$("#formRes")[0],c=new FormData(b);return $.ajax({url:"/Ccreacion",type:"POST",async:!0,processData:!1,contentType:!1,data:c,dataType:"html",complete:function(a,b){Thread.quickReplyDone(a,b)}}),!1},quickReplyDone:function(b,c){var a=JSON.parse(b.responseText);if("OK"!=a.errores)$(".ErroresM").remove(),$('<div class="ErroresM">'+a.errores+"</div>").prependTo(".ResF"),$(".ErroresM").fadeIn(150),$(".cargaC").fadeOut(50),$(".BotonRES").fadeIn(100);else{n=$("#textCCC").text()+1,$.get("/actualizar/"+TID+"/"+n,function(b){var a=$(b).filter("#NPosts");$("#HComentariosC").prepend(a),$(a).slideToggle(100),$(".MostrarCCxx").each(function(){var a=$(this).text().substring(1);a.length>0&&($(".MostrarCCxx").remove(),$("#pid"+a).load(location.href+" #pid"+a+" >* "))})}),$(".CSeparadorR").addClass("invisible"),$(".CargandoCr").fadeIn(100),$("#textCCC").empty(),$("#textCC").load("/contar/"+TID+" #Comentarios"),$(".CSeparadorR").removeClass("CargAct"),$(".ErroresM").remove(),$("#cita").val(""),$(".Respondiendo").remove(),$(".IFYi").removeClass("rojito"),$(".IFMi").removeClass("rojito"),$("#IMGP").hide(),$("#formRes")[0].reset(),$(".cargaC").fadeOut(50),$(".BotonRES").fadeIn(100),$("#countdownS").show(),$(".BotonRESx").show(),setTimeout(function(){$("#countdownS").hide()},1e3),setTimeout(function(){$(".BotonRESx").hide()},1e4);var d="0:10",e=setInterval(function(){var c=d.split(":"),b=parseInt(c[0],10),a=parseInt(c[1],10);b=--a<0?--b:b,a=(a=a<0?59:a)<10?"0"+a:a,$("#countdown").html(b+":"+a),b<0&&clearInterval(e),a<=0&&b<=0&&clearInterval(e),d=b+":"+a},1e3)}setTimeout(function(){$(".CargandoCr").hide(),$(".CSeparadorR").removeClass("invisible")},200)}};$(document).ready(function(){function b(a){if(a.files&&a.files[0]){var b=new FileReader;b.onload=function(a){$("#IMGP").attr("src",a.target.result),$("#IMGP").show()},b.readAsDataURL(a.files[0])}else $("#IMGP").hide()}$("#file").change(function(){b(this)});var a=document.getElementById("message"),c=document.getElementById("file");a.addEventListener("paste",a=>{a.clipboardData.files.length>0&&(c.files=a.clipboardData.files,b(file))})}),window.onload=function(){window.intervaloC=setInterval(function(){var a=$("#textC").text()-$("#textCC").text();a>0&&($("#textCCC").empty(),$("#textCCC").append(a),$(".CSeparadorR").addClass("CargAct"),RecargHab=1),$("#textC").load("/contar/"+TID+" #Comentarios")},2e3)},General.Recargar=function(){if(!(RecargHab>0))return!1;$(".CSeparadorR").addClass("invisible"),$(".CargandoCr").fadeIn(100),clearInterval(window.intervaloC);var a=$("#textCCC").text();$.get("/actualizar/"+TID+"/"+a,function(b){var a=$(b).filter("#NPosts");$("#HComentariosC").prepend(a),$(a).slideToggle(100),$(".MostrarCCxx").each(function(){var a=$(this).text().substring(1);a.length>0&&($(".MostrarCCxx").remove(),$("#pid"+a).load(location.href+" #pid"+a+" >* "))})}),setTimeout(function(){$(".CargandoCr").hide(),$(".CSeparadorR").removeClass("invisible")},200),$("#textCC").load("/contar/"+TID+" #Comentarios"),$("#textCCC").empty(),$(".CSeparadorR").removeClass("CargAct"),RecargHab=0,window.intervaloC=setInterval(function(){var a=$("#textC").text()-$("#textCC").text();a>0&&($("#textCCC").empty(),$("#textCCC").append(a),$(".CSeparadorR").addClass("CargAct"),RecargHab=1),$("#textC").load("/contar/"+TID+" #Comentarios")},2e3)},Thread.init()