-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2022 a las 04:03:40
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dupontegenoma`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_dataloadvariants`
--

CREATE TABLE `tb_dataloadvariants` (
  `IdDataLoadVari` int(11) NOT NULL,
  `Muestra` varchar(64) DEFAULT NULL,
  `CrPosicion` varchar(64) DEFAULT NULL,
  `Gen` varchar(64) DEFAULT NULL,
  `VarianteTranscripto` varchar(128) DEFAULT NULL,
  `VarianteProteina` varchar(128) DEFAULT NULL,
  `Efect` varchar(128) DEFAULT NULL,
  `ACMG` varchar(128) DEFAULT NULL,
  `gnomADExome` varchar(64) DEFAULT NULL,
  `gnomADGenome` varchar(64) DEFAULT NULL,
  `FrequencyExAC` varchar(64) DEFAULT NULL,
  `Cigosidad` varchar(64) DEFAULT NULL,
  `Coverage` varchar(64) DEFAULT NULL,
  `FS` varchar(64) DEFAULT NULL,
  `GQ` varchar(64) DEFAULT NULL,
  `Qual` varchar(64) DEFAULT NULL,
  `RefSeq` varchar(64) DEFAULT NULL,
  `IDdbSNP` varchar(64) DEFAULT NULL,
  `Comments` varchar(128) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `IdLoad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_load`
--

CREATE TABLE `tb_load` (
  `IdLoad` int(11) NOT NULL,
  `NameDocument` varchar(64) DEFAULT NULL,
  `Description` varchar(128) DEFAULT NULL,
  `State` bit(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `IdTypeLoad` int(11) NOT NULL,
  `IdPerson` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_person`
--

CREATE TABLE `tb_person` (
  `IdPerson` int(11) NOT NULL,
  `Name` varchar(64) DEFAULT NULL,
  `Document` varchar(64) DEFAULT NULL,
  `Phone` varchar(16) DEFAULT NULL,
  `Email` varchar(24) DEFAULT NULL,
  `Passw` varchar(256) DEFAULT NULL,
  `PasswUpdate` bit(1) DEFAULT NULL,
  `State` bit(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL,
  `IdTypeDocument` int(11) NOT NULL,
  `IdProfile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_person`
--

INSERT INTO `tb_person` (`IdPerson`, `Name`, `Document`, `Phone`, `Email`, `Passw`, `PasswUpdate`, `State`, `DateCreate`, `IdTypeDocument`, `IdProfile`) VALUES
(1, 'admin', '12345', '12345', 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', b'0', b'1', '2022-03-17 23:59:20', 1, 1),
(2, 'Esneider Rocha', '1234567890', '1234567', 'neider.1991@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', b'1', b'1', '2022-03-23 20:33:14', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_profile`
--

CREATE TABLE `tb_profile` (
  `IdProfile` int(11) NOT NULL,
  `Description` varchar(16) DEFAULT NULL,
  `State` bit(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_profile`
--

INSERT INTO `tb_profile` (`IdProfile`, `Description`, `State`, `DateCreate`) VALUES
(1, 'Admin', b'1', '2022-03-17 04:12:35'),
(2, 'Laborarotio', b'1', '2022-03-17 04:13:51'),
(3, 'Cliente', b'1', '2022-03-17 04:14:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_typedocument`
--

CREATE TABLE `tb_typedocument` (
  `IdTypeDocument` int(11) NOT NULL,
  `Description` varchar(64) DEFAULT NULL,
  `State` bit(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_typedocument`
--

INSERT INTO `tb_typedocument` (`IdTypeDocument`, `Description`, `State`, `DateCreate`) VALUES
(1, 'Cédula', b'1', '2022-03-17 04:14:43'),
(2, 'Tarjeta de Identidad', b'1', '2022-03-17 04:14:56'),
(3, 'Cédula de Extranjería', b'1', '2022-03-17 04:16:09'),
(4, 'Pasaporte', b'1', '2022-03-17 04:16:30'),
(5, 'NIT', b'1', '2022-03-17 04:16:41'),
(6, 'DNI', b'1', '2022-03-17 04:17:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_typeload`
--

CREATE TABLE `tb_typeload` (
  `IdTypeLoad` int(11) NOT NULL,
  `Description` varchar(16) DEFAULT NULL,
  `State` bit(1) DEFAULT NULL,
  `DateCreate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_typeload`
--

INSERT INTO `tb_typeload` (`IdTypeLoad`, `Description`, `State`, `DateCreate`) VALUES
(1, 'Variantes', b'1', '2022-03-17 04:21:28'),
(2, 'Relacional', b'1', '2022-03-17 04:21:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_dataloadvariants`
--
ALTER TABLE `tb_dataloadvariants`
  ADD PRIMARY KEY (`IdDataLoadVari`),
  ADD KEY `IdLoad` (`IdLoad`);

--
-- Indices de la tabla `tb_load`
--
ALTER TABLE `tb_load`
  ADD PRIMARY KEY (`IdLoad`),
  ADD KEY `IdTypeLoad` (`IdTypeLoad`),
  ADD KEY `IdPerson` (`IdPerson`);

--
-- Indices de la tabla `tb_person`
--
ALTER TABLE `tb_person`
  ADD PRIMARY KEY (`IdPerson`),
  ADD KEY `IdTypeDocument` (`IdTypeDocument`),
  ADD KEY `IdProfile` (`IdProfile`);

--
-- Indices de la tabla `tb_profile`
--
ALTER TABLE `tb_profile`
  ADD PRIMARY KEY (`IdProfile`);

--
-- Indices de la tabla `tb_typedocument`
--
ALTER TABLE `tb_typedocument`
  ADD PRIMARY KEY (`IdTypeDocument`);

--
-- Indices de la tabla `tb_typeload`
--
ALTER TABLE `tb_typeload`
  ADD PRIMARY KEY (`IdTypeLoad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_dataloadvariants`
--
ALTER TABLE `tb_dataloadvariants`
  MODIFY `IdDataLoadVari` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_load`
--
ALTER TABLE `tb_load`
  MODIFY `IdLoad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_person`
--
ALTER TABLE `tb_person`
  MODIFY `IdPerson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_profile`
--
ALTER TABLE `tb_profile`
  MODIFY `IdProfile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_typedocument`
--
ALTER TABLE `tb_typedocument`
  MODIFY `IdTypeDocument` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tb_typeload`
--
ALTER TABLE `tb_typeload`
  MODIFY `IdTypeLoad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_dataloadvariants`
--
ALTER TABLE `tb_dataloadvariants`
  ADD CONSTRAINT `tb_dataloadvariants_ibfk_1` FOREIGN KEY (`IdLoad`) REFERENCES `tb_load` (`IdLoad`);

--
-- Filtros para la tabla `tb_load`
--
ALTER TABLE `tb_load`
  ADD CONSTRAINT `tb_load_ibfk_1` FOREIGN KEY (`IdTypeLoad`) REFERENCES `tb_typeload` (`IdTypeLoad`),
  ADD CONSTRAINT `tb_load_ibfk_2` FOREIGN KEY (`IdPerson`) REFERENCES `tb_person` (`IdPerson`);

--
-- Filtros para la tabla `tb_person`
--
ALTER TABLE `tb_person`
  ADD CONSTRAINT `tb_person_ibfk_1` FOREIGN KEY (`IdTypeDocument`) REFERENCES `tb_typedocument` (`IdTypeDocument`),
  ADD CONSTRAINT `tb_person_ibfk_2` FOREIGN KEY (`IdProfile`) REFERENCES `tb_profile` (`IdProfile`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
