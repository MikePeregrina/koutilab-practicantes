-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2023 a las 19:14:52
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aerobotp_beta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_cursos_personal`
--

CREATE TABLE `acceso_cursos_personal` (
  `id_acceso_curso` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acceso_cursos_personal`
--

INSERT INTO `acceso_cursos_personal` (`id_acceso_curso`, `id_curso`, `id_alumno`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_cursos_preparatoria`
--

CREATE TABLE `acceso_cursos_preparatoria` (
  `id_acceso_curso` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acceso_cursos_preparatoria`
--

INSERT INTO `acceso_cursos_preparatoria` (`id_acceso_curso`, `id_curso`, `id_alumno`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_cursos_primaria`
--

CREATE TABLE `acceso_cursos_primaria` (
  `id_acceso_curso` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acceso_cursos_primaria`
--

INSERT INTO `acceso_cursos_primaria` (`id_acceso_curso`, `id_curso`, `id_alumno`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_cursos_secundaria`
--

CREATE TABLE `acceso_cursos_secundaria` (
  `id_acceso_curso` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acceso_cursos_secundaria`
--

INSERT INTO `acceso_cursos_secundaria` (`id_acceso_curso`, `id_curso`, `id_alumno`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_cursos_universidad`
--

CREATE TABLE `acceso_cursos_universidad` (
  `id_acceso_curso` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acceso_cursos_universidad`
--

INSERT INTO `acceso_cursos_universidad` (`id_acceso_curso`, `id_curso`, `id_alumno`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_paquete_institucional`
--

CREATE TABLE `acceso_paquete_institucional` (
  `id_acceso_paquete` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `fondo` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `rol` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `usuario`, `contrasena`, `image`, `fondo`, `nombre`, `pais`, `estado`, `fecha_registro`, `rol`) VALUES
(1, '@admin', 'acbf157754bc921e70ab30b1e79c75f5', NULL, NULL, 'Admin', 'México', 1, '2023-07-05 03:18:06', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_personal`
--

CREATE TABLE `alumnos_personal` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `fondo` varchar(100) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos_personal`
--

INSERT INTO `alumnos_personal` (`id_alumno`, `nombre`, `usuario`, `contrasena`, `email`, `image`, `fondo`, `estado`, `conexiones`, `fecha_registro`) VALUES
(1, 'Alumno Personal', '@alumnopersonal', 'acbf157754bc921e70ab30b1e79c75f5', 'alumnopersonal@gmail.com', 'Mascota-Aerobot-01.png', 'portada-1.png', 1, 0, '2023-07-05 03:05:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_preparatoria`
--

CREATE TABLE `alumnos_preparatoria` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `grado_escolar` varchar(100) DEFAULT NULL,
  `fondo` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos_preparatoria`
--

INSERT INTO `alumnos_preparatoria` (`id_alumno`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `grado_escolar`, `fondo`, `id_escuela`, `id_docente`, `estado`, `conexiones`, `fecha_registro`) VALUES
(1, 'Alumno Preparatoria', '@alumnopreparatoria', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-WWRPR6OU', 'alumnopreparatoria@gmail.com', 'Mascota-Aerobot-01.png', NULL, 'portada-1.png', 3, 1, 1, 7, '2023-06-25 23:53:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_primaria`
--

CREATE TABLE `alumnos_primaria` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `grado_escolar` varchar(100) DEFAULT NULL,
  `fondo` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos_primaria`
--

INSERT INTO `alumnos_primaria` (`id_alumno`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `grado_escolar`, `fondo`, `id_escuela`, `id_docente`, `estado`, `conexiones`, `fecha_registro`) VALUES
(1, 'Alumno Primaria', '@alumnoprimaria', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-R1U2SD8L', 'alumnoprimaria@gmail.com', 'Mascota-Aerobot-01.png', '1°', 'portada-1.png', 1, 1, 1, 33, '2023-06-25 23:52:24'),
(2, 'asdf', 'asdf', 'asdf', 'asdf', 'asdfasdf', 'asdf', 'asdf', 'asdfdf', 1, 1, 1, 10, '2023-06-27 00:08:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_secundaria`
--

CREATE TABLE `alumnos_secundaria` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `grado_escolar` varchar(100) DEFAULT NULL,
  `fondo` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos_secundaria`
--

INSERT INTO `alumnos_secundaria` (`id_alumno`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `grado_escolar`, `fondo`, `id_escuela`, `id_docente`, `estado`, `conexiones`, `fecha_registro`) VALUES
(1, 'Alumno Secundaria', '@alumnosecundaria', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-DT9VQK1', 'alumnosecundaria@gmail.com', 'Mascota-Aerobot-01.png', NULL, 'portada-1.png', 2, 1, 1, 6, '2023-06-25 23:53:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_universidad`
--

CREATE TABLE `alumnos_universidad` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `grado_escolar` varchar(100) DEFAULT NULL,
  `fondo` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos_universidad`
--

INSERT INTO `alumnos_universidad` (`id_alumno`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `grado_escolar`, `fondo`, `id_escuela`, `id_docente`, `estado`, `conexiones`, `fecha_registro`) VALUES
(1, 'Alumno Universidad', '@alumnouniversidad', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-XBZ9KHW', 'alumnouniversidad@gmail.com', 'Mascota-Aerobot-01.png', NULL, 'portada-1.png', 4, 1, 1, 0, '2023-06-25 23:53:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_archivo` int(11) NOT NULL,
  `archivo_data` longblob NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_capsula` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_institucional`
--

CREATE TABLE `capsulas_institucional` (
  `id_capsula` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_institucional`
--

INSERT INTO `capsulas_institucional` (`id_capsula`, `nombre`) VALUES
(1, 'capsula1'),
(2, 'capsula2'),
(3, 'capsula3'),
(4, 'capsula4'),
(5, 'capsula5'),
(6, 'capsula6'),
(7, 'capsula7'),
(8, 'capsula8'),
(9, 'capsula9'),
(10, 'capsula10'),
(11, 'capsula11'),
(12, 'capsula12'),
(13, 'capsula13'),
(14, 'capsula14'),
(15, 'capsula15'),
(16, 'capsula16'),
(17, 'capsula17'),
(18, 'capsula18'),
(19, 'capsula19'),
(20, 'capsula20'),
(21, 'capsula21'),
(22, 'capsula22'),
(23, 'capsula23'),
(24, 'capsula24'),
(25, 'capsula25'),
(26, 'capsula26'),
(27, 'capsula27'),
(28, 'capsula28'),
(29, 'capsula29'),
(30, 'capsula30'),
(31, 'capsula31'),
(32, 'capsula32'),
(33, 'capsula33'),
(34, 'capsula34'),
(35, 'capsula35'),
(36, 'capsula36'),
(37, 'capsula37'),
(38, 'capsula38'),
(39, 'capsula39'),
(40, 'capsula40'),
(41, 'capsula41'),
(42, 'capsula42'),
(43, 'capsula43'),
(44, 'capsula44'),
(45, 'capsula45'),
(46, 'capsula46'),
(47, 'capsula47'),
(48, 'capsula48'),
(49, 'capsula49'),
(50, 'capsula50'),
(51, 'capsula51'),
(52, 'capsula52'),
(53, 'capsula53'),
(54, 'capsula54'),
(55, 'capsula55'),
(56, 'capsula56'),
(57, 'capsula57'),
(58, 'capsula58'),
(59, 'capsula59'),
(60, 'capsula60'),
(61, 'capsula61');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_pago_institucional`
--

CREATE TABLE `capsulas_pago_institucional` (
  `id_institucional_pago` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_pago_institucional`
--

INSERT INTO `capsulas_pago_institucional` (`id_institucional_pago`, `nombre`) VALUES
(1, 'capsulapago1'),
(2, 'capsulapago2'),
(3, 'capsulapago3'),
(4, 'capsulapago4'),
(5, 'capsulapago5'),
(1, 'capsulapago1'),
(2, 'capsulapago2'),
(3, 'capsulapago3'),
(4, 'capsulapago4'),
(5, 'capsulapago5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_pago_personal`
--

CREATE TABLE `capsulas_pago_personal` (
  `id_capsula_pago` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_pago_personal`
--

INSERT INTO `capsulas_pago_personal` (`id_capsula_pago`, `nombre`) VALUES
(1, 'capsulapago1'),
(2, 'capsulapago2'),
(3, 'capsulapago3'),
(4, 'capsulapago4'),
(5, 'capsulapago5'),
(6, 'capsulapago6'),
(7, 'capsulapago7'),
(8, 'capsulapago8'),
(9, 'capsulapago9'),
(10, 'capsulapago10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_pago_preparatoria`
--

CREATE TABLE `capsulas_pago_preparatoria` (
  `id_capsula_pago` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_pago_preparatoria`
--

INSERT INTO `capsulas_pago_preparatoria` (`id_capsula_pago`, `nombre`) VALUES
(1, 'capsulapago1'),
(2, 'capsulapago2'),
(3, 'capsulapago3'),
(4, 'capsulapago4'),
(5, 'capsulapago5'),
(6, 'capsulapago6'),
(7, 'capsulapago7'),
(8, 'capsulapago8'),
(9, 'capsulapago9'),
(10, 'capsulapago10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_pago_primaria`
--

CREATE TABLE `capsulas_pago_primaria` (
  `id_capsula_pago` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_pago_primaria`
--

INSERT INTO `capsulas_pago_primaria` (`id_capsula_pago`, `nombre`) VALUES
(1, 'capsulapago1'),
(2, 'capsulapago2'),
(3, 'capsulapago3'),
(4, 'capsulapago4'),
(5, 'capsulapago5'),
(6, 'capsulapago6'),
(7, 'capsulapago7'),
(8, 'capsulapago8'),
(9, 'capsulapago9'),
(10, 'capsulapago10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_pago_secundaria`
--

CREATE TABLE `capsulas_pago_secundaria` (
  `id_capsula_pago` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_pago_secundaria`
--

INSERT INTO `capsulas_pago_secundaria` (`id_capsula_pago`, `nombre`) VALUES
(1, 'capsulapago1'),
(2, 'capsulapago2'),
(3, 'capsulapago3'),
(4, 'capsulapago4'),
(5, 'capsulapago5'),
(6, 'capsulapago6'),
(7, 'capsulapago7'),
(8, 'capsulapago8'),
(9, 'capsulapago9'),
(10, 'capsulapago10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_pago_universidad`
--

CREATE TABLE `capsulas_pago_universidad` (
  `id_capsula_pago` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_pago_universidad`
--

INSERT INTO `capsulas_pago_universidad` (`id_capsula_pago`, `nombre`) VALUES
(1, 'capsulapago1'),
(2, 'capsulapago2'),
(3, 'capsulapago3'),
(4, 'capsulapago4'),
(5, 'capsulapago5'),
(6, 'capsulapago6'),
(7, 'capsulapago7'),
(8, 'capsulapago8'),
(9, 'capsulapago9'),
(10, 'capsulapago10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_personal`
--

CREATE TABLE `capsulas_personal` (
  `id_capsula` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_personal`
--

INSERT INTO `capsulas_personal` (`id_capsula`, `nombre`) VALUES
(1, 'capsula1'),
(2, 'capsula2'),
(3, 'capsula3'),
(4, 'capsula4'),
(5, 'capsula5'),
(6, 'capsula6'),
(7, 'capsula7'),
(8, 'capsula8'),
(9, 'capsula9'),
(10, 'capsula10'),
(11, 'capsula11'),
(12, 'capsula12'),
(13, 'capsula13'),
(14, 'capsula14'),
(15, 'capsula15'),
(16, 'capsula16'),
(17, 'capsula17'),
(18, 'capsula18'),
(19, 'capsula19'),
(20, 'capsula20'),
(21, 'capsula21'),
(22, 'capsula22'),
(23, 'capsula23'),
(24, 'capsula24'),
(25, 'capsula25'),
(26, 'capsula26'),
(27, 'capsula27'),
(28, 'capsula28'),
(29, 'capsula29'),
(30, 'capsula30'),
(31, 'capsula31'),
(32, 'capsula32'),
(33, 'capsula33'),
(34, 'capsula34'),
(35, 'capsula35'),
(36, 'capsula36'),
(37, 'capsula37'),
(38, 'capsula38'),
(39, 'capsula39'),
(40, 'capsula40'),
(41, 'capsula41'),
(42, 'capsula42'),
(43, 'capsula43'),
(44, 'capsula44'),
(45, 'capsula45'),
(46, 'capsula46'),
(47, 'capsula47'),
(48, 'capsula48'),
(49, 'capsula49'),
(50, 'capsula50'),
(51, 'capsula51'),
(52, 'capsula52'),
(53, 'capsula53'),
(54, 'capsula54'),
(55, 'capsula55'),
(56, 'capsula56'),
(57, 'capsula57'),
(58, 'capsula58'),
(59, 'capsula59'),
(60, 'capsula60'),
(61, 'capsula61');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_preparatoria`
--

CREATE TABLE `capsulas_preparatoria` (
  `id_capsula` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_preparatoria`
--

INSERT INTO `capsulas_preparatoria` (`id_capsula`, `nombre`) VALUES
(1, 'capsula1'),
(2, 'capsula2'),
(3, 'capsula3'),
(4, 'capsula4'),
(5, 'capsula5'),
(6, 'capsula6'),
(7, 'capsula7'),
(8, 'capsula8'),
(9, 'capsula9'),
(10, 'capsula10'),
(11, 'capsula11'),
(12, 'capsula12'),
(13, 'capsula13'),
(14, 'capsula14'),
(15, 'capsula15'),
(16, 'capsula16'),
(17, 'capsula17'),
(18, 'capsula18'),
(19, 'capsula19'),
(20, 'capsula20'),
(21, 'capsula21'),
(22, 'capsula22'),
(23, 'capsula23'),
(24, 'capsula24'),
(25, 'capsula25'),
(26, 'capsula26'),
(27, 'capsula27'),
(28, 'capsula28'),
(29, 'capsula29'),
(30, 'capsula30'),
(31, 'capsula31'),
(32, 'capsula32'),
(33, 'capsula33'),
(34, 'capsula34'),
(35, 'capsula35'),
(36, 'capsula36'),
(37, 'capsula37'),
(38, 'capsula38'),
(39, 'capsula39'),
(40, 'capsula40'),
(41, 'capsula41'),
(42, 'capsula42'),
(43, 'capsula43'),
(44, 'capsula44'),
(45, 'capsula45'),
(46, 'capsula46'),
(47, 'capsula47'),
(48, 'capsula48'),
(49, 'capsula49'),
(50, 'capsula50'),
(51, 'capsula51'),
(52, 'capsula52'),
(53, 'capsula53'),
(54, 'capsula54'),
(55, 'capsula55'),
(56, 'capsula56'),
(57, 'capsula57'),
(58, 'capsula58'),
(59, 'capsula59'),
(60, 'capsula60'),
(61, 'capsula61');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_primaria`
--

CREATE TABLE `capsulas_primaria` (
  `id_capsula` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_primaria`
--

INSERT INTO `capsulas_primaria` (`id_capsula`, `nombre`) VALUES
(1, 'capsula1'),
(2, 'capsula2'),
(3, 'capsula3'),
(4, 'capsula4'),
(5, 'capsula5'),
(6, 'capsula6'),
(7, 'capsula7'),
(8, 'capsula8'),
(9, 'capsula9'),
(10, 'capsula10'),
(11, 'capsula11'),
(12, 'capsula12'),
(13, 'capsula13'),
(14, 'capsula14'),
(15, 'capsula15'),
(16, 'capsula16'),
(17, 'capsula17'),
(18, 'capsula18'),
(19, 'capsula19'),
(20, 'capsula20'),
(21, 'capsula21'),
(22, 'capsula22'),
(23, 'capsula23'),
(24, 'capsula24'),
(25, 'capsula25'),
(26, 'capsula26'),
(27, 'capsula27'),
(28, 'capsula28'),
(29, 'capsula29'),
(30, 'capsula30'),
(31, 'capsula31'),
(32, 'capsula32'),
(33, 'capsula33'),
(34, 'capsula34'),
(35, 'capsula35'),
(36, 'capsula36'),
(37, 'capsula37'),
(38, 'capsula38'),
(39, 'capsula39'),
(40, 'capsula40'),
(41, 'capsula41'),
(42, 'capsula42'),
(43, 'capsula43'),
(44, 'capsula44'),
(45, 'capsula45'),
(46, 'capsula46'),
(47, 'capsula47'),
(48, 'capsula48'),
(49, 'capsula49'),
(50, 'capsula50'),
(51, 'capsula51'),
(52, 'capsula52'),
(53, 'capsula53'),
(54, 'capsula54'),
(55, 'capsula55'),
(56, 'capsula56'),
(57, 'capsula57'),
(58, 'capsula58'),
(59, 'capsula59'),
(60, 'capsula60'),
(61, 'capsula61');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_secundaria`
--

CREATE TABLE `capsulas_secundaria` (
  `id_capsula` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_secundaria`
--

INSERT INTO `capsulas_secundaria` (`id_capsula`, `nombre`) VALUES
(1, 'capsula1'),
(2, 'capsula2'),
(3, 'capsula3'),
(4, 'capsula4'),
(5, 'capsula5'),
(6, 'capsula6'),
(7, 'capsula7'),
(8, 'capsula8'),
(9, 'capsula9'),
(10, 'capsula10'),
(11, 'capsula11'),
(12, 'capsula12'),
(13, 'capsula13'),
(14, 'capsula14'),
(15, 'capsula15'),
(16, 'capsula16'),
(17, 'capsula17'),
(18, 'capsula18'),
(19, 'capsula19'),
(20, 'capsula20'),
(21, 'capsula21'),
(22, 'capsula22'),
(23, 'capsula23'),
(24, 'capsula24'),
(25, 'capsula25'),
(26, 'capsula26'),
(27, 'capsula27'),
(28, 'capsula28'),
(29, 'capsula29'),
(30, 'capsula30'),
(31, 'capsula31'),
(32, 'capsula32'),
(33, 'capsula33'),
(34, 'capsula34'),
(35, 'capsula35'),
(36, 'capsula36'),
(37, 'capsula37'),
(38, 'capsula38'),
(39, 'capsula39'),
(40, 'capsula40'),
(41, 'capsula41'),
(42, 'capsula42'),
(43, 'capsula43'),
(44, 'capsula44'),
(45, 'capsula45'),
(46, 'capsula46'),
(47, 'capsula47'),
(48, 'capsula48'),
(49, 'capsula49'),
(50, 'capsula50'),
(51, 'capsula51'),
(52, 'capsula52'),
(53, 'capsula53'),
(54, 'capsula54'),
(55, 'capsula55'),
(56, 'capsula56'),
(57, 'capsula57'),
(58, 'capsula58'),
(59, 'capsula59'),
(60, 'capsula60'),
(61, 'capsula61');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas_universidad`
--

CREATE TABLE `capsulas_universidad` (
  `id_capsula` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_universidad`
--

INSERT INTO `capsulas_universidad` (`id_capsula`, `nombre`) VALUES
(1, 'capsula1'),
(2, 'capsula2'),
(3, 'capsula3'),
(4, 'capsula4'),
(5, 'capsula5'),
(6, 'capsula6'),
(7, 'capsula7'),
(8, 'capsula8'),
(9, 'capsula9'),
(10, 'capsula10'),
(11, 'capsula11'),
(12, 'capsula12'),
(13, 'capsula13'),
(14, 'capsula14'),
(15, 'capsula15'),
(16, 'capsula16'),
(17, 'capsula17'),
(18, 'capsula18'),
(19, 'capsula19'),
(20, 'capsula20'),
(21, 'capsula21'),
(22, 'capsula22'),
(23, 'capsula23'),
(24, 'capsula24'),
(25, 'capsula25'),
(26, 'capsula26'),
(27, 'capsula27'),
(28, 'capsula28'),
(29, 'capsula29'),
(30, 'capsula30'),
(31, 'capsula31'),
(32, 'capsula32'),
(33, 'capsula33'),
(34, 'capsula34'),
(35, 'capsula35'),
(36, 'capsula36'),
(37, 'capsula37'),
(38, 'capsula38'),
(39, 'capsula39'),
(40, 'capsula40'),
(41, 'capsula41'),
(42, 'capsula42'),
(43, 'capsula43'),
(44, 'capsula44'),
(45, 'capsula45'),
(46, 'capsula46'),
(47, 'capsula47'),
(48, 'capsula48'),
(49, 'capsula49'),
(50, 'capsula50'),
(51, 'capsula51'),
(52, 'capsula52'),
(53, 'capsula53'),
(54, 'capsula54'),
(55, 'capsula55'),
(56, 'capsula56'),
(57, 'capsula57'),
(58, 'capsula58'),
(59, 'capsula59'),
(60, 'capsula60'),
(61, 'capsula61');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_institucional`
--

CREATE TABLE `cursos_institucional` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos_institucional`
--

INSERT INTO `cursos_institucional` (`id_curso`, `curso`) VALUES
(1, 'Programacion web basica'),
(2, 'Programacion web intermedio'),
(3, 'Programación web avanzado'),
(4, 'Python básico'),
(5, 'Python intermedio'),
(6, 'Python avanzado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_personal`
--

CREATE TABLE `cursos_personal` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos_personal`
--

INSERT INTO `cursos_personal` (`id_curso`, `curso`) VALUES
(1, 'Programacion web basica'),
(2, 'Programacion web intermedio'),
(3, 'Programación web avanzado'),
(4, 'Python basico'),
(5, 'Python intermedio'),
(6, 'Python avanzado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_preparatoria`
--

CREATE TABLE `cursos_preparatoria` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos_preparatoria`
--

INSERT INTO `cursos_preparatoria` (`id_curso`, `curso`) VALUES
(1, 'Programacion web basica'),
(2, 'Programacion web intermedio'),
(3, 'Programación web avanzado'),
(4, 'Python basico'),
(5, 'Python intermedio'),
(6, 'Python avanzado'),
(7, 'Informatica basico'),
(8, 'Informatica intermedio'),
(9, 'Informatica avanzado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_primaria`
--

CREATE TABLE `cursos_primaria` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos_primaria`
--

INSERT INTO `cursos_primaria` (`id_curso`, `curso`) VALUES
(1, 'Programacion web basica'),
(2, 'Programacion web intermedio'),
(3, 'Programación web avanzado'),
(4, 'Python basico'),
(5, 'Python intermedio'),
(6, 'Python avanzado'),
(7, 'Informatica basico'),
(8, 'Informatica intermedio'),
(9, 'Informatica avanzado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_secundaria`
--

CREATE TABLE `cursos_secundaria` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos_secundaria`
--

INSERT INTO `cursos_secundaria` (`id_curso`, `curso`) VALUES
(1, 'Programacion web basica'),
(2, 'Programacion web intermedio'),
(3, 'Programación web avanzado'),
(4, 'Python basico'),
(5, 'Python intermedio'),
(6, 'Python avanzado'),
(7, 'Informatica basico'),
(8, 'Informatica intermedio'),
(9, 'Informatica avanzado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_universidad`
--

CREATE TABLE `cursos_universidad` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos_universidad`
--

INSERT INTO `cursos_universidad` (`id_curso`, `curso`) VALUES
(1, 'Programacion web basica'),
(2, 'Programacion web intermedio'),
(3, 'Programación web avanzado'),
(4, 'Python basico'),
(5, 'Python intermedio'),
(6, 'Python avanzado'),
(7, 'Informatica basico'),
(8, 'Informatica intermedio'),
(9, 'Informatica avanzado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_pago_institucional`
--

CREATE TABLE `detalle_capsulas_pago_institucional` (
  `id_detalle_capsula_pago` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_pago_personal`
--

CREATE TABLE `detalle_capsulas_pago_personal` (
  `id_detalle_capsula_pago` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_pago_preparatoria`
--

CREATE TABLE `detalle_capsulas_pago_preparatoria` (
  `id_detalle_capsula_pago` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_pago_primaria`
--

CREATE TABLE `detalle_capsulas_pago_primaria` (
  `id_detalle_capsula_pago` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_pago_secundaria`
--

CREATE TABLE `detalle_capsulas_pago_secundaria` (
  `id_detalle_capsula_pago` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_pago_universidad`
--

CREATE TABLE `detalle_capsulas_pago_universidad` (
  `id_detalle_capsula_pago` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_personal`
--

CREATE TABLE `detalle_capsulas_personal` (
  `id_detalle_capsula` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_preparatoria`
--

CREATE TABLE `detalle_capsulas_preparatoria` (
  `id_detalle_capsula` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_primaria`
--

CREATE TABLE `detalle_capsulas_primaria` (
  `id_detalle_capsula` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_capsulas_primaria`
--

INSERT INTO `detalle_capsulas_primaria` (`id_detalle_capsula`, `id_capsula`, `id_curso`, `id_alumno`) VALUES
(1, 26, 1, 1),
(2, 26, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_secundaria`
--

CREATE TABLE `detalle_capsulas_secundaria` (
  `id_detalle_capsula` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_universidad`
--

CREATE TABLE `detalle_capsulas_universidad` (
  `id_detalle_capsula` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_estadisticas_institucional`
--

CREATE TABLE `detalle_estadisticas_institucional` (
  `id_detalle_estadistica` int(11) NOT NULL,
  `progreso` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `teorico` int(11) DEFAULT NULL,
  `practico` int(11) DEFAULT NULL,
  `trofeos` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_estadisticas_personal`
--

CREATE TABLE `detalle_estadisticas_personal` (
  `id_detalle_estadistica` int(11) NOT NULL,
  `progreso` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `teorico` int(11) DEFAULT NULL,
  `practico` int(11) DEFAULT NULL,
  `trofeos` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_estadisticas_preparatoria`
--

CREATE TABLE `detalle_estadisticas_preparatoria` (
  `id_detalle_estadistica` int(11) NOT NULL,
  `progreso` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `teorico` int(11) DEFAULT NULL,
  `practico` int(11) DEFAULT NULL,
  `trofeos` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_estadisticas_primaria`
--

CREATE TABLE `detalle_estadisticas_primaria` (
  `id_detalle_estadistica` int(11) NOT NULL,
  `progreso` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `teorico` int(11) DEFAULT NULL,
  `practico` int(11) DEFAULT NULL,
  `trofeos` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_estadisticas_secundaria`
--

CREATE TABLE `detalle_estadisticas_secundaria` (
  `id_detalle_estadistica` int(11) NOT NULL,
  `progreso` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `teorico` int(11) DEFAULT NULL,
  `practico` int(11) DEFAULT NULL,
  `trofeos` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_estadisticas_universidad`
--

CREATE TABLE `detalle_estadisticas_universidad` (
  `id_detalle_estadistica` int(11) NOT NULL,
  `progreso` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `teorico` int(11) DEFAULT NULL,
  `practico` int(11) DEFAULT NULL,
  `trofeos` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupos_institucional`
--

CREATE TABLE `detalle_grupos_institucional` (
  `id_detalle_grupo` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupos_institucional`
--

INSERT INTO `detalle_grupos_institucional` (`id_detalle_grupo`, `id`, `id_grupo`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupos_personal`
--

CREATE TABLE `detalle_grupos_personal` (
  `id_detalle_grupo` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupos_preparatoria`
--

CREATE TABLE `detalle_grupos_preparatoria` (
  `id_detalle_grupo` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupos_preparatoria`
--

INSERT INTO `detalle_grupos_preparatoria` (`id_detalle_grupo`, `id_alumno`, `id_grupo`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupos_primaria`
--

CREATE TABLE `detalle_grupos_primaria` (
  `id_detalle_grupo` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupos_primaria`
--

INSERT INTO `detalle_grupos_primaria` (`id_detalle_grupo`, `id_alumno`, `id_grupo`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupos_secundaria`
--

CREATE TABLE `detalle_grupos_secundaria` (
  `id_detalle_grupo` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupos_secundaria`
--

INSERT INTO `detalle_grupos_secundaria` (`id_detalle_grupo`, `id_alumno`, `id_grupo`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupos_universidad`
--

CREATE TABLE `detalle_grupos_universidad` (
  `id_detalle_grupo` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupos_universidad`
--

INSERT INTO `detalle_grupos_universidad` (`id_detalle_grupo`, `id_alumno`, `id_grupo`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupo_cursos_institucional`
--

CREATE TABLE `detalle_grupo_cursos_institucional` (
  `id_detalle_grupo_curso` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupo_cursos_institucional`
--

INSERT INTO `detalle_grupo_cursos_institucional` (`id_detalle_grupo_curso`, `id_grupo`, `id_curso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupo_cursos_personal`
--

CREATE TABLE `detalle_grupo_cursos_personal` (
  `id_detalle_grupo_curso` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupo_cursos_preparatoria`
--

CREATE TABLE `detalle_grupo_cursos_preparatoria` (
  `id_detalle_grupo_curso` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupo_cursos_preparatoria`
--

INSERT INTO `detalle_grupo_cursos_preparatoria` (`id_detalle_grupo_curso`, `id_grupo`, `id_curso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupo_cursos_primaria`
--

CREATE TABLE `detalle_grupo_cursos_primaria` (
  `id_detalle_grupo_curso` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupo_cursos_primaria`
--

INSERT INTO `detalle_grupo_cursos_primaria` (`id_detalle_grupo_curso`, `id_grupo`, `id_curso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupo_cursos_secundaria`
--

CREATE TABLE `detalle_grupo_cursos_secundaria` (
  `id_detalle_grupo_curso` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupo_cursos_secundaria`
--

INSERT INTO `detalle_grupo_cursos_secundaria` (`id_detalle_grupo_curso`, `id_grupo`, `id_curso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupo_cursos_universidad`
--

CREATE TABLE `detalle_grupo_cursos_universidad` (
  `id_detalle_grupo_curso` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupo_cursos_universidad`
--

INSERT INTO `detalle_grupo_cursos_universidad` (`id_detalle_grupo_curso`, `id_grupo`, `id_curso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_intentos_institucional`
--

CREATE TABLE `detalle_intentos_institucional` (
  `id_detalle_intento` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `intentos` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_intentos_personal`
--

CREATE TABLE `detalle_intentos_personal` (
  `id_detalle_intento` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `intentos` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_intentos_preparatoria`
--

CREATE TABLE `detalle_intentos_preparatoria` (
  `id_detalle_intento` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `intentos` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_intentos_primaria`
--

CREATE TABLE `detalle_intentos_primaria` (
  `id_detalle_intento` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `intentos` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_intentos_primaria`
--

INSERT INTO `detalle_intentos_primaria` (`id_detalle_intento`, `id_capsula`, `id_alumno`, `intentos`, `id_curso`) VALUES
(1, 21, 1, 2, 6),
(2, 28, 1, 2, 6),
(3, 3, 1, 3, 1),
(4, 6, 1, 2, 1),
(5, 3, 1, 2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_intentos_secundaria`
--

CREATE TABLE `detalle_intentos_secundaria` (
  `id_detalle_intento` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `intentos` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_intentos_universidad`
--

CREATE TABLE `detalle_intentos_universidad` (
  `id_detalle_intento` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `intentos` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores_personal`
--

CREATE TABLE `directores_personal` (
  `id_director` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores_preparatoria`
--

CREATE TABLE `directores_preparatoria` (
  `id_director` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `directores_preparatoria`
--

INSERT INTO `directores_preparatoria` (`id_director`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `id_escuela`, `estado`, `conexiones`) VALUES
(1, 'Director Preparatoria', '@directorpreparatoria', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-TCRXOMIJ', 'directorpreparatoria@gmail.com', NULL, 3, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores_primaria`
--

CREATE TABLE `directores_primaria` (
  `id_director` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `directores_primaria`
--

INSERT INTO `directores_primaria` (`id_director`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `id_escuela`, `estado`) VALUES
(1, 'Director Primaria', '@directorprimaria', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-HQGD5NF2', 'directorprimaria@gmail.com', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores_secundaria`
--

CREATE TABLE `directores_secundaria` (
  `id_director` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `directores_secundaria`
--

INSERT INTO `directores_secundaria` (`id_director`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `id_escuela`, `estado`) VALUES
(1, 'Director Secundaria', '@directorsecundaria', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-DVB7OL5J', 'directorsecundaria@gmail.com', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores_universidad`
--

CREATE TABLE `directores_universidad` (
  `id_director` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `directores_universidad`
--

INSERT INTO `directores_universidad` (`id_director`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `id_escuela`, `estado`) VALUES
(1, 'Director Universidad', '@directoruniversidad', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-CCC5KGI', 'directoruniversidad@gmail.com', NULL, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director_institucional`
--

CREATE TABLE `director_institucional` (
  `id_director` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `conexiones` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `director_institucional`
--

INSERT INTO `director_institucional` (`id_director`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `id_escuela`, `estado`, `conexiones`) VALUES
(1, 'brandon', '@directorinstitucional', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-HQGD5NF2', 'b.rodriguezt@upam.edu.mx', 'brandon - 2023.06.24 - 05.18.06am.jpg', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_personal`
--

CREATE TABLE `docentes_personal` (
  `id_docente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_preparatoria`
--

CREATE TABLE `docentes_preparatoria` (
  `id_docente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes_preparatoria`
--

INSERT INTO `docentes_preparatoria` (`id_docente`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `id_escuela`, `estado`, `conexiones`, `fecha_registro`) VALUES
(1, 'Docente Preparatoria', '@docentepreparatoria', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-IP311LQJ', 'docentepreparatoria@gmail.com', NULL, 3, 1, 0, '2023-06-25 23:54:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_primaria`
--

CREATE TABLE `docentes_primaria` (
  `id_docente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes_primaria`
--

INSERT INTO `docentes_primaria` (`id_docente`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `id_escuela`, `estado`, `conexiones`, `fecha_registro`) VALUES
(1, 'Docente Primaria', '@docenteprimaria', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-EIU2XXKS', 'docenteprimaria@gmail.com', NULL, 1, 1, 7, '2023-06-25 23:53:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_secundaria`
--

CREATE TABLE `docentes_secundaria` (
  `id_docente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes_secundaria`
--

INSERT INTO `docentes_secundaria` (`id_docente`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `id_escuela`, `estado`, `conexiones`, `fecha_registro`) VALUES
(1, 'Docente Secundaria', '@docentesecundaria', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-T4UR2CK1', 'docentesecundaria@gmail.com', NULL, 2, 1, 2, '2023-06-25 23:54:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_universidad`
--

CREATE TABLE `docentes_universidad` (
  `id_docente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `conexiones` int(11) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes_universidad`
--

INSERT INTO `docentes_universidad` (`id_docente`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `id_escuela`, `estado`, `conexiones`, `fecha_registro`) VALUES
(1, 'Docente Universidad', '@docenteuniversidad', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-8TGBBD1Z', 'docenteuniversidad@gmail.com', NULL, 4, 1, 0, '2023-06-25 23:54:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuelas`
--

CREATE TABLE `escuelas` (
  `id_escuela` int(11) NOT NULL,
  `nombre_escuela` varchar(100) DEFAULT NULL,
  `cct` varchar(100) DEFAULT NULL,
  `nombre_director` varchar(100) DEFAULT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `num_exterior` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `codigo_postal` varchar(100) DEFAULT NULL,
  `nivel_educativo` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `autorizacion` varchar(100) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `clave_alumno` varchar(100) DEFAULT NULL,
  `clave_docente` varchar(100) DEFAULT NULL,
  `clave_director` varchar(100) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escuelas`
--

INSERT INTO `escuelas` (`id_escuela`, `nombre_escuela`, `cct`, `nombre_director`, `calle`, `num_exterior`, `estado`, `codigo_postal`, `nivel_educativo`, `pais`, `autorizacion`, `id_admin`, `clave_alumno`, `clave_docente`, `clave_director`, `estatus`, `created_at`) VALUES
(1, 'Primaria Desarrollo', 'ABC123', 'Director Primaria', 'Desarrollo', '99', 'Puebla', '99999', 'Primaria', 'México', 'Admin', 1, 'ABC-R1U2SD8L', 'ABC-EIU2XXKS', 'ABC-HQGD5NF2', 1, '2023-07-05 03:04:52'),
(2, 'Secundaria Desarrollo', 'ABC123', 'Director Secundaria', 'Desarrollo', '99', 'Puebla', '99999', 'Secundaria', 'México', 'Admin', 1, 'ABC-DT9VQK1', 'ABC-T4UR2CK1', 'ABC-DVB7OL5J', 1, '2023-07-05 03:04:52'),
(3, 'Preparatoria Desarrollo', 'ABC123', 'Director Preparatoria', 'Desarrollo', '99', 'Puebla', '99999', 'Preparatoria', 'México', 'Admin', 1, 'ABC-WWRPR6OU', 'ABC-IP311LQJ', 'ABC-TCRXOMIJ', 1, '2023-07-05 03:04:52'),
(4, 'Universidad Desarrollo', 'ABC123', 'Director Universidad', 'Desarrollo', '99', 'Puebla', '99999', 'Universidad', 'México', 'Admin', 1, 'ABC-XBZ9KHW', 'ABC-8TGBBD1Z', 'ABC-CCC5KGI', 1, '2023-07-05 03:04:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_institucional`
--

CREATE TABLE `estadisticas_institucional` (
  `id_estadistica` int(11) NOT NULL,
  `progreso` int(5) DEFAULT NULL,
  `puntos` int(5) DEFAULT NULL,
  `teorico` int(5) DEFAULT NULL,
  `practico` int(5) DEFAULT NULL,
  `trofeos` int(5) DEFAULT NULL,
  `id` int(5) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas_institucional`
--

INSERT INTO `estadisticas_institucional` (`id_estadistica`, `progreso`, `puntos`, `teorico`, `practico`, `trofeos`, `id`, `id_curso`) VALUES
(1, 99, 20, 20, 10, 10, 1, 1),
(2, 99, 99, 99, 99, 99, 1, 1),
(3, 99, 99, 99, 99, 99, 1, 2),
(3, 99, 99, 99, 99, 99, 1, 3),
(3, 99, 99, 99, 99, 99, 1, 4),
(3, 99, 99, 99, 99, 99, 1, 5),
(3, 99, 99, 99, 99, 99, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_personal`
--

CREATE TABLE `estadisticas_personal` (
  `id_estadistica` int(11) NOT NULL,
  `progreso` int(5) DEFAULT NULL,
  `puntos` int(5) DEFAULT NULL,
  `teorico` int(5) DEFAULT NULL,
  `practico` int(5) DEFAULT NULL,
  `trofeos` int(5) DEFAULT NULL,
  `id_alumno` int(5) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_preparatoria`
--

CREATE TABLE `estadisticas_preparatoria` (
  `id_estadistica` int(11) NOT NULL,
  `progreso` int(5) DEFAULT NULL,
  `puntos` int(5) DEFAULT NULL,
  `teorico` int(5) DEFAULT NULL,
  `practico` int(5) DEFAULT NULL,
  `trofeos` int(5) DEFAULT NULL,
  `id_alumno` int(5) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_primaria`
--

CREATE TABLE `estadisticas_primaria` (
  `id_estadistica` int(11) NOT NULL,
  `progreso` int(5) DEFAULT NULL,
  `puntos` int(5) DEFAULT NULL,
  `teorico` int(5) DEFAULT NULL,
  `practico` int(5) DEFAULT NULL,
  `trofeos` int(5) DEFAULT NULL,
  `id_alumno` int(5) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas_primaria`
--

INSERT INTO `estadisticas_primaria` (`id_estadistica`, `progreso`, `puntos`, `teorico`, `practico`, `trofeos`, `id_alumno`, `id_curso`) VALUES
(1, 0, 0, 0, 0, 0, 1, 1),
(2, 0, 0, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_secundaria`
--

CREATE TABLE `estadisticas_secundaria` (
  `id_estadistica` int(11) NOT NULL,
  `progreso` int(5) DEFAULT NULL,
  `puntos` int(5) DEFAULT NULL,
  `teorico` int(5) DEFAULT NULL,
  `practico` int(5) DEFAULT NULL,
  `trofeos` int(5) DEFAULT NULL,
  `id_alumno` int(5) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_universidad`
--

CREATE TABLE `estadisticas_universidad` (
  `id_estadistica` int(11) NOT NULL,
  `progreso` int(5) DEFAULT NULL,
  `puntos` int(5) DEFAULT NULL,
  `teorico` int(5) DEFAULT NULL,
  `practico` int(5) DEFAULT NULL,
  `trofeos` int(5) DEFAULT NULL,
  `id_alumno` int(5) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `id_formulario` int(11) NOT NULL,
  `nombre_r` varchar(200) DEFAULT NULL,
  `cargo` varchar(200) DEFAULT NULL,
  `contacto` varchar(10) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `nombre_e` varchar(200) DEFAULT NULL,
  `clave` varchar(200) DEFAULT NULL,
  `pais` varchar(200) DEFAULT NULL,
  `estado` varchar(150) DEFAULT NULL,
  `grado` varchar(150) DEFAULT NULL,
  `numero_a` int(40) DEFAULT NULL,
  `otro_c` varchar(300) DEFAULT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `num_exterior` varchar(100) DEFAULT NULL,
  `colonia` varchar(100) DEFAULT NULL,
  `codigo_postal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_personal`
--

CREATE TABLE `grupos_personal` (
  `id_grupo` int(11) NOT NULL,
  `materia` varchar(100) DEFAULT NULL,
  `nombre_grupo` varchar(100) DEFAULT NULL,
  `grado` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_preparatoria`
--

CREATE TABLE `grupos_preparatoria` (
  `id_grupo` int(11) NOT NULL,
  `materia` varchar(100) DEFAULT NULL,
  `nombre_grupo` varchar(100) DEFAULT NULL,
  `grado` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos_preparatoria`
--

INSERT INTO `grupos_preparatoria` (`id_grupo`, `materia`, `nombre_grupo`, `grado`, `clave`, `id_docente`, `estado`) VALUES
(1, 'Desarrollo Preparatoria', 'Desarrollo Preparatoria', '1°', 'DES-2G0OR1C', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_primaria`
--

CREATE TABLE `grupos_primaria` (
  `id_grupo` int(11) NOT NULL,
  `materia` varchar(100) DEFAULT NULL,
  `nombre_grupo` varchar(100) DEFAULT NULL,
  `grado` varchar(100) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos_primaria`
--

INSERT INTO `grupos_primaria` (`id_grupo`, `materia`, `nombre_grupo`, `grado`, `id_docente`, `estado`) VALUES
(1, 'Desarrollo Primaria', 'Desarrollo Primaria', '1°', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_secundaria`
--

CREATE TABLE `grupos_secundaria` (
  `id_grupo` int(11) NOT NULL,
  `materia` varchar(100) DEFAULT NULL,
  `nombre_grupo` varchar(100) DEFAULT NULL,
  `grado` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos_secundaria`
--

INSERT INTO `grupos_secundaria` (`id_grupo`, `materia`, `nombre_grupo`, `grado`, `clave`, `id_docente`, `estado`) VALUES
(1, 'Desarrollo Secundaria', 'Desarrollo Secundaria', '1°', 'DES-CCM9KE', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_universidad`
--

CREATE TABLE `grupos_universidad` (
  `id_grupo` int(11) NOT NULL,
  `materia` varchar(100) DEFAULT NULL,
  `nombre_grupo` varchar(100) DEFAULT NULL,
  `grado` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos_universidad`
--

INSERT INTO `grupos_universidad` (`id_grupo`, `materia`, `nombre_grupo`, `grado`, `clave`, `id_docente`, `estado`) VALUES
(1, 'Desarrollo Universidad', 'Desarrollo Universidad', '1°', 'DES-CINZQ5Y', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_director`
--

CREATE TABLE `paquete_director` (
  `id_director` int(11) NOT NULL,
  `nombre_paquete` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `cupo` smallint(6) NOT NULL,
  `image` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquete_director`
--

INSERT INTO `paquete_director` (`id_director`, `nombre_paquete`, `clave`, `cupo`, `image`) VALUES
(1, 'Paquete 1', 'MVH-MEA7B', 1212, 'brandon - 2023.06.23 - 06.22.19am.jpg'),
(1, 'Paquete 2', 'PBK-GC0EY', 20, 'brandon - 2023.06.23 - 06.22.19am.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment`
--

INSERT INTO `payment` (`id_payment`, `payment_id`, `item_number`, `item_name`, `payment_amount`, `payment_currency`, `create_at`) VALUES
(1, 'PAYID-MSKP67Y90D85707C9020090J', '1', 'Cápsula de prueba', 2.00, 'USD', '2023-06-23 02:12:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_institucional`
--

CREATE TABLE `payment_institucional` (
  `id_payment` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_personal`
--

CREATE TABLE `payment_personal` (
  `id_payment` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_preparatoria`
--

CREATE TABLE `payment_preparatoria` (
  `id_payment` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_primaria`
--

CREATE TABLE `payment_primaria` (
  `id_payment` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_primaria`
--

INSERT INTO `payment_primaria` (`id_payment`, `payment_id`, `item_number`, `item_name`, `payment_amount`, `payment_currency`, `id_alumno`, `create_at`) VALUES
(1, '1', '1', '1', 100.00, '1', 1, '2023-07-06 00:50:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_secundaria`
--

CREATE TABLE `payment_secundaria` (
  `id_payment` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_universidad`
--

CREATE TABLE `payment_universidad` (
  `id_payment` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `item_number` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerencias`
--

CREATE TABLE `sugerencias` (
  `id_sugerencia` int(11) NOT NULL,
  `nombre_escuela` varchar(100) DEFAULT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `mensaje` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_account`
--

CREATE TABLE `temp_account` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fechaRegistro` date NOT NULL DEFAULT current_timestamp(),
  `status` smallint(6) NOT NULL DEFAULT 1,
  `image` tinytext DEFAULT NULL,
  `fondo` tinytext DEFAULT NULL,
  `conexiones` smallint(6) NOT NULL DEFAULT 0,
  `id_escuela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temp_account`
--

INSERT INTO `temp_account` (`id`, `nombre`, `clave`, `email`, `username`, `password`, `fechaRegistro`, `status`, `image`, `fondo`, `conexiones`, `id_escuela`) VALUES
(1, 'DiegoGod', 'ABC-R1U2SD8L', 'cuentatemporal@gmail.com', '@alumnoinstitucional', 'acbf157754bc921e70ab30b1e79c75f5', '2023-06-20', 1, 'Mascota-Aerobot-01.png', 'portada-1.png', 1, 1),
(4, 'aasdfasdf', 'PBK-GC0EY', 'asdfasdfsadf@gmail.com', '@asdfasdfasd', 'e10adc3949ba59abbe56e057f20f883e', '2023-06-25', 1, 'Mascota-Aerobot-01.png', 'portada-1.png', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userdirector`
--

CREATE TABLE `userdirector` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_director` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `userdirector`
--

INSERT INTO `userdirector` (`id`, `id_director`) VALUES
(1, 1),
(4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso_cursos_personal`
--
ALTER TABLE `acceso_cursos_personal`
  ADD PRIMARY KEY (`id_acceso_curso`);

--
-- Indices de la tabla `acceso_cursos_preparatoria`
--
ALTER TABLE `acceso_cursos_preparatoria`
  ADD PRIMARY KEY (`id_acceso_curso`);

--
-- Indices de la tabla `acceso_cursos_primaria`
--
ALTER TABLE `acceso_cursos_primaria`
  ADD PRIMARY KEY (`id_acceso_curso`);

--
-- Indices de la tabla `acceso_cursos_secundaria`
--
ALTER TABLE `acceso_cursos_secundaria`
  ADD PRIMARY KEY (`id_acceso_curso`);

--
-- Indices de la tabla `acceso_cursos_universidad`
--
ALTER TABLE `acceso_cursos_universidad`
  ADD PRIMARY KEY (`id_acceso_curso`);

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `alumnos_personal`
--
ALTER TABLE `alumnos_personal`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `alumnos_preparatoria`
--
ALTER TABLE `alumnos_preparatoria`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `alumnos_primaria`
--
ALTER TABLE `alumnos_primaria`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `alumnos_secundaria`
--
ALTER TABLE `alumnos_secundaria`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `alumnos_universidad`
--
ALTER TABLE `alumnos_universidad`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`);

--
-- Indices de la tabla `capsulas_pago_personal`
--
ALTER TABLE `capsulas_pago_personal`
  ADD PRIMARY KEY (`id_capsula_pago`);

--
-- Indices de la tabla `capsulas_pago_preparatoria`
--
ALTER TABLE `capsulas_pago_preparatoria`
  ADD PRIMARY KEY (`id_capsula_pago`);

--
-- Indices de la tabla `capsulas_pago_primaria`
--
ALTER TABLE `capsulas_pago_primaria`
  ADD PRIMARY KEY (`id_capsula_pago`);

--
-- Indices de la tabla `capsulas_pago_secundaria`
--
ALTER TABLE `capsulas_pago_secundaria`
  ADD PRIMARY KEY (`id_capsula_pago`);

--
-- Indices de la tabla `capsulas_pago_universidad`
--
ALTER TABLE `capsulas_pago_universidad`
  ADD PRIMARY KEY (`id_capsula_pago`);

--
-- Indices de la tabla `capsulas_personal`
--
ALTER TABLE `capsulas_personal`
  ADD PRIMARY KEY (`id_capsula`);

--
-- Indices de la tabla `capsulas_preparatoria`
--
ALTER TABLE `capsulas_preparatoria`
  ADD PRIMARY KEY (`id_capsula`);

--
-- Indices de la tabla `capsulas_primaria`
--
ALTER TABLE `capsulas_primaria`
  ADD PRIMARY KEY (`id_capsula`);

--
-- Indices de la tabla `capsulas_secundaria`
--
ALTER TABLE `capsulas_secundaria`
  ADD PRIMARY KEY (`id_capsula`);

--
-- Indices de la tabla `capsulas_universidad`
--
ALTER TABLE `capsulas_universidad`
  ADD PRIMARY KEY (`id_capsula`);

--
-- Indices de la tabla `cursos_personal`
--
ALTER TABLE `cursos_personal`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `cursos_preparatoria`
--
ALTER TABLE `cursos_preparatoria`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `cursos_primaria`
--
ALTER TABLE `cursos_primaria`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `cursos_secundaria`
--
ALTER TABLE `cursos_secundaria`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `cursos_universidad`
--
ALTER TABLE `cursos_universidad`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `detalle_capsulas_pago_personal`
--
ALTER TABLE `detalle_capsulas_pago_personal`
  ADD PRIMARY KEY (`id_detalle_capsula_pago`);

--
-- Indices de la tabla `detalle_capsulas_pago_preparatoria`
--
ALTER TABLE `detalle_capsulas_pago_preparatoria`
  ADD PRIMARY KEY (`id_detalle_capsula_pago`);

--
-- Indices de la tabla `detalle_capsulas_pago_primaria`
--
ALTER TABLE `detalle_capsulas_pago_primaria`
  ADD PRIMARY KEY (`id_detalle_capsula_pago`);

--
-- Indices de la tabla `detalle_capsulas_pago_secundaria`
--
ALTER TABLE `detalle_capsulas_pago_secundaria`
  ADD PRIMARY KEY (`id_detalle_capsula_pago`);

--
-- Indices de la tabla `detalle_capsulas_pago_universidad`
--
ALTER TABLE `detalle_capsulas_pago_universidad`
  ADD PRIMARY KEY (`id_detalle_capsula_pago`);

--
-- Indices de la tabla `detalle_capsulas_personal`
--
ALTER TABLE `detalle_capsulas_personal`
  ADD PRIMARY KEY (`id_detalle_capsula`);

--
-- Indices de la tabla `detalle_capsulas_preparatoria`
--
ALTER TABLE `detalle_capsulas_preparatoria`
  ADD PRIMARY KEY (`id_detalle_capsula`);

--
-- Indices de la tabla `detalle_capsulas_primaria`
--
ALTER TABLE `detalle_capsulas_primaria`
  ADD PRIMARY KEY (`id_detalle_capsula`);

--
-- Indices de la tabla `detalle_capsulas_secundaria`
--
ALTER TABLE `detalle_capsulas_secundaria`
  ADD PRIMARY KEY (`id_detalle_capsula`);

--
-- Indices de la tabla `detalle_capsulas_universidad`
--
ALTER TABLE `detalle_capsulas_universidad`
  ADD PRIMARY KEY (`id_detalle_capsula`);

--
-- Indices de la tabla `detalle_estadisticas_personal`
--
ALTER TABLE `detalle_estadisticas_personal`
  ADD PRIMARY KEY (`id_detalle_estadistica`);

--
-- Indices de la tabla `detalle_estadisticas_preparatoria`
--
ALTER TABLE `detalle_estadisticas_preparatoria`
  ADD PRIMARY KEY (`id_detalle_estadistica`);

--
-- Indices de la tabla `detalle_estadisticas_primaria`
--
ALTER TABLE `detalle_estadisticas_primaria`
  ADD PRIMARY KEY (`id_detalle_estadistica`);

--
-- Indices de la tabla `detalle_estadisticas_secundaria`
--
ALTER TABLE `detalle_estadisticas_secundaria`
  ADD PRIMARY KEY (`id_detalle_estadistica`);

--
-- Indices de la tabla `detalle_estadisticas_universidad`
--
ALTER TABLE `detalle_estadisticas_universidad`
  ADD PRIMARY KEY (`id_detalle_estadistica`);

--
-- Indices de la tabla `detalle_grupos_personal`
--
ALTER TABLE `detalle_grupos_personal`
  ADD PRIMARY KEY (`id_detalle_grupo`);

--
-- Indices de la tabla `detalle_grupos_preparatoria`
--
ALTER TABLE `detalle_grupos_preparatoria`
  ADD PRIMARY KEY (`id_detalle_grupo`);

--
-- Indices de la tabla `detalle_grupos_primaria`
--
ALTER TABLE `detalle_grupos_primaria`
  ADD PRIMARY KEY (`id_detalle_grupo`);

--
-- Indices de la tabla `detalle_grupos_secundaria`
--
ALTER TABLE `detalle_grupos_secundaria`
  ADD PRIMARY KEY (`id_detalle_grupo`);

--
-- Indices de la tabla `detalle_grupos_universidad`
--
ALTER TABLE `detalle_grupos_universidad`
  ADD PRIMARY KEY (`id_detalle_grupo`);

--
-- Indices de la tabla `detalle_grupo_cursos_personal`
--
ALTER TABLE `detalle_grupo_cursos_personal`
  ADD PRIMARY KEY (`id_detalle_grupo_curso`);

--
-- Indices de la tabla `detalle_grupo_cursos_preparatoria`
--
ALTER TABLE `detalle_grupo_cursos_preparatoria`
  ADD PRIMARY KEY (`id_detalle_grupo_curso`);

--
-- Indices de la tabla `detalle_grupo_cursos_primaria`
--
ALTER TABLE `detalle_grupo_cursos_primaria`
  ADD PRIMARY KEY (`id_detalle_grupo_curso`);

--
-- Indices de la tabla `detalle_grupo_cursos_secundaria`
--
ALTER TABLE `detalle_grupo_cursos_secundaria`
  ADD PRIMARY KEY (`id_detalle_grupo_curso`);

--
-- Indices de la tabla `detalle_grupo_cursos_universidad`
--
ALTER TABLE `detalle_grupo_cursos_universidad`
  ADD PRIMARY KEY (`id_detalle_grupo_curso`);

--
-- Indices de la tabla `detalle_intentos_personal`
--
ALTER TABLE `detalle_intentos_personal`
  ADD PRIMARY KEY (`id_detalle_intento`);

--
-- Indices de la tabla `detalle_intentos_preparatoria`
--
ALTER TABLE `detalle_intentos_preparatoria`
  ADD PRIMARY KEY (`id_detalle_intento`);

--
-- Indices de la tabla `detalle_intentos_primaria`
--
ALTER TABLE `detalle_intentos_primaria`
  ADD PRIMARY KEY (`id_detalle_intento`);

--
-- Indices de la tabla `detalle_intentos_secundaria`
--
ALTER TABLE `detalle_intentos_secundaria`
  ADD PRIMARY KEY (`id_detalle_intento`);

--
-- Indices de la tabla `detalle_intentos_universidad`
--
ALTER TABLE `detalle_intentos_universidad`
  ADD PRIMARY KEY (`id_detalle_intento`);

--
-- Indices de la tabla `directores_personal`
--
ALTER TABLE `directores_personal`
  ADD PRIMARY KEY (`id_director`);

--
-- Indices de la tabla `directores_preparatoria`
--
ALTER TABLE `directores_preparatoria`
  ADD PRIMARY KEY (`id_director`);

--
-- Indices de la tabla `directores_primaria`
--
ALTER TABLE `directores_primaria`
  ADD PRIMARY KEY (`id_director`);

--
-- Indices de la tabla `directores_secundaria`
--
ALTER TABLE `directores_secundaria`
  ADD PRIMARY KEY (`id_director`);

--
-- Indices de la tabla `directores_universidad`
--
ALTER TABLE `directores_universidad`
  ADD PRIMARY KEY (`id_director`);

--
-- Indices de la tabla `director_institucional`
--
ALTER TABLE `director_institucional`
  ADD PRIMARY KEY (`id_director`);

--
-- Indices de la tabla `docentes_personal`
--
ALTER TABLE `docentes_personal`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `docentes_preparatoria`
--
ALTER TABLE `docentes_preparatoria`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `docentes_primaria`
--
ALTER TABLE `docentes_primaria`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `docentes_secundaria`
--
ALTER TABLE `docentes_secundaria`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `docentes_universidad`
--
ALTER TABLE `docentes_universidad`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  ADD PRIMARY KEY (`id_escuela`);

--
-- Indices de la tabla `estadisticas_personal`
--
ALTER TABLE `estadisticas_personal`
  ADD PRIMARY KEY (`id_estadistica`);

--
-- Indices de la tabla `estadisticas_preparatoria`
--
ALTER TABLE `estadisticas_preparatoria`
  ADD PRIMARY KEY (`id_estadistica`);

--
-- Indices de la tabla `estadisticas_primaria`
--
ALTER TABLE `estadisticas_primaria`
  ADD PRIMARY KEY (`id_estadistica`);

--
-- Indices de la tabla `estadisticas_secundaria`
--
ALTER TABLE `estadisticas_secundaria`
  ADD PRIMARY KEY (`id_estadistica`);

--
-- Indices de la tabla `estadisticas_universidad`
--
ALTER TABLE `estadisticas_universidad`
  ADD PRIMARY KEY (`id_estadistica`);

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`id_formulario`);

--
-- Indices de la tabla `grupos_personal`
--
ALTER TABLE `grupos_personal`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `grupos_preparatoria`
--
ALTER TABLE `grupos_preparatoria`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `grupos_primaria`
--
ALTER TABLE `grupos_primaria`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `grupos_secundaria`
--
ALTER TABLE `grupos_secundaria`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `grupos_universidad`
--
ALTER TABLE `grupos_universidad`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `paquete_director`
--
ALTER TABLE `paquete_director`
  ADD PRIMARY KEY (`id_director`,`nombre_paquete`) USING BTREE;

--
-- Indices de la tabla `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indices de la tabla `payment_institucional`
--
ALTER TABLE `payment_institucional`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indices de la tabla `payment_preparatoria`
--
ALTER TABLE `payment_preparatoria`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indices de la tabla `payment_primaria`
--
ALTER TABLE `payment_primaria`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indices de la tabla `payment_secundaria`
--
ALTER TABLE `payment_secundaria`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indices de la tabla `payment_universidad`
--
ALTER TABLE `payment_universidad`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indices de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  ADD PRIMARY KEY (`id_sugerencia`);

--
-- Indices de la tabla `temp_account`
--
ALTER TABLE `temp_account`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `userdirector`
--
ALTER TABLE `userdirector`
  ADD PRIMARY KEY (`id`,`id_director`),
  ADD KEY `fkDirectorInstitucionalUserDirector` (`id_director`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso_cursos_personal`
--
ALTER TABLE `acceso_cursos_personal`
  MODIFY `id_acceso_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `acceso_cursos_preparatoria`
--
ALTER TABLE `acceso_cursos_preparatoria`
  MODIFY `id_acceso_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `acceso_cursos_primaria`
--
ALTER TABLE `acceso_cursos_primaria`
  MODIFY `id_acceso_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `acceso_cursos_secundaria`
--
ALTER TABLE `acceso_cursos_secundaria`
  MODIFY `id_acceso_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `acceso_cursos_universidad`
--
ALTER TABLE `acceso_cursos_universidad`
  MODIFY `id_acceso_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnos_personal`
--
ALTER TABLE `alumnos_personal`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnos_preparatoria`
--
ALTER TABLE `alumnos_preparatoria`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnos_primaria`
--
ALTER TABLE `alumnos_primaria`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `alumnos_secundaria`
--
ALTER TABLE `alumnos_secundaria`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnos_universidad`
--
ALTER TABLE `alumnos_universidad`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `capsulas_pago_personal`
--
ALTER TABLE `capsulas_pago_personal`
  MODIFY `id_capsula_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `capsulas_pago_preparatoria`
--
ALTER TABLE `capsulas_pago_preparatoria`
  MODIFY `id_capsula_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `capsulas_pago_primaria`
--
ALTER TABLE `capsulas_pago_primaria`
  MODIFY `id_capsula_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `capsulas_pago_secundaria`
--
ALTER TABLE `capsulas_pago_secundaria`
  MODIFY `id_capsula_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `capsulas_pago_universidad`
--
ALTER TABLE `capsulas_pago_universidad`
  MODIFY `id_capsula_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `capsulas_personal`
--
ALTER TABLE `capsulas_personal`
  MODIFY `id_capsula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `capsulas_preparatoria`
--
ALTER TABLE `capsulas_preparatoria`
  MODIFY `id_capsula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `capsulas_primaria`
--
ALTER TABLE `capsulas_primaria`
  MODIFY `id_capsula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `capsulas_secundaria`
--
ALTER TABLE `capsulas_secundaria`
  MODIFY `id_capsula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `capsulas_universidad`
--
ALTER TABLE `capsulas_universidad`
  MODIFY `id_capsula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `cursos_personal`
--
ALTER TABLE `cursos_personal`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cursos_preparatoria`
--
ALTER TABLE `cursos_preparatoria`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cursos_primaria`
--
ALTER TABLE `cursos_primaria`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cursos_secundaria`
--
ALTER TABLE `cursos_secundaria`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cursos_universidad`
--
ALTER TABLE `cursos_universidad`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_pago_personal`
--
ALTER TABLE `detalle_capsulas_pago_personal`
  MODIFY `id_detalle_capsula_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_pago_preparatoria`
--
ALTER TABLE `detalle_capsulas_pago_preparatoria`
  MODIFY `id_detalle_capsula_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_pago_primaria`
--
ALTER TABLE `detalle_capsulas_pago_primaria`
  MODIFY `id_detalle_capsula_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_pago_secundaria`
--
ALTER TABLE `detalle_capsulas_pago_secundaria`
  MODIFY `id_detalle_capsula_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_pago_universidad`
--
ALTER TABLE `detalle_capsulas_pago_universidad`
  MODIFY `id_detalle_capsula_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_personal`
--
ALTER TABLE `detalle_capsulas_personal`
  MODIFY `id_detalle_capsula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_preparatoria`
--
ALTER TABLE `detalle_capsulas_preparatoria`
  MODIFY `id_detalle_capsula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_primaria`
--
ALTER TABLE `detalle_capsulas_primaria`
  MODIFY `id_detalle_capsula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_secundaria`
--
ALTER TABLE `detalle_capsulas_secundaria`
  MODIFY `id_detalle_capsula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_universidad`
--
ALTER TABLE `detalle_capsulas_universidad`
  MODIFY `id_detalle_capsula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_estadisticas_personal`
--
ALTER TABLE `detalle_estadisticas_personal`
  MODIFY `id_detalle_estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_estadisticas_preparatoria`
--
ALTER TABLE `detalle_estadisticas_preparatoria`
  MODIFY `id_detalle_estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_estadisticas_primaria`
--
ALTER TABLE `detalle_estadisticas_primaria`
  MODIFY `id_detalle_estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_estadisticas_secundaria`
--
ALTER TABLE `detalle_estadisticas_secundaria`
  MODIFY `id_detalle_estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_estadisticas_universidad`
--
ALTER TABLE `detalle_estadisticas_universidad`
  MODIFY `id_detalle_estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_grupos_personal`
--
ALTER TABLE `detalle_grupos_personal`
  MODIFY `id_detalle_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_grupos_preparatoria`
--
ALTER TABLE `detalle_grupos_preparatoria`
  MODIFY `id_detalle_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_grupos_primaria`
--
ALTER TABLE `detalle_grupos_primaria`
  MODIFY `id_detalle_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_grupos_secundaria`
--
ALTER TABLE `detalle_grupos_secundaria`
  MODIFY `id_detalle_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_grupos_universidad`
--
ALTER TABLE `detalle_grupos_universidad`
  MODIFY `id_detalle_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_grupo_cursos_personal`
--
ALTER TABLE `detalle_grupo_cursos_personal`
  MODIFY `id_detalle_grupo_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_grupo_cursos_preparatoria`
--
ALTER TABLE `detalle_grupo_cursos_preparatoria`
  MODIFY `id_detalle_grupo_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_grupo_cursos_primaria`
--
ALTER TABLE `detalle_grupo_cursos_primaria`
  MODIFY `id_detalle_grupo_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_grupo_cursos_secundaria`
--
ALTER TABLE `detalle_grupo_cursos_secundaria`
  MODIFY `id_detalle_grupo_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_grupo_cursos_universidad`
--
ALTER TABLE `detalle_grupo_cursos_universidad`
  MODIFY `id_detalle_grupo_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_intentos_personal`
--
ALTER TABLE `detalle_intentos_personal`
  MODIFY `id_detalle_intento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_intentos_preparatoria`
--
ALTER TABLE `detalle_intentos_preparatoria`
  MODIFY `id_detalle_intento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_intentos_primaria`
--
ALTER TABLE `detalle_intentos_primaria`
  MODIFY `id_detalle_intento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_intentos_secundaria`
--
ALTER TABLE `detalle_intentos_secundaria`
  MODIFY `id_detalle_intento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_intentos_universidad`
--
ALTER TABLE `detalle_intentos_universidad`
  MODIFY `id_detalle_intento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `directores_personal`
--
ALTER TABLE `directores_personal`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `directores_preparatoria`
--
ALTER TABLE `directores_preparatoria`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `directores_primaria`
--
ALTER TABLE `directores_primaria`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `directores_secundaria`
--
ALTER TABLE `directores_secundaria`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `directores_universidad`
--
ALTER TABLE `directores_universidad`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `director_institucional`
--
ALTER TABLE `director_institucional`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `docentes_personal`
--
ALTER TABLE `docentes_personal`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docentes_preparatoria`
--
ALTER TABLE `docentes_preparatoria`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `docentes_primaria`
--
ALTER TABLE `docentes_primaria`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `docentes_secundaria`
--
ALTER TABLE `docentes_secundaria`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `docentes_universidad`
--
ALTER TABLE `docentes_universidad`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  MODIFY `id_escuela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estadisticas_personal`
--
ALTER TABLE `estadisticas_personal`
  MODIFY `id_estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticas_preparatoria`
--
ALTER TABLE `estadisticas_preparatoria`
  MODIFY `id_estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticas_primaria`
--
ALTER TABLE `estadisticas_primaria`
  MODIFY `id_estadistica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estadisticas_secundaria`
--
ALTER TABLE `estadisticas_secundaria`
  MODIFY `id_estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticas_universidad`
--
ALTER TABLE `estadisticas_universidad`
  MODIFY `id_estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `id_formulario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos_personal`
--
ALTER TABLE `grupos_personal`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos_preparatoria`
--
ALTER TABLE `grupos_preparatoria`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grupos_primaria`
--
ALTER TABLE `grupos_primaria`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grupos_secundaria`
--
ALTER TABLE `grupos_secundaria`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grupos_universidad`
--
ALTER TABLE `grupos_universidad`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `payment_institucional`
--
ALTER TABLE `payment_institucional`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payment_preparatoria`
--
ALTER TABLE `payment_preparatoria`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payment_primaria`
--
ALTER TABLE `payment_primaria`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `payment_secundaria`
--
ALTER TABLE `payment_secundaria`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payment_universidad`
--
ALTER TABLE `payment_universidad`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  MODIFY `id_sugerencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temp_account`
--
ALTER TABLE `temp_account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paquete_director`
--
ALTER TABLE `paquete_director`
  ADD CONSTRAINT `fkPaqueteDirectorDirectorInstitucional` FOREIGN KEY (`id_director`) REFERENCES `director_institucional` (`id_director`);

--
-- Filtros para la tabla `userdirector`
--
ALTER TABLE `userdirector`
  ADD CONSTRAINT `fkDirectorInstitucionalUserDirector` FOREIGN KEY (`id_director`) REFERENCES `director_institucional` (`id_director`),
  ADD CONSTRAINT `fkTempAccountUserDirector` FOREIGN KEY (`id`) REFERENCES `temp_account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
