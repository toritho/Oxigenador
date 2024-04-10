-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2024 a las 23:09:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `b-oxigenador`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `estado` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `id_registro`, `estado`, `fecha`, `hora`) VALUES
(1, 1, '0', '2024-04-09', '14:42:31'),
(2, 1, '1', '2024-04-09', '14:43:01'),
(3, 1, '0', '2024-04-09', '15:14:21'),
(4, 1, '1', '2024-04-09', '15:14:40'),
(5, 1, '0', '2024-04-10', '00:01:00'),
(6, 1, '1', '2024-04-10', '00:02:00'),
(7, 1, '0', '2024-04-10', '00:03:00'),
(8, 1, '1', '2024-04-10', '00:04:00'),
(83, 1, '0', '2024-04-10', '00:40:00'),
(84, 1, '1', '2024-04-10', '00:41:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programarhora`
--

CREATE TABLE `programarhora` (
  `id` int(11) NOT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `h_encendido` time NOT NULL,
  `h_apagado` time NOT NULL,
  `estado1` varchar(255) NOT NULL,
  `estado2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `id_usuario`, `nombre`, `estado`) VALUES
(1, 1, 'oxigenador', 0),
(3, 1, 'gg', 0);

--
-- Disparadores `registro`
--
DELIMITER $$
CREATE TRIGGER `guardar_cambio_estado_trigger` AFTER UPDATE ON `registro` FOR EACH ROW BEGIN
    DECLARE v_fecha_actual DATE;
    DECLARE v_hora_actual TIME;
    
    -- Obtener la fecha y hora actuales
    SET v_fecha_actual = CURDATE();
    SET v_hora_actual = CURTIME();
    
    -- Insertar el registro en la tabla historial
    INSERT INTO historial (id_registro, estado, fecha, hora)
    VALUES (OLD.id, OLD.estado, v_fecha_actual, v_hora_actual);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `correo`, `contraseña`) VALUES
(1, 'tg@gmail.com', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_historial` (`id_registro`);

--
-- Indices de la tabla `programarhora`
--
ALTER TABLE `programarhora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_programar_hora` (`id_registro`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_registro` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `programarhora`
--
ALTER TABLE `programarhora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `fk_id_historial` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id`);

--
-- Filtros para la tabla `programarhora`
--
ALTER TABLE `programarhora`
  ADD CONSTRAINT `fk_id_programar_hora` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_id_registro` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
