<?php

require_once 'PodencoDB.php';

class CatSubCat {
    private $idPro;
    private $idCat;
    private $idSubCat;  

    function __construct($idPro, $idCat, $idSubCat) {
        $this->idPro = $idPro;
        $this->idCat = $idCat;
        $this->idSubCat = $idSubCat;
    }
    function getIdPro() {
        return $this->idPro;
    }

    function getIdCat() {
        return $this->idCat;
    }

    function getIdSubCat() {
        return $this->idSubCat;
    }
    public function insertCatSubcat() {
        $conexion = PodencoDB::connectDB();
        $insercioncasu = "INSERT INTO catsubcat (idPro, idCat, idSubCat) "
                . "VALUES ( \"".$this->idPro."\", \"".$this->idCat."\", \"".$this->idSubCat."\")";
        $conexion->exec($insercioncasu);
    }
    public function delete() {
        $conexion = PodencoDB::connectDB();
        $borrado = "DELETE FROM catsubcat WHERE idPro=\"".$this->idPro."\"";
        $conexion->exec($borrado);
    }
    public function modificaCatSubCat() {
        $conexion = PodencoDB::connectDB();
        $modificar = "UPDATE catsubcat SET idPro=\"".$this->idPro."\", idCat=\"".$this->idCat."\", idSubCat=\"".$this->idSubCat."\" WHERE idPro=\"".$this->idPro."\"";
        $conexion->exec($modificar);
    }
}