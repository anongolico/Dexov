<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Usuario;
use App\Moderacion;
require (__DIR__.'/../../Global.php');

date_default_timezone_set('America/Argentina/Buenos_Aires');

class CreacionController extends Controller
{
    public function Hilo()
    {
        $Usuario = new Usuario();
        $Moderacion = new Moderacion();

        $Video = ""; 
        $VideoURL = "";
        $VYT = "";
        $IMAGEN = "";
        $error = 0;
        $esGIF = 0;
        $tag = 0;
        $usuario = '';

        $UIP = getUserIP();

        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        $id = generateRandomStringN(9);
        $fecha = time();
        $autor = $Usuario->idUsuario();

        if(!empty($_POST['categoria']))
		{
        $categoria = $_POST['categoria'];

        switch ($categoria) {
            case '1':
            $categoria = "ANM";
            break;
            case '2':
            $categoria = "ART";
            break;
            case '3':
            $categoria = "CNC";
            break;
            case '4':
            $categoria = "CIN";
            break;
            case '5':
            $categoria = "OFF";
            break;
            case '6':
            $categoria = "HMR";
            break;
            case '7':
            $categoria = "MUS";
            break;
            case '8':
            $categoria = "NOT";
            break;
            case '9':
            $categoria = "PAR";
            break;
            case '10':
            $categoria = "POL";
            break;
            case '11':
            $categoria = "RAN";
            break;
            case '12':
            $categoria = "TEC";
            break;
            case '13':
            $categoria = "HOT";
            break;
            default:
                $categoria = "OFF";
                break;
            }
        }

        //****
        //
        //Empieza verificacion del hilo
        //
        //****

                //Flood
        
                $IPC = $UIP;

                $ultimaAccion = ultimaAccion($IPC);
        
                if($fecha-$ultimaAccion <= '9')
                {
                $error = 1;
                @header("Content-type: application/json; charset=utf-8");
                echo json_encode(array("errores" => "Flood"));
                exit;
                }

        //Baneo

        $estaBaneado = DB::table('baneados')
        ->where('IP', $IPC)->count();
        
        if($estaBaneado > 0)
		{
            $BANm = DB::table('baneados')->where('IP', $IPC)->orderByDesc('fecha')->value('motivo');
            $BANf = DB::table('baneados')->where('IP', $IPC)->orderByDesc('fecha')->value('finaliza');

        $FinBan = date('d/m/Y h:i A', $BANf);

		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
		echo json_encode(array("errores" => "<div style='font-size: 14px;position: relative;top: -5px;line-height: 1;letter-spacing: -0.7px;'>Baneado hasta $FinBan<br>Razon: $BANm</div>"));
        exit;
		}

        //Sin archivo

        if(empty($_POST['youtube']) && (empty($_FILES['imagen']['name'])) && empty($_FILES['media']['tmp_name']))
		{
            $error = 1;
            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("errores" => "Tenes que subir algo"));
            exit;
		}

        if((!empty($_POST['youtube']) && (!empty($_FILES['imagen']['name'])) && !empty($_FILES['media']['tmp_name'])) OR (!empty($_POST['youtube']) && (!empty($_FILES['imagen']['name']))) OR (!empty($_POST['youtube']) && (!empty($_FILES['media']['tmp_name']))) OR (!empty($_FILES['imagen']['name']) && (!empty($_FILES['media']['tmp_name']))))
		{ 
            $error = 1;
            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("errores" => "Podes subir una sola cosa"));
            exit;
		}

        //Largo del texto

        $contenidoC = strlen($contenido);

        if($contenidoC == 0)
		{
		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
		echo json_encode(array("errores" => "Tenes que escribir algo"));
        exit;
		}

                //Titulo

                $tituloC = strlen($titulo);

                if($tituloC == 0)
                {
                $error = 1;
                @header("Content-type: application/json; charset=utf-8");
                echo json_encode(array("errores" => "Falta el titulo"));
                exit;
                }

        //Usuario

        $autorC = $Usuario->esUsuario();

        if(!$autorC)
		{
		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("errores" => "Error"));
        exit;
		}

        //Categoria

        if(empty($_POST['categoria']) OR !in_array($_POST['categoria'], array('1','2','3','4','5','6','7','8','9','10','11','12','13')))
		{
		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("errores" => "Selecciona una categoria"));
        exit;
		}

        //****
        //
        //Termina verificacion del comentario
        //
        //****

        if(empty($_FILES['imagen']['name']) && empty($_POST['youtube']) && !empty($_FILES['media']['tmp_name'])){
            $PesoI = 5242880;	    
            $videoC = $_FILES['media']['tmp_name'];
            $mime = mime_content_type($videoC);
            if(!strstr($mime, "video/")){
                $error = 1;
                @header("Content-type: application/json; charset=utf-8");
                echo json_encode(array("errores" => "Video invalido"));
                exit;
            }
            elseif($_FILES['media']['size'] > $PesoI)
            {
                $error = 1;
                @header("Content-type: application/json; charset=utf-8");
                echo json_encode(array("errores" => "Peso maximo del video: 5MB"));
                exit;
            }
            else
            {
                $NombreI = generateRandomString();
                $uploaddir = 'public/Subidas/';
                $filename = "T_".$NombreI.".mp4";
            
                $raw = $uploaddir . $filename;
                $_FILES['media']['tmp_name'];
                move_uploaded_file($_FILES['media']['tmp_name'], $raw);
                $Video = "1";
                $VideoURL = 'public/Subidas/'.$filename.''; 

                $IMAGEN = 'public/IMG/VideoF.png';
            }
            }
     
            if(!empty($_FILES['imagen']['name']) && empty($_POST['youtube']) && empty($_FILES['media']['tmp_name'])){
    
            $PesoI = 5242880;
    
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    
            if($check !== false) {
                $uploadOk = 1;
                } else {
                $uploadOk = 0;
                }
            if($_FILES['imagen']['type'] == 'image/gif' || $_FILES['imagen']['type'] == 'image/jpeg' || $_FILES['imagen']['type'] == 'image/jpg' || $_FILES['imagen']['type'] == 'image/png' || $_FILES['imagen']['type'] == 'image/webp' || $_FILES['imagen']['type'] == 'image/gif')
            {
            if($uploadOk != 0)
            {
            if($_FILES['imagen']['size'] < $PesoI)
            {
            
                $IMGSubir = SubirI('imagen','public/Subidas/','',TRUE,'public/Subidas/Miniaturas/','336','336');
                
                $IMAGEN = $IMGSubir;

            if($_FILES['imagen']['type'] == 'image/gif')
	        {
            $esGIF = 1;
	        }
            }
            else
            {
                $error = 1;
                @header("Content-type: application/json; charset=utf-8");
                echo json_encode(array("errores" => "Peso maximo: 5MB"));
                exit;
            }
            }
            else
            {
                $error = 1;
                @header("Content-type: application/json; charset=utf-8");
                echo json_encode(array("errores" => "Archivo no valido"));
                exit;
            }
            }
            else
            {
                $error = 1;
                @header("Content-type: application/json; charset=utf-8");
                echo json_encode(array("errores" => "Archivo no valido"));
                exit;
            }
            }
    
        if(!empty($_POST['youtube']) && empty($_FILES['imagen']['name']) && empty($_FILES['media']['tmp_name']))
        {
        $vyoutube = $_POST['youtube'];
            
        $preg = preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $vyoutube, $matches);  
        
        if($preg)
        {
        $headers = get_headers('https://www.youtube.com/oembed?format=json&url=http://www.youtube.com/watch?v=' . $matches[1]);
        if(((is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$headers[0]) : false))) {
        $URLYT = 'https://img.youtube.com/vi/'.$matches[1].'/maxresdefault.jpg';
        $URLYT720 = 'https://img.youtube.com/vi/'.$matches[1].'/hq720.jpg';
        if(@getimagesize($URLYT720))
        {
        $content = file_get_contents('https://img.youtube.com/vi/'.$matches[1].'/hq720.jpg');
        $new_w = 336;
        $new_h = 336;
        $thumb_create = imagecreatetruecolor(336,336);
        }
        elseif(@getimagesize($URLYT) && !@getimagesize($URLYT720)) 
        {
        $content = file_get_contents('https://img.youtube.com/vi/'.$matches[1].'/maxresdefault.jpg');
        $new_w = 336;
        $new_h = 336;
        $thumb_create = imagecreatetruecolor(336,336);
        }
        else
        {
        $content = file_get_contents('https://img.youtube.com/vi/'.$matches[1].'/hqdefault.jpg');
        $new_w = 266;
        $new_h = 266;
        $thumb_create = imagecreatetruecolor(266,266);
        }
        $NombreI = generateRandomString();
        file_put_contents('public/Subidas/Miniaturas/T_'.$NombreI.'.jpg', $content);
            
        $fileName = 'public/Subidas/Miniaturas/T_'.$NombreI.'.jpg';
                    
        $thumbnail = $fileName;
        
        $upload_image = $fileName;
                    
        $source = imagecreatefromjpeg($upload_image);
        
    $orig_w = imagesx($source);
    $orig_h = imagesy($source);
        
    $w_ratio = ($new_w / $orig_w);
    $h_ratio = ($new_h / $orig_h);
    if(@getimagesize($URLYT) || @getimagesize($URLYT720))
        {
        $ratio = max($h_ratio, $w_ratio);
        }
        else
        {
        $ratio = 1;
         }
        
        $sy = floor(imagesy($source) * $ratio);
        $sx = floor(imagesx($source) * $ratio);
        
    $m_y = floor(($new_h - $sy) / 2);
    $m_x = floor(($new_w - $sx) / 2);
                    
    imagecopyresampled($thumb_create,$source,$m_x,$m_y,0,0,$sx, $sy, $orig_w, $orig_h);
    
    imagejpeg($thumb_create,$thumbnail,80);
    
        $IMAGEN = 'T_'.$NombreI.'.jpg'; 
        $VYT = $matches[1];
    }
    else
    {
            $error = 1;
            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("errores" => "El video no existe"));
    }
    }
    else
    {
            $error = 1;
            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("errores" => "El video no existe"));
    }
    }

    if(isset($_POST['tag']) && ($Moderacion->nivelMod() == 1))
    {
    $tag = '1';
    $usuario = DB::table('usuarios')
            ->where('id', $autor)
            ->value('usuario');
    }

    if(isset($_POST['tag']) && ($Moderacion->nivelMod() == 2))
    {
        $tag = '2';
        $usuario = DB::table('usuarios')
                ->where('id', $autor)
                ->value('usuario');
    }

        if($error > 0)
		{
        exit;
		}
		else
		{
        DB::table('hilos')->insert([
            'id' => $id,
            'titulo' => $titulo,
            'contenido' => $contenido,
            'imagen' => $IMAGEN,
            'fecha' => $fecha,
            'sticky' => 0, 
            'ucomentario' => $fecha,
            'autor' => $autor,
            'Video' => $Video,
            'VideoURL' => $VideoURL,
            'VYT' => $VYT,
            'esGIF' => $esGIF,
            'categoria' => $categoria,
            'comentarios' => '0',
            'visible' => '1',
            'tag' => $tag,
            'usuario' => $usuario,
        ]);

        DB::table('usuarios')
            ->where('id', $autor)
            ->update(['UIP' => $UIP, 'ultimoPost' => $fecha]);

        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("errores" => "OK", "link" => $id));
        exit;
    }
    }

    public function Comentario()
    {
        $Usuario = new Usuario();
        $Moderacion = new Moderacion();

        $Video = ""; 
        $VideoURL = "";
        $VYT = "";
        $IMAGEN = "";
        $error = 0;
        $ColorAvatar = rand(1,4);
        $esGIF = 0;
        $esOP = 0;
        $tag = 0;

        $UIP = getUserIP();

        $hilo = $_POST['hilo'];
        $cita = $_POST['cita'];
        $contenido = $_POST['contenido'];
        $id = generateRandomStringN(9);
        $fecha = time();
        $autor = $Usuario->idUsuario();

        //****
        //
        //Empieza verificacion del comentario
        //
        //****

        //Flood
        
        $IPC = $UIP;

        $ultimaAccion = ultimaAccion($IPC);

        if($fecha-$ultimaAccion <= '9')
		{
		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
		echo json_encode(array("errores" => "Flood"));
        exit;
		}

        //Baneo

        $estaBaneado = DB::table('baneados')
        ->where('IP', $IPC)->count();
        
        if($estaBaneado > 0)
		{
            $BANm = DB::table('baneados')->where('IP', $IPC)->orderByDesc('fecha')->value('motivo');
            $BANf = DB::table('baneados')->where('IP', $IPC)->orderByDesc('fecha')->value('finaliza');

        $FinBan = date('d/m/Y h:i A', $BANf);

		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
		echo json_encode(array("errores" => "Baneado.<br> Motivo: $BANm<br> Finaliza $FinBan"));
        exit;
		}

        //Largo del texto

        $contenidoC = strlen($contenido);

        if($contenidoC == 0)
		{
		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
		echo json_encode(array("errores" => "Tenes que escribir algo"));
        exit;
		}

        //Usuario

        $autorC = $Usuario->esUsuario();

        if(!$autorC)
		{
		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("errores" => "Error"));
        exit;
		}

        //Citado

        $citadoC = $cita;

        $Valido = DB::table('comentarios')
        ->where('id', $citadoC)->count();

        if(!empty($citadoC) && ($Valido < 1))
		{
		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("errores" => "Comentario inexistente"));
        exit;
		}		

        //¿Existe el hilo?

        $hiloC = $hilo;

        $Valido = DB::table('hilos')
        ->where('id', $hiloC)->where('visible', '1')->count();

        if($Valido < 1)
		{
		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
        echo json_encode(array("errores" => "El hilo no existe"));
        exit;
		}	

        //****
        //
        //Termina verificacion del comentario
        //
        //****

        if(empty($_FILES['imagen']['name']) && empty($_POST['youtube']) && !empty($_FILES['media']['tmp_name'])){
        $PesoI = 5242880;	    
        $videoC = $_FILES['media']['tmp_name'];
        $mime = mime_content_type($videoC);
        if(!strstr($mime, "video/")){
            $error = 1;
            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("errores" => "Video invalido"));
            exit;
		}
        elseif($_FILES['media']['size'] > $PesoI)
		{
            $error = 1;
            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("errores" => "Peso maximo del video: 5MB"));
            exit;
		}
        else
        {
            $NombreI = generateRandomString();
            $uploaddir = 'public/Subidas/';
            $filename = "T_".$NombreI.".mp4";
        
            $raw = $uploaddir . $filename;
            $_FILES['media']['tmp_name'];
            move_uploaded_file($_FILES['media']['tmp_name'], $raw);
            $Video = "1";
            $VideoURL = 'public/Subidas/'.$filename.''; 
        }
        }
 
        if(!empty($_FILES['imagen']['name']) && empty($_POST['youtube']) && empty($_FILES['media']['tmp_name'])){

        $PesoI = 5242880;

        $check = getimagesize($_FILES["imagen"]["tmp_name"]);

        if($check !== false) {
            $uploadOk = 1;
            } else {
            $uploadOk = 0;
            }
        if($_FILES['imagen']['type'] == 'image/gif' || $_FILES['imagen']['type'] == 'image/jpeg' || $_FILES['imagen']['type'] == 'image/jpg' || $_FILES['imagen']['type'] == 'image/png' || $_FILES['imagen']['type'] == 'image/webp' || $_FILES['imagen']['type'] == 'image/gif')
        {
        if($uploadOk != 0)
		{
        if($_FILES['imagen']['size'] < $PesoI)
		{
	    
            $IMGSubir = SubirI('imagen','public/Subidas/','',TRUE,'public/Subidas/Miniaturas/','336','336');
            
            if($_FILES['imagen']['type'] == 'image/gif')
	        {
	        $IMAGEN = $IMGSubir;
            $esGIF = 1;
	        }
            elseif($_FILES['imagen']['type'] != 'image/gif')
            {
            $IMAGEN = $IMGSubir;
            }
            else 
            {
            $IMAGEN = '';
        }
        }
        else
		{
            $error = 1;
            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("errores" => "Peso maximo: 5MB"));
            exit;
		}
        }
        else
		{
            $error = 1;
            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("errores" => "Archivo no valido"));
            exit;
		}
        }
        else
		{
            $error = 1;
            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("errores" => "Archivo no valido"));
            exit;
		}
        }

    if(!empty($_POST['youtube']) && empty($_FILES['imagen']['name']) && empty($_FILES['media']['tmp_name']))
	{
    $vyoutube = $_POST['youtube'];
		
	$preg = preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $vyoutube, $matches);  
    
    if($preg)
    {
    $headers = get_headers('https://www.youtube.com/oembed?format=json&url=http://www.youtube.com/watch?v=' . $matches[1]);
    if(((is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$headers[0]) : false))) {
    $URLYT = 'https://img.youtube.com/vi/'.$matches[1].'/maxresdefault.jpg';
	$URLYT720 = 'https://img.youtube.com/vi/'.$matches[1].'/hq720.jpg';
	if(@getimagesize($URLYT720))
	{
	$content = file_get_contents('https://img.youtube.com/vi/'.$matches[1].'/hq720.jpg');
	$new_w = 336;
    $new_h = 336;
	$thumb_create = imagecreatetruecolor(336,336);
	}
	elseif(@getimagesize($URLYT) && !@getimagesize($URLYT720)) 
	{
	$content = file_get_contents('https://img.youtube.com/vi/'.$matches[1].'/maxresdefault.jpg');
	$new_w = 336;
    $new_h = 336;
	$thumb_create = imagecreatetruecolor(336,336);
	}
	else
	{
	$content = file_get_contents('https://img.youtube.com/vi/'.$matches[1].'/hqdefault.jpg');
	$new_w = 266;
    $new_h = 266;
	$thumb_create = imagecreatetruecolor(266,266);
	}
	$NombreI = generateRandomString();
    file_put_contents('public/Subidas/Miniaturas/T_'.$NombreI.'.jpg', $content);
		
	$fileName = 'public/Subidas/Miniaturas/T_'.$NombreI.'.jpg';
				
	$thumbnail = $fileName;
	
	$upload_image = $fileName;
				
	$source = imagecreatefromjpeg($upload_image);
	
$orig_w = imagesx($source);
$orig_h = imagesy($source);
	
$w_ratio = ($new_w / $orig_w);
$h_ratio = ($new_h / $orig_h);
if(@getimagesize($URLYT) || @getimagesize($URLYT720))
	{
    $ratio = max($h_ratio, $w_ratio);
	}
	else
	{
    $ratio = 1;
 	}
	
	$sy = floor(imagesy($source) * $ratio);
    $sx = floor(imagesx($source) * $ratio);
	
$m_y = floor(($new_h - $sy) / 2);
$m_x = floor(($new_w - $sx) / 2);
				
imagecopyresampled($thumb_create,$source,$m_x,$m_y,0,0,$sx, $sy, $orig_w, $orig_h);

imagejpeg($thumb_create,$thumbnail,80);

	$IMAGEN = 'T_'.$NombreI.'.jpg'; 
	$VYT = $matches[1];
}
else
{
		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
		echo json_encode(array("errores" => "El video no existe"));
}
}
else
{
		$error = 1;
        @header("Content-type: application/json; charset=utf-8");
		echo json_encode(array("errores" => "El video no existe"));
}
}

$OPv = DB::table('hilos')
->where('id', $hilo)->value('autor');

if($OPv == $autor)
{
$esOP = 1;
}

if(isset($_POST['tag']) && ($Moderacion->nivelMod() == 1))
{
    $tag = '1';
}

    if(isset($_POST['tag']) && ($Moderacion->nivelMod() == 2))
    {
        $tag = '2';
    }

        if($error > 0)
		{
        exit;
		}
		else
		{		
            DB::table('comentarios')->insert([
                'id' => $id,
                'contenido' => $contenido,
                'hilo' => $hilo,
                'fecha' => $fecha,
                'imagen' => $IMAGEN,
                'autor' => $autor,
                'responde' => $cita,
                'Video' => $Video,
                'VideoURL' => $VideoURL,
                'VYT' => $VYT,
                'color' => $ColorAvatar,
                'visible' => '1',
                'esGIF' => $esGIF,
                'esOP' => $esOP,
                'tag' => $tag,
            ]);

            $comentarios = DB::table('hilos')
            ->where('id', $hilo)->value('comentarios');

            DB::table('hilos')
            ->where('id', $hilo)
            ->update(['ucomentario' => $fecha, 'comentarios' => $comentarios+1]);

            DB::table('usuarios')
            ->where('id', $autor)
            ->update(['UIP' => $UIP, 'ultimoPost' => $fecha]);

        if($cita > 0)
		{
            $receptor = DB::table('comentarios')
            ->where('id', $cita)->value('autor');

            if($autor != $receptor)
            {
            DB::table('notificaciones')->insert([
                'id' => generateRandomStringN(12),
                'emisor' => $autor,
                'receptor' => $receptor,
                'clase' => '2',
                'leida' => '0',
                'hilo' => $hilo,
                'comentario' => $id,
                'fecha' => $fecha
            ]);
        }
		}

        if($cita < 1)
		{
            $receptor = DB::table('hilos')
            ->where('id', $hilo)->value('autor');

            if($autor != $receptor)
            {
            DB::table('notificaciones')->insert([
                'id' => generateRandomStringN(12),
                'emisor' => $autor,
                'receptor' => $receptor,
                'clase' => '1',
                'leida' => '0',
                'hilo' => $hilo,
                'comentario' => $id,
                'fecha' => $fecha
            ]);
        }
        }

            @header("Content-type: application/json; charset=utf-8");
            echo json_encode(array("errores" => "OK"));
            exit;
        }
    }
}