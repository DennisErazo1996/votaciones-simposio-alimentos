<?php

include_once('db-connection.php');

$idCategoria = $_GET['categoria'];
$idParticipante = $_GET['participante'];

// Consulta para obtener los posters de la categoría
$sql = "Select row_number() over(order by x.id_trabajo) as numero, x.* from (SELECT p.id as id_trabajo, p.autor, p.descripcion, p.id_categoria, cat.descripcion as descripcion_categoria FROM tbl_posters p join tbl_categorias cat on p.id_categoria = cat.id where p.deleted_at is null
UNION ALL
SELECT o.id as id_trabajo, o.descripcion, o.autor , o.id_categoria, cat.descripcion as descripcion_categoria FROM tbl_descripcion_oral o join tbl_categorias cat on o.id_categoria = cat.id where o.deleted_at is null) x
where x.id_categoria = ?;";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $idCategoria);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
//var_dump($row);
$descripcionCategoria = $row['descripcion_categoria'];
$result->data_seek(0);  // Restablece el puntero a la primera fila


// Cerrar la conexión a la base de datos
$stmt->close();
$mysqli->close();



?>