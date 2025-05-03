<?php
session_start();
include('../config/database.php');

if ($_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

if (isset($_POST['confirmar']) && isset($_POST['tipo']) && isset($_POST['id'])) {
    $tipo = $_POST['tipo'];
    $id = (int)$_POST['id'];

    if (!in_array($tipo, ['cliente', 'empresa'])) {
        die("Tipo inválido.");
    }

    $tabla = $tipo === 'cliente' ? 'clientes' : 'empresas';

    $query = "DELETE FROM $tabla WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../views/dashboard_admin.php?msg=eliminado");
        exit;
    } else {
        echo "❌ Error al eliminar: " . mysqli_error($conn);
    }
} else {
    echo "❌ Datos incompletos.";
}
?>
