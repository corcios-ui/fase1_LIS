<?php
$host = "localhost";
$user = "root";
$pass = "1234567890";
$dbname = "cuponera";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}
?>

