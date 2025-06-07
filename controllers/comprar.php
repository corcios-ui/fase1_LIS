<?php
session_start();
include '../config/database.php';

if ($_SESSION['tipo'] != 'cliente') die("Acceso denegado");

if (isset($_POST['comprar'])) {
    $cliente_user = $_SESSION['usuario'];
    $oferta_id = intval($_POST['oferta_id']);

    // Validaciones de campos simulados
    $tarjeta = $_POST['tarjeta'];
    $vencimiento = $_POST['vencimiento'];
    $cvv = $_POST['cvv'];

    if (!preg_match("/^\d{13,16}$/", $tarjeta)) {
        die("Número de tarjeta inválido.");
    }

    if (!preg_match("/^\d{3}$/", $cvv)) {
        die("CVV inválido.");
    }

    $mes_actual = date('Y-m');
    if ($vencimiento <= $mes_actual) {
        die("La tarjeta está vencida.");
    }

    // Obtener cliente_id
    $cliente_sql = "SELECT id FROM clientes WHERE usuario = '$cliente_user'";
    $res_cliente = mysqli_query($conn, $cliente_sql);
    $cliente = mysqli_fetch_assoc($res_cliente);
    $cliente_id = $cliente['id'];

    // Validar cantidad máxima
    $check = "SELECT COUNT(*) as total FROM compras WHERE cliente_id = $cliente_id AND oferta_id = $oferta_id";
    $res = mysqli_query($conn, $check);
    $row = mysqli_fetch_assoc($res);
    if ($row['total'] >= 5) {
        die("Ya compraste 5 cupones de esta oferta.");
    }

    $codigo = strtoupper(uniqid("CUPON_"));
    $sql = "INSERT INTO compras (cliente_id, oferta_id, codigo_cupon) VALUES ($cliente_id, $oferta_id, '$codigo')";
    if (mysqli_query($conn, $sql)) {
        echo "✅ Compra realizada. Tu código de cupón es: <b>$codigo</b>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
