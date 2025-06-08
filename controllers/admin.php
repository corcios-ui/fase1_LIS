<?php
include '../config/database.php';

if (isset($_POST['aprobar'])) {
    $id = intval($_POST['id']);
    $comision = floatval($_POST['comision']);

    if ($comision < 0 || $comision > 100) {
        die("La comisión debe estar entre 0 y 100.");
    }

    $sql = "UPDATE empresas SET aprobada = 1, porcentaje_comision = $comision WHERE id = $id";
    mysqli_query($conn, $sql);
    header("Location: ../views/empresas_pendientes.php");

} elseif (isset($_POST['rechazar'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM empresas WHERE id = $id";
    mysqli_query($conn, $sql);
    header("Location: ../views/empresas_pendientes.php");
}

?>
