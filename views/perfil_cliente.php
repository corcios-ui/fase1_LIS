<?php
session_start();
include('../config/database.php');
include('../includes/header.php');

if ($_SESSION['tipo'] != 'cliente') {
    echo "Acceso denegado.";
    include('../includes/footer.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$res = mysqli_query($conn, "SELECT * FROM clientes WHERE usuario = '$usuario'");
$cliente = mysqli_fetch_assoc($res);

echo "<h2>Mi Perfil</h2>";
echo "<p><strong>Usuario:</strong> {$cliente['usuario']}</p>";
echo "<p><strong>Nombre completo:</strong> {$cliente['nombre_completo']} {$cliente['apellidos']}</p>";
echo "<p><strong>Correo:</strong> {$cliente['correo']}</p>";
echo "<p><strong>DUI:</strong> {$cliente['dui']}</p>";
echo "<p><strong>Fecha de nacimiento:</strong> {$cliente['fecha_nacimiento']}</p>";

echo "<p><a href='../controllers/logout.php'>Cerrar sesión</a></p>";

include('../includes/footer.php');
?>
