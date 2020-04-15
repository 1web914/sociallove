-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-04-2020 a las 23:18:51
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sociallove`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contador`
--

CREATE TABLE `contador` (
  `id` int(11) NOT NULL,
  `contador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contador`
--

INSERT INTO `contador` (`id`, `contador`) VALUES
(1, 257666),
(1, 257666),
(1, 257666),
(1, 257666),
(1, 257666),
(1, 257666),
(1, 257666),
(1, 257666);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `foto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_login` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `foto`, `usuario_login`) VALUES
(49, 'chica1.jpg', 'Alba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `like`
--

CREATE TABLE `like` (
  `usuario_da_like` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_recibe_like` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `notificado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL,
  `usuario_envia` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_recibe` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `texto` mediumtext COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `notificado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `usuario_login` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pago` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cod_operacion` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `importe` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `id_rango` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_has_pedido`
--

CREATE TABLE `producto_has_pedido` (
  `producto_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango`
--

CREATE TABLE `rango` (
  `id` int(11) NOT NULL,
  `descripcion` mediumtext COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio` double NOT NULL,
  `Hechizos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `rango`
--

INSERT INTO `rango` (`id`, `descripcion`, `nombre`, `precio`, `Hechizos`) VALUES
(0, '3 Me gustas de empiece', 'Registrado', 0, 3),
(1, '25 Me gustas de mas\r\n20.78€', 'Vip 6 meses', 52.8, 25),
(2, '15 Me gustas de mas\r\n18.78€', 'Vip 3 meses', 32.4, 15),
(3, '5 Me gustas de mas\r\n12.78€', 'Vip 1 mes', 16.8, 5),
(4, '2 Me gustas de mas\r\n0.98€', 'Pass discovery', 6.9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`) VALUES
(0, 'admin'),
(1, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `login` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `edad` int(2) NOT NULL,
  `hechizos` int(11) NOT NULL,
  `genero` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `busco` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `ubicacion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `rol_id` int(11) NOT NULL,
  `rango_id` int(11) NOT NULL,
  `foto_perfil` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `validacion` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `sobreti` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `gustos` text COLLATE utf8_spanish2_ci NOT NULL,
  `loquebuscas` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `aficciones` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`login`, `password`, `email`, `nombre`, `apellidos`, `edad`, `hechizos`, `genero`, `busco`, `ubicacion`, `rol_id`, `rango_id`, `foto_perfil`, `validacion`, `sobreti`, `gustos`, `loquebuscas`, `aficciones`) VALUES
('Aithor', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'Thor9977@yahoo.com', 'Aitor', '', 27, 3, 'chico', 'chica', 'Alcobendas', 1, 0, 'chico15.jpg', '', '', '', '', ''),
('Alba', '$2y$10$GN5L9/OG0P5z7k51nwFqLeYJGmkTnAkvCV2BOkcuy8eEugF/2BLLW', 'alba@gmail.com', 'Alba', '', 24, 3, 'chica', 'chico', 'Aldaia', 1, 0, 'chica1.jpg', '', '', '', '', ''),
('Albert', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'albert@hotmail.com', 'Albert', '', 26, 3, 'chico', 'chica', 'Barcelona', 1, 0, 'chico23.jpg', '', '', '', '', ''),
('AlexTZ', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'Alextzr@gmail.com', 'Alejandro', '', 32, 3, 'chico', 'chica', 'Peñiscola', 1, 0, 'chico20.jpg', '', '', '', '', ''),
('Alfredo', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'alfred111@gmail.com', 'Alfredo', '', 24, 3, 'chico', 'chica', 'Valdemoro', 1, 0, 'chico21.jpg', '', '', '', '', ''),
('AnaHi', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'anahi_Madrid@gmail.com', 'Ana', '', 26, 3, 'chica', 'chica', 'Madrid', 1, 0, 'chica16.jpg', '', '', '', '', ''),
('Angeles', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'angelesMurciana@gmail.com', 'Angeles', '', 27, 3, 'chica', 'chica', 'Barrio peral', 1, 0, 'chica15.jpg', '', '', '', '', ''),
('Angie', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'angelicadel_monte@gmail.com', 'Angelica', '', 23, 28, 'chica', 'chico', 'Vigo', 1, 0, 'chica4.jpg', '', '', '', '', ''),
('Antonio', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'toni@gmail.com', 'Antonio', '', 29, 3, 'chico', 'chica', 'Madrid', 1, 0, 'chico1.jpg', '', '', '', '', ''),
('Bren', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'brenda@yahoo.com', 'Brenda', '', 26, 3, 'chica', 'chico', 'Los peñascos', 1, 0, 'chica12.jpg', '', '', '', '', ''),
('Canelita', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'canelita@gmail.com', 'Carmen', '', 33, 3, 'chica', 'chico', 'Madrid', 1, 0, 'chica18.jpg', '', '', '', '', ''),
('Carla', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'carlita@gmail.com', 'Carla', '', 22, 3, 'chica', 'chico', 'mollet del valles', 1, 0, 'chica7.jpg', '', '', '', '', ''),
('Carles', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'carlesBartolo@gmail.com', 'Carles', '', 20, 3, 'chico', 'chica', 'Sabadell', 1, 0, 'chico7.jpg', '', '', '', '', ''),
('Cat', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'catalina@gmail.com', 'Catalina', '', 19, 3, 'chica', 'chica', 'Burgos', 1, 0, 'chica14.jpg', '', '', '', '', ''),
('Celia', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'celia@terra.es', 'Celia', '', 19, 3, 'chica', 'chico', 'Salamanca', 1, 0, 'chica13.jpg', '', '', '', '', ''),
('Cristina', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'CristinitaGetafe@gmail.com', 'Cristina', '', 31, 3, 'chica', 'chico', 'Madrid', 1, 0, 'chica10.jpg', '', '', '', '', ''),
('Chechu', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'jesus@hotmail.com', 'Jesús', '', 25, 3, 'chico', 'chico', 'Montserrat', 1, 0, 'chico8.jpg', '', '', '', '', ''),
('Eva', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'evamaria@gmail.com', 'Eva', '', 21, 3, 'chica', 'chico', 'Sevilla', 1, 0, 'chica23.jpg', '', '', '', '', ''),
('FelipeLuis', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'FelipeLuis@yahoo.com', 'Felipe', '', 34, 3, 'chico', 'chica', 'Sevilla', 1, 0, 'chico19.jpg', '', '', '', '', ''),
('Fernandito', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'ferElMorenohDeFuenla@gmail.com', 'Fernando', '', 24, 3, 'chico', 'chica', 'Fuenlabrada', 1, 0, 'chico12.jpg', '', '', '', '', ''),
('Hector69', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'HectorGarri@hotmail.com', 'Hector', '', 21, 3, 'chico', 'chica', 'Segovia', 1, 0, 'chico16.jpg', '', '', '', '', ''),
('Iker', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'IkerCasillas@gmail.com', 'Iker', '', 23, 3, 'chico', 'chica', 'Móstoles', 1, 0, 'chico13.jpg', '', '', '', '', ''),
('Isa', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'isabella@gmail.com', 'isabel', '', 23, 3, 'chica', 'chico', 'Huesca', 1, 0, 'chica5.jpg', '', '', '', '', ''),
('Jessi', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'jesikaMartinez@gmail.com', 'Jesica', '', 29, 3, 'chica', 'chico', 'Toledo', 1, 0, 'chica3.jpg', '', '', '', '', ''),
('Jose', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'josito@hotmail.com', 'Jose Manuel', '', 25, 3, 'chico', 'chica', 'Barcelona', 1, 0, 'chico2.jpg', '', '', '', '', ''),
('Jose Antonio', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'JoseAntonioGarcia@hotmail.com', 'Jose.A', '', 19, 3, 'chico', 'chica', 'Madrid', 1, 0, 'chico6.jpg', '', '', '', '', ''),
('Juanito', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'JuanTorres@gmail.com', 'Juan', '', 32, 3, 'chico', 'chica', 'Getafe', 1, 0, 'chico5.jpg', '', '', '', '', ''),
('La Patri', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'LaPatriLoRompe@gmail.com', 'Patri', '', 28, 3, 'chica', 'chico', 'Valencia', 1, 0, 'chica19.jpg', '', '', '', '', ''),
('Lorena', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'lore@gmail.com', 'Lorena', '', 28, 3, 'chica', 'chico', 'Teruel', 1, 0, 'chica6.jpg', '', '', '', '', ''),
('Lucas Lera', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'lucasLera@musica.com', 'Lucas', '', 18, 3, 'chico', 'chico', 'Pinto', 1, 0, 'chico17.jpg', '', '', '', '', ''),
('Maddie', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'maddi98@gmail.com', 'Maddie', '', 21, 3, 'chica', 'chica', 'Valladolid', 1, 0, 'chica21.jpg', '', '', '', '', ''),
('Manu', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'manolin@yahoo.com', 'Manuel', '', 28, 3, 'chico', 'chica', 'Valencia', 1, 0, 'chico3.jpg', '', '', '', '', ''),
('Marina Santos', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'marinaSantoValle@gmail.com', 'Marina Santos', '', 30, 3, 'chica', 'chico', 'Sangarren', 1, 0, 'chica9.jpg', '', '', '', '', ''),
('Martona', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'martitaGuapa@gmail.com', 'Marta', '', 18, 3, 'chica', 'chico', 'Pineda de mar', 1, 0, 'chica8.jpg', '', '', '', '', ''),
('Mel', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'melani@gmail.com', 'Melani', '', 26, 3, 'chica', 'chico', 'Barcelona', 1, 0, 'chica2.jpg', '', '', '', '', ''),
('Melisa', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'melisaMelisa@hotmail.com', 'Melisa', '', 25, 3, 'chica', 'chico', 'Cantabria', 1, 0, 'chica22.jpg', '', '', '', '', ''),
('Miguel Angel', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'miguelito@hotmail.com', 'Miguel Angel', '', 28, 3, 'chico', 'chica', 'Valencia', 1, 0, 'chico10.jpg', '', '', '', '', ''),
('Pako', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'franciscofdez@gmail.com', 'Francisco', '', 26, 3, 'chico', 'chica', 'Alcalá de Henares', 1, 0, 'chico4.jpg', '', '', '', '', ''),
('Pedritoh', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'PedritohReshulon@gmail.com', 'Pedro', '', 22, 3, 'chico', 'chico', 'Castellón', 1, 0, 'chico11.jpg', '', '', '', '', ''),
('Rafita', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'rafi@gmail.com', 'Rafa', '', 30, 3, 'chico', 'chica', 'Leganés', 1, 0, 'chico9.jpg', '', '', '', '', ''),
('Rodri', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'rodenas@gmail.com', 'Rodrigo', '', 22, 3, 'chico', 'chica', 'Madrid', 1, 0, 'chico24.jpg', '', '', '', '', ''),
('Samu BPAC', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'SamuBripac@hotmail.com', 'Samuel', '', 29, 3, 'chico', 'chica', 'S.S de los Reyes', 1, 0, 'chico14.jpg', '', '', '', '', ''),
('Sandritah', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'sandritaReshulona@hotmail.com', 'Sandra', '', 31, 3, 'chica', 'chica', 'Salamanca', 1, 0, 'chica17.jpg', '', '', '', '', ''),
('Valeria', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'valeria@hotmail.com', 'Valeria', '', 19, 3, 'chica', 'chica', 'Madrid', 1, 0, 'chica11.jpg', '', '', '', '', ''),
('Vanesa', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'vanesa@yahoo.es', 'Vanesa', '', 35, 3, 'chica', 'chico', 'La rioja', 1, 0, 'chica20.jpg.webp', '', '', '', '', ''),
('Veronica', '$2y$10$9enIPzbe2qFP1XvV.yfq5enbz/w.LZDA9FPXya4jmPzshkZh1voaW', 'VeronicaGarcia@hotmail.com', 'Veronica', '', 29, 3, 'chica', 'chico', 'Malaga', 1, 0, 'chica24.jpg', '', '', '', '', ''),
('Vity', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'Vi99_Love@hotmail.com', 'Victor', '', 31, 3, 'chico', 'chica', 'Toledo', 1, 0, 'chico18.jpg', '', '', '', '', ''),
('Xavi', '$2y$10$qi2vgQCkaFLFQhGpIg6aMOr3c3Fmnal49sdAa1bbFDT5Gzp7u2zU6', 'xavi77@hotmail.com', 'Xavier', '', 30, 3, 'chico', 'chico', 'Igualada', 1, 0, 'chico22.jpg', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `usuario_visitado` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_visitante` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `notificado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`,`usuario_login`),
  ADD KEY `fk_fotos_usuario1_idx` (`usuario_login`);

--
-- Indices de la tabla `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`usuario_da_like`,`usuario_recibe_like`),
  ADD KEY `fk_usuario_has_usuario_usuario2_idx` (`usuario_recibe_like`),
  ADD KEY `fk_usuario_has_usuario_usuario1_idx` (`usuario_da_like`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`,`usuario_envia`,`usuario_recibe`),
  ADD KEY `fk_usuario_has_usuario_usuario4_idx` (`usuario_recibe`),
  ADD KEY `fk_usuario_has_usuario_usuario3_idx` (`usuario_envia`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_login_idx` (`usuario_login`),
  ADD KEY `id_rango_idx` (`id_rango`);

--
-- Indices de la tabla `producto_has_pedido`
--
ALTER TABLE `producto_has_pedido`
  ADD PRIMARY KEY (`producto_id`,`pedido_id`),
  ADD KEY `fk_Producto_has_Pedido_Pedido1_idx` (`pedido_id`),
  ADD KEY `fk_Producto_has_Pedido_Producto_idx` (`producto_id`);

--
-- Indices de la tabla `rango`
--
ALTER TABLE `rango`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`login`,`rol_id`,`rango_id`),
  ADD KEY `fk_usuario_rol_idx` (`rol_id`),
  ADD KEY `fk_usuario_rango1_idx` (`rango_id`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`usuario_visitado`,`usuario_visitante`),
  ADD KEY `fk_usuario_has_usuario_usuario6_idx` (`usuario_visitante`),
  ADD KEY `fk_usuario_has_usuario_usuario5_idx` (`usuario_visitado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fk_fotos_usuario1` FOREIGN KEY (`usuario_login`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `fk_usuario_has_usuario_usuario1` FOREIGN KEY (`usuario_da_like`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_usuario_usuario2` FOREIGN KEY (`usuario_recibe_like`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_usuario_has_usuario_usuario3` FOREIGN KEY (`usuario_envia`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_usuario_usuario4` FOREIGN KEY (`usuario_recibe`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `id_rango` FOREIGN KEY (`id_rango`) REFERENCES `rango` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_login` FOREIGN KEY (`usuario_login`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_has_pedido`
--
ALTER TABLE `producto_has_pedido`
  ADD CONSTRAINT `fk_Producto_has_Pedido_Pedido1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_has_Pedido_Producto` FOREIGN KEY (`producto_id`) REFERENCES `rango` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rango1` FOREIGN KEY (`rango_id`) REFERENCES `rango` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `fk_usuario_has_usuario_usuario5` FOREIGN KEY (`usuario_visitado`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_usuario_usuario6` FOREIGN KEY (`usuario_visitante`) REFERENCES `usuario` (`login`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
