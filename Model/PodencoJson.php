<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include "PodencoDB.php";
$consulta = "SELECT idPro, nombrePro
			 FROM producto 
			 ORDER BY idPro ";

$resultado = mysql_query($consulta);
$datosjson = "[";
while ($fila = mysql_fetch_array($resultado)) {
  if ($datosjson != "[") {
    $datosjson .= ",";
  }
  
  $datosjson .= '{"idPro":"' . $fila["idPro"] . '",';
  $datosjson .= '"nombrePro":"' . $fila["nombrePro"] . '",';
  $consulta2 = "SELECT idinmueble, direccion, visita
			 FROM inmueble
			 WHERE visita > 0 and idtipo=" . $fila["idtipo"] . " 
			 ORDER BY idinmueble ";
//echo $consulta2;			 
  $datosjson .= '"inmuebles":';
  $resultado2 = mysql_query($consulta2);
  $datosjson2 = "[";
  while ($fila2 = mysql_fetch_array($resultado2)) {
    if ($datosjson2 != "[") {
      $datosjson2 .= ",";
    }
    $datosjson2 .= '{"idinmueble":"' . $fila2["idinmueble"] . '",';
    $datosjson2 .= '"direccion":"' . $fila2["direccion"] . '",';
        $datosjson2 .= '"visita":"' . $fila2["visita"] . '"}';
  }//while consulta2
  $datosjson2 .="]";
  $datosjson .= $datosjson2;
  $datosjson .= '}';
} //while consulta1

$datosjson .="]"; //fin de la primera consulta

echo $datosjson;
?>
