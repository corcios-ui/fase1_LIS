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

    echo "<label for='titulo_{$row['id']}'>Título:</label><br>";
    echo "<input type='text' id='titulo_{$row['id']}' name='titulo' value='{$row['titulo']}' required><br><br>";

    echo "<label for='precio_regular_{$row['id']}'>Precio regular ($):</label><br>";
    echo "<input type='number' id='precio_regular_{$row['id']}' step='0.01' name='precio_regular' value='{$row['precio_regular']}' required min='0'><br><br>";

    echo "<label for='precio_oferta_{$row['id']}'>Precio de oferta ($):</label><br>";
    echo "<input type='number' id='precio_oferta_{$row['id']}' step='0.01' name='precio_oferta' value='{$row['precio_oferta']}' required min='0'><br><br>";

    echo "<label for='fecha_inicio_{$row['id']}'>Fecha de inicio:</label><br>";
    echo "<input type='date' id='fecha_inicio_{$row['id']}' name='fecha_inicio' value='{$row['fecha_inicio']}' required><br><br>";

    echo "<label for='fecha_fin_{$row['id']}'>Fecha de fin:</label><br>";
    echo "<input type='date' id='fecha_fin_{$row['id']}' name='fecha_fin' value='{$row['fecha_fin']}' required><br><br>";

    echo "<label for='fecha_limite_{$row['id']}'>Fecha límite de canje:</label><br>";
    echo "<input type='date' id='fecha_limite_{$row['id']}' name='fecha_limite_canje' value='{$row['fecha_limite_canje']}' required><br><br>";

    echo "<label for='cantidad_{$row['id']}'>Cantidad:</label><br>";
    echo "<input type='number' id='cantidad_{$row['id']}' name='cantidad' value='{$row['cantidad']}' min='1'><br><br>";

    echo "<label for='descripcion_{$row['id']}'>Descripción:</label><br>";
    echo "<textarea id='descripcion_{$row['id']}' name='descripcion' required>{$row['descripcion']}</textarea><br><br>";

    echo "<label for='estado_{$row['id']}'>Estado:</label><br>";
    echo "<select id='estado_{$row['id']}' name='estado'>
            <option value='disponible'" . ($row['estado'] == 'disponible' ? " selected" : "") . ">Disponible</option>
            <option value='no disponible'" . ($row['estado'] == 'no disponible' ? " selected" : "") . ">No disponible</option>
          </select><br><br>";

    echo "<button type='submit' name='actualizar'>Actualizar</button> ";
    echo "<button type='submit' name='eliminar' style='background-color:red;color:white;'>Eliminar</button>";
    echo "</form><hr>";
    echo "</div>";
}

include('../includes/footer.php');
?>
