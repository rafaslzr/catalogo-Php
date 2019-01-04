<?php

require_once '../Model/PodencoDB.php';
require_once '../Model/Producto.php';
require_once '../Model/CatSubCat.php';

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
            return this.optional(element) || /^[a-záéíóúñ.0123456789\s]+$/i.test(value);
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
                        
                        descripcion: {required: false, nombre: true, minlength: 0, maxlength: 60},
                        
                        imagen: {required: true, nombre: true},
                        
                        nombreCat: {required: true, nombre: true},
                        
                        nombreSubCat: {required: true, nombre: true}

                    },

                    messages: {

                        nombrePro: {required: ' El campo es requerido', nombre: 'Sólo letras y números', minlength: ' El mínimo permitido son 2 caracteres', maxlength: ' El máximo permitido son 25 caracteres'},

                        precioPro: {required: ' El campo es requerido', digits: 'Sólo dígitos', minlength: 'El mínimo permitido es 1 caracter', maxlength: ' El máximo permitido son 6 caracteres'},
                        
                        coment1: {required: ' El campo es requerido', nombre: 'Sólo letras y números', minlength: ' El mínimo permitido son 0 caracteres', maxlength: ' El máximo permitido son 20 caracteres'},
                        
                        coment2: {required: ' El campo es requerido', nombre: 'Sólo letras y números', minlength: ' El mínimo permitido son 0 caracteres', maxlength: ' El máximo permitido son 20 caracteres'},
                        
                        descripcion: {required: ' El campo es requerido', nombre: 'Sólo letras y números', minlength: ' El mínimo permitido son 0 caracteres', maxlength: ' El máximo permitido son 60 caracteres'},
                        
                        imagen: {required: ' El campo es requerido', nombre: 'Sólo letras y números'},
                        
                        nombreCat: {required: ' El campo es requerido', nombre: 'Sólo letras y números'},
                        
                        nombreSubCat: {required: ' El campo es requerido', nombre: 'Sólo letras y números'}

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

        <form action="../Controller/insertarGraba.php"  id="formval" method="POST">
            <input type="hidden" name="idPro" value=""/>
            <br/>
            <h2 class="formu">Formulario para modificar producto<br /></h2><br/>

            <h3 class="formu">Nombre del producto</h3>
            <input type="text" size="40" name="nombrePro" value="" id="nombrePro" />

            <h3 class="formu">Precio del producto</h3>
            <input type="number" size="15" step="any" name="precioPro" id="precioPro" value=""/>

            <br/><h3 class="formu">Primer comentario</h3>
            <input type="text" size="20" name="coment1" id="coment1" value=""/>

            <br/><h3 class="formu">Segundo comentario</h3>
            <input type="text" size="20" name="coment2" value=""/>

            <br/><h3 class="formu">Descripcion</h3>
            <textarea name="descripcion" cols="50" rows="2" value=""/></textarea>

            <h3 class="formu">Nombre de imagen</h3>
            <select name='imagen'>
                <ul>
                    <option value="" selected>Elige</option>
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
            <h3 class="formu"><label><input type="checkbox" name="principal" value="on" /> Aparezca en pag principal</label></h3>
                
            <h3 class="formu">Categoria
            <select name="nombreCat" id="nombreCat" class="formu">
                <option value="">Elige</option>
                <option value="perro" >Perro</option>
                <option value="gato" >Gato</option>
                <option value="aves" >Aves</option>
                <option value="roedores" >Roedores</option>
                <option value="peces" >Peces</option>
                <option value="ganaderia" >Ganadería</option>
                <option value="varios" >Varios</option>
            </select></h3>
            
            <h3 class="formu">Subcategoria
            <select name="nombreSubCat" id="nombreSubCat" class="formu">
                <option value="">Elige</option>
                <option value="alimentacion" >Alimentacion</option>
                <option value="accesorios" >Accesorios</option>
                <option value="vivos" >Vivos</option>
                <option value="cinegetica" >Cinegetica</option>
                <option value="caballos" >Caballos</option>
                <option value="ovino" >Ovino</option>
                <option value="porcino" >Porcino</option>
                <option value="mas" >Vivos</option>
                <option value="varios" >Varios</option>
            </select></h3>
            
            <input type="submit" class="hboton" class="formu" id="btn" value="Aceptar"/>
            <a class="hboton" href="../Controller/modificarGeneral.php"<span class="formu">Cancelar y volver</span></a>
        </form>
    </div>
    </body>
</html>