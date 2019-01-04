<?php
  require_once '../Model/Producto.php';
  require_once 'twig/lib/Twig/Autoloader.php';
  require_once '../Model/PodencoDB.php';
  
  Twig_Autoloader::register();
  $loader = new Twig_Loader_Filesystem(__DIR__.'/../View');
  $twig = new Twig_Environment($loader);

  $productos = Producto::getProductosGen();//selecciona la tabla producto en todos los productos
 
  echo $twig->render('modificarGeneral.html.twig', ['productos' => $productos]);