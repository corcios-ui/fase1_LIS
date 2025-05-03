<?php
include '../config/database.php';

if (isset($_POST['recuperar'])) {
    $tipo = $_POST['tipo_usuario'];
    $usuario = $_POST['usuario'];
    $nueva = password_hash($_POST['nueva'], PASSWORD_DEFAULT);

    $tabla = $tipo === 'cliente' ? 'clientes' : ($tipo === 'empresa' ? 'empresas' : 'administradores');

    $sql = "UPDATE $tabla SET contrasena = '$nueva' WHERE usuario = '$usuario'";
    if (mysqli_query($conn, $sql)) {
        echo "Contraseña actualizada correctamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
