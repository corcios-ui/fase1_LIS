<?php
session_start();
include('../config/database.php');
include('../includes/header.php');

if ($_SESSION['tipo'] != 'empresa') {
    echo "Acceso denegado.";
    include('../includes/footer.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$res = mysqli_query($conn, "SELECT id FROM empresas WHERE usuario = '$usuario'");
$empresa = mysqli_fetch_assoc($res);
$empresa_id = $empresa['id'];

$ofertas = mysqli_query($conn, "SELECT * FROM ofertas WHERE empresa_id = $empresa_id");

echo "<h2>Mis Ofertas</h2>";
while ($row = mysqli_fetch_assoc($ofertas)) {
    echo "<div>";
    echo "<form action='../controllers/editar_oferta.php' method='POST'>";
    echo "<input type='hidden' name='id' value='{$row['id']}'>";
    echo "<input type='text' name='titulo' value='{$row['titulo']}' required><br>";
    echo "<input type='number' step='0.01' name='precio_regular' value='{$row['precio_regular']}' required><br>";
    echo "<input type='number' step='0.01' name='precio_oferta' value='{$row['precio_oferta']}' required><br>";
    echo "<input type='date' name='fecha_inicio' value='{$row['fecha_inicio']}' required><br>";
    echo "<input type='date' name='fecha_fin' value='{$row['fecha_fin']}' required><br>";
    echo "<input type='date' name='fecha_limite_canje' value='{$row['fecha_limite_canje']}' required><br>";
    echo "<input type='number' name='cantidad' value='{$row['cantidad']}'><br>";
    echo "<textarea name='descripcion' required>{$row['descripcion']}</textarea><br>";
    echo "<select name='estado'>
            <option value='disponible'" . ($row['estado'] == 'disponible' ? " selected" : "") . ">Disponible</option>
            <option value='no disponible'" . ($row['estado'] == 'no disponible' ? " selected" : "") . ">No disponible</option>
          </select><br>";
    echo "<button type='submit' name='actualizar'>Actualizar</button>";
    echo "<button type='submit' name='eliminar' style='background-color:red;color:white;'>Eliminar</button>";
    echo "</form><hr>";
    echo "</div>";
}

include('../includes/footer.php');
?>
