<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once(__DIR__ . '/../config/rutas.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>La Cuponera SV</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styles.css">
</head>
<body>
<header>
    <h1>La Cuponera SV</h1>
    <nav>
        <a href="<?php echo BASE_URL; ?>index.php">Inicio</a>
        <?php
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['tipo'] == 'cliente') {
                echo "<a href='" . VIEWS . "perfil_cliente.php'>Mi Perfil</a>";
                echo "<a href='" . VIEWS . "historial_compras.php'>Mis Compras</a>";
            } elseif ($_SESSION['tipo'] == 'empresa') {
                echo "<a href='" . VIEWS . "perfil_empresa.php'>Mi Empresa</a>";
                echo "<a href='" . VIEWS . "publicar_oferta.php'>Publicar Oferta</a>";
                echo "<a href='" . VIEWS . "mis_ofertas.php'>Mis Ofertas</a>";
            } elseif ($_SESSION['tipo'] == 'admin') {
                echo "<a href='" . VIEWS . "perfil_admin.php'>Admin</a>";
            }
            echo "<a href='" . CONTROLLERS . "logout.php'>Cerrar sesión</a>";
        } else {
            echo "<a href='" . VIEWS . "login.php'>Iniciar Sesión</a>";
            echo "<a href='" . VIEWS . "registro_cliente.php'>Registro Cliente</a>";
            echo "<a href='" . VIEWS . "registro_empresa.php'>Registro Empresa</a>";
        }
        ?>
        <a href="<?php echo VIEWS; ?>ver_oferta.php">Ver Ofertas</a>
        <a href="<?php echo VIEWS; ?>buscar_ofertas.php">Buscar</a>
    </nav>
</header>
<main>
