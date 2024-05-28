-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2024 a las 08:03:12
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

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
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `codAlmacen` int(11) NOT NULL,
  `nombreAlmacen` varchar(100) DEFAULT NULL,
  `direccionAlmacen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`codAlmacen`, `nombreAlmacen`, `direccionAlmacen`) VALUES
(1, 'Almacén Central', 'Zona Industrial 123'),
(2, 'Almacén Secundario', 'Zona Comercial 456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `codArea` int(11) NOT NULL,
  `descripcionArea` varchar(255) DEFAULT NULL,
  `codAlmacen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`codArea`, `descripcionArea`, `codAlmacen`) VALUES
(1, 'Área de Electrónica', 1),
(2, 'Área de Ropa', 1),
(3, 'Área de Alimentos', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `codBanco` int(11) NOT NULL,
  `nombreBanco` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `banco`
--

INSERT INTO `banco` (`codBanco`, `nombreBanco`) VALUES
(1, 'Banco A'),
(2, 'Banco B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `codCargo` int(11) NOT NULL,
  `descripcionCargo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`codCargo`, `descripcionCargo`) VALUES
(1, 'Gerente'),
(2, 'Supervisor'),
(3, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `codCategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`codCategoria`, `nombreCategoria`) VALUES
(1, 'Electrónica'),
(2, 'Ropa'),
(3, 'Alimentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cedulaCliente` varchar(20) NOT NULL,
  `nombreCliente` varchar(100) DEFAULT NULL,
  `apellidoCliente` varchar(100) DEFAULT NULL,
  `telefonoCliente` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cedulaCliente`, `nombreCliente`, `apellidoCliente`, `telefonoCliente`) VALUES
('V-11223344-5', 'María', 'Rodríguez', '04141122334'),
('V-55667788-9', 'Juan', 'Martínez', '04145566778');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleentrega`
--

CREATE TABLE `detalleentrega` (
  `codDetalleEntrega` int(11) NOT NULL,
  `precioEntregas` decimal(10,2) DEFAULT NULL,
  `cantidadEntregas` int(11) DEFAULT NULL,
  `codEntrega` int(11) DEFAULT NULL,
  `codExistencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalleentrega`
--

INSERT INTO `detalleentrega` (`codDetalleEntrega`, `precioEntregas`, `cantidadEntregas`, `codEntrega`, `codExistencia`) VALUES
(1, 1500.00, 10, 1, 1),
(2, 3000.00, 5, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `codDetalleVenta` int(11) NOT NULL,
  `cantidadVenta` int(11) DEFAULT NULL,
  `precioVentas` decimal(10,2) DEFAULT NULL,
  `codExistencia` int(11) DEFAULT NULL,
  `codVenta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`codDetalleVenta`, `cantidadVenta`, `precioVentas`, `codExistencia`, `codVenta`) VALUES
(1, 2, 3000.00, 1, 1001),
(2, 1, 1500.00, 2, 1002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `codEntrega` int(11) NOT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `fechaEntrega` date DEFAULT NULL,
  `numFactura` int(11) DEFAULT NULL,
  `codProveedor` int(11) DEFAULT NULL,
  `cedulaTrabajador` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`codEntrega`, `observacion`, `fechaEntrega`, `numFactura`, `codProveedor`, `cedulaTrabajador`) VALUES
(1, 'Entrega puntual', '2024-01-01', 1001, 1, 'V-12345678-9'),
(2, 'Entrega incompleta', '2024-02-15', 1002, 2, 'V-98765432-1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `existencia`
--

CREATE TABLE `existencia` (
  `codExistencia` int(11) NOT NULL,
  `cantidadExistencia` int(11) DEFAULT NULL,
  `codArea` int(11) DEFAULT NULL,
  `codProducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `existencia`
--

INSERT INTO `existencia` (`codExistencia`, `cantidadExistencia`, `codArea`, `codProducto`) VALUES
(1, 100, 1, 1),
(2, 50, 2, 2),
(3, 200, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codProducto` int(11) NOT NULL,
  `descripcionProducto` varchar(255) DEFAULT NULL,
  `nombreProducto` varchar(100) DEFAULT NULL,
  `codCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codProducto`, `descripcionProducto`, `nombreProducto`, `codCategoria`) VALUES
(1, 'Descripción del producto A', 'Producto A', 1),
(2, 'Descripción del producto B', 'Producto B', 2),
(3, 'Descripción del producto C', 'Producto C', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `codProveedor` int(11) NOT NULL,
  `nombreProveedor` varchar(100) DEFAULT NULL,
  `telefonoProveedor` varchar(15) DEFAULT NULL,
  `direccionProveedor` varchar(255) DEFAULT NULL,
  `correoProveedor` varchar(100) DEFAULT NULL,
  `rifProveedor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`codProveedor`, `nombreProveedor`, `telefonoProveedor`, `direccionProveedor`, `correoProveedor`, `rifProveedor`) VALUES
(1, 'Proveedor A', '123456789', 'Calle Falsa 123', 'proveedora@example.com', 'J-12345678-9'),
(2, 'Proveedor B', '987654321', 'Avenida Siempre Viva 742', 'proveedorb@example.com', 'J-98765432-1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `cedulaTrabajador` varchar(20) NOT NULL,
  `nombreTrabajador` varchar(100) DEFAULT NULL,
  `apellidoTrabajador` varchar(100) DEFAULT NULL,
  `correoTrabajador` varchar(100) DEFAULT NULL,
  `telefonoTrabajador` varchar(15) DEFAULT NULL,
  `codCargo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`cedulaTrabajador`, `nombreTrabajador`, `apellidoTrabajador`, `correoTrabajador`, `telefonoTrabajador`, `codCargo`) VALUES
('V-12345678-9', 'Carlos', 'Pérez', 'carlos.perez@example.com', '04141234567', 1),
('V-98765432-1', 'Ana', 'Gómez', 'ana.gomez@example.com', '04149876543', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `numFactura` int(11) NOT NULL,
  `fechaVenta` datetime DEFAULT NULL,
  `tipoPago` varchar(50) DEFAULT NULL,
  `cedulaCliente` varchar(20) DEFAULT NULL,
  `codBanco` int(11) DEFAULT NULL,
  `cedulaTrabajador` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`numFactura`, `fechaVenta`, `tipoPago`, `cedulaCliente`, `codBanco`, `cedulaTrabajador`) VALUES
(1001, '2024-03-01 10:00:00', 'Tarjeta de Crédito', 'V-11223344-5', 1, 'V-12345678-9'),
(1002, '2024-03-15 14:30:00', 'Efectivo', 'V-55667788-9', 2, 'V-98765432-1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`codAlmacen`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`codArea`);

--
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`codBanco`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`codCargo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cedulaCliente`);

--
-- Indices de la tabla `detalleentrega`
--
ALTER TABLE `detalleentrega`
  ADD PRIMARY KEY (`codDetalleEntrega`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`codDetalleVenta`);

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`codEntrega`);

--
-- Indices de la tabla `existencia`
--
ALTER TABLE `existencia`
  ADD PRIMARY KEY (`codExistencia`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codProducto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`codProveedor`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`cedulaTrabajador`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`numFactura`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
