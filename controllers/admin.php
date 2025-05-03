<?php
include '../config/database.php';

if (isset($_POST['aprobar'])) {
    $id = $_POST['id'];
    $comision = $_POST['comision'];
    $sql = "UPDATE empresas SET aprobada = 1, porcentaje_comision = $comision WHERE id = $id";
    mysqli_query($conn, $sql);
    header("Location: ../views/empresas_pendientes.php");
} elseif (isset($_POST['rechazar'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM empresas WHERE id = $id";
    mysqli_query($conn, $sql);
    header("Location: ../views/empresas_pendientes.php");
}
?>
