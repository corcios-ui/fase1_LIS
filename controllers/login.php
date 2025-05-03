<?php
session_start();
include '../config/database.php';

if (isset($_POST['login'])) {
    $tipo = $_POST['tipo_usuario'];
    $usuario = trim($_POST['usuario']);
    $pass = $_POST['contrasena'];

    // Si es admin con credenciales quemadas
    if ($tipo === 'admin' && $usuario === 'jose' && $pass === 'jose') {
        $_SESSION['usuario'] = 'jose';
        $_SESSION['tipo'] = 'admin';
        header("Location: ../views/perfil_admin.php");
        exit;
    }

    // Cliente o empresa con verificación desde base de datos
    $tabla = $tipo === 'cliente' ? 'clientes' : 'empresas';
    $usuario_seguro = mysqli_real_escape_string($conn, $usuario);
    $sql = "SELECT * FROM $tabla WHERE usuario = '$usuario_seguro'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (password_verify($pass, $row['contrasena'])) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['tipo'] = $tipo;
            header("Location: ../views/perfil_{$tipo}.php");
            exit;
        }
    }

    echo "<p style='color:red;'>❌ Credenciales incorrectas.</p>";
}
?>
