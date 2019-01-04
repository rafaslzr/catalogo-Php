<?php
  require_once '../Model/PodencoDB.php';
  require_once '../Model/Producto.php';
  require_once 'twig/lib/Twig/Autoloader.php';
  
  Twig_Autoloader::register();
  $loader = new Twig_Loader_Filesystem(__DIR__.'/../View');
  $twig = new Twig_Environment($loader);
  
  $productos = Producto::getProductosInd();
 
  echo $twig->render('principal.html.twig', ['productos' => $productos]);