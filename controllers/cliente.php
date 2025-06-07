<?php
include '../config/database.php';

if (isset($_POST['registrar_cliente'])) {
    $usuario = trim($_POST['usuario']);
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $nombre = trim($_POST['nombre_completo']);
    $apellidos = trim($_POST['apellidos']);
    $dui = $_POST['dui'];
    $fecha = $_POST['fecha_nacimiento'];

    $edad = date_diff(date_create($fecha), date_create('today'))->y;

    if ($edad < 18) {
        die("Debes ser mayor de 18 años.");
    }

    // Validar si el usuario ya existe
    $check = "SELECT id FROM clientes WHERE usuario = '$usuario'";
    $res = mysqli_query($conn, $check);
    if (mysqli_num_rows($res) > 0) {
        die("El nombre de usuario ya está en uso. Por favor elige otro.");
    }

    // Insertar si no existe
    $sql = "INSERT INTO clientes (usuario, correo, contrasena, nombre_completo, apellidos, dui, fecha_nacimiento)
            VALUES ('$usuario', '$correo', '$contrasena', '$nombre', '$apellidos', '$dui', '$fecha')";

    if (mysqli_query($conn, $sql)) {
        echo "Registro exitoso.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
