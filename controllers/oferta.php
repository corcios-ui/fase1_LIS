<?php
session_start();
include '../config/database.php';

if ($_SESSION['tipo'] != 'empresa') die("Acceso denegado");

if (isset($_POST['publicar'])) {
    $empresa_id_query = "SELECT id FROM empresas WHERE usuario = '{$_SESSION['usuario']}' AND aprobada = 1";
    $res = mysqli_query($conn, $empresa_id_query);
    if ($row = mysqli_fetch_assoc($res)) {
        $empresa_id = $row['id'];

        $titulo = $_POST['titulo'];
        $precio_regular = $_POST['precio_regular'];
        $precio_oferta = $_POST['precio_oferta'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $fecha_canje = $_POST['fecha_limite_canje'];
        $cantidad = !empty($_POST['cantidad']) ? $_POST['cantidad'] : "NULL";
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];

        $sql = "INSERT INTO ofertas (empresa_id, titulo, precio_regular, precio_oferta, fecha_inicio, fecha_fin, fecha_limite_canje, cantidad, descripcion, estado)
                VALUES ($empresa_id, '$titulo', $precio_regular, $precio_oferta, '$fecha_inicio', '$fecha_fin', '$fecha_canje', $cantidad, '$descripcion', '$estado')";

        if (mysqli_query($conn, $sql)) {
            echo "Oferta publicada.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "No tienes permisos para publicar.";
    }
}
?>
