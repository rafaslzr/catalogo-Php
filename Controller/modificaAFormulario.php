<?php

  //require_once 'twig/lib/Twig/Autoloader.php';

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

//    print_r($producto);
 
  header("Location: ../View/modifica.php?idPro=$idPro&nombreCat=$nombreCat&nombreSubCat=$nombreSubCat");
  
//  Twig_Autoloader::register();
//  $loader = new Twig_Loader_Filesystem(__DIR__.'/../View');
//  $twig = new Twig_Environment($loader);
//  
//  echo $twig->render('modifica.html.twig', ['producto' => $producto]);
  
  
 
  
  

  
