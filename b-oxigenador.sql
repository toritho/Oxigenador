-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2024 a las 17:30:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

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
(85, 1, '0', '2024-04-09', '17:08:37'),
(86, 1, '1', '2024-04-09', '17:08:42'),
(87, 1, '0', '2024-04-09', '17:11:59'),
(88, 1, '1', '2024-04-09', '17:12:05'),
(89, 3, '0', '2024-04-09', '17:14:40'),
(90, 3, '1', '2024-04-09', '17:14:44'),
(91, 1, '0', '2024-04-09', '17:16:58'),
(92, 1, '1', '2024-04-09', '17:17:02'),
(93, 3, '0', '2024-04-09', '17:17:05'),
(94, 3, '1', '2024-04-09', '17:17:09'),
(95, 4, '0', '2024-04-09', '17:17:24'),
(96, 4, '1', '2024-04-09', '17:17:29'),
(97, 1, '0', '2024-04-09', '17:17:35'),
(98, 1, '1', '2024-04-09', '17:17:38'),
(99, 4, '0', '2024-04-09', '17:19:08'),
(100, 4, '1', '2024-04-09', '17:19:08'),
(101, 4, '1', '2024-04-09', '17:19:09'),
(102, 4, '0', '2024-04-09', '17:19:13'),
(103, 4, '1', '2024-04-09', '17:19:16'),
(104, 1, '0', '2024-04-09', '17:21:34'),
(105, 1, '1', '2024-04-09', '17:21:35'),
(106, 4, '0', '2024-04-09', '17:21:42'),
(107, 4, '1', '2024-04-09', '17:21:44'),
(108, 1, '0', '2024-04-23', '21:36:29'),
(109, 1, '1', '2024-04-23', '21:36:30'),
(110, 1, '1', '2024-04-23', '21:36:31'),
(111, 1, '0', '2024-04-23', '21:37:06'),
(112, 1, '1', '2024-04-23', '21:37:08'),
(113, 1, '0', '2024-04-25', '20:36:21'),
(114, 1, '1', '2024-04-25', '20:36:24'),
(115, 1, '0', '2024-04-25', '20:37:21'),
(116, 1, '1', '2024-04-25', '20:37:24'),
(117, 1, '0', '2024-04-25', '20:39:27'),
(118, 1, '1', '2024-04-25', '20:39:29'),
(119, 1, '0', '2024-04-25', '20:39:31'),
(120, 1, '1', '2024-04-25', '20:39:35'),
(121, 1, '0', '2024-04-25', '20:39:36'),
(122, 1, '0', '2024-04-25', '20:39:37'),
(123, 1, '0', '2024-04-25', '20:39:38'),
(124, 1, '1', '2024-04-25', '20:43:36'),
(125, 1, '0', '2024-04-25', '20:43:39'),
(126, 1, '0', '2024-04-25', '20:43:40'),
(127, 1, '0', '2024-04-26', '09:31:21'),
(128, 1, '1', '2024-04-26', '09:31:24'),
(129, 1, '0', '2024-04-30', '22:17:56'),
(130, 1, '1', '2024-04-30', '22:17:58'),
(131, 1, '0', '2024-04-30', '23:27:32'),
(132, 1, '1', '2024-04-30', '23:27:33');

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
(3, 1, 'gg', 0),
(4, 1, 'aspersor', 0);

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
(1, 'tg@gmail.com', '1234'),
(2, 'pablo@gmail.com', '$2y$10$eS2XQr0kFqd9Frw8X5xOwO4qoXEem7lJNjisue6Am0G80Fi2rmQKu');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `programarhora`
--
ALTER TABLE `programarhora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
