-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2022 a las 19:51:02
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sitio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `baneados`
--

CREATE TABLE `baneados` (
  `id` varchar(9) NOT NULL,
  `IP` varchar(40) NOT NULL,
  `fecha` int(10) NOT NULL,
  `duracion` text NOT NULL,
  `finaliza` text NOT NULL,
  `motivo` text NOT NULL,
  `autor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` varchar(9) NOT NULL,
  `contenido` text NOT NULL,
  `hilo` varchar(9) NOT NULL,
  `fecha` int(10) NOT NULL,
  `imagen` text NOT NULL,
  `autor` varchar(12) NOT NULL,
  `responde` varchar(12) NOT NULL,
  `Video` text DEFAULT NULL,
  `VideoURL` text DEFAULT NULL,
  `VYT` text DEFAULT NULL,
  `color` int(1) NOT NULL,
  `visible` int(1) NOT NULL,
  `esGIF` int(1) NOT NULL,
  `esOP` int(1) NOT NULL,
  `tag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncias`
--

CREATE TABLE `denuncias` (
  `id` varchar(12) NOT NULL,
  `denunciante` varchar(12) NOT NULL,
  `hilo` varchar(9) NOT NULL,
  `comentario` varchar(9) NOT NULL,
  `motivo` text NOT NULL,
  `fecha` int(10) NOT NULL,
  `IP` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hilos`
--

CREATE TABLE `hilos` (
  `id` varchar(9) NOT NULL,
  `titulo` text NOT NULL,
  `contenido` text NOT NULL,
  `imagen` text NOT NULL,
  `fecha` int(10) NOT NULL,
  `sticky` int(1) NOT NULL,
  `ucomentario` int(10) NOT NULL,
  `autor` varchar(12) NOT NULL,
  `Video` text NOT NULL,
  `VideoURL` text NOT NULL,
  `VYT` text NOT NULL,
  `esGIF` int(1) NOT NULL,
  `categoria` varchar(3) NOT NULL,
  `comentarios` varchar(10) NOT NULL,
  `visible` int(1) NOT NULL,
  `tag` int(1) NOT NULL,
  `usuario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` varchar(12) NOT NULL,
  `emisor` varchar(12) NOT NULL,
  `receptor` varchar(12) NOT NULL,
  `clase` int(1) NOT NULL,
  `hilo` varchar(9) NOT NULL,
  `comentario` varchar(9) NOT NULL,
  `leida` int(1) NOT NULL,
  `fecha` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `nombre` varchar(20) NOT NULL,
  `ejecutada` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`nombre`, `ejecutada`) VALUES
('borrarCache', 1662398234),
('borrarHilos', 1662461347),
('borrarNotificaciones', 1662466456),
('borrarUsuarios', 1662422005),
('levantarBaneos', 1662468389);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(12) NOT NULL,
  `usuario` varchar(12) NOT NULL,
  `clave` text NOT NULL,
  `sesion` varchar(18) NOT NULL,
  `favoritos` text DEFAULT NULL,
  `ocultos` text DEFAULT NULL,
  `nivel` int(1) NOT NULL,
  `UIP` varchar(40) DEFAULT NULL,
  `ultimoPost` int(10) DEFAULT NULL,
  `ultimaDen` int(10) DEFAULT NULL,
  `adm` int(1) NOT NULL,
  `fecha` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `sesion`, `favoritos`, `ocultos`, `nivel`, `UIP`, `ultimoPost`, `ultimaDen`, `adm`, `fecha`) VALUES
('123456789123', 'Raul', 'jejetabien', '123456123123898989', NULL, NULL, 2, NULL, NULL, NULL, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `baneados`
--
ALTER TABLE `baneados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fecha` (`fecha`),
  ADD KEY `IP` (`IP`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hilo` (`hilo`) USING BTREE,
  ADD KEY `fecha` (`fecha`) USING BTREE,
  ADD KEY `autor` (`autor`) USING BTREE,
  ADD KEY `responde` (`responde`),
  ADD KEY `visible` (`visible`);
ALTER TABLE `comentarios` ADD FULLTEXT KEY `contenido` (`contenido`);

--
-- Indices de la tabla `denuncias`
--
ALTER TABLE `denuncias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fecha` (`fecha`);

--
-- Indices de la tabla `hilos`
--
ALTER TABLE `hilos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`autor`),
  ADD KEY `fecha` (`fecha`),
  ADD KEY `ucomentario` (`ucomentario`),
  ADD KEY `visible` (`visible`);
ALTER TABLE `hilos` ADD FULLTEXT KEY `contenido` (`contenido`);
ALTER TABLE `hilos` ADD FULLTEXT KEY `titulo` (`titulo`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receptor` (`receptor`),
  ADD KEY `leida` (`leida`),
  ADD KEY `fecha` (`fecha`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sesion` (`sesion`),
  ADD KEY `UIP` (`UIP`);
ALTER TABLE `usuarios` ADD FULLTEXT KEY `usuario` (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
