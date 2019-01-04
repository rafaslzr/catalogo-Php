<?php
    require_once '../Model/Producto.php';
    require_once '../Model/CatSubCat.php';

    $principal = "";//este if esta por que el on que manda checkbox no me sirve
    if($_POST['principal'] == "on"){//tengo que convertirlo a checked
        $principal = "checked";
    } else {
        $principal = "";
    }
    //en productoAux creo el objeto para el constructor de la Clase Producto
    $productoAux = new Producto($_POST['idPro'], $_POST['nombrePro'], $_POST['precioPro'],
            $_POST['coment1'], $_POST['coment2'], $_POST['descripcion'],
            $_POST['imagen'], $principal, $_POST['nombreCat'], $_POST['nombreSubCat']);
    //var_dump($productoAux);

    $productoAux->modificaProducto();//esto ejecuta el uptade que afecta a la tabla
                                     //producto
    
    //como en vez de id paso nombre de categoria y subcategoria ahora tengo que convertirlos a id
    $idCategoria = Producto::getIdCatNombre($_POST['nombreCat']);
    //var_dump($idCategoria);

    $idSubCategoria = Producto::getIdSubCatNombre($_POST['nombreSubCat'], $idCategoria);
    //var_dump($idSubCategoria);
    
    //despues de conseguir el id de la categoria y subcategoria ya puedo construir el objeto
    //para la Clase CatSubCat
    $catsubcatAux = new CatSubCat($_POST['idPro'], $idCategoria, $idSubCategoria);
    var_dump($catsubcatAux);
    
    $catsubcatAux->modificaCatSubCat();//ahora modifico la tabla catsubcat
    
    //Nota: solo tengo que modificar estas dos tablas ya que categoria y subcategoria
    //estan solo para consultarlas
    
    header("Location: modificarGeneral.php");//vuelvo para elegir si hago mas cambios o salgo
