<?php

include_once('db-connection.php');


// Consulta para obtener los posters de la categoría
$sql = "WITH CategoriasConVotos AS (
    SELECT v.id_categoria, c.descripcion AS categoria, COUNT(v.id_categoria) AS votos, 
    CASE 
    	WHEN v.id_categoria = 1 THEN p.descripcion
    	WHEN v.id_categoria = 2 THEN o.descripcion
    	WHEN v.id_categoria = 3 THEN p.descripcion
    	ELSE o.descripcion
    END as descripcion_trabajo,
    CASE 
    	WHEN v.id_categoria = 1 THEN p.id
    	WHEN v.id_categoria = 2 THEN o.id
    	WHEN v.id_categoria = 3 THEN p.id
    	ELSE o.id
    END as id_trabajo
    FROM tbl_votaciones v
    JOIN tbl_categorias c ON c.id = v.id_categoria
    LEFT JOIN tbl_posters p ON p.id = v.id_trabajo
    LEFT JOIN tbl_descripcion_oral o ON o.id = v.id_trabajo
    GROUP BY v.id_categoria, c.descripcion, p.descripcion, o.descripcion, p.id, o.id
)
,
MaxVotosPorCategoria AS (
    SELECT id_categoria, MAX(votos) AS max_votos
    FROM CategoriasConVotos
    GROUP BY id_categoria
)
SELECT cv.id_categoria, cv.categoria, upper(cv.descripcion_trabajo) as descripcion_trabajo, cv.votos, cv.id_trabajo
FROM CategoriasConVotos cv
JOIN MaxVotosPorCategoria mv ON cv.id_categoria = mv.id_categoria AND cv.votos = mv.max_votos;";

$stmt = $mysqli->prepare($sql);
//$stmt->bind_param('i', $idCategoria);
$stmt->execute();
$result = $stmt->get_result();


// Cerrar la conexión a la base de datos
$stmt->close();
$mysqli->close();



?>