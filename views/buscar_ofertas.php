<?php
include('../config/database.php');
include('../includes/header.php');

$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

$sql = "
    SELECT o.*, e.nombre AS empresa
    FROM ofertas o
    JOIN empresas e ON o.empresa_id = e.id
    WHERE o.estado = 'disponible' AND 
         (o.titulo LIKE '%$buscar%' OR e.nombre LIKE '%$buscar%')
";

$res = mysqli_query($conn, $sql);

echo "<h2>Buscar Ofertas</h2>";
echo "<form method='GET'>
        <input type='text' name='buscar' value='" . htmlspecialchars($buscar) . "' placeholder='Buscar por título o empresa'>
        <button type='submit'>Buscar</button>
      </form><hr>";

if (mysqli_num_rows($res) === 0) {
    echo "<p>No se encontraron resultados.</p>";
} else {
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
}

include('../includes/footer.php');
?>
