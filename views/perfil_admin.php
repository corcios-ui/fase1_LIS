<?php
session_start();
include('../includes/header.php');

if ($_SESSION['tipo'] != 'admin') {
    echo "Acceso denegado.";
    include('../includes/footer.php');
    exit;
}

echo "<h2>Panel del Administrador</h2>";
echo "<p>Bienvenido <strong>{$_SESSION['usuario']}</strong>. Desde aquí puedes gestionar el sistema.</p>";
echo "<ul>
        <li><a href='dashboard_admin.php'>Inicio admin</a></li>
        <li><a href='reportes_admin.php'>Reportes</a></li>
        <li><a href='empresas_pendientes.php'>Empresas pendientes</a></li>
        <li><a href='ver_empresas.php'>Ver empresas</a></li>
        <li><a href='ver_clientes.php'>Ver clientes</a></li>
        <li><a href='eliminar.php'>Eliminar clientes y empresas</a></li>
      </ul>";

echo "<p><a href='../controllers/logout.php'>Cerrar sesión</a></p>";

include('../includes/footer.php');
?>
