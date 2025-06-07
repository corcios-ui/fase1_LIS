<?php
session_start();
include('../config/database.php');
include('../includes/header.php');

if ($_SESSION['tipo'] != 'admin') {
    echo "<div class='alert alert-danger'>Acceso denegado.</div>";
    include('../includes/footer.php');
    exit;
}

echo "<div class='container mt-4'>";
echo "<h2>Eliminar Usuarios</h2>";

if (isset($_GET['tipo']) && isset($_GET['id'])) {
    $tipo = $_GET['tipo'];
    $id = intval($_GET['id']);

    $tabla = ($tipo === 'cliente') ? 'clientes' : (($tipo === 'empresa') ? 'empresas' : null);

    if ($tabla) {
        $del = mysqli_query($conn, "DELETE FROM $tabla WHERE id = $id");
        echo $del ? "<div class='alert alert-success'>Usuario eliminado.</div>" : "<div class='alert alert-danger'>Error al eliminar.</div>";
    } else {
        echo "<div class='alert alert-warning'>❌ Parámetros inválidos.</div>";
    }
}

// Mostrar usuarios
$res_c = mysqli_query($conn, "SELECT id, usuario, correo FROM clientes");
$res_e = mysqli_query($conn, "SELECT id, nombre AS usuario, correo FROM empresas");

echo "<h4 class='mt-4'>Clientes</h4><ul class='list-group'>";
while ($c = mysqli_fetch_assoc($res_c)) {
    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
            {$c['usuario']} ({$c['correo']})
            <a href='eliminar.php?tipo=cliente&id={$c['id']}' class='btn btn-sm btn-danger'>Eliminar</a>
          </li>";
}
echo "</ul>";

echo "<h4 class='mt-4'>Empresas</h4><ul class='list-group'>";
while ($e = mysqli_fetch_assoc($res_e)) {
    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
            {$e['usuario']} ({$e['correo']})
            <a href='eliminar.php?tipo=empresa&id={$e['id']}' class='btn btn-sm btn-danger'>Eliminar</a>
          </li>";
}
echo "</ul></div>";

include('../includes/footer.php');
?>
