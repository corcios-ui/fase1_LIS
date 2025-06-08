<?php
include('../includes/header.php');
$hoy = date('Y-m-d');
?>

<h2>Publicar Oferta</h2>

<form action="../controllers/oferta.php" method="POST">

    <label for="titulo">Título de la oferta:</label><br>
    <input type="text" name="titulo" id="titulo" required><br><br>

    <label for="precio_regular">Precio regular ($):</label><br>
    <input type="number" name="precio_regular" id="precio_regular" step="0.01" min="0" required><br><br>

    <label for="precio_oferta">Precio de oferta ($):</label><br>
    <input type="number" name="precio_oferta" id="precio_oferta" step="0.01" min="0" required><br><br>

    <label for="fecha_inicio">Fecha de inicio:</label><br>
    <input type="date" name="fecha_inicio" id="fecha_inicio" required min="<?php echo $hoy; ?>"><br><br>

    <label for="fecha_fin">Fecha de fin:</label><br>
    <input type="date" name="fecha_fin" id="fecha_fin" required min="<?php echo $hoy; ?>"><br><br>

    <label for="fecha_limite_canje">Fecha límite para canje:</label><br>
    <input type="date" name="fecha_limite_canje" id="fecha_limite_canje" required min="<?php echo $hoy; ?>"><br><br>

    <label for="cantidad">Cantidad de cupones(opcional):</label><br>
    <input type="number" name="cantidad" id="cantidad" min="1"><br><br>

    <label for="descripcion">Descripción de la oferta:</label><br>
    <textarea name="descripcion" id="descripcion" rows="4" required></textarea><br><br>

    <label for="estado">Estado:</label><br>
    <select name="estado" id="estado" required>
        <option value="disponible">Disponible</option>
        <option value="no disponible">No disponible</option>
    </select><br><br>

    <button type="submit" name="publicar">Publicar</button>
</form>

<?php include('../includes/footer.php'); ?>
