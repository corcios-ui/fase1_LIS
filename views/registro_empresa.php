<?php include('../includes/header.php'); ?>
<h2>Registro de Empresa</h2>
<form action="../controllers/empresa.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre de la empresa" required><br>
    <input type="text" name="nit" placeholder="NIT" required><br>
    <input type="text" name="direccion" placeholder="Dirección" required><br>
    <input type="text" name="telefono" placeholder="Teléfono" required><br>
    <input type="email" name="correo" placeholder="Correo electrónico" required><br>
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="contrasena" placeholder="Contraseña" required><br>
    <button type="submit" name="registrar_empresa">Registrar</button>
</form>
<?php include('../includes/footer.php'); ?>
