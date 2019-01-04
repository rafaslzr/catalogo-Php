<?php

require_once 'PodencoDB.php';

class Producto {
  private $idPro;
  private $nombrePro;
  private $precioPro;
  private $coment1;
  private $coment2;
  private $descripcion;
  private $imagen;
  private $principal;
  private $idCat;
  private $idSubCat;
  
  function __construct($idPro, $nombrePro, $precioPro, $coment1, $coment2, $descripcion, $imagen, $principal, $idCat, $idSubCat) {
    $this->idPro = $idPro;
    $this->nombrePro = $nombrePro;
    $this->precioPro = $precioPro;
    $this->coment1 = $coment1;
    $this->coment2 = $coment2;
    $this->descripcion = $descripcion;
    $this->imagen = $imagen;
    $this->principal = $principal;
    $this->idCat = $idCat;
    $this->idSubCat = $idSubCat;
  }

  public function getIdPro() {
    return $this->idPro;
  }
  public function getNombrePro() {
    return $this->nombrePro;
  }
  function getPrecioPro() {
    return $this->precioPro;
  }
  function getComent1() {
    return $this->coment1;
  }
  function getComent2() {
    return $this->coment2;
  }
  public function getDescripcion() {
    return $this->descripcion;
  }
  public function getImagen() {
    return $this->imagen;
  }
  function getPrincipal() {
    return $this->principal;
  }
  function getIdCat() {
      return $this->idCat;
  }
  function getIdSubCat() {
      return $this->idSubCat;
  }
  
  public static function getIdCatNombre($nombreCat) {
    $conexion = PodencoDB::connectDB();
    $variable = "SELECT idCat FROM categoria WHERE nombreCat=\"".$nombreCat."\"";
    $categ = $conexion->query($variable)->fetchObject();
    $idCategoria = $categ->idCat;
    return $idCategoria;
  }
  
  public static function getIdSubCatNombre($nombreSubCat, $idCategoria) {
    $conexion = PodencoDB::connectDB();
    $variablet = "SELECT idSubCat FROM subcategoria WHERE nombreSubCat=\"".$nombreSubCat."\" and idCat=\"".$idCategoria."\"";
    $subcateg = $conexion->query($variablet)->fetchObject();
    $idSubCategoria = $subcateg->idSubCat;
    return $idSubCategoria;
  }
  
  public static function getProductosCons($idCategoria, $idSubCategoria) {
    $conexion = PodencoDB::connectDB();
    $consultabarra = "SELECT p.* FROM producto p, categoria c, subcategoria s, catsubcat cs WHERE p.idPro=cs.idPro and c.idCat=cs.idCat and s.idSubCat=cs.idSubCat and cs.idCat=\"".$idCategoria."\" and cs.idSubCat=\"".$idSubCategoria."\"";
    $cb = $conexion->query($consultabarra);
    
    while ($registro = $cb->fetchObject()) {
      $productos[] = new Producto($registro->idPro, $registro->nombrePro, $registro->precioPro,
              $registro->coment1, $registro->coment2 ,$registro->descripcion,
              $registro->imagen, $registro->principal);
    }
    return $productos;
  }
  
  public function insertProducto() {
    $conexion = PodencoDB::connectDB();
    $insercion = "INSERT INTO producto (nombrePro, precioPro, coment1, coment2, descripcion, imagen, principal) "
	    . "VALUES ( \"".$this->nombrePro."\", \"".$this->precioPro."\", \"".$this->coment1."\", \"".$this->coment2."\","
	    . " \"".$this->descripcion."\", \"".$this->imagen."\", \"".$this->principal."\")";
    $conexion->exec($insercion);
  }
  public function getIdProFromCSC($nombrePro, $precioPro) {//para obtener el idPro apartir del nombre y precio que se autogenero al insertar
    $conexion = PodencoDB::connectDB();
    $variableid = "SELECT idPro FROM producto WHERE nombrePro=\"".$nombrePro."\" and precioPro=\"".$precioPro."\"";
    $idpro = $conexion->query($variableid)->fetchObject();
    $idprores = $idpro->idPro;     
    return $idprores;
  }
  ///////////////////////////////////////////////////////////////////
  
  public function delete() {
    $conexion = PodencoDB::connectDB();
    $borrado = "DELETE FROM producto WHERE idPro=\"".$this->idPro."\"";
    $conexion->exec($borrado);
  }
  
  public function modificaProducto() {
    $conexion = PodencoDB::connectDB();
    $modificar = "UPDATE producto SET idPro=\"".$this->idPro."\",nombrePro=\""
            .$this->nombrePro."\",precioPro=\"".$this->precioPro."\",coment1=\""
            .$this->coment1."\",coment2=\"".$this->coment2."\",descripcion=\""
            .$this->descripcion."\",`imagen`=\"".$this->imagen."\", principal=\""
            .$this->principal."\" WHERE idPro=\"".$this->idPro."\"";
    $conexion->exec($modificar);
  }
  
  
  public static function getProductoById($idPro) { //añade un producto desde modificaProducto que a su vez viene de formularioPodenco.html.twig
    $conexion = PodencoDB::connectDB();
    $variable = "SELECT idPro, nombrePro, precioPro, coment1, coment2, descripcion, imagen, principal, idSubCat FROM producto WHERE idPro=\"".$idPro."\"";
    $pepe = $conexion->query($variable)->fetchObject();
      $producto = new Producto($pepe->idPro, $pepe->nombrePro, $pepe->precioPro,
              $pepe->coment1, $pepe->coment2 ,$pepe->descripcion, $pepe->imagen,
              $pepe->principal, $pepe->idSubCat);
    return $producto;
  }

  public static function getIdCatIdPro() {
    $conexion = PodencoDB::connectDB();
    $variable = "SELECT idCat FROM catsubcat WHERE idPro=\"".$_GET['idPro']."\"";
    $idkatego = $conexion->query($variable)->fetchObject();
      $idCatego = $idkatego->idCat;
    return $idCatego;
  }
  public static function getNombreCatIdCat($idCategoria) {
    $conexion = PodencoDB::connectDB();
    $variable = "SELECT nombreCat FROM categoria WHERE idCat=\"".$idCategoria."\"";
    $nombrekatego = $conexion->query($variable)->fetchObject();
      $nombreCatego = $nombrekatego->nombreCat;
    return $nombreCatego;
  }
  public static function getNombreSubCatIdCat($idSubCategoria) {
    $conexion = PodencoDB::connectDB();
    $variable = "SELECT nombreSubCat FROM subcategoria WHERE idSubCat=\"".$idSubCategoria."\"";
    $nombresubkatego = $conexion->query($variable)->fetchObject();
      $nombreSubCatego = $nombresubkatego->nombreSubCat;
    return $nombreSubCatego;
  }
  public static function getIdSubCatIdPro() {
    $conexion = PodencoDB::connectDB();
    $variable = "SELECT idSubCat FROM catsubcat WHERE idPro=\"".$_GET['idPro']."\"";
    $idsubkatego = $conexion->query($variable)->fetchObject();
      $idSubCatego = $idsubkatego->idSubCat;
    return $idSubCatego;
  }
  public static function getProducto($nombreCatego, $nombreSubCatego) {
    $conexion = PodencoDB::connectDB();
    $variable = "SELECT idPro, nombrePro, precioPro, coment1, coment2, descripcion"
            . ", imagen, principal FROM producto WHERE idPro=\"".$_GET['idPro']."\"";
    $pepe = $conexion->query($variable)->fetchObject();
      $producto = new Producto($pepe->idPro, $pepe->nombrePro, $pepe->precioPro,
              $pepe->coment1, $pepe->coment2 ,$pepe->descripcion,
              $pepe->imagen, $pepe->principal, $nombreCatego, $nombreSubCatego);
    return $producto;
  }
  
  public static function getProductosInd() {
    $conexion = PodencoDB::connectDB();
    $seleccion = "SELECT idPro ,nombrePro, precioPro, coment1, coment2, descripcion"
            . ", imagen, principal FROM producto where principal = 'checked'";
    $consulta = $conexion->query($seleccion);
    
    
    while ($registro = $consulta->fetchObject()) {
      $productos[] = new Producto($registro->idPro, $registro->nombrePro, $registro->precioPro, $registro->coment1, $registro->coment2 ,$registro->descripcion, $registro->imagen, $registro->principal);
    }   
    return $productos;    
  }
  
  public static function getProductosGen() {//selecciona la tabla producto en todos los productos
    $conexion = PodencoDB::connectDB();
    $seleccion = "SELECT idPro ,nombrePro, precioPro, coment1, coment2, descripcion, imagen, principal FROM producto";
    $consulta = $conexion->query($seleccion);
    
    
    while ($registro = $consulta->fetchObject()) {
      $productos[] = new Producto($registro->idPro, $registro->nombrePro, $registro->precioPro,
              $registro->coment1, $registro->coment2 ,$registro->descripcion,
              $registro->imagen, $registro->principal);
    }   
    return $productos;    
  }

}