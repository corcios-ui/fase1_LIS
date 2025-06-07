<?php include('../includes/header.php'); ?>
<h2>Registro de Empresa</h2>

<script>
// Solo letras y espacios
function soloLetras(e) {
    let tecla = e.key;
    const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]$/;
    if (!regex.test(tecla)) {
        e.preventDefault();
    }
}

// Formatear NIT (solo acepta números y guiones, opcionalmente puedes personalizar el formato)
function formatearNIT(input) {
    let valor = input.value.replace(/\D/g, ''); // solo dígitos

    if (valor.length > 4 && valor.length <= 10) {
        input.value = valor.slice(0, 4) + '-' + valor.slice(4);
    }
    if (valor.length > 10 && valor.length <= 13) {
        input.value = valor.slice(0, 4) + '-' + valor.slice(4, 10) + '-' + valor.slice(10);
    }
    if (valor.length > 13) {
        input.value = valor.slice(0, 4) + '-' + valor.slice(4, 10) + '-' + valor.slice(10, 13) + '-' + valor.slice(13, 14);
    } else {
        input.value = valor;
    }
}

function validarTelefono(e, input) {
    const valor = input.value + e.key;

    // Solo permitir números
    if (!/\d/.test(e.key)) {
        e.preventDefault();
        return;
    }

    // Impedir más de 8 dígitos
    if (input.value.length >= 8) {
        e.preventDefault();
        return;
    }

    // Validar el primer dígito
    if (input.value.length === 0 && !/[267]/.test(e.key)) {
        e.preventDefault();
        return;
    }
}
</script>

<form action="../controllers/empresa.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre de la empresa" required 
        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ 0-9]{3,50}" 
        title="Solo letras y números" 
        onkeypress="soloLetras(event)"><br>

    <input type="text" name="nit" placeholder="NIT (Ej: 0614-290398-102-3)" 
       required maxlength="17"
       pattern="^\d{4}-\d{6}-\d{3}-\d{1}$" 
       title="Formato válido: 0614-290398-102-3" 
       oninput="formatearNIT(this)">


    <input type="text" name="direccion" placeholder="Dirección" required><br>

    <input type="text" name="telefono" placeholder="Teléfono (ej: 70112233)" required 
       maxlength="8"
       onkeypress="validarTelefono(event, this)"
       title="Debe tener 8 dígitos y comenzar con 2, 6 o 7">

    <input type="email" name="correo" placeholder="Correo electrónico" required><br>

    <input type="text" name="usuario" placeholder="Usuario" required 
        pattern="[A-Za-z0-9_]{4,20}" 
        title="Solo letras, números y guiones bajos."><br>

    <input type="password" name="contrasena" placeholder="Contraseña" required minlength="6"><br>

    <button type="submit" name="registrar_empresa">Registrar</button>
</form>

<?php include('../includes/footer.php'); ?>
