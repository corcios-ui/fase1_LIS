-- Crear base de datos
CREATE DATABASE IF NOT EXISTS `cuponera` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `cuponera`;

-- Tabla administradores
CREATE TABLE IF NOT EXISTS `administradores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(50),
  `contrasena` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM administradores;
INSERT INTO `administradores` (`id`, `usuario`, `contrasena`) VALUES
  (1, 'admin', '$2y$12$JzyDvRFLzyHzlLc6C9KWaut7DnlTzkTk/E6bio946FKmfRtCFf/6q'),
  (2, 'jose', '1234'),
  (3, 'jose', '$2y$10$0Jt1P.yNfSjyUSKHixdzv.JPPjGEzj9ZsCTZXnLG/4HeT8PUsDwHK');

-- Tabla clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(50),
  `correo` VARCHAR(100),
  `contrasena` VARCHAR(255),
  `nombre_completo` VARCHAR(100),
  `apellidos` VARCHAR(100),
  `dui` VARCHAR(10),
  `fecha_nacimiento` DATE,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `clientes` (`id`, `usuario`, `correo`, `contrasena`, `nombre_completo`, `apellidos`, `dui`, `fecha_nacimiento`) VALUES
  (1, 'cliente01', 'cliente@example.com', '$2y$10$wKZ3iMHGgh3KlyeE3RYqYeU9LG/xLFM.jTKZyTr0wU2/8TjDXVWx6', 'Juan', 'Pérez', '12345678-9', '2000-01-01'),
  (2, 'jose', 'jsankjsa@gmail.com', '$2y$12$pXmecWHNExc1C7d5k4ov9u7XMEWZBN/iethG1ePH4d5IdaMI1EShG', 'josejosje', 'jsojdoje', '44444444-4', '1999-06-08');

-- Tabla empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100),
  `nit` VARCHAR(17),
  `direccion` TEXT,
  `telefono` VARCHAR(20),
  `correo` VARCHAR(100),
  `usuario` VARCHAR(50),
  `contrasena` VARCHAR(255),
  `aprobada` TINYINT(1) DEFAULT 0,
  `porcentaje_comision` DECIMAL(5,2),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `empresas` (`id`, `nombre`, `nit`, `direccion`, `telefono`, `correo`, `usuario`, `contrasena`, `aprobada`, `porcentaje_comision`) VALUES
  (1, 'Super Descuentos', '0614-150922-101-3', 'Calle Ficticia #123', '2222-2222', 'empresa@example.com', 'empresa01', '$2y$10$wKZ3iMHGgh3KlyeE3RYqYeU9LG/xLFM.jTKZyTr0wU2/8TjDXVWx6', 1, 15.00),
  (2, 'dan', '1111-111111-111-1', '1111', '1111', '1111@aaa.com', 'dan', '$2y$12$0TQjxuY4X7hZzA1j1xc54OqiffMHwX.W8OBhTikeLykSXSq.ravQC', 1, 10.00),
  (3, 'dc repuestos', '0586-243111-101-1', 'mi casa', '78151382', 'corciosv@gmail.com', 'admin', '$2y$12$g3TJI8bm8b3vX9huUZr97ePVlD2NGVBWVlR8T5HXE8yTQeUYFYhFa', 1, 10.00);

-- Tabla ofertas
CREATE TABLE IF NOT EXISTS `ofertas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `empresa_id` INT,
  `titulo` VARCHAR(100),
  `precio_regular` DECIMAL(10,2),
  `precio_oferta` DECIMAL(10,2),
  `fecha_inicio` DATE,
  `fecha_fin` DATE,
  `fecha_limite_canje` DATE,
  `cantidad` INT,
  `descripcion` TEXT,
  `estado` ENUM('disponible','no disponible') DEFAULT 'disponible',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`empresa_id`) REFERENCES `empresas`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ofertas` (`id`, `empresa_id`, `titulo`, `precio_regular`, `precio_oferta`, `fecha_inicio`, `fecha_fin`, `fecha_limite_canje`, `cantidad`, `descripcion`, `estado`) VALUES
  (2, 3, 'perros', 500.00, 499.00, '2025-05-01', '2025-05-31', '2025-06-15', 6, 'Bonitos cachorros', 'disponible');

-- Tabla compras (se crea al final porque tiene claves foráneas a clientes y ofertas)
CREATE TABLE IF NOT EXISTS `compras` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT,
  `oferta_id` INT,
  `codigo_cupon` VARCHAR(100),
  `fecha_compra` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`id`),
  FOREIGN KEY (`oferta_id`) REFERENCES `ofertas`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `compras` (`id`, `cliente_id`, `oferta_id`, `codigo_cupon`, `fecha_compra`) VALUES
  (1, 2, 2, 'CUPON_6815A6D430F2A', '2025-05-02 23:17:08');
