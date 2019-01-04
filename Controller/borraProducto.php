<?php
  require_once '../Model/Producto.php';
  require_once '../Model/CatSubCat.php';
  
  $productoAux = new Producto($_GET['idPro']);
  $productoAux->delete();
  
  $catsubcatAux = new CatSubCat($_GET['idPro']);
  $catsubcatAux->delete();
  
  header("Location: ../Controller/modificarGeneral.php");
