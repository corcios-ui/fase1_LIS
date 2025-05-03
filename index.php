<?php
global $conn;
include('config/database.php');
include('includes/header.php');

echo "<h2>Bienvenido a La Cuponera SV</h2>";

echo "<form action='views/buscar_ofertas.php' method='GET'>
        <input type='text' name='buscar' placeholder='Buscar ofertas...'>
        <button type='submit'>Buscar</button>
      </form><hr>";

$res = mysqli_query($conn, "
    SELECT o.*, e.nombre AS empresa
    FROM ofertas o
    JOIN empresas e ON o.empresa_id = e.id
    WHERE o.estado = 'disponible'
    ORDER BY RAND()
    LIMIT 3
");

echo "<h3>Ofertas destacadas</h3>";
while ($row = mysqli_fetch_assoc($res)) {
    echo "<div>";
    echo "<h3>{$row['titulo']}</h3>";
    echo "<strong>Empresa:</strong> {$row['empresa']}<br>";
    echo "<strong>Precio:</strong> <s>\${$row['precio_regular']}</s> → <b>\${$row['precio_oferta']}</b><br>";
    echo "<p>{$row['descripcion']}</p>";
    echo "<form action='views/comprar_oferta.php' method='GET'>
            <input type='hidden' name='id' value='{$row['id']}'>
            <button type='submit'>Comprar</button>
          </form>";
    echo "</div><hr>";
}

echo "<p><a href='views/ver_oferta.php'>Ver todas las ofertas</a></p>";

include('includes/footer.php');
?>
