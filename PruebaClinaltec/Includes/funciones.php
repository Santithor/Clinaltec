<?php
include_once("conexion.php");

function ejecutarConsulta($query, $params = []) {
    $conn = conectar();
    try {
        $stmt = $conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        if (stripos($query, 'SELECT') === 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $stmt->rowCount();
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    } finally {
        $conn = null;
    }
}
?>
