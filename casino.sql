-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2024 a las 17:51:44
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
-- Base de datos: `casino`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apuestas`
--

CREATE TABLE `apuestas` (
  `id_apuesta` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_partido` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `cuota` decimal(5,2) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `resultado` char(1) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apuestas`
--

INSERT INTO `apuestas` (`id_apuesta`, `id_usuario`, `id_partido`, `monto`, `cuota`, `fecha`, `resultado`, `estado`) VALUES
(592618, 818774, 108364, 10.00, 1.77, '2024-05-22 15:44:30', '1', NULL),
(807787, 990376, 108364, 100.00, 1.65, '2024-05-21 16:24:14', '2', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas`
--

CREATE TABLE `cuotas` (
  `id_partido` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cuota_local` decimal(5,2) DEFAULT NULL,
  `cuota_visitante` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuotas`
--

INSERT INTO `cuotas` (`id_partido`, `fecha`, `cuota_local`, `cuota_visitante`) VALUES
(41282, '2024-05-19 12:32:47', 2.25, 2.30),
(58821, '2024-05-19 12:41:10', 1.76, 1.80),
(108364, '2024-05-21 16:24:14', 1.62, 1.77);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `id_partido` int(11) NOT NULL,
  `competicion` varchar(50) DEFAULT NULL,
  `jugador_visitante` varchar(50) DEFAULT NULL,
  `jugador_local` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `resultado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`id_partido`, `competicion`, `jugador_visitante`, `jugador_local`, `fecha`, `hora`, `resultado`) VALUES
(41282, 'Copa Fed', 'Player 1', 'Player 2', '2024-05-20', '15:00:00', '2'),
(58821, 'Copa Fed', 'Player 3', 'Player 4', '2024-05-22', '15:00:00', '1'),
(108364, 'ATP Tour Finals', 'Iniesta', 'Melendi', '2024-05-25', '11:15:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passwords`
--

CREATE TABLE `passwords` (
  `id_usuario` int(11) NOT NULL,
  `contrasena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `passwords`
--

INSERT INTO `passwords` (`id_usuario`, `contrasena`) VALUES
(818774, '$2y$10$TMscydC5PD1uVfY2zUxSCulbFnQqbgvDsFNpDQPd3br69lxcwbFga'),
(990376, '$2y$10$OkxuU8rfLK4kV0jzfxZoCuSiOhQOo25fKh/WRM.QVpzxWSYuLRbei');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruleta`
--

CREATE TABLE `ruleta` (
  `id` int(11) NOT NULL,
  `numero_aleatorio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ruleta`
--

INSERT INTO `ruleta` (`id`, `numero_aleatorio`) VALUES
(1, 24),
(2, 27),
(3, 36),
(4, 17),
(5, 5),
(6, 34),
(7, 0),
(8, 26),
(9, 2),
(10, 23),
(11, 19),
(12, 14),
(13, 17),
(14, 33),
(15, 20),
(16, 36),
(17, 7),
(18, 15),
(19, 9),
(20, 5),
(21, 27),
(22, 5),
(23, 21),
(24, 34),
(25, 13),
(26, 26),
(27, 31),
(28, 20),
(29, 19),
(30, 33),
(31, 2),
(32, 13),
(33, 15),
(34, 10),
(35, 11),
(36, 10),
(37, 4),
(38, 13),
(39, 35),
(40, 21),
(41, 22),
(42, 21),
(43, 36),
(44, 25),
(45, 18),
(46, 22),
(47, 8),
(48, 26),
(49, 18),
(50, 4),
(51, 15),
(52, 14),
(53, 0),
(54, 35),
(55, 11),
(56, 31),
(57, 8),
(58, 5),
(59, 8),
(60, 14),
(61, 9),
(62, 9),
(63, 4),
(64, 8),
(65, 32),
(66, 17),
(67, 8),
(68, 4),
(69, 10),
(70, 21),
(71, 22),
(72, 14),
(73, 23),
(74, 9),
(75, 16),
(76, 16),
(77, 16),
(78, 11),
(79, 9),
(80, 12),
(81, 8),
(82, 22),
(83, 12),
(84, 14),
(85, 33),
(86, 32),
(87, 34),
(88, 8),
(89, 5),
(90, 29),
(91, 23),
(92, 32),
(93, 1),
(94, 12),
(95, 5),
(96, 7),
(97, 11),
(98, 25),
(99, 26),
(100, 27),
(101, 33),
(102, 3),
(103, 6),
(104, 6),
(105, 31),
(106, 24),
(107, 31),
(108, 24),
(109, 17),
(110, 25),
(111, 29),
(112, 0),
(113, 7),
(114, 18),
(115, 27),
(116, 12),
(117, 5),
(118, 14),
(119, 29),
(120, 33),
(121, 28),
(122, 27),
(123, 32),
(124, 0),
(125, 12),
(126, 11),
(127, 3),
(128, 19),
(129, 3),
(130, 16),
(131, 5),
(132, 34),
(133, 1),
(134, 27),
(135, 11),
(136, 27),
(137, 2),
(138, 36),
(139, 28),
(140, 9),
(141, 13),
(142, 29),
(143, 18),
(144, 14),
(145, 36),
(146, 26),
(147, 6),
(148, 18),
(149, 14),
(150, 19),
(151, 17),
(152, 2),
(153, 33),
(154, 28),
(155, 18),
(156, 0),
(157, 15),
(158, 16),
(159, 30),
(160, 17),
(161, 31),
(162, 26),
(163, 34),
(164, 26),
(165, 16),
(166, 36),
(167, 17),
(168, 12),
(169, 16),
(170, 26),
(171, 29),
(172, 5),
(173, 15),
(174, 28),
(175, 22),
(176, 17),
(177, 17),
(178, 5),
(179, 7),
(180, 10),
(181, 10),
(182, 4),
(183, 20),
(184, 16),
(185, 24),
(186, 28),
(187, 0),
(188, 29),
(189, 6),
(190, 6),
(191, 29),
(192, 28),
(193, 12),
(194, 3),
(195, 14),
(196, 33),
(197, 5),
(198, 24),
(199, 24),
(200, 24),
(201, 16),
(202, 30),
(203, 13),
(204, 17),
(205, 36),
(206, 5),
(207, 17),
(208, 25),
(209, 31),
(210, 26),
(211, 14),
(212, 19),
(213, 31),
(214, 11),
(215, 30),
(216, 13),
(217, 0),
(218, 10),
(219, 31),
(220, 21),
(221, 31),
(222, 30),
(223, 3),
(224, 15),
(225, 34),
(226, 25),
(227, 5),
(228, 15),
(229, 21),
(230, 28),
(231, 21),
(232, 27),
(233, 27),
(234, 24),
(235, 34),
(236, 31),
(237, 12),
(238, 6),
(239, 10),
(240, 26),
(241, 34),
(242, 5),
(243, 8),
(244, 25),
(245, 19),
(246, 6),
(247, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cod_postal` varchar(10) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `rol_usuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `dni`, `nickname`, `nombre`, `apellido`, `correo`, `telefono`, `fecha_nac`, `genero`, `pais`, `ciudad`, `direccion`, `cod_postal`, `saldo`, `estado`, `rol_usuario`) VALUES
(818774, '48992165F', 'carlos_123', 'Carlos Javier', 'Montero Portillo', 'illoooxddd@gmail.com', '111222333', '2003-05-24', 'Masculino', 'España', 'Sevilla', 'Calle Madre de Dios', '41620', 90.00, 'A', 'usuario'),
(990376, '88844433D', 'admin', 'Admin', 'Admin', 'admin@gmail.com', '666777888', '1998-03-12', 'Masculino', 'España', 'Sevilla', 'admin', '41620', 283.46, 'A', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  ADD PRIMARY KEY (`id_apuesta`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_partido` (`id_partido`);

--
-- Indices de la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD PRIMARY KEY (`id_partido`,`fecha`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`id_partido`);

--
-- Indices de la tabla `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ruleta`
--
ALTER TABLE `ruleta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ruleta`
--
ALTER TABLE `ruleta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apuestas`
--
ALTER TABLE `apuestas`
  ADD CONSTRAINT `apuestas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `apuestas_ibfk_2` FOREIGN KEY (`id_partido`) REFERENCES `partidos` (`id_partido`);

--
-- Filtros para la tabla `cuotas`
--
ALTER TABLE `cuotas`
  ADD CONSTRAINT `cuotas_ibfk_1` FOREIGN KEY (`id_partido`) REFERENCES `partidos` (`id_partido`);

--
-- Filtros para la tabla `passwords`
--
ALTER TABLE `passwords`
  ADD CONSTRAINT `passwords_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
