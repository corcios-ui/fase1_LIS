<?php
session_start();
include('../config/database.php');
include('../includes/header.php');

if ($_SESSION['tipo'] != 'cliente') {
    echo "Acceso denegado.";
    include('../includes/footer.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$cliente_res = mysqli_query($conn, "SELECT id FROM clientes WHERE usuario = '$usuario'");
$cliente = mysqli_fetch_assoc($cliente_res);
$cliente_id = $cliente['id'];

$res = mysqli_query($conn, "
    SELECT c.codigo_cupon, o.titulo, o.precio_oferta, c.fecha_compra
    FROM compras c
    JOIN ofertas o ON c.oferta_id = o.id
    WHERE c.cliente_id = $cliente_id
");

echo "<h2>Historial de Compras</h2>";
while ($row = mysqli_fetch_assoc($res)) {
    echo "<div>";
    echo "<strong>{$row['titulo']}</strong><br>";
    echo "Precio: \${$row['precio_oferta']}<br>";
    echo "Fecha: {$row['fecha_compra']}<br>";
    echo "Código Cupón: <b>{$row['codigo_cupon']}</b><br>";
    echo "<hr>";
    echo "</div>";
}

include('../includes/footer.php');
?>
