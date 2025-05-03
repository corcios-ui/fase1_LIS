<?php
include '../config/database.php';

if (isset($_POST['registrar_cliente'])) {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $nombre = $_POST['nombre_completo'];
    $apellidos = $_POST['apellidos'];
    $dui = $_POST['dui'];
    $fecha = $_POST['fecha_nacimiento'];

    $edad = date_diff(date_create($fecha), date_create('today'))->y;

    if ($edad < 18) {
        echo "Debes ser mayor de 18 años.";
        exit;
    }

    $sql = "INSERT INTO clientes (usuario, correo, contrasena, nombre_completo, apellidos, dui, fecha_nacimiento)
            VALUES ('$usuario', '$correo', '$contrasena', '$nombre', '$apellidos', '$dui', '$fecha')";

    if (mysqli_query($conn, $sql)) {
        echo "Registro exitoso.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
