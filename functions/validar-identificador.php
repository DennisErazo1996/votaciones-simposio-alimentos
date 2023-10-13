<?php

include_once('db-connection.php');

// Obtener el identificador de la solicitud
$identificador = $_GET['identificador'];

// Crear una consulta SQL
$sql = "SELECT COUNT(*) existe, id, nombre FROM tbl_participantes WHERE identificador = ? GROUP BY nombre, id;";

// Preparar la consulta
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $mysqli->error);
}

// Vincular el parámetro a la consulta
$stmt->bind_param('s', $identificador);

// Ejecutar la consulta
if (!$stmt->execute()) {
    die('Error al ejecutar la consulta: ' . $stmt->error);
}

// Obtener el resultado de la consulta
$stmt->bind_result($existe, $id, $nombre);
$stmt->fetch();

// Cerrar la conexión a la base de datos
$stmt->close();
$mysqli->close();

// Devolver el resultado de la consulta
echo json_encode(['existe' => $existe, 'nombre'=>$nombre, 'id'=>$id]);

?>