<?php
include_once("./includes/funciones.php");

$query = "SELECT * FROM Pacientes";
$resultados = ejecutarConsulta($query);

echo "<pre>";
print_r($resultados);
echo "</pre>";
?>
