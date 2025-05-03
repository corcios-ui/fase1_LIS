<?php include('../includes/header.php'); ?>
<h2>Registro de Cliente</h2>
<form action="../controllers/cliente.php" method="POST">
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="email" name="correo" placeholder="Correo electrónico" required><br>
    <input type="password" name="contrasena" placeholder="Contraseña" required><br>
    <input type="text" name="nombre_completo" placeholder="Nombre completo" required><br>
    <input type="text" name="apellidos" placeholder="Apellidos" required><br>
    <input type="text" name="dui" placeholder="DUI" required><br>
    <input type="date" name="fecha_nacimiento" required><br>
    <button type="submit" name="registrar_cliente">Registrar</button>
</form>
<?php include('../includes/footer.php'); ?>
