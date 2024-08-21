<?php
// // agregar_paciente.php

// // Conectar a la base de datos
// $serverName = "localhost";
// $connectionOptions = array(
//     "Database" => "ClinicaDB",
//     "Uid" => "tu_usuario", // Cambiar por tu usuario de SQL Server
//     "PWD" => "tu_contraseña" // Cambiar por tu contraseña de SQL Server
// );

// $conn = sqlsrv_connect($serverName, $connectionOptions);

// if ($conn === false) {
//     die(print_r(sqlsrv_errors(), true));
// }

// Obtener los datos del formulario

$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$genero = $_POST['genero'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];

// Insertar el nuevo paciente en la base de datos
$sql = "INSERT INTO Pacientes (Nombre, Edad, Género, DepartamentoID, MunicipioID) 
        VALUES (?, ?, ?, (SELECT DepartamentoID FROM Departamentos WHERE Descripcion = ?), 
                      (SELECT MunicipioID FROM Municipios WHERE Descripcion = ?))";
$params = array($nombre, $edad, $genero, $departamento, $municipio);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Obtener el ID del paciente recién agregado
$pacienteID = sqlsrv_query($conn, "SELECT SCOPE_IDENTITY() AS id");
$pacienteID = sqlsrv_fetch_array($pacienteID, SQLSRV_FETCH_ASSOC)['id'];

// Cerrar la conexión
sqlsrv_close($conn);

// Enviar la respuesta al cliente con el ID del nuevo paciente
echo json_encode(array("success" => true, "id" => $pacienteID));
?>
