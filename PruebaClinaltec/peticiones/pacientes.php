<?php
header('Content-Type: application/json');   
include_once("../includes/funciones.php");

$datos_pacientes = array();  

$query = "SELECT PacienteID,
                Nombre,
                Edad,
                Genero,
                dep.Descripción Departamento,
                mun.Descripcion Municipio
            FROM dbo.Pacientes d_pa
            INNER JOIN dbo.Departamentos dep ON (dep.DepartamentoID = d_pa.DepartamentoID)
            INNER JOIN dbo.Municipios mun ON (mun.MunicipioID = d_pa.MunicipioID
                                            AND mun.DepartamentoID = dep.DepartamentoID)";
$resultados = ejecutarConsulta($query);


foreach($resultados as $data){
    $datos_pacientes[] = array(
                                "PacienteID"    => $data["PacienteID"],
                                "Nombre"        => $data["Nombre"],
                                "Edad"          => $data["Edad"],
                                "Genero"        => $data["Genero"],
                                "Departamento"  => $data["Departamento"],
                                "Municipio"     => $data["Municipio"]
                                );
}