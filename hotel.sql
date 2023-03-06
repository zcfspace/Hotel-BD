-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2023 a las 11:12:49
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `correo`, `telefono`, `direccion`) VALUES
(1, 'nombre2', 'apellido2', '2@gmail.com', 2, 'Calle pepe 2'),
(2, 'nombre3', 'apellido3', '3@gmail.com', 3, 'Calle pepe 3'),
(3, 'nombre4', 'apellido4', '4@gmail.com', 4, 'Calle pepe 4'),
(4, 'nombre5', 'apellido5', '5@gmail.com', 5, 'Calle pepe 5'),
(5, 'nombre6', 'apellido6', '6@gmail.com', 6, 'Calle pepe 6'),
(6, 'nombre7', 'apellido7', '7@gmail.com', 7, 'Calle pepe 7'),
(7, 'nombre8', 'apellido8', '8@gmail.com', 8, 'Calle pepe 8'),
(8, 'nombre9', 'apellido9', '9@gmail.com', 9, 'Calle pepe 9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `cod_activation` varchar(45) DEFAULT NULL,
  `salt` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `apellido`, `puesto`, `email`, `password`, `activo`, `cod_activation`, `salt`) VALUES
(1, 'user1', 'aplledio1', 'trabajador', 'a@gmail.com', '1234', NULL, NULL, NULL),
(2, 'user2', 'apellido2', 'trabajador', 'a@gmail.com', '1234', NULL, NULL, NULL),
(3, 'user3', 'apellido3', 'trabajador', 'a@gmail.com', '1234', NULL, NULL, NULL),
(4, 'user4', 'apellido4', 'trabajador', 'a@gmail.com', '1234', NULL, NULL, NULL),
(5, 'user5', 'apellido5', 'trabajador', 'a@gmail.com', '1234', NULL, NULL, NULL),
(6, 'user6', 'apellido6', 'trabajador', 'a@gmail.com', '1234', NULL, NULL, NULL),
(7, 'user7', 'apellido7', 'trabajador', 'a@gmail.com', '1234', NULL, NULL, NULL),
(8, 'user8', 'apellido8', 'trabajador', 'a@gmail.com', '1234', NULL, NULL, NULL),
(9, 'user9', 'apellido9', 'trabajador', 'a@gmail.com', '1234', NULL, NULL, NULL),
(35, 'test', NULL, NULL, '444@gmail.com', '5d08fa2c2947291cde3760fef8933f1f2e0f2b90021f0134bd2c86b78ba263fe', 0, '9157', '0860265987198875'),
(37, 'hola', NULL, NULL, 'test@gmail.com', 'a5c22405ebc4645a7f07f2546089a69c177c9577165c0043b7e523e1b86d466d', 0, '1727', '5503852653113658'),
(38, 'hola', NULL, NULL, 'hola@gmail.com', '9213d1a20c5925751123aebbb0d2be4f15b30c8f579c99a3082ef56c56bc9329', 0, '8518', '6286345140721306'),
(39, 'hola', NULL, NULL, 'hola2@gmail.com', 'b27a2cbff0771d69c41aa0d0f9766f65a3cf0e012b93f269c058fef66fd40591', 1, '7907', '3998464700161753'),
(46, 'testMail', NULL, NULL, 'zcfwebsite@gmail.com', 'd43123cf20f9be31ea3651e34ec5798ef113052d33851145829abe54325ace33', 1, '2661', '4652143229229094'),
(47, 'testMail', NULL, NULL, 'czhe581@g.educaand.es', 'b5365eab6c220bc43a74a52ce57eadba83a390096c7a01b03b1f61c4fec9b323', 1, '9768', '1805091613680013'),
(48, 'MailTest', NULL, NULL, 'zcfspace@gmail.com', '16596c16b0233f2f2fb9acf0dea601ccb336655d57c2775890d4ca10da621901', 0, '1215', '3095635744532722');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `numero`, `tipo`, `precio`) VALUES
(1, 1, 'lujo', 999),
(2, 2, 'tipo1', 888),
(3, 2, 'tipo2', 777),
(4, 3, 'eco', 59.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_entrada` datetime NOT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `imagen`, `fecha_entrada`, `fecha_salida`, `id_empleado`, `id_cliente`) VALUES
(244, 'img/reserva_2023-02-15_120841_63ecbd399f6ac.jpg', '2023-02-23 02:00:00', '2023-02-28 00:00:00', 7, 1),
(246, 'img/reserva_2023-02-15_115051_63ecb90b18766.png', '2023-02-16 00:00:00', '2023-02-24 00:00:00', 5, 1),
(247, 'img/reserva_2023-02-15_100650_63eca0aa6526b.png', '2023-02-15 00:00:00', '2023-02-16 00:00:00', 1, 1),
(256, 'img/reserva_2023-02-15_100653_63eca0ade9e1a.png', '2022-10-10 00:00:00', '2022-11-11 00:00:00', 4, 7),
(278, '', '2023-02-16 00:00:00', '2023-02-17 00:00:00', 1, 1),
(280, '', '2023-02-16 00:00:00', '2023-02-17 00:00:00', 1, 1),
(281, NULL, '2023-02-16 00:00:00', '2023-02-17 00:00:00', 1, 1),
(282, NULL, '2023-02-16 00:00:00', '2023-02-17 00:00:00', 1, 1),
(283, NULL, '2023-02-16 00:00:00', '2023-02-17 00:00:00', 1, 1),
(284, NULL, '2023-02-16 00:00:00', '2023-02-17 00:00:00', 1, 1),
(285, NULL, '2023-02-16 00:00:00', '2023-02-17 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_has_habitaciones`
--

CREATE TABLE `reservas_has_habitaciones` (
  `Reservas_id_reserva` int(11) NOT NULL,
  `Habitaciones_id_habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservas_has_habitaciones`
--

INSERT INTO `reservas_has_habitaciones` (`Reservas_id_reserva`, `Habitaciones_id_habitacion`) VALUES
(244, 1),
(244, 2),
(246, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre_servicio` varchar(255) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nombre_servicio`, `precio`) VALUES
(1, 'spa', 99),
(2, 'servicio2', 49.99),
(3, 'servicio1', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_has_reservas`
--

CREATE TABLE `servicios_has_reservas` (
  `Servicios_id_servicio` int(11) NOT NULL,
  `Reservas_id_reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios_has_reservas`
--

INSERT INTO `servicios_has_reservas` (`Servicios_id_servicio`, `Reservas_id_reserva`) VALUES
(1, 244),
(2, 246),
(3, 244);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `fk_Facturas_Reservas1_idx` (`id_reserva`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_habitacion`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `fk_Reservas_Empleados1_idx` (`id_empleado`),
  ADD KEY `fk_Reservas_Clientes1_idx` (`id_cliente`);

--
-- Indices de la tabla `reservas_has_habitaciones`
--
ALTER TABLE `reservas_has_habitaciones`
  ADD PRIMARY KEY (`Reservas_id_reserva`,`Habitaciones_id_habitacion`),
  ADD KEY `fk_Reservas_has_Habitaciones_Habitaciones1_idx` (`Habitaciones_id_habitacion`),
  ADD KEY `fk_Reservas_has_Habitaciones_Reservas1_idx` (`Reservas_id_reserva`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `servicios_has_reservas`
--
ALTER TABLE `servicios_has_reservas`
  ADD PRIMARY KEY (`Servicios_id_servicio`,`Reservas_id_reserva`),
  ADD KEY `fk_Servicios_has_Reservas_Reservas1_idx` (`Reservas_id_reserva`),
  ADD KEY `fk_Servicios_has_Reservas_Servicios1_idx` (`Servicios_id_servicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_Facturas_Reservas1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_Reservas_Clientes1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reservas_Empleados1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas_has_habitaciones`
--
ALTER TABLE `reservas_has_habitaciones`
  ADD CONSTRAINT `fk_Reservas_has_Habitaciones_Habitaciones1` FOREIGN KEY (`Habitaciones_id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reservas_has_Habitaciones_Reservas1` FOREIGN KEY (`Reservas_id_reserva`) REFERENCES `reservas` (`id_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicios_has_reservas`
--
ALTER TABLE `servicios_has_reservas`
  ADD CONSTRAINT `fk_Servicios_has_Reservas_Reservas1` FOREIGN KEY (`Reservas_id_reserva`) REFERENCES `reservas` (`id_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Servicios_has_Reservas_Servicios1` FOREIGN KEY (`Servicios_id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
