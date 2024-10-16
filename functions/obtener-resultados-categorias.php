<?php

include_once('db-connection.php');


// Consulta para obtener los posters de la categoría
/*$sql = "WITH CategoriasConVotos AS (
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
    WHERE v.deleted_at is null
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
JOIN MaxVotosPorCategoria mv ON cv.id_categoria = mv.id_categoria AND cv.votos = mv.max_votos;";*/

$sql="
    WITH CategoriasConVotos AS (
    SELECT 
        v.id_categoria, 
        c.descripcion AS categoria, 
        COUNT(v.id_categoria) AS votos, 
        CASE 
            WHEN v.id_categoria = 1 THEN p.descripcion
            WHEN v.id_categoria = 2 THEN o.descripcion
            ELSE NULL
        END AS descripcion_trabajo,
        CASE 
            WHEN v.id_categoria = 1 THEN p.id
            WHEN v.id_categoria = 2 THEN o.id
            ELSE NULL
        END AS id_trabajo
    FROM tbl_votaciones v
    JOIN tbl_categorias c ON c.id = v.id_categoria
    LEFT JOIN tbl_posters p ON p.id = v.id_trabajo
    LEFT JOIN tbl_descripcion_oral o ON o.id = v.id_trabajo
    WHERE v.deleted_at IS NULL
      AND v.id_categoria IN (1, 2)  -- Filtramos solo las categorías 1 y 2
    GROUP BY v.id_categoria, c.descripcion, p.descripcion, o.descripcion, p.id, o.id
),
RankingCategorias AS (
    SELECT 
        cv.*,
        ROW_NUMBER() OVER (PARTITION BY cv.id_categoria ORDER BY cv.votos DESC) AS ranking
    FROM CategoriasConVotos cv
)
SELECT 
    id_categoria, 
    categoria, 
    UPPER(descripcion_trabajo) AS descripcion_trabajo, 
    votos, 
    id_trabajo
FROM RankingCategorias
WHERE 
    (id_categoria = 1 AND ranking <= 3)  -- Top 3 para la categoría 1
    OR (id_categoria = 2 AND ranking = 1);
";
$stmt = $mysqli->prepare($sql);
//$stmt->bind_param('i', $idCategoria);
$stmt->execute();
$result = $stmt->get_result();


// Cerrar la conexión a la base de datos
$stmt->close();
$mysqli->close();



?>