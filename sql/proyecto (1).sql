-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2021 a las 02:00:54
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartproduct`
--

CREATE TABLE `cartproduct` (
  `id_cart` varchar(300) NOT NULL,
  `id_pr` int(11) NOT NULL,
  `nom_p` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cartproduct`
--

INSERT INTO `cartproduct` (`id_cart`, `id_pr`, `nom_p`, `stock`, `total`, `id`) VALUES
('619424ef05e1b', 3, 'jljlkjl', 2, '175958', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Electrodomésticos'),
(2, 'Ropa'),
(3, 'Suministro de oficinas fg'),
(5, 'Computación'),
(6, 'Telefonos'),
(7, 'Categoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `documento` int(12) NOT NULL,
  `vendedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido`, `documento`, `vendedor`) VALUES
(1, 'Prueba', 'Prueba', 2147483647, 2),
(8, 'PeraF', 'PEra', 4656, 4),
(9, 'Prueba registro', 'PRueba', 3453534, 2),
(10, 'Prueba 3', 'Prueba', 3333, 2),
(11, 'uyiyuiy', 'iyiyiyi', 77667, 2),
(12, 'ewrwerwer', 'wrwerwer', 5345345, 2),
(14, 'Nuevo', 'Nuevo', 7798, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `porcentaje` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `documento` int(12) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `rol` int(11) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `contrasena` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `documento`, `nombre`, `apellido`, `direccion`, `telefono`, `rol`, `usuario`, `contrasena`) VALUES
(1, 12345, 'PRueba', 'Prueba', 'prueba', '7787987', 1, 'rool', 'pass123'),
(2, 888888, 'hghjgjg', 'gjhghjgkg', 'hggkjgkjg', 'jhgjhgjg', 2, 'hhkhjkh', 'hjkhkjh'),
(3, 2147483647, 'Prueba 2', 'Prueba 2', 'klhjkhuhhjkh', '77978797897897', 0, 'test_2', 'pass123'),
(4, 454645645, 'kjkl', 'jlkñjlkj', 'j', 'jlj', 2, 'kljlkjkl', 'lkjkl'),
(5, 2147483647, 'uiouoiuouo', 'ououou', 'uoouoiuo', 'iuoiu', 2, 'uououoiuoi', 'oioiuou'),
(6, 234234, 'ewrwer', 'werewr', 'wrwer', 'werer', 1, 'wrwer', 'werwr'),
(11, 34444, 'Prueba', 'Vendedor', 'kkkkk', 'kkkkkkk', 2, 'test_1', 'pass123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `codigo` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_c` int(11) NOT NULL,
  `precio_v` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nombre`, `descripcion`, `precio_c`, `precio_v`, `stock`, `categoria`, `imagen`) VALUES
(3, 'HJLKLO0989LL', 'jljlkjl', 'lkjlkjlkjljl', 98, 87979, 89, 2, 'https://telechollos.com/wp-content/uploads/2017/07/teclado-gaming-emish.jpg'),
(4, 'LOFLGO9787', 'Prueba', 'poipiiipiopipip', 98898, 9009898, 9, 5, 'https://h20386.www2.hp.com/AustraliaStore/Html/Merch/Images/c04328601_1750x1285.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_v` int(11) NOT NULL,
  `id_cart_p` varchar(255) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_ven` int(11) NOT NULL,
  `fech` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_v`, `id_cart_p`, `id_client`, `id_ven`, `fech`) VALUES
(2, '619424ef05e1b', 14, 11, '2021-11-17 00:45:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cartproduct`
--
ALTER TABLE `cartproduct`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_CARTPRODUCT_PRODUCT` (`id_pr`),
  ADD KEY `id_cart` (`id_cart`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CLIENTE_EMPLEADO` (`vendedor`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`,`documento`) USING BTREE,
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CATEGORIA_PRODUCTO` (`categoria`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_v`),
  ADD KEY `FK_VENTA_CLINETE` (`id_client`),
  ADD KEY `FK_VENTA_EMPLADO` (`id_ven`),
  ADD KEY `FK_VENTA_CARTPRODUCT` (`id_cart_p`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cartproduct`
--
ALTER TABLE `cartproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_v` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cartproduct`
--
ALTER TABLE `cartproduct`
  ADD CONSTRAINT `FK_CARTPRODUCT_PRODUCT` FOREIGN KEY (`id_pr`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FK_CLIENTE_EMPLEADO` FOREIGN KEY (`vendedor`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_CATEGORIA_PRODUCTO` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `FK_VENTA_CARTPRODUCT` FOREIGN KEY (`id_cart_p`) REFERENCES `cartproduct` (`id_cart`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_VENTA_CLINETE` FOREIGN KEY (`id_client`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_VENTA_EMPLADO` FOREIGN KEY (`id_ven`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
