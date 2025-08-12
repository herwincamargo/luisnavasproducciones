-- Base de datos: `luisnavas_producciones`

-- Estructura de tabla para la tabla `eventos`
CREATE TABLE `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Estructura de tabla para la tabla `usuarios`
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Nota: Deberás crear un usuario administrador manualmente para poder acceder al panel.
-- Ejemplo para crear un usuario 'admin' con contraseña 'admin123':
INSERT INTO `usuarios` (`username`, `password`) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
-- La contraseña 'admin123' está hasheada con password_hash() de PHP.
