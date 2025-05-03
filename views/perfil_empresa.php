<?php
session_start();
include('../config/database.php');
include('../includes/header.php');

if ($_SESSION['tipo'] != 'empresa') {
    echo "Acceso denegado.";
    include('../includes/footer.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$res = mysqli_query($conn, "SELECT * FROM empresas WHERE usuario = '$usuario'");
$empresa = mysqli_fetch_assoc($res);

echo "<h2>Perfil de Empresa</h2>";
echo "<p><strong>Nombre:</strong> {$empresa['nombre']}</p>";
echo "<p><strong>NIT:</strong> {$empresa['nit']}</p>";
echo "<p><strong>Correo:</strong> {$empresa['correo']}</p>";
echo "<p><strong>Teléfono:</strong> {$empresa['telefono']}</p>";
echo "<p><strong>Dirección:</strong> {$empresa['direccion']}</p>";
echo "<p><strong>Comisión:</strong> {$empresa['porcentaje_comision']}%</p>";

echo "<p><a href='../controllers/logout.php'>Cerrar sesión</a></p>";

include('../includes/footer.php');
?>
