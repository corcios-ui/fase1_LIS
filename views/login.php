<?php include('../includes/header.php'); ?>
<h2>Iniciar Sesión</h2>

<form action="../controllers/login.php" method="POST">
    <select name="tipo_usuario" required>
        <option value="">Seleccionar tipo</option>
        <option value="cliente">Cliente</option>
        <option value="empresa">Empresa</option>
        <option value="admin">Administrador</option>
    </select><br>

    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="contrasena" placeholder="Contraseña" required><br>

    <button type="submit" name="login">Ingresar</button>
</form>

<!-- ✅ Este botón es un enlace disfrazado que redirige -->
<form action="recuperar.php" method="GET" style="margin-top:10px;">
    <button type="submit">¿Olvidaste tu contraseña?</button>
</form>

<?php include('../includes/footer.php'); ?>
