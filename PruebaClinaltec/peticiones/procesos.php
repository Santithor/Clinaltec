<?php
include_once("../includes/funciones.php");

// Agregar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $municipality = $_POST['municipality'];

    $query = "INSERT INTO usuarios (id, nombre, departamento, municipio) VALUES (:id, :name, :department, :municipality)";
    ejecutarConsulta($query, [':id' => $id, ':name' => $name, ':department' => $department, ':municipality' => $municipality]);
    exit;
}

// Obtener usuarios para la tabla
if (isset($_POST['action']) && $_POST['action'] === 'getUsers') {
    $query = "SELECT u.id, u.nombre, d.descripcion AS departamento, m.descripcion AS municipio
              FROM usuarios u
              JOIN departamentos d ON u.departamento = d.id
              JOIN municipios m ON u.municipio = m.id";
    $users = ejecutarConsulta($query);

    foreach ($users as $user) {
        echo "<tr><td>{$user['id']}</td><td>{$user['nombre']}</td><td>{$user['departamento']}</td><td>{$user['municipio']}</td></tr>";
    }
    exit;
}

// Obtener la cantidad de usuarios
if (isset($_POST['action']) && $_POST['action'] === 'getUserCount') {
    $query = "SELECT COUNT(*) as count FROM usuarios";
    $result = ejecutarConsulta($query);
    echo $result[0]['count'];
    exit;
}

// Obtener departamentos para el select input
if (isset($_POST['action']) && $_POST['action'] === 'getDepartments') {
    $query = "SELECT id, descripcion FROM departamentos";
    $departments = ejecutarConsulta($query);

    echo '<option value="">Seleccione un departamento</option>';
    foreach ($departments as $department) {
        echo "<option value='{$department['id']}'>{$department['descripcion']}</option>";
    }
    exit;
}

// Obtener municipios para el select input
if (isset($_POST['action']) && $_POST['action'] === 'getMunicipalities') {
    $departmentId = $_POST['departmentId'];
    $query = "SELECT id, descripcion FROM municipios WHERE id_departamento = :departmentId";
    $municipalities = ejecutarConsulta($query, [':departmentId' => $departmentId]);

    echo '<option value="">Seleccione un municipio</option>';
    foreach ($municipalities as $municipality) {
        echo "<option value='{$municipality['id']}'>{$municipality['descripcion']}</option>";
    }
    exit;
}
?>
