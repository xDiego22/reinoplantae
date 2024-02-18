-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2024 a las 18:31:24
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdplantae`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filogenia`
--

CREATE TABLE `filogenia` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `filogenia`
--

INSERT INTO `filogenia` (`id`, `tipo`) VALUES
(1, 'Angiospermas'),
(2, 'Gimnospermas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitats`
--

CREATE TABLE `habitats` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `habitat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `habitats`
--

INSERT INTO `habitats` (`id`, `tipo`, `habitat`) VALUES
(1, 'Acuatica', 'Agua Dulce'),
(2, 'Acuatica', 'Agua Salada'),
(3, 'Terrestre', 'Desierto'),
(4, 'Terrestre', 'Selva'),
(5, 'Terrestre', 'Tundra'),
(6, 'Terrestre', 'Sabana'),
(7, 'Terrestre', 'Bosque'),
(8, 'Terrestre', 'Pradera'),
(9, 'Terrestre', 'Pantano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inflorescencia`
--

CREATE TABLE `inflorescencia` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inflorescencia`
--

INSERT INTO `inflorescencia` (`id`, `tipo`) VALUES
(1, 'Flotante'),
(2, 'Sumergida'),
(3, 'Espiciforme'),
(4, 'Racemosa'),
(5, 'Cimosa'),
(6, 'Capituliforme');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantas`
--

CREATE TABLE `plantas` (
  `id_planta` int(11) NOT NULL,
  `id_habitat` int(11) NOT NULL,
  `id_reproduccion` int(11) NOT NULL,
  `id_filogenia` int(11) NOT NULL,
  `id_inflorescencia` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `plantas`
--

INSERT INTO `plantas` (`id_planta`, `id_habitat`, `id_reproduccion`, `id_filogenia`, `id_inflorescencia`, `nombre`, `descripcion`) VALUES
(1, 1, 1, 1, 1, 'Lirio de Agua', 'Es una planta acuática con delicadas flores blancas o azules que flotan en la superficie del agua. Sus hojas verdes en forma de corazón también se encuentran en la superficie del agua, proporcionan'),
(2, 2, 4, 1, 2, 'Alga marina', 'Una especie de alga parda que crece en aguas saladas, con tallos ramificados y vesículas llenas de aire que les ayudan a flotar.'),
(3, 3, 3, 1, 4, 'Cactus', 'Una planta suculenta adaptada a climas desérticos, con tallos gruesos y hojas transformadas en espinas.'),
(4, 4, 1, 1, 4, 'Orquídea', 'Una familia de plantas con flores exóticas y variadas, comúnmente encontradas en climas tropicales y selvas.'),
(5, 5, 1, 2, 5, 'Abeto', 'Un árbol de hoja perenne que crece en climas fríos de la tundra, con ramas horizontales y conos erguidos.'),
(6, 6, 1, 1, 5, 'Hierba de la Pampa', 'Una planta herbácea con largas hojas plumosas, nativa de las regiones de sabana y pastizales.'),
(7, 7, 1, 1, 4, 'Roble', 'Un árbol de hoja caduca que prospera en bosques templados y subtropicales, conocido por sus hojas lobuladas y sus frutos llamados bellotas.'),
(8, 8, 1, 1, 6, 'Girasol', 'Una planta anual con flores grandes y brillantes que siguen el movimiento del sol, comúnmente cultivada en praderas y campos agrícolas.'),
(9, 9, 1, 1, 4, 'Manglar', 'Un árbol adaptado a vivir en suelos salinos y anegados, que forma bosques característicos en las zonas costeras tropicales.'),
(10, 5, 1, 1, 4, 'Roble Blanco', 'Árbol de hoja caduca con hojas lobuladas y frutos en forma de bellotas.'),
(11, 4, 3, 2, 3, 'Enebro común', 'Es un arbusto perenne que pertenece a la familia Cupressaceae. Este arbusto es conocido por su resistencia y versatilidad, creciendo en una variedad de condiciones climáticas, desde bosques templados'),
(12, 8, 7, 1, 4, 'Cebolla', 'Una planta herbácea bulbosa, cultivada por sus bulbos comestibles y utilizada en la cocina de todo el mundo.'),
(13, 7, 4, 2, 6, 'Ephedra', 'Son conocidas por sus propiedades medicinales, especialmente por contener alcaloides como la efedrina.'),
(14, 2, 7, 2, 1, 'Posidonia oceánica', 'Planta acuática perenne con largas hojas en forma de cinta.'),
(15, 3, 1, 1, 4, 'Saguaro', 'Un cactus gigante que crece en los desiertos de América del Norte, con brazos ramificados y flores blancas.'),
(16, 1, 5, 2, 2, 'Vallisneria', 'Planta acuática perenne con hojas largas y delgadas.'),
(17, 5, 2, 2, 4, 'Sauce rastrero', 'Pequeño arbusto perenne con hojas verde claro y tallos rastreros.'),
(18, 3, 1, 2, 3, 'Yuca de Mojave', 'Es una planta nativa del desierto de Mojave en América del Norte y pertenece a la familia de las Agavaceae, produce semillas desnudas en lugar de flores verdaderas '),
(19, 9, 1, 1, 6, 'Lirio de Paz', 'Es conocido por su distintiva espata blanca y su capacidad para purificar el aire interior.'),
(20, 6, 1, 1, 4, 'Baobab', 'Un árbol icónico de África con tronco grueso y frutos comestibles, conocido como el \"árbol de la vida\".'),
(21, 7, 4, 1, 5, 'Castaño', 'Estos árboles son conocidos por sus frutos comestibles, las castañas, que son valoradas tanto como alimento humano como para la vida silvestre. Además, la madera de castaño ha sido históricamente'),
(22, 4, 6, 1, 4, 'Plátano', 'Son plantas frutales conocidas por sus grandes racimos de frutas comestibles. Además de su valor alimenticio para los humanos, los plátanos también son importantes en los ecosistemas de selva tropi'),
(23, 7, 1, 2, 3, 'Pino', 'Son árboles icónicos en muchos ecosistemas forestales, conocidos por sus hojas en forma de aguja y sus semillas en forma de piña. Son importantes en la industria maderera y en la conservación del '),
(24, 8, 1, 2, 3, 'Junco Ciperáceo', 'Son conocidas por su aspecto de hierba alta y esbelta, con hojas lineales y tallos sólidos. Tienen una amplia tolerancia a una variedad de condiciones de suelo y agua, lo que las hace bien adaptadas '),
(25, 9, 7, 1, 5, 'Lirio Amarillo', 'Es conocida por sus llamativas flores de color amarillo brillante con manchas marrones o rojizas en los pétalos. Además de su valor estético, el lirio amarillo desempeña un papel importante en los'),
(26, 6, 4, 1, 4, 'Paja Brava', 'Es una planta importante en las sabanas, donde contribuye a la estabilidad del suelo y proporciona alimento para la vida silvestre y el ganado. Además, su capacidad para formar densas coberturas vege'),
(27, 1, 7, 1, 1, 'Jacinto de Agua', 'Es conocido por su rápido crecimiento y capacidad para cubrir grandes áreas de agua. Aunque es valorado por su belleza, puede convertirse en una planta invasora y causar problemas en los ecosistemas'),
(28, 2, 7, 1, 1, 'Zostera marina', 'Es una planta marina fundamental en los ecosistemas costeros, ya que proporciona hábitats importantes para una variedad de especies marinas, ayuda a estabilizar los sedimentos y mejora la calidad del'),
(29, 9, 2, 1, 3, 'Papiro', 'Es conocido por su distintiva apariencia de hierba alta con hojas largas y delgadas. Históricamente, ha sido utilizado por varias culturas para la fabricación de papel, cestería y embarcaciones.'),
(30, 4, 4, 1, 5, 'Palmera de Cera', 'Es conocida por su alto valor ornamental y su cera natural, que se utiliza para diversos fines. Además, es una planta importante para la vida silvestre y contribuye a la biodiversidad de las selvas t');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reproduccion`
--

CREATE TABLE `reproduccion` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reproduccion`
--

INSERT INTO `reproduccion` (`id`, `tipo`, `descripcion`) VALUES
(1, 'Sexual', 'Semilla'),
(2, 'Asexual', 'Division'),
(3, 'Asexual', 'Esquejes'),
(4, 'Sexual', 'Polen'),
(5, 'Sexual', 'Fecundacion'),
(6, 'Asexual', 'Estolones'),
(7, 'Asexual', 'Bulbos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `filogenia`
--
ALTER TABLE `filogenia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habitats`
--
ALTER TABLE `habitats`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inflorescencia`
--
ALTER TABLE `inflorescencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id_planta`),
  ADD KEY `id_habitat` (`id_habitat`),
  ADD KEY `id_reproduccion` (`id_reproduccion`),
  ADD KEY `id_filogenia` (`id_filogenia`),
  ADD KEY `id_inflorescencia` (`id_inflorescencia`);

--
-- Indices de la tabla `reproduccion`
--
ALTER TABLE `reproduccion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habitats`
--
ALTER TABLE `habitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `inflorescencia`
--
ALTER TABLE `inflorescencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `plantas`
--
ALTER TABLE `plantas`
  MODIFY `id_planta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `reproduccion`
--
ALTER TABLE `reproduccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD CONSTRAINT `plantas_ibfk_1` FOREIGN KEY (`id_reproduccion`) REFERENCES `reproduccion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `plantas_ibfk_3` FOREIGN KEY (`id_habitat`) REFERENCES `habitats` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `plantas_ibfk_4` FOREIGN KEY (`id_inflorescencia`) REFERENCES `inflorescencia` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `plantas_ibfk_5` FOREIGN KEY (`id_filogenia`) REFERENCES `filogenia` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
