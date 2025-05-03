<?php
session_start();
include '../config/database.php';

if ($_SESSION['tipo'] != 'empresa') {
    die("Acceso denegado.");
}

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $precio_regular = $_POST['precio_regular'];
    $precio_oferta = $_POST['precio_oferta'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $fecha_canje = $_POST['fecha_limite_canje'];
    $cantidad = !empty($_POST['cantidad']) ? $_POST['cantidad'] : "NULL";
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    $sql = "UPDATE ofertas SET
                titulo = '$titulo',
                precio_regular = $precio_regular,
                precio_oferta = $precio_oferta,
                fecha_inicio = '$fecha_inicio',
                fecha_fin = '$fecha_fin',
                fecha_limite_canje = '$fecha_canje',
                cantidad = $cantidad,
                descripcion = '$descripcion',
                estado = '$estado'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Oferta actualizada correctamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} elseif (isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM ofertas WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Oferta eliminada correctamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
