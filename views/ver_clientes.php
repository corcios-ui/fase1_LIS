<?php
session_start();
include('../config/database.php');
include('../includes/header.php');

if ($_SESSION['tipo'] != 'admin') {
    echo "Acceso denegado.";
    include('../includes/footer.php');
    exit;
}

echo "<h2>Clientes Registrados</h2>";

$res = mysqli_query($conn, "SELECT nombre_completo, apellidos, correo, usuario, dui, fecha_nacimiento FROM clientes");

if (mysqli_num_rows($res) > 0) {
    echo "<table border='1' cellpadding='8'>
            <tr>
                <th>Nombre completo</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>DUI</th>
                <th>Fecha de nacimiento</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['nombre_completo']}</td>
                <td>{$row['apellidos']}</td>
                <td>{$row['correo']}</td>
                <td>{$row['usuario']}</td>
                <td>{$row['dui']}</td>
                <td>{$row['fecha_nacimiento']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay clientes registrados aún.</p>";
}

include('../includes/footer.php');
?>
