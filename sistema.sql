-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-09-2024 a las 22:31:03
-- Versión del servidor: 11.5.2-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `caja` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `caja`, `estado`) VALUES
(1, 'ADMINISTRADOR', 1),
(2, 'DESPACHADOR', 1),
(3, 'CAJERO', 1),
(4, 'SECRETARIA', 1),
(5, 'AYUDANTE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombres`, `estado`) VALUES
(1, 'DOCUMENTOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cierre_caja`
--

CREATE TABLE `cierre_caja` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `monto_inicial` decimal(10,2) DEFAULT NULL,
  `monto_final` decimal(10,2) DEFAULT 0.00,
  `fecha_apertura` date DEFAULT NULL,
  `fecha_cierre` date DEFAULT NULL,
  `total_ventas` int(11) DEFAULT NULL,
  `monto_total` decimal(10,2) DEFAULT 0.00,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `dni` char(8) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `telefono` char(9) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `dni`, `nombres`, `apellidos`, `telefono`, `direccion`, `estado`) VALUES
(1, '42776034', 'ROSENDO', 'LOPEZ MAMANI', '951468213', 'AV AREQUIPA 1254', 1),
(2, '70070699', 'rosa', 'AROCUTIPA MAMANI', '968512457', 'JR LIMA 562', 1),
(3, '86452514', 'RONALD', 'AROAPAZA VELASQUEZ', '965784123', 'URB SIMON BOLIVAR 1254', 1),
(4, '86457812', 'LUCRESIA', 'ROSAS ESPEJO', '965211236', 'URB SALCEDO TAPARACHI 1256', 1),
(5, '56894578', 'JUAN', 'FLORES', '951456789', 'Av Heroes del Cenepa 231', 1),
(6, '', 'HUMBERTO AMILCAR', 'QUISPE TICONA', '', '', 1),
(7, '0', 'NEXAR', 'CUTIPA CHAMBI', '', '', 1),
(8, '1', 'ROBERTO', 'RIVAS RIVAS', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `total`, `fecha`, `estado`) VALUES
(1, 80200.00, '2024-09-12 20:29:58', 1),
(2, 400000.00, '2024-09-13 16:38:07', 1),
(3, 120000.00, '2024-09-13 17:17:41', 1),
(4, 25000.00, '2024-09-13 19:22:56', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `ruc` varchar(20) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `mensaje` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `ruc`, `nombre`, `telefono`, `direccion`, `mensaje`) VALUES
(1, '20427776034', 'IEES MARIA AUXILIADORA', '(051)774874', 'JR LAMBAYEQUE 591', 'Empresa dedicada a la venta de Pollos a la Brasa.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`id`, `id_producto`, `id_usuario`, `precio`, `cantidad`, `sub_total`) VALUES
(6, 5, 1, 300.00, 1000, 300000.00),
(7, 7, 1, 30.00, 1000, 30000.00),
(8, 8, 1, 35.00, 1000, 35000.00),
(9, 9, 1, 100.00, 1000, 100000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`id`, `id_compra`, `id_producto`, `cantidad`, `precio`, `sub_total`) VALUES
(1, 1, 1, 1000, 0.20, 200.00),
(2, 1, 2, 1000, 80.00, 80000.00),
(3, 2, 3, 1000, 400.00, 400000.00),
(4, 3, 4, 1000, 120.00, 120000.00),
(5, 4, 6, 1000, 25.00, 25000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT 0.00,
  `sub_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT 0.00,
  `precio` decimal(10,2) DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `id_venta`, `id_producto`, `cantidad`, `descuento`, `precio`, `sub_total`) VALUES
(1, 1, 2, 5, 0.00, 80.00, 400.00),
(2, 2, 2, 10, 0.00, 80.00, 800.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `nombrecorto` varchar(3) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `nombres`, `nombrecorto`, `estado`) VALUES
(1, 'UNIDAD', 'Un', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permiso`) VALUES
(1, 'usuarios'),
(2, 'configuracion'),
(3, 'roles'),
(4, 'arqueo_caja'),
(5, 'clientes'),
(6, 'medidas'),
(7, 'categorias'),
(8, 'productos'),
(9, 'nueva_compra'),
(10, 'historial_compra'),
(11, 'nueva_venta'),
(12, 'historial_ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `precio_compra` decimal(5,2) DEFAULT NULL,
  `precio_venta` decimal(5,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_medida` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `descripcion`, `precio_compra`, `precio_venta`, `cantidad`, `id_medida`, `id_categoria`, `foto`, `estado`) VALUES
(1, '1', 'ACCESO A LA INFORMACIÓN', 0.20, 0.20, 1000, 1, 1, 'default.jpg', 1),
(2, '2', 'ALQUILER DE AULA', 80.00, 80.00, 985, 1, 1, 'default.jpg', 1),
(3, '3', 'ALQUILER DE AULA POR MES PROYECTOR MULTIMEDIA', 400.00, 400.00, 1000, 1, 1, 'default.jpg', 1),
(4, '4', 'ALQUILER DE AULA Y PROYECTOR MULYIMEDIA', 120.00, 120.00, 1000, 1, 1, 'default.jpg', 1),
(5, '5', 'ALQUILER DE AULA X MES', 300.00, 300.00, NULL, 1, 1, 'default.jpg', 1),
(6, '6', 'ALQUILER DE LOZA DEPORTIVA X HORA', 25.00, 25.00, 1000, 1, 1, 'default.jpg', 1),
(7, '7', 'ALQUILER GRAS SINTETICO  X HORA DE DIA', 30.00, 30.00, NULL, 1, 1, 'default.jpg', 1),
(8, '8', 'ALQUILER GRAS SINTETICO  X HORA DE  NOCHE', 35.00, 35.00, NULL, 1, 1, 'default.jpg', 1),
(9, '9', 'ALQUILER DE SALON DE USOS MULTIPLES SUM', 100.00, 100.00, NULL, 1, 1, 'default.jpg', 1),
(10, '10', 'ALQUILER DE POLIDEPORTIVO  X HORA DE DIA', 150.00, 150.00, NULL, 1, 1, 'default.jpg', 1),
(11, '11', 'ALQUILER DE POLIDEPORTIVO POR HORA DE NOCHE', 250.00, 250.00, NULL, 1, 1, 'default.jpg', 1),
(12, '12', 'ALQUILER LABORATORIO DE COMPUTO', 150.00, 150.00, NULL, 1, 1, 'default.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `id_caja` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 3,
  `logo` varchar(20) DEFAULT NULL,
  `imagen` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `apellidos`, `password`, `id_caja`, `estado`, `logo`, `imagen`) VALUES
(1, 'nexar', 'NEXAR', 'CUTIPA CHAMBI', '4b3cb72d96b3bb93313bd5638c7917bcb0e4365ab1f3c1aef4691b44d38b95fe', 1, 1, 'react', '1.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `estado` int(11) DEFAULT 1,
  `apertura` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_usuario`, `id_cliente`, `total`, `fecha`, `estado`, `apertura`) VALUES
(1, 1, 6, 400.00, '2024-09-12 20:35:13', 1, 1),
(2, 1, 7, 800.00, '2024-09-12 20:51:02', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cierre_caja`
--
ALTER TABLE `cierre_caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cierre_caja`
--
ALTER TABLE `cierre_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
