<?php
session_start();
include('../config/database.php');
include('../includes/header.php');

if ($_SESSION['tipo'] != 'admin') {
    echo "Acceso denegado.";
    include('../includes/footer.php');
    exit;
}

echo "<h2>Empresas Registradas</h2>";

$res = mysqli_query($conn, "SELECT nombre, correo, nit, direccion, telefono, porcentaje_comision FROM empresas WHERE aprobada = 1");

if (mysqli_num_rows($res) > 0) {
    echo "<table border='1' cellpadding='8'>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>NIT</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Comisión (%)</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['nombre']}</td>
                <td>{$row['correo']}</td>
                <td>{$row['nit']}</td>
                <td>{$row['direccion']}</td>
                <td>{$row['telefono']}</td>
                <td>{$row['porcentaje_comision']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay empresas aprobadas aún.</p>";
}

include('../includes/footer.php');
?>
