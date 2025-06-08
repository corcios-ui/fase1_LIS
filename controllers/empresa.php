<?php
include '../config/database.php';

if (isset($_POST['registrar_empresa'])) {
    $nombre = trim($_POST['nombre']);
    $nit = $_POST['nit'];
    $direccion = trim($_POST['direccion']);
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $usuario = trim($_POST['usuario']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ 0-9]{3,50}$/", $nombre)) {
        die("Nombre de empresa inválido.");
    }
    if (!preg_match("/^[0-9\-]{14,17}$/", $nit)) {
        die("NIT inválido.");
    }
    if (!preg_match("/^\d{8}$/", $telefono)) {
        die("Teléfono inválido.");
    }
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Correo inválido.");
    }
    if (!preg_match("/^[A-Za-z0-9_]{4,20}$/", $usuario)) {
        die("Usuario inválido.");
    }

    // Validar si el usuario ya existe
    $check = "SELECT id FROM empresas WHERE usuario = '$usuario'";
    $res = mysqli_query($conn, $check);
    if (mysqli_num_rows($res) > 0) {
    die("El nombre de usuario ya está en uso. Por favor elige otro.");
    }


    $sql = "INSERT INTO empresas (nombre, nit, direccion, telefono, correo, usuario, contrasena)
            VALUES ('$nombre', '$nit', '$direccion', '$telefono', '$correo', '$usuario', '$contrasena')";

    if (mysqli_query($conn, $sql)) {
        echo "Registro enviado. Espera aprobación del administrador.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
