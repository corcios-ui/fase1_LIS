<?php
include '../config/database.php';

if (isset($_POST['recuperar'])) {
    $tipo = $_POST['tipo_usuario'];
    $usuario = trim($_POST['usuario']);
    $nueva = $_POST['nueva'];

    if (empty($usuario) || empty($nueva)) {
        die("Campos requeridos.");
    }

    if (strlen($nueva) < 6) {
        die("La nueva contraseña debe tener al menos 6 caracteres.");
    }

    $tabla = $tipo === 'cliente' ? 'clientes' : ($tipo === 'empresa' ? 'empresas' : 'administradores');
    $nueva_hash = password_hash($nueva, PASSWORD_DEFAULT);

    $sql = "UPDATE $tabla SET contrasena = '$nueva_hash' WHERE usuario = '$usuario'";
    if (mysqli_query($conn, $sql)) {
        echo "✅ Contraseña actualizada correctamente.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
