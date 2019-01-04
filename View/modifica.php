<?php

require_once '../Model/PodencoDB.php';
require_once '../Model/Producto.php';
require_once '../Model/CatSubCat.php';

$idPro = $_GET['idPro'];
  
$idCategoria = Producto::getIdCatIdPro($idPro);
//    print_r($idCategoria);
$idSubCategoria = Producto::getIdSubCatIdPro($idPro);
//    print_r($idSubCategoria);

$nombreCat = Producto::getNombreCatIdCat($idCategoria);
//    print_r($nombreCat);
$nombreSubCat = Producto::getNombreSubCatIdCat($idSubCategoria);
//    print_r($nombreSubCat);

$producto = Producto::getProducto($nombreCat, $nombreSubCat);
//var_dump($producto);

$ip = $producto->getIdPro();
$np = $producto->getNombrePro();
$pp = $producto->getPrecioPro();
$c1 = $producto->getComent1();
$c2 = $producto->getComent2();
$des = $producto->getDescripcion();
$i = $producto->getImagen();
$p = $producto->getPrincipal();

if($nombreCat == "perro"){
    $perrosel = "selected";
} else {
    $perrosel = "";
}
if($nombreCat == "gato"){
    $gatosel = "selected";
} else {
    $gatosel = "";
}
if($nombreCat == "aves"){
    $avessel = "selected";
} else {
    $avessel = "";
}
if($nombreCat == "roedores"){
    $roedoressel = "selected";
} else {
    $roedoressel = "";
}
if($nombreCat == "peces"){
    $pecessel = "selected";
} else {
    $pecessel = "";
}
if($nombreCat == "ganaderia"){
    $ganaderiasel = "selected";
} else {
    $ganaderiasel = "";
}
if($nombreCat == "varios"){
    $variossel = "selected";
} else {
    $variossel = "";
}

if($nombreSubCat == "alimentacion"){
    $alimentacionsel = "selected";
} else {
    $alimentacionsel = "";
}
if($nombreSubCat == "accesorios"){
    $accesoriossel = "selected";
} else {
    $accesoriossel = "";
}
if($nombreSubCat == "vivos"){
    $vivossel = "selected";
} else {
    $vivossel = "";
}
if($nombreSubCat == "cinegetica"){
    $cinegeticasel = "selected";
} else {
    $cinegeticasel = "";
}
if($nombreSubCat == "caballos"){
    $caballossel = "selected";
} else {
    $caballossel = "";
}
if($nombreSubCat == "ovino"){
    $ovinosel = "selected";
} else {
    $ovinosel = "";
}
if($nombreSubCat == "porcino"){
    $porcinosel = "selected";
} else {
    $porcinosel = "";
}
if($nombreSubCat == "mas"){
    $massel = "selected";
} else {
    $massel = "";
}
if($nombreSubCat == "varios"){
    $variosusel = "selected";
} else {
    $variosusel = "";
}

?>
<!DOCTYPE html>
<html >
    <head>
        <title>El Cachorro</title>
        <link rel="icon" type="image/png" href="../View/favicon/favicon.ico" /><!--chrome-->
        <link rel="icon" type="image/svg+xml" href="../View/favicon/tigrepro.svg"><!--firefox-->
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="../View/styleAntiguo.css" rel="stylesheet" type="text/css" />
        <!--<script type="text/javascript" src="js/jquery.js"></script>-->
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/arial.js"></script>
        <script type="text/javascript" src="js/cuf_run.js"></script>
        <script src="js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="js/jquery.validate.js" type="text/javascript"></script>

        <script>

        $(function(){
            
        jQuery.validator.addMethod("nombre", function(value, element) {
            return this.optional(element) || /^[a-záéíóúñ0123456789\s]+$/i.test(value);
        });

        /* Capturar el click del botón */
        $("#btn").on("click", function() {
            /* Validar el formulario */

            $("#formval").validate ({

                    rules: {

                        nombrePro: {required: true, nombre: true, minlength: 2, maxlength: 25},

                        precioPro: {required: true, digits: false, minlength: 1, maxlength: 6},
                        
                        coment1: {required: false, nombre: true, minlength: 0, maxlength: 20},
                        
                        coment2: {required: false, nombre: true, minlength: 0, maxlength: 20},
                        
                        descripcion: {required: false, nombre: false, minlength: 0, maxlength: 60}

                    },

                    messages: {

                        nombrePro: {required: ' El campo es requerido', nombre: 'Sólo letras y números', minlength: ' El mínimo permitido son 2 caracteres', maxlength: ' El máximo permitido son 25 caracteres'},

                        precioPro: {required: ' El campo es requerido', digits: 'Sólo dígitos', minlength: 'El mínimo permitido es 1 caracter', maxlength: ' El máximo permitido son 6 caracteres'},
                        
                        coment1: {required: ' El campo es requerido', nombre: 'Sólo letras y números', minlength: ' El mínimo permitido son 0 caracteres', maxlength: ' El máximo permitido son 20 caracteres'},
                        
                        coment2: {required: ' El campo es requerido', nombre: 'Sólo letras y números', minlength: ' El mínimo permitido son 0 caracteres', maxlength: ' El máximo permitido son 20 caracteres'},
                        
                        descripcion: {required: ' El campo es requerido', nombre: 'Sólo letras y números', minlength: ' El mínimo permitido son 0 caracteres', maxlength: ' El máximo permitido son 60 caracteres'}

                    }

                });

            });

        });
        </script>
    </head>
    <body>
        <div id="cabecera">
            <div id="titulo">
                <p>El Cachorro</p><p id="actividad">Tienda de animales</p>

            </div>
            <div id="logocab">
                <img src="../View/favicon/tigrepro.svg" 
                     alt="El Podenco" style="height:100%;"></img>
            </div>
        </div>
        
    <div id="formulario">

        <form action="../Controller/modificaGraba.php"  id="formval" method="POST">
            <input type="hidden" name="idPro" value="<?=$ip?>"/>
            <br/>
            <h2 class="formu">Formulario para modificar producto<br /></h2><br/>

            <h3 class="formu">Nombre del producto</h3>
            <input type="text" size="40" name="nombrePro" value="<?=$np?>" id="nombrePro" />

            <h3 class="formu">Precio del producto</h3>
            <input type="number" size="15" step="any" name="precioPro" id="precioPro" value="<?=$pp?>"/>

            <br/><h3 class="formu">Primer comentario</h3>
            <input type="text" size="20" name="coment1" id="coment1" value="<?=$c1?>"/>

            <br/><h3 class="formu">Segundo comentario</h3>
            <input type="text" size="20" name="coment2" value="<?=$c2?>"/>

            <br/><h3 class="formu">Descripcion</h3>
            <textarea name="descripcion" cols="50" rows="2" value="" ><?=$des?></textarea>

            <h3 class="formu">Nombre de imagen</h3>
            <select name='imagen'>
                <ul>
                <?php
                    if ($gestor = opendir('img')) {
                        while (false !== ($entrada = readdir($gestor))) {
                            if (!is_dir($entrada)&& ($entrada == $i)) {
                                echo "<option value='$entrada' selected>".$entrada."</option>";
                            }
                            if (!is_dir($entrada)&& ($entrada != $i)) {
                                echo "<option value='$entrada'>".$entrada."</option>";
                            }
                        }
                        closedir($gestor);
                    }
                ?>
                </ul>
            </select>
            
            <!--<h3 id ="check" class="formu"><input type="checkbox" name="principal" ?=$p?>/> Aparezca en página principal</h3>-->
            <h3 class="formu"><label><input type="checkbox" name="principal" value="on" <?= $p ?> /> Aparezca en pag principal</label></h3>
                
            <h3 class="formu">Categoria
            <select name="nombreCat" class="formu">
                <option value="perro" <?= $perrosel ?>>Perro</option>
                <option value="gato" <?= $gatosel ?>>Gato</option>
                <option value="aves" <?= $avessel ?>>Aves</option>
                <option value="roedores" <?= $roedoressel ?>>Roedores</option>
                <option value="peces" <?= $pecessel ?>>Peces</option>
                <option value="ganaderia" <?= $ganaderiasel ?>>Ganadería</option>
                <option value="varios" <?= $variossel ?>>Varios</option>
            </select></h3>
            
            <h3 class="formu">Subcategoria
            <select name="nombreSubCat" class="formu">
                <option value="alimentacion" <?= $alimentacionsel ?>>Alimentacion</option>
                <option value="accesorios" <?= $accesoriossel ?>>Accesorios</option>
                <option value="vivos" <?= $vivossel ?>>Vivos</option>
                <option value="cinegetica" <?= $cinegeticasel ?>>Cinegetica</option>
                <option value="caballos" <?= $caballossel ?>>Caballos</option>
                <option value="ovino" <?= $ovinosel ?>>Ovino</option>
                <option value="porcino" <?= $porcinosel ?>>Porcino</option>
                <option value="mas" <?= $massel ?>>Vivos</option>
                <option value="varios" <?= $variosusel ?>>Varios</option>
            </select></h3>
            
            <input type="submit" class="hboton" class="formu" id="btn" value="Aceptar"/>
            <a class="hboton" href="../Controller/modificarGeneral.php"<span class="formu">Cancelar y volver</span></a>
        </form>
    </div>
    </body>
</html>
