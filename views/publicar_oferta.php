<?php
include('../includes/header.php');
?>

<h2>Publicar Oferta</h2>
<form action="../controllers/oferta.php" method="POST">
    <input type="text" name="titulo" placeholder="Título de la oferta" required><br>
    <input type="number" name="precio_regular" step="0.01" placeholder="Precio regular" required><br>
    <input type="number" name="precio_oferta" step="0.01" placeholder="Precio de oferta" required><br>
    <input type="date" name="fecha_inicio" required><br>
    <input type="date" name="fecha_fin" required><br>
    <input type="date" name="fecha_limite_canje" required><br>
    <input type="number" name="cantidad" placeholder="Cantidad (opcional)"><br>
    <textarea name="descripcion" placeholder="Descripción de la oferta" required></textarea><br>
    <select name="estado">
        <option value="disponible">Disponible</option>
        <option value="no disponible">No disponible</option>
    </select><br>
    <button type="submit" name="publicar">Publicar</button>
</form>

<?php include('../includes/footer.php'); ?>
