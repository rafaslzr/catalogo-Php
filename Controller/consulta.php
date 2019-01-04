<?php
    require_once '../Model/Producto.php';
    require_once 'twig/lib/Twig/Autoloader.php';

    Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem(__DIR__.'/../View');
    $twig = new Twig_Environment($loader);

    require_once '../Model/PodencoDB.php';
    
    //lo primero es conseguir el id de categoria y subcategoria para poder filtrar
    //la informacion como la barra de menus delplegable los organiza
    $nombreCat = $_GET['nombreCat'];
    $nombreSubCat = $_GET['nombreSubCat'];
    
    $idCategoria = Producto::getIdCatNombre($nombreCat);

    $idSubCategoria = Producto::getIdSubCatNombre($nombreSubCat, $idCategoria);
    
    //ahora si se puede mandar la informacion para hacer un select por categoria
    //y subcategoria para que responda al menu desplegable
    $productos = Producto::getProductosCons($idCategoria, $idSubCategoria);

    echo $twig->render('consulta.html.twig', ['productos' => $productos]);