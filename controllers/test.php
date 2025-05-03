<?php
session_start();
include '../config/database.php';

if (isset($_POST['login'])) {
    $tipo = $_POST['tipo_usuario'];         // cliente / empresa / admin
    $usuario = trim($_POST['usuario']);
    $pass = $_POST['contrasena'];

    $tabla = $tipo === 'cliente' ? 'clientes' : ($tipo === 'empresa' ? 'empresas' : 'administradores');

    $sql = "SELECT * FROM $tabla WHERE usuario = '$usuario'";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        die("❌ Error en query: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($res) === 0) {
        die("❌ Usuario no encontrado en tabla '$tabla'");
    }

    $row = mysqli_fetch_assoc($res);

    echo "🔐 Usuario encontrado: " . $row['usuario'] . "<br>";
    echo "🔐 Contraseña guardada (hash): " . $row['contrasena'] . "<br>";

    if (password_verify($pass, $row['contrasena'])) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo'] = $tipo;
        echo "✅ Contraseña verificada correctamente. Redirigiendo...";
        header("Location: ../views/dashboard_{$tipo}.php");
        exit;
    } else {
        echo "❌ La contraseña no coincide con el hash.";
    }
}
?>
