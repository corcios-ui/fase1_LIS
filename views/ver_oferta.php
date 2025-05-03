<?php
include('../config/database.php');
include('../includes/header.php');

$res = mysqli_query($conn, "SELECT ofertas.*, empresas.nombre AS empresa FROM ofertas JOIN empresas ON ofertas.empresa_id = empresas.id WHERE estado='disponible'");

echo "<h2>Ofertas disponibles</h2>";
while ($row = mysqli_fetch_assoc($res)) {
    echo "<div>";
    echo "<h3>{$row['titulo']}</h3>";
    echo "<strong>Empresa:</strong> {$row['empresa']}<br>";
    echo "<strong>Precio:</strong> <s>\${$row['precio_regular']}</s> → <b>\${$row['precio_oferta']}</b><br>";
    echo "<p>{$row['descripcion']}</p>";
    echo "<form action='comprar_oferta.php' method='GET'>
            <input type='hidden' name='id' value='{$row['id']}'>
            <button type='submit'>Comprar</button>
          </form>";
    echo "</div><hr>";
}
include('../includes/footer.php');
?>
