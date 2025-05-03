<?php
session_start();
include('../includes/header.php');

if ($_SESSION['tipo'] != 'admin') {
    echo "Acceso denegado.";
    include('../includes/footer.php');
    exit;
}

// Obtener datos de la URL
$tipo = $_GET['tipo'] ?? '';
$id = $_GET['id'] ?? '';

if (!in_array($tipo, ['cliente', 'empresa']) || !is_numeric($id)) {
    echo "<p>❌ Parámetros inválidos.</p>";
    include('../includes/footer.php');
    exit;
}

echo "<h2>Confirmar eliminación</h2>";
echo "<p>¿Estás seguro de que deseas eliminar este <strong>$tipo</strong> con ID <strong>$id</strong>?</p>";

echo "<form action='../controllers/eliminar.php' method='POST'>
        <input type='hidden' name='tipo' value='$tipo'>
        <input type='hidden' name='id' value='$id'>
        <button type='submit' name='confirmar'>✅ Sí, eliminar</button>
        <a href='dashboard_admin.php'>❌ Cancelar</a>
      </form>";

include('../includes/footer.php');
?>

