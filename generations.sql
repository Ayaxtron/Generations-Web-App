-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2018 a las 06:28:16
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `generations`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `amigo` varchar(50) NOT NULL,
  `pertenece_a_usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`amigo`, `pertenece_a_usuario`) VALUES
('prueba', 'Braulio'),
('Braulio', 'yuy'),
('prueba', 'yuy'),
('Braulio', 'prueba'),
('yuy', 'prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `limite` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`nombre`, `descripcion`, `limite`) VALUES
('t1', 'ghj', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `pertenece_usuario` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `al_grupo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`pertenece_usuario`, `admin`, `al_grupo`) VALUES
('prueba', 1, 't1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `nom_usu` varchar(50) NOT NULL,
  `nombre_publicacion` varchar(20) NOT NULL,
  `texto_publicacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`nom_usu`, `nombre_publicacion`, `texto_publicacion`) VALUES
('', 'a', 'aa'),
('prueba', 'nigget', 'holi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre_de_usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(200) NOT NULL,
  `permiso` int(11) NOT NULL,
  `nombre_real` varchar(20) NOT NULL,
  `apellido_real` varchar(50) NOT NULL,
  `fecha_nac` date NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre_de_usuario`, `contrasenia`, `permiso`, `nombre_real`, `apellido_real`, `fecha_nac`, `telefono`) VALUES
('Braulio', '$2y$10$.FLfVaQwGUnBB041/YkJzOTyHqHXcnIPg5H4LJ96ZVSfkz00wUlGq', 0, 'Jose Augusto', 'Jesus', '2014-02-04', 'sfdgv256 5949449466 '),
('prueba', '$2y$10$NW3OqNnwiw7Cc/Y0TJcDn.9ls1BuLPeBgYbRV42jL84UCwrmJvyne', 0, 'ok', 'si', '2018-11-15', '55220000000'),
('test', '$2y$10$THpoHVv6v2d9V0oWL/G./OX4WOVkImJD4vTYW5584woW470z2Zou2', 0, 'pep', 'pop', '2018-11-15', ''),
('yuy', '$2y$10$FBepS94igkoK7qc5LjknhOpgIvd6SxFEBQYLeJ34nLXydsPMfqxYK', 0, 'yuy', 'yuy', '2018-11-09', 'yuy');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`nombre_publicacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombre_de_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
