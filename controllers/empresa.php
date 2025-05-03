<?php
include '../config/database.php';

if (isset($_POST['registrar_empresa'])) {
    $nombre = $_POST['nombre'];
    $nit = $_POST['nit'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO empresas (nombre, nit, direccion, telefono, correo, usuario, contrasena)
            VALUES ('$nombre', '$nit', '$direccion', '$telefono', '$correo', '$usuario', '$contrasena')";

    if (mysqli_query($conn, $sql)) {
        echo "Registro enviado. Espera aprobación del administrador.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
