-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         11.7.2-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para cuponera
CREATE DATABASE IF NOT EXISTS `cuponera` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `cuponera`;

-- Volcando estructura para tabla cuponera.administradores
CREATE TABLE IF NOT EXISTS `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Volcando datos para la tabla cuponera.administradores: ~1 rows (aproximadamente)
INSERT INTO `administradores` (`id`, `usuario`, `contrasena`) VALUES
	(1, 'admin', '$2y$12$JzyDvRFLzyHzlLc6C9KWaut7DnlTzkTk/E6bio946FKmfRtCFf/6q'),
	(2, 'jose', '1234'),
	(3, 'jose', '$2y$10$0Jt1P.yNfSjyUSKHixdzv.JPPjGEzj9ZsCTZXnLG/4HeT8PUsDwHK');

-- Volcando estructura para tabla cuponera.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `dui` varchar(10) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Volcando datos para la tabla cuponera.clientes: ~1 rows (aproximadamente)
INSERT INTO `clientes` (`id`, `usuario`, `correo`, `contrasena`, `nombre_completo`, `apellidos`, `dui`, `fecha_nacimiento`) VALUES
	(1, 'cliente01', 'cliente@example.com', '$2y$10$wKZ3iMHGgh3KlyeE3RYqYeU9LG/xLFM.jTKZyTr0wU2/8TjDXVWx6', 'Juan', 'Pérez', '12345678-9', '2000-01-01'),
	(2, 'jose', 'jsankjsa@gmail.com', '$2y$12$pXmecWHNExc1C7d5k4ov9u7XMEWZBN/iethG1ePH4d5IdaMI1EShG', 'josejosje', 'jsojdoje', '4444444', '1999-06-08');

-- Volcando estructura para tabla cuponera.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `oferta_id` int(11) DEFAULT NULL,
  `codigo_cupon` varchar(100) DEFAULT NULL,
  `fecha_compra` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `oferta_id` (`oferta_id`),
  CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`oferta_id`) REFERENCES `ofertas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Volcando datos para la tabla cuponera.compras: ~0 rows (aproximadamente)
INSERT INTO `compras` (`id`, `cliente_id`, `oferta_id`, `codigo_cupon`, `fecha_compra`) VALUES
	(1, 2, 2, 'CUPON_6815A6D430F2A', '2025-05-02 23:17:08');

-- Volcando estructura para tabla cuponera.empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `nit` varchar(17) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `aprobada` tinyint(1) DEFAULT 0,
  `porcentaje_comision` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Volcando datos para la tabla cuponera.empresas: ~1 rows (aproximadamente)
INSERT INTO `empresas` (`id`, `nombre`, `nit`, `direccion`, `telefono`, `correo`, `usuario`, `contrasena`, `aprobada`, `porcentaje_comision`) VALUES
	(1, 'Super Descuentos', '0614-150922-101-3', 'Calle Ficticia #123', '2222-2222', 'empresa@example.com', 'empresa01', '$2y$10$wKZ3iMHGgh3KlyeE3RYqYeU9LG/xLFM.jTKZyTr0wU2/8TjDXVWx6', 1, 15.00),
	(2, 'dan', '1111', '1111', '1111', '1111@aaa.com', 'dan', '$2y$12$0TQjxuY4X7hZzA1j1xc54OqiffMHwX.W8OBhTikeLykSXSq.ravQC', 1, 10.00),
	(3, 'dc repuestos', '058624311', 'mi casa', '78151382', 'corciosv@gmail.com', 'admin', '$2y$12$g3TJI8bm8b3vX9huUZr97ePVlD2NGVBWVlR8T5HXE8yTQeUYFYhFa', 1, 10.00);

-- Volcando estructura para tabla cuponera.ofertas
CREATE TABLE IF NOT EXISTS `ofertas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `precio_regular` decimal(10,2) DEFAULT NULL,
  `precio_oferta` decimal(10,2) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_limite_canje` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` enum('disponible','no disponible') DEFAULT 'disponible',
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `ofertas_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Volcando datos para la tabla cuponera.ofertas: ~0 rows (aproximadamente)
INSERT INTO `ofertas` (`id`, `empresa_id`, `titulo`, `precio_regular`, `precio_oferta`, `fecha_inicio`, `fecha_fin`, `fecha_limite_canje`, `cantidad`, `descripcion`, `estado`) VALUES
	(2, 3, 'perros', 500.00, 499.00, '2025-05-01', '2025-05-31', '2025-06-15', 6, 'Bonitos cachorros', 'disponible');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
