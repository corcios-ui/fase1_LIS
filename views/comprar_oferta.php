<?php
session_start();
include('../config/database.php');
include('../includes/header.php');

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'cliente') {
    echo "Debes iniciar sesión como cliente para comprar.";
    include('../includes/footer.php');
    exit;
}

$oferta_id = $_GET['id'];

// Obtener datos
$sql = "SELECT * FROM ofertas WHERE id = $oferta_id AND estado = 'disponible'";
$res = mysqli_query($conn, $sql);
$oferta = mysqli_fetch_assoc($res);

if (!$oferta) {
    echo "Oferta no disponible.";
    include('../includes/footer.php');
    exit;
}
?>

<h2>Comprar: <?php echo $oferta['titulo']; ?></h2>
<form action="../controllers/comprar.php" method="POST">
    <input type="hidden" name="oferta_id" value="<?php echo $oferta_id; ?>">

    <label>Número de tarjeta:</label><br>
    <input type="text" name="tarjeta" required 
           pattern="\d{13,16}" maxlength="16"
           title="Debe contener entre 13 y 16 dígitos"
           oninput="this.value=this.value.replace(/[^0-9]/g,'');"><br>

    <label>Fecha vencimiento:</label><br>
    <input type="month" name="vencimiento" required><br>

    <label>CVV:</label><br>
    <input type="text" name="cvv" required 
           pattern="\d{3}" maxlength="3"
           title="CVV de 3 dígitos"
           oninput="this.value=this.value.replace(/[^0-9]/g,'');"><br>

    <button type="submit" name="comprar">Confirmar compra</button>
</form>


<?php include('../includes/footer.php'); ?>
