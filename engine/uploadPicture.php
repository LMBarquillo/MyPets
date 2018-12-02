<?php

/**
 * uploadPicture.php
 * Receptor POST PHP para subir archivos al servidor y redimensionarlos.
 * 
 * @author Luis Miguel Barquillo Romero
 */

if(isset($_GET['files'])) {
	$retorno = "";
    $files = array();

    $uploaddir = '../img/pets/';
    $currentDateTime = new DateTime();
    
    foreach($_FILES as $file) {
		// Evitamos extensiones potencialmente peligrosas
		if(extensionPermitida(pathinfo($file['name'], PATHINFO_EXTENSION))) {
		    // Movemos la imagen a la carpeta donde la guardaremos
			if(move_uploaded_file($file['tmp_name'], $uploaddir.basename($file['name']))) {
				$f = $uploaddir.$file['name'];
				// El nombre final lleva concatenado el Timestamp para que sea siempre único.
				$final = $uploaddir.'600_'.$currentDateTime->getTimestamp().'_'.basename($file['name']);
				// La redimensionamos al tamaño final que deseamos.
				if(redimensionarImagen($f,$final,600,600,true,true)) {
					$files[] = substr($final, 3, strlen($final)-3); // quitamos el "../"
					$retorno = array('files' => $files);
				} else $retorno = array('error' => 'Imagen demasiado grande.');				
			} else $retorno = array('error' => 'Se produjo un error al subir el archivo.');
		} else $retorno = array('error' => 'La extensión del archivo subido no está permitida.');
    }
} else {
    $retorno = array('success' => 'OK', 'formData' => $_POST);
}
// Tras terminar, devolvemos el resultado.
echo json_encode($retorno);


/** FUNCIONES ADICIONALES DE APOYO **/
function extensionPermitida($ext) {
	$e = strtoupper($ext);
	return $e == "JPG" || $e == "JPEG" || $e == "PNG" || $e == "GIF";
}

/**
 * Redimensiona una imagen
 * @param String $file El archvivo de imagen original 
 * @param String $destiny El archivo destino
 * @param int $w Ancho destino
 * @param int $h Alto destino
 * @param boolean $crop Cortar para ajustar al nuevo tamaño
 * @param boolean $delete Borrar el original al terminar
 * @return resource|boolean
 */
function redimensionarImagen($file, $destiny, $w, $h, $crop=FALSE, $delete=FALSE) {
    list($width, $height) = getimagesize($file);
	// Si tiene más de 24 millones de píxeles, nos peta la memoria. Limitamos a 20 porsiaca.
	if($width*$height <= 20000000) {
		$r = $width / $height;
		if ($crop) {
			if ($width > $height) {
				$width = ceil($width-($width*abs($r-$w/$h)));
			} else {
				$height = ceil($height-($height*abs($r-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} else {
			if ($w/$h > $r) {
				$newwidth = $h*$r;
				$newheight = $h;
			} else {
				$newheight = $w/$r;
				$newwidth = $w;
			}
		}
		$dst = imagecreatetruecolor($newwidth, $newheight);
		$src = "";
		
		$ext = strtoupper(pathinfo($file, PATHINFO_EXTENSION));
		if($ext == "JPG" || $ext == "JPEG") {
			$src = imagecreatefromjpeg($file);
		} else if($ext == "PNG") {
			$src = imagecreatefrompng($file);
		} else if($ext == "GIF") {
			$src = imagecreatefromgif($file);
		} else {
			
		}	
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		imagejpeg($dst,$destiny,90);
		if($delete) {
			unlink($file);
		}

		return $dst;		
	} else {
		return false;
	}    
}
?>