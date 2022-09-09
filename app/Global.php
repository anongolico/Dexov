<?php

function generateRandomString($length = 20) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomStringN($length = 20) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function SubirI($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){
	
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
    
    $filename_err = explode(".",$_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    $fileName = 'T_'.generateRandomString().'.'.$file_ext;
	
	if((strtolower($file_ext)) == 'jpg' OR (strtolower($file_ext)) == 'png' OR (strtolower($file_ext)) == 'jpeg' OR (strtolower($file_ext)) == 'gif' OR (strtolower($file_ext)) == 'webp')
    {    
    $upload_image = $target_path.basename($fileName);
	}
	else
    {   
	return false;
	}

    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
    {
        if($thumb == TRUE && (strtolower($file_ext)) == 'jpg' OR (strtolower($file_ext)) == 'png' OR (strtolower($file_ext)) == 'jpeg' OR (strtolower($file_ext)) == 'gif' OR (strtolower($file_ext)) == 'webp')
        {
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch((strtolower($file_ext))){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
				case 'webp':
                    $source = imagecreatefromwebp($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
   }
			
$orig_w = imagesx($source);
$orig_h = imagesy($source);
	
$w_ratio = ($thumb_width / $orig_w);
$h_ratio = ($thumb_height / $orig_h);
$ratio = max($h_ratio, $w_ratio);
			
	$sy = floor(imagesy($source) * $ratio);
    $sx = floor(imagesx($source) * $ratio);
	
$m_y = floor(($thumb_height - $sy) / 2);
$m_x = floor(($thumb_width - $sx) / 2);
			
            imagecopyresampled($thumb_create,$source,$m_x,$m_y,0,0,$sx, $sy, $orig_w, $orig_h);
            switch((strtolower($file_ext))){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,80);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,80);
                    break;
                case 'gif':
                    imagegif($thumb_create,$thumbnail,80);
                    break;
				case 'webp':
                    imagewebp($thumb_create,$thumbnail,80);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,80);
            }
        }

        return $fileName;
    }
    else
    {
        return false;
    }
}

function ban_date2timestampG($date, $stamp=0)
{
	if($stamp == 0)
	{
		$stamp = time();
	}
	$d = explode('-', $date);
	$nowdate = date("H-j-n-Y", $stamp);
	$n = explode('-', $nowdate);
	$n[0] += $d[0];
	$n[1] += $d[1];
	$n[2] += $d[2];
	$n[3] += $d[3];
	return mktime($n[0], date("i", $stamp), 0, $n[2], $n[1], $n[3]);
}

function getUserIP() {
    $IPADRESS = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $IPADRESS = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $IPADRESS = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $IPADRESS = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        $IPADRESS = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $IPADRESS = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $IPADRESS = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $IPADRESS = $_SERVER['REMOTE_ADDR'];
    else
        $IPADRESS = 'UNKNOWN';
    return $IPADRESS;
}

function ultimaAccion($IP)
{	
        $query = DB::table('usuarios')->where('UIP', $IP)->select('ultimoPost')->orderByDesc('ultimoPost')->value('ultimoPost');
		return $query;
}

function ultimaAccionD($IP)
{	
        $query = DB::table('usuarios')->where('UIP', $IP)->select('ultimaDen')->orderByDesc('ultimaDen')->value('ultimaDen');
		return $query;
}

function ultimoRegistro($IP)
{	
        $query = DB::table('usuarios')->where('UIP', $IP)->select('fecha')->orderByDesc('fecha')->value('fecha');
		return $query;
}