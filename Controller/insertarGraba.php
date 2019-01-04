<?php
    require_once '../Model/Producto.php';
    require_once '../Model/CatSubCat.php';
    

    // sube la imagen al servidor
    ////move_uploaded_file($_FILES["imagen"]["tmp_name"], "../View/images/" . $_FILES["imagen"]["name"]);

    // inserta el producto en la base de datos
    $principal = "";
    if($_POST['principal'] == "on"){
        $principal = "checked";
    }
    $productoAux = new Producto("", $_POST['nombrePro'], $_POST['precioPro'],
            $_POST['coment1'], $_POST['coment2'], $_POST['descripcion'],
            $_POST['imagen'], $principal, $_POST['nombreCat'], $_POST['nombreSubCat']);
    
    //print_r($productoAux);
    $productoAux->insertProducto();
    
    $nombrePro = $_POST['nombrePro'];
    $precioPro = $_POST['precioPro'];
    $nombreCat = $_POST['nombreCat'];
    $nombreSubCat = $_POST['nombreSubCat'];
    print_r($nombreCat);
    
    $idProducto = Producto::getIdProFromCSC($nombrePro, $precioPro);
    print_r($idProducto);
    
    print_r($nombreSubCat);
    $idCategoria = Producto::getIdCatNombre($nombreCat);
    print_r($idCategoria);

    $idSubCategoria = Producto::getIdSubCatNombre($nombreSubCat, $idCategoria);
    print_r($idSubCategoria);
    
    $catsubcatAux = new CatSubCat($idProducto, $idCategoria, $idSubCategoria);
    print_r($productoAux2 );
    $catsubcatAux->insertCatSubcat();
    
     
    header("Location: modificarGeneral.php");