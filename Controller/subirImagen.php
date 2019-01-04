<?php

//eliminar imagen

if(isset($_GET['eliminar'])){
    $archivo = $_GET['eliminar'];
    $directorio = "../View/img";
    if(unlink($directorio.'/'.$archivo)){
        header("Location: subirImagen.php");
        exit;
    }
}

//formulario

if(isset($_POST['submit'])){ // comprobamos que se ha enviado el formulario
    
    // comprobar que han seleccionado una foto
    if($_FILES['foto']['name'] != ""){ // El campo foto contiene una imagen...
        
        // Primero, hay que validar que se trata de un JPG/GIF/PNG
        $tipoArchivo = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");
        $extension = end(explode(".", $_FILES["foto"]["name"]));
        if ((($_FILES["foto"]["type"] == "image/gif")
                || ($_FILES["foto"]["type"] == "image/jpeg")
                || ($_FILES["foto"]["type"] == "image/png")
                || ($_FILES["foto"]["type"] == "image/pjpeg"))
                && in_array($extension, $tipoArchivo)) {
            // el archivo es un JPG/GIF/PNG, entonces...
            
            $extension = end(explode('.', $_FILES['foto']['name']));
            $foto = $_FILES['foto']['name'];
            //$directorio = dirname(__FILE__);
            $directorio = "../View/img";
            
            // almacenar imagen en el servidor
            move_uploaded_file($_FILES['foto']['tmp_name'], $directorio.'/'.$foto);
            $minFoto = 'min_'.$foto;
            resizeImagen($directorio.'/', $minFoto, 100, 100, $foto, $extension);
            unlink($directorio.'/'.$minFoto);
            
        } else { //el archivo no es JPG/GIF/PNG
            $malformato = $_FILES["foto"]["type"];
            header("Location: subirImagenErrorFormt.php");
            exit;
          }
        
    } else { //el archivo no es de imagen
        header("Location: subirImagenErrorNoImg.php");
        exit;
    }
        
} // fin del submit

//redimensionar la imagen

function resizeImagen($ruta, $nombre, $alto, $ancho, $nombreN, $extension){
    $rutaImagenOriginal = $ruta.$nombre;
    if($extension == 'GIF' || $extension == 'gif'){
    $img_original = imagecreatefromgif($rutaImagenOriginal);
    }
    if($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG'){
    $img_original = imagecreatefromjpeg($rutaImagenOriginal);
    }
    if($extension == 'png' || $extension == 'PNG'){
    $img_original = imagecreatefrompng($rutaImagenOriginal);
    }
    $max_ancho = $ancho;
    $max_alto = $alto;
    list($ancho,$alto)=getimagesize($rutaImagenOriginal);
    $x_ratio = $max_ancho / $ancho;
    $y_ratio = $max_alto / $alto;
    if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
  	$ancho_final = $ancho;
		$alto_final = $alto;
	} elseif (($x_ratio * $alto) < $max_alto){
		$alto_final = ceil($x_ratio * $alto);
		$ancho_final = $max_ancho;
	} else{
		$ancho_final = ceil($y_ratio * $ancho);
		$alto_final = $max_alto;
	}
    $tmp=imagecreatetruecolor($ancho_final,$alto_final);
    imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
    imagedestroy($img_original);
    $calidad=70;
    imagejpeg($tmp,$ruta.$nombreN,$calidad);    
}//fin resize imagen

include_once '../View/cabecera.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>El Cachorro</title>
        <link href="../View/styleAntiguo.css" rel="stylesheet" type="text/css"/>  
    </head>

    <body>
        <div id="subirImagen">
            <div id="titulosub">
                <h1>Subir/Borrar imagenes y reducir tamaño</h1>
                <p id="subparrafo">Se admiten archivos: *.gif, *.png y *.jpg-*.jpeg</p>
            </div>
            <br />
            <section>

                <br />
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>"
                      method="POST"
                      enctype="multipart/form-data">
                    <fieldset>
                        <div><input type="file" name="foto" /></div>
                        <div style="margin-top: 10px;"><input type="submit" name="submit" value=" Enviar "/>
                        <?php if(isset($_POST['submit'])) { ?>
                        <br /><div class="msg">El archivo ha sido cargado satisfactoriamente.</div>
                        <?php } ?>
                    </fieldset>
                </form>
                <br /><br />
                <div id="bot">
                    <ul class="botones">
                        <li id="boton"><a class="hboton" href="index.php"<span>Principal</span></a></li>
                        <!--<li id="boton"><a class="hboton" href="../Controller/subirImagen.php"<span>Subir/Borrar otra imagen</span></a></li>-->
                        <li id="boton"><a class="hboton" href="../Controller/modificarGeneral.php"<span>Modificar</span></a></li>
                    </ul>
                </div>  

                <div class="lista">
                    <?php
                    $path = "../View/img";
                    $directorio=dir($path);

                    while ($archivo = $directorio->read()) {
                        $extension = end(explode('.', $archivo));
                        if($extension == 'png' || $extension == 'gif' || $extension == 'jpg' || $extension == 'jpeg'){
                            echo "<a href='../View/img/".$archivo."' target='_blank'>".$archivo."</a> <a class='elimina' href='".$_SERVER['PHP_SELF']."?eliminar=".$archivo."'>eliminar</a><br>";
                        }
                    }
                    $directorio->close();
                    ?>
                </div>
            </section>
        </div>
    </body>
</html>