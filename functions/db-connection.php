<?php

// Define los datos de conexión
$host = "localhost";
$user = "root";
$password = "";
$database = "v_simposio_alimentos";

// Crea la conexión
$mysqli = new mysqli($host, $user, $password, $database);

// Comprueba la conexión
if ($mysqli->connect_error) {
  die("Error al conectarse a la base de datos: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");

?>