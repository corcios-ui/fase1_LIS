<?php
session_start();
include '../config/database.php';

if (isset($_POST['login'])) {
    $tipo = $_POST['tipo_usuario'];
    $usuario = trim($_POST['usuario']);
    $pass = $_POST['contrasena'];

    // Validación básica
    if (empty($usuario) || empty($pass)) {
        die("<p style='color:red;'>❌ Usuario y contraseña son obligatorios.</p>");
    }

    if (!preg_match("/^[A-Za-z0-9_]{4,20}$/", $usuario)) {
        die("<p style='color:red;'>❌ Usuario inválido. Usa solo letras, números y guión bajo.</p>");
    }

    // Tabla según tipo
    switch ($tipo) {
        case 'admin': $tabla = 'administradores'; break;
        case 'cliente': $tabla = 'clientes'; break;
        case 'empresa': $tabla = 'empresas'; break;
        default:
            die("<p style='color:red;'>❌ Tipo de usuario no válido.</p>");
    }

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
