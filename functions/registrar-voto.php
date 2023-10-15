<?php

include_once('db-connection.php');

$idCategoria = $_GET['categoria'];
$idParticipante = $_GET['participante'];
$idTrabajo = $_GET['idTrabajo'];

// Consulta para obtener los posters de la categoría
$sql = "insert into tbl_votaciones(id_participante, id_trabajo, id_categoria) values(?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('iii', $idParticipante, $idTrabajo, $idCategoria);
$stmt->execute();
$result = $stmt->get_result();


// Cerrar la conexión a la base de datos
$stmt->close();
$mysqli->close();



?>