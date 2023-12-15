<?php
$servername = "monorail.proxy.rlwy.net";
$username = "railway";
$password = "cH12AH-FGeAbA-AGeeGg1bDh6aa4f31h"; // Considera el manejo seguro de contraseñas
$dbname = "railway";
$port = 52067; // Puerto específico para MySQL

// Intenta establecer una conexión a la base de datos
$connection = new mysqli($servername, $username, $password, $dbname, $port);

// Verifica si la conexión fue exitosa
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Si la conexión fue exitosa, muestra un mensaje en la consola
echo "<script> console.log('Connected successfully to the database') </script>";

// Cierra la conexión después de realizar las operaciones necesarias
$connection->close();
?>

