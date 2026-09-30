-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2026 a las 16:31:52
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
-- Base de datos: `bd_libro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `ID_autores` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellidos` varchar(50) DEFAULT NULL,
  `telefono` bigint(14) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `archivo` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`ID_autores`, `Nombre`, `Apellidos`, `telefono`, `correo`, `archivo`) VALUES
(9, 'Brenda', 'Retamozo', 675267867, 'Brenda@gmail.com', 'uploads/autores/1790704141_images (1).jpg'),
(10, 'Gustavo', 'Quispe', 675267867, 'gus@gamil.com', 'uploads/autores/1790704166_images.jpg'),
(11, 'Maria', 'Quispe', 675267867, 'gus@gamil.com', 'uploads/autores/1790704186_images (4).jpg'),
(18, 'Luis', 'Quispe', 675267867, 'gus@gamil.com', 'uploads/autores/1790704220_8923938.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editores`
--

CREATE TABLE `editores` (
  `ID_editores` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellidos` varchar(50) DEFAULT NULL,
  `nombre_editorial` varchar(70) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `archivo` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editores`
--

INSERT INTO `editores` (`ID_editores`, `Nombre`, `Apellidos`, `nombre_editorial`, `pais`, `archivo`) VALUES
(1, 'Pedro', 'Diaz Perea', NULL, NULL, 'uploads/editores/1790704241_Designer (3).png'),
(2, 'Alejandro', 'Peralta', NULL, NULL, 'uploads/editores/1790704267_7db544052cbba234c5ee3a6dc78543ae.jpg'),
(3, 'Irene', 'Dussan Pineda', NULL, NULL, NULL),
(5, 'Brenda', 'Retamozo Merino', 'Grupo vacio', 'Peru', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `ID_libro` int(11) NOT NULL,
  `Titulo` varchar(45) DEFAULT NULL,
  `Tipo` varchar(45) DEFAULT NULL,
  `ID_autor` int(11) DEFAULT NULL,
  `ID_editor` int(11) DEFAULT NULL,
  `ID_traductor` int(11) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `archivo` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`ID_libro`, `Titulo`, `Tipo`, `ID_autor`, `ID_editor`, `ID_traductor`, `genero`, `archivo`) VALUES
(7, 'La odisea', 'Novela', 10, 3, 7, 'Romance', 'uploads/libros/1790701737_images (7).jpg'),
(8, 'Michael Jackson', 'Documental', 18, 5, 7, 'Terror', 'uploads/libros/1790704679_Michael_Jackson_in_1988 (1).jpg'),
(9, 'Amor', NULL, 9, 2, 7, NULL, NULL),
(11, 'Rápidos y Furiosos', 'Ficción', 10, 3, 3, 'Historia', 'uploads/libros/1790701678_images (6).jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traductores`
--

CREATE TABLE `traductores` (
  `ID_traductores` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellidos` varchar(50) DEFAULT NULL,
  `idioma_nativo` varchar(30) DEFAULT NULL,
  `idiomas_traduccion` varchar(50) DEFAULT NULL,
  `certificaciones` int(11) DEFAULT NULL,
  `archivo` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `traductores`
--

INSERT INTO `traductores` (`ID_traductores`, `Nombre`, `Apellidos`, `idioma_nativo`, `idiomas_traduccion`, `certificaciones`, `archivo`) VALUES
(2, 'Amador', 'Peralta', NULL, NULL, NULL, NULL),
(3, 'Alejandra', 'Pineda', NULL, NULL, NULL, NULL),
(7, 'Brenda', 'Retamozo Merino', 'Quechua', 'Ingles', NULL, 'uploads/traductores/1790698950_Captura de pantalla (475).png'),
(9, 'Luis', 'Quispe', 'Castellano', 'Frances', 12, 'uploads/traductores/1790698931_Captura de pantalla (474).png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`ID_autores`);

--
-- Indices de la tabla `editores`
--
ALTER TABLE `editores`
  ADD PRIMARY KEY (`ID_editores`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`ID_libro`),
  ADD KEY `ID_autor` (`ID_autor`),
  ADD KEY `ID_editor` (`ID_editor`),
  ADD KEY `ID_traductor` (`ID_traductor`);

--
-- Indices de la tabla `traductores`
--
ALTER TABLE `traductores`
  ADD PRIMARY KEY (`ID_traductores`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `ID_autores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `editores`
--
ALTER TABLE `editores`
  MODIFY `ID_editores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `ID_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `traductores`
--
ALTER TABLE `traductores`
  MODIFY `ID_traductores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`ID_autor`) REFERENCES `autores` (`ID_autores`),
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`ID_editor`) REFERENCES `editores` (`ID_editores`),
  ADD CONSTRAINT `libros_ibfk_3` FOREIGN KEY (`ID_traductor`) REFERENCES `traductores` (`ID_traductores`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
