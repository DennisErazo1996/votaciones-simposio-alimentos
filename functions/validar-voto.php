<?php

include_once('db-connection.php');


$idCategoria = $_GET['idCategoria'];
$idParticipante = $_GET['idParticipante'];


$sql = "SELECT id_categoria, id_participante FROM tbl_votaciones WHERE id_categoria = ? AND id_participante = ?;";
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $mysqli->error);
}

$stmt->bind_param('ii', $idCategoria, $idParticipante);

if (!$stmt->execute()) {
    die('Error al ejecutar la consulta: ' . $stmt->error);
}

$stmt->bind_result($id_categoria, $id_participante);
$stmt->fetch();

// Cerrar la conexión a la base de datos
$stmt->close();
$mysqli->close();

echo json_encode(['idCategoria' => $id_categoria, 'idParticipante'=>$id_participante]);

?>