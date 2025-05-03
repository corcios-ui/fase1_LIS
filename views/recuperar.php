<?php include('../includes/header.php'); ?>
<h2>Recuperar Contraseña</h2>
<form action="../controllers/recuperar.php" method="POST">
    <label>Tipo de usuario:</label>
    <select name="tipo_usuario">
        <option value="cliente">Cliente</option>
        <option value="empresa">Empresa</option>
        <option value="admin">Administrador</option>
    </select><br>
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="nueva" placeholder="Nueva contraseña" required><br>
    <button type="submit" name="recuperar">Actualizar</button>
</form>
<?php include('../includes/footer.php'); ?>
