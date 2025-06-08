<?php include('../includes/header.php'); ?>
<h2>Registro de Cliente</h2>

<script>
// Solo permite letras y espacios
function soloLetras(e) {
    let tecla = e.key;
    const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]$/;
    if (!regex.test(tecla)) {
        e.preventDefault();
    }
}

// Inserta guión automático en DUI
function formatearDUI(input) {
    let valor = input.value.replace(/\D/g, ''); // Elimina todo excepto dígitos

    if (valor.length > 8) {
        valor = valor.slice(0, 8) + '-' + valor.slice(8, 9);
    }

    input.value = valor;
}
</script>

<form action="../controllers/cliente.php" method="POST">
    <input type="text" name="usuario" placeholder="Usuario" required pattern="[A-Za-z0-9_]{4,20}" title="Solo letras, números y guiones bajos."><br>
    <input type="email" name="correo" placeholder="Correo electrónico" required><br>
    <input type="password" name="contrasena" placeholder="Contraseña" required minlength="6"><br>

    <input type="text" name="nombre_completo" placeholder="Nombre completo" required 
        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]{3,50}" 
        title="Solo letras"
        onkeypress="soloLetras(event)"><br>

    <input type="text" name="apellidos" placeholder="Apellidos" required 
        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]{3,50}" 
        title="Solo letras"
        onkeypress="soloLetras(event)"><br>

    <input type="text" name="dui" placeholder="DUI (Ej: 12345678-9)" required
    pattern="^\d{8}-\d$"
    title="Formato válido: 12345678-9"
    maxlength="10"
    oninput="formatearDUI(this)"
    onkeypress="return event.charCode >= 48 && event.charCode <= 57"> 

    <label for="fecha_nacimiento">Fecha de nacimiento:</label><br>
    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required><br>

    <button type="submit" name="registrar_cliente">Registrar</button>
</form>

<?php include('../includes/footer.php'); ?>
