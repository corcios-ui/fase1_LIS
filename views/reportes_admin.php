<?php
session_start();
include('../config/database.php');
include('../includes/header.php');

if ($_SESSION['tipo'] != 'admin') {
    echo "Acceso denegado.";
    include('../includes/footer.php');
    exit;
}

echo "<h2>Reportes del Sistema</h2>";

$cupones_vendidos = mysqli_query($conn, "
    SELECT e.nombre AS empresa, COUNT(*) AS total
    FROM compras c
    JOIN ofertas o ON c.oferta_id = o.id
    JOIN empresas e ON o.empresa_id = e.id
    GROUP BY e.nombre
");

echo "<h3>Total de cupones vendidos por empresa</h3>";
while ($row = mysqli_fetch_assoc($cupones_vendidos)) {
    echo "<p>{$row['empresa']}: <b>{$row['total']}</b> cupones</p>";
}

$ganancias = mysqli_query($conn, "
    SELECT e.nombre AS empresa,
           SUM(o.precio_oferta * (e.porcentaje_comision / 100)) AS ganancia
    FROM compras c
    JOIN ofertas o ON c.oferta_id = o.id
    JOIN empresas e ON o.empresa_id = e.id
    GROUP BY e.nombre
");

echo "<h3>Total de ganancias por empresa (por comisión)</h3>";
while ($row = mysqli_fetch_assoc($ganancias)) {
    $ganancia = number_format($row['ganancia'], 2);
echo "<p>{$row['empresa']}: <b>\${$ganancia}</b></p>";

}

include('../includes/footer.php');
?>
