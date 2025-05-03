<?php
include('../config/database.php');
include('../includes/header.php');

$res = mysqli_query($conn, "SELECT * FROM empresas WHERE aprobada = 0");

echo "<h2>Empresas Pendientes</h2>";
while ($row = mysqli_fetch_assoc($res)) {
    echo "<div>";
    echo "<strong>{$row['nombre']}</strong> - {$row['correo']}<br>";
    echo "<form action='../controllers/admin.php' method='POST'>
            <input type='hidden' name='id' value='{$row['id']}'>
            <input type='number' name='comision' placeholder='Comisión (%)' required>
            <button type='submit' name='aprobar'>Aprobar</button>
            <button type='submit' name='rechazar'>Rechazar</button>
          </form>";
    echo "</div><hr>";
}
include('../includes/footer.php');
?>
