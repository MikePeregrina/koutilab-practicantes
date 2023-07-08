-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2023 a las 04:27:24
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
-- Base de datos: `aerobotp_desarrollo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso_cursos`
--

CREATE TABLE `acceso_cursos` (
  `id_acceso` int(11) NOT NULL,
  `curso` varchar(100) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acceso_cursos`
--

INSERT INTO `acceso_cursos` (`id_acceso`, `curso`, `id_alumno`) VALUES
(1, 'Programacion web basica', 1),
(2, 'Programacion web intermedio', 1),
(3, 'Programacion web avanzado', 1),
(4, 'Python basico', 1),
(5, 'Python intermedio', 1),
(6, 'Python avanzado', 1),
(7, 'Arduino basico', 1),
(8, 'Arduino intermedio', 1),
(9, 'Arduino avanzado', 1),
(10, 'Programacion web basica', 2),
(11, 'Programacion web basica', 3),
(12, '', 1),
(13, '', 1),
(14, '', 1),
(15, '', 1),
(16, '', 1),
(17, '', 1),
(18, '', 1),
(19, 'Programacion web basica', 1),
(20, 'Programacion web basica', 4),
(21, 'Programacion web basica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `fondo` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `rol` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `usuario`, `contrasena`, `clave`, `image`, `fondo`, `nombre`, `pais`, `rol`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL, NULL, 'admin', 'México', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `nivel_educativo` varchar(100) DEFAULT NULL,
  `grado_escolar` varchar(100) DEFAULT NULL,
  `nombre_grupo` varchar(100) DEFAULT NULL,
  `fondo` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `nivel_educativo`, `grado_escolar`, `nombre_grupo`, `fondo`, `id_escuela`, `id_docente`) VALUES
(1, 'Alumno Desarrollo', 'alumno.desarrollo', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-6GBXLNEP', 'prueba@gmail.com', 'Mascota-Aerobot-01.png', 'Primaria', '1', '1A', 'portada-1.png', 1, 2),
(2, 'Jaime Reyes Ruiz', '@jaimereye-8o60', '37ccb42609d619075943d1eb8d5ad9f5', 'ABC-6GBXLNEP', 'prueba@gmail.com', 'Mascota-Aerobot-01.png', 'Primaria', '1°', '1A', 'portada-1.png', 1, 1),
(3, 'Rafael Solead Cruz', '@rafaelsol-7rfs', '37ccb42609d619075943d1eb8d5ad9f5', 'ABC-6GBXLNEP', 'prueba@gmail.com', 'Mascota-Aerobot-01.png', 'Primaria', '1°', '1A', 'portada-1.png', 1, 1),
(4, 'Secundaria', '@secundaria', '37ccb42609d619075943d1eb8d5ad9f5', 'ASD-K5L8O9I', 'prueba@gmail.com', 'Mascota-Aerobot-04.png', '', NULL, NULL, 'portada-1.png', 2, 2),
(5, 'Jaime', '@jaimepro', 'e10adc3949ba59abbe56e057f20f883e', 'ASD-K5L8O9I', 'jaime.reyesr22@gmail.com', 'Mascota-Aerobot-01.png', 'Secundaria', NULL, NULL, 'portada-1.png', 2, NULL),
(6, 'fasdf', '@asdf', '63d0cea9d550e495fde1b81310951bd7', 'ASD-K5L8O9I', 'jaime.reyesr22@gmail.com', 'Mascota-Aerobot-01.png', 'Secundaria', NULL, NULL, 'portada-1.png', 2, NULL),
(7, 'asdfasf', '@asdfaaas', '85d7c8771b1acc3f16cc3a1cfc23e3a2', 'ASD-K5L8O9I', 'asdf@gmailc.om', 'Mascota-Aerobot-01.png', 'Secundaria', NULL, NULL, 'portada-1.png', 2, NULL),
(8, 'asdf', '@asdfasdfasdf', '85d7c8771b1acc3f16cc3a1cfc23e3a2', 'ASD-K5L8O9I', 'asdfasf@gmia.com', 'Mascota-Aerobot-01.png', 'Secundaria', NULL, NULL, 'portada-1.png', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capsulas`
--

CREATE TABLE `capsulas` (
  `id_capsula` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas`
--

INSERT INTO `capsulas` (`id_capsula`, `nombre`) VALUES
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
-- Estructura de tabla para la tabla `capsulas_pago`
--

CREATE TABLE `capsulas_pago` (
  `id_capsula_pago` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `capsulas_pago`
--

INSERT INTO `capsulas_pago` (`id_capsula_pago`, `nombre`) VALUES
(1, 'capsulapago1'),
(2, 'capsulapago2'),
(3, 'capsulapago3'),
(4, 'capsulapago4'),
(5, 'capsulapago5'),
(6, 'capsulapago6');

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
(7, 'Arduino basico'),
(8, 'Arduino intermedio'),
(9, 'Arduino avanzado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas`
--

CREATE TABLE `detalle_capsulas` (
  `id` int(11) NOT NULL,
  `id_permiso` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_capsulas`
--

INSERT INTO `detalle_capsulas` (`id`, `id_permiso`, `id_usuario`, `id_curso`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 7, 1, 1),
(8, 8, 1, 1),
(9, 9, 1, 1),
(10, 10, 1, 1),
(11, 11, 1, 1),
(12, 12, 1, 1),
(13, 13, 1, 1),
(14, 14, 1, 1),
(15, 15, 1, 1),
(16, 16, 1, 1),
(17, 17, 1, 1),
(18, 18, 1, 1),
(19, 19, 1, 1),
(20, 20, 1, 1),
(21, 21, 1, 1),
(22, 22, 1, 1),
(23, 23, 1, 1),
(24, 24, 1, 1),
(25, 25, 1, 1),
(26, 26, 1, 1),
(27, 27, 1, 1),
(28, 28, 1, 1),
(29, 29, 1, 1),
(30, 30, 1, 1),
(31, 31, 1, 1),
(32, 32, 1, 1),
(33, 33, 1, 1),
(34, 34, 1, 1),
(35, 35, 1, 1),
(36, 36, 1, 1),
(37, 37, 1, 1),
(38, 38, 1, 1),
(39, 39, 1, 1),
(40, 40, 1, 1),
(41, 41, 1, 1),
(42, 42, 1, 1),
(43, 43, 1, 1),
(44, 44, 1, 1),
(45, 45, 1, 1),
(46, 46, 1, 1),
(47, 47, 1, 1),
(48, 48, 1, 1),
(49, 49, 1, 1),
(50, 50, 1, 1),
(51, 51, 1, 1),
(52, 52, 1, 1),
(53, 53, 1, 1),
(54, 54, 1, 1),
(55, 55, 1, 1),
(56, 1, 1, 1),
(57, 1, 2, 1),
(58, 2, 2, 1),
(59, 26, 1, 1),
(60, 26, 1, 1),
(61, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capsulas_pago`
--

CREATE TABLE `detalle_capsulas_pago` (
  `id` int(11) NOT NULL,
  `id_permiso` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_capsulas_pago`
--

INSERT INTO `detalle_capsulas_pago` (`id`, `id_permiso`, `id_usuario`, `id_curso`) VALUES
(1, 3, 1, 1),
(2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_estadisticas`
--

CREATE TABLE `detalle_estadisticas` (
  `id` int(11) NOT NULL,
  `trofeos` int(11) DEFAULT NULL,
  `progreso` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `audiovisual` int(11) DEFAULT NULL,
  `practico` int(11) DEFAULT NULL,
  `teorico` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_estadisticas`
--

INSERT INTO `detalle_estadisticas` (`id`, `trofeos`, `progreso`, `puntos`, `audiovisual`, `practico`, `teorico`, `id_alumno`, `id_curso`) VALUES
(1, NULL, 2, NULL, NULL, NULL, 10, 2, 1),
(2, 100, NULL, NULL, NULL, NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupos`
--

CREATE TABLE `detalle_grupos` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_grupos`
--

INSERT INTO `detalle_grupos` (`id`, `id_alumno`, `id_grupo`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 1, 0),
(5, 1, 0),
(6, 1, 0),
(7, 1, 0),
(8, 1, 0),
(9, 1, 0),
(10, 1, 0),
(11, 1, 2),
(12, 4, 3),
(13, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_intentos`
--

CREATE TABLE `detalle_intentos` (
  `id_intento` int(11) NOT NULL,
  `id_capsula` int(11) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `intentos` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_intentos`
--

INSERT INTO `detalle_intentos` (`id_intento`, `id_capsula`, `id_alumno`, `intentos`, `id_curso`) VALUES
(1, 16, 1, 4, 1),
(2, 2, 1, 14, 1),
(3, 2, 2, 1, 1),
(4, 5, 1, 4, 1),
(5, 7, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores`
--

CREATE TABLE `directores` (
  `id_director` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_escuela` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `nombre`, `usuario`, `contrasena`, `clave`, `email`, `image`, `id_escuela`) VALUES
(1, 'Docente Desarrollo', 'docente.desarrollo', 'acbf157754bc921e70ab30b1e79c75f5', 'ABC-V9J8TPJW', '', 'Docente Desarrollo - 2023.03.28 - 06.46.47pm.jpg', 1),
(2, 'docentesecundaria', '@docentes', 'e10adc3949ba59abbe56e057f20f883e', 'ASD-P7LC9B5', '', NULL, 2);

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
  `clave_director` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escuelas`
--

INSERT INTO `escuelas` (`id_escuela`, `nombre_escuela`, `cct`, `nombre_director`, `calle`, `num_exterior`, `estado`, `codigo_postal`, `nivel_educativo`, `pais`, `autorizacion`, `id_admin`, `clave_alumno`, `clave_docente`, `clave_director`) VALUES
(1, 'Desarrollo', 'ABC123', 'Director', 'Calle', 'Número Exterior', 'Estado', '99999', 'Primaria', 'México', 'admin', 1, 'ABC-6GBXLNEP', 'ABC-V9J8TPJW', 'ABC-BV1NUK4'),
(2, 'Desarrollo Secundaria', 'ASDFASDFDS', 'Yo', 'asdfasdf', 'asdfasdf', 'Hidalgo', 'asasf', 'Secundaria', 'México', 'admin', 1, 'ASD-K5L8O9I', 'ASD-P7LC9B5', 'ASD-T7XZN01Z');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas`
--

CREATE TABLE `estadisticas` (
  `id_estadistica` int(11) NOT NULL,
  `trofeos` int(5) DEFAULT NULL,
  `progreso` int(5) DEFAULT NULL,
  `puntos` int(5) DEFAULT NULL,
  `audiovisual` int(5) DEFAULT NULL,
  `practico` int(5) DEFAULT NULL,
  `teorico` int(5) DEFAULT NULL,
  `id_alumno` int(5) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadisticas`
--

INSERT INTO `estadisticas` (`id_estadistica`, `trofeos`, `progreso`, `puntos`, `audiovisual`, `practico`, `teorico`, `id_alumno`, `id_curso`) VALUES
(1, 0, 0, 0, 0, 0, 0, 1, 1),
(2, 100, 2, 0, 0, 0, 10, 2, 1),
(3, 0, 2, 0, 0, 0, 10, 2, 1),
(4, 0, 0, 0, 0, 0, 0, 1, 1),
(5, 0, 0, 0, 0, 0, 0, 1, 1),
(6, 0, 0, 0, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `id` int(11) NOT NULL,
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
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `materia` varchar(100) DEFAULT NULL,
  `nombre_grupo` varchar(100) DEFAULT NULL,
  `grado` varchar(100) DEFAULT NULL,
  `curso` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `materia`, `nombre_grupo`, `grado`, `curso`, `clave`, `id_docente`) VALUES
(1, 'Desarrollo', '1A', '1°', 'Programacion web basica', NULL, 1),
(2, 'asdf', 'asdfsaf', '1°', 'Programacion web basica', 'ASD-EGELIU', 1),
(3, 'Prueba', 'COMPUTACION', '1°', 'Programacion web basica', 'COM-0K9WT26', 2);

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
(1, 'PAYID-MQ65ZMA25T93734RK5018616', '1', 'Cápsula de prueba', 2.00, 'USD', '2023-04-17 23:56:51'),
(2, 'PAYID-MQ653SA8J155564B24059019', '1', 'Cápsula de prueba', 2.00, 'USD', '2023-04-18 00:02:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `clave`, `rol`) VALUES
(1, 'admin', 1),
(2, 'alumno', 2),
(3, 'docente', 3),
(4, 'director', 4),
(5, 'adminsecundario', 5),
(6, 'ABC-6GBXLNEP', 2),
(7, 'ABC-V9J8TPJW', 3),
(8, 'ABC-BV1NUK4', 4),
(9, 'ABC-6GBXLNEP', 2),
(10, 'ABC-6GBXLNEP', 2),
(11, 'alumnosecundaria', 6),
(12, 'docentesecundaria', 7),
(13, 'directorsecundaria', 8),
(14, 'alumnopreparatoria', 9),
(15, 'docentepreparatoria', 10),
(16, 'directorpreparatoria', 11),
(17, 'ASD-K5L8O9I', 6),
(18, 'ASD-P7LC9B5', 7),
(19, 'ASD-T7XZN01Z', 8);

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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso_cursos`
--
ALTER TABLE `acceso_cursos`
  ADD PRIMARY KEY (`id_acceso`);

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `capsulas`
--
ALTER TABLE `capsulas`
  ADD PRIMARY KEY (`id_capsula`);

--
-- Indices de la tabla `capsulas_pago`
--
ALTER TABLE `capsulas_pago`
  ADD PRIMARY KEY (`id_capsula_pago`);

--
-- Indices de la tabla `cursos_primaria`
--
ALTER TABLE `cursos_primaria`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `detalle_capsulas`
--
ALTER TABLE `detalle_capsulas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_capsulas_pago`
--
ALTER TABLE `detalle_capsulas_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_estadisticas`
--
ALTER TABLE `detalle_estadisticas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_grupos`
--
ALTER TABLE `detalle_grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_intentos`
--
ALTER TABLE `detalle_intentos`
  ADD PRIMARY KEY (`id_intento`);

--
-- Indices de la tabla `directores`
--
ALTER TABLE `directores`
  ADD PRIMARY KEY (`id_director`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  ADD PRIMARY KEY (`id_escuela`);

--
-- Indices de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  ADD PRIMARY KEY (`id_estadistica`);

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  ADD PRIMARY KEY (`id_sugerencia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso_cursos`
--
ALTER TABLE `acceso_cursos`
  MODIFY `id_acceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `capsulas`
--
ALTER TABLE `capsulas`
  MODIFY `id_capsula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `capsulas_pago`
--
ALTER TABLE `capsulas_pago`
  MODIFY `id_capsula_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cursos_primaria`
--
ALTER TABLE `cursos_primaria`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas`
--
ALTER TABLE `detalle_capsulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `detalle_capsulas_pago`
--
ALTER TABLE `detalle_capsulas_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_estadisticas`
--
ALTER TABLE `detalle_estadisticas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_grupos`
--
ALTER TABLE `detalle_grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_intentos`
--
ALTER TABLE `detalle_intentos`
  MODIFY `id_intento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `directores`
--
ALTER TABLE `directores`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  MODIFY `id_escuela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  MODIFY `id_estadistica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `sugerencias`
--
ALTER TABLE `sugerencias`
  MODIFY `id_sugerencia` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
