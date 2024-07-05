-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-07-2024 a las 05:31:10
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
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `clArea` int(10) NOT NULL,
  `codArea` int(10) NOT NULL,
  `nombreArea` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `clCargo` int(10) NOT NULL,
  `codCargo` int(10) NOT NULL,
  `nombreCargo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `clCategoria` int(10) NOT NULL,
  `codCategoria` int(10) NOT NULL,
  `nombreCategoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleentrada`
--

CREATE TABLE `detalleentrada` (
  `precioEntrada` decimal(10,2) NOT NULL,
  `cantidadEntrada` int(10) NOT NULL,
  `clEntrada` int(10) NOT NULL,
  `clProducto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesalida`
--

CREATE TABLE `detallesalida` (
  `cantidadSalida` int(10) NOT NULL,
  `precioSalida` decimal(10,2) NOT NULL,
  `clExistencia` int(10) NOT NULL,
  `clSalida` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `clEmpleado` int(10) NOT NULL,
  `prefijoCedula` char(1) NOT NULL,
  `cedulaEmpleado` int(10) NOT NULL,
  `nombreEmpleado` varchar(30) NOT NULL,
  `apellidoEmpleado` varchar(30) NOT NULL,
  `correoEmpleado` varchar(30) NOT NULL,
  `telefonoEmpleado` bigint(11) NOT NULL,
  `clCargo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `existencia`
--

CREATE TABLE `existencia` (
  `clExistencia` int(10) NOT NULL,
  `cantidadExistencia` int(10) NOT NULL,
  `clArea` int(10) NOT NULL,
  `clProducto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notaentrada`
--

CREATE TABLE `notaentrada` (
  `clEntrada` int(10) NOT NULL,
  `fechaEntrada` datetime NOT NULL,
  `numFactura` int(10) NOT NULL,
  `clProveedor` int(10) NOT NULL,
  `clEmpleado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notasalida`
--

CREATE TABLE `notasalida` (
  `clSalida` int(10) NOT NULL,
  `codSalida` int(10) NOT NULL,
  `fechaSalida` datetime NOT NULL,
  `clEmpleado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `clProducto` int(10) NOT NULL,
  `codProducto` int(10) NOT NULL,
  `nombreProducto` varchar(30) NOT NULL,
  `descProducto` varchar(30) NOT NULL,
  `ultimoPrecio` decimal(10,2) NOT NULL,
  `clCategoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `clProveedor` int(10) NOT NULL,
  `prefijoRif` char(1) NOT NULL,
  `rifProveedor` int(10) NOT NULL,
  `nombreProveedor` varchar(30) NOT NULL,
  `telefonoProveedor` bigint(11) NOT NULL,
  `direccionProveedor` varchar(30) NOT NULL,
  `correoProveedor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`clArea`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`clCargo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`clCategoria`);

--
-- Indices de la tabla `detalleentrada`
--
ALTER TABLE `detalleentrada`
  ADD KEY `detalleencargoEncargo` (`clEntrada`),
  ADD KEY `detalleencargoProducto` (`clProducto`);

--
-- Indices de la tabla `detallesalida`
--
ALTER TABLE `detallesalida`
  ADD KEY `detallesalidaExistencia` (`clExistencia`),
  ADD KEY `detallesalidaSalida` (`clSalida`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`clEmpleado`),
  ADD KEY `empleadoCargo` (`clCargo`);

--
-- Indices de la tabla `existencia`
--
ALTER TABLE `existencia`
  ADD PRIMARY KEY (`clExistencia`),
  ADD KEY `existenciaArea` (`clArea`),
  ADD KEY `existenciaProducto` (`clProducto`);

--
-- Indices de la tabla `notaentrada`
--
ALTER TABLE `notaentrada`
  ADD PRIMARY KEY (`clEntrada`),
  ADD KEY `encargoProveedor` (`clProveedor`),
  ADD KEY `encargoEmpleado` (`clEmpleado`);

--
-- Indices de la tabla `notasalida`
--
ALTER TABLE `notasalida`
  ADD PRIMARY KEY (`clSalida`),
  ADD KEY `salidaEmpleado` (`clEmpleado`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`clProducto`),
  ADD KEY `productoCategoria` (`clCategoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`clProveedor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `clArea` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `clCargo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `clCategoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `clEmpleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `existencia`
--
ALTER TABLE `existencia`
  MODIFY `clExistencia` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notaentrada`
--
ALTER TABLE `notaentrada`
  MODIFY `clEntrada` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notasalida`
--
ALTER TABLE `notasalida`
  MODIFY `clSalida` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `clProducto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `clProveedor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleentrada`
--
ALTER TABLE `detalleentrada`
  ADD CONSTRAINT `detalleencargoEncargo` FOREIGN KEY (`clEntrada`) REFERENCES `notaentrada` (`clEntrada`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleencargoProducto` FOREIGN KEY (`clProducto`) REFERENCES `producto` (`clProducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallesalida`
--
ALTER TABLE `detallesalida`
  ADD CONSTRAINT `detallesalidaExistencia` FOREIGN KEY (`clExistencia`) REFERENCES `existencia` (`clExistencia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detallesalidaSalida` FOREIGN KEY (`clSalida`) REFERENCES `notasalida` (`clSalida`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleadoCargo` FOREIGN KEY (`clCargo`) REFERENCES `cargo` (`clCargo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `existencia`
--
ALTER TABLE `existencia`
  ADD CONSTRAINT `existenciaArea` FOREIGN KEY (`clArea`) REFERENCES `area` (`clArea`) ON UPDATE CASCADE,
  ADD CONSTRAINT `existenciaProducto` FOREIGN KEY (`clProducto`) REFERENCES `producto` (`clProducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `notaentrada`
--
ALTER TABLE `notaentrada`
  ADD CONSTRAINT `encargoEmpleado` FOREIGN KEY (`clEmpleado`) REFERENCES `empleado` (`clEmpleado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `encargoProveedor` FOREIGN KEY (`clProveedor`) REFERENCES `proveedor` (`clProveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `notasalida`
--
ALTER TABLE `notasalida`
  ADD CONSTRAINT `salidaEmpleado` FOREIGN KEY (`clEmpleado`) REFERENCES `empleado` (`clEmpleado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `productoCategoria` FOREIGN KEY (`clCategoria`) REFERENCES `categoria` (`clCategoria`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
