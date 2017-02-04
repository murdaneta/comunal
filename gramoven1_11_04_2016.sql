-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2016 at 07:40 AM
-- Server version: 5.5.46-0+deb8u1
-- PHP Version: 5.6.14-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gramoven1`
--

-- --------------------------------------------------------

--
-- Table structure for table `economias`
--

CREATE TABLE IF NOT EXISTS `economias` (
  `actividad_economica` varchar(2) NOT NULL,
  `id_familia` int(11) NOT NULL,
  `descripcion_ventas` text NOT NULL,
  `ingreso_familiar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `economias`
--

INSERT INTO `economias` (`actividad_economica`, `id_familia`, `descripcion_ventas`, `ingreso_familiar`) VALUES
('Si', 1, 'Mangos', '2.000.0001 y mÃ¡s'),
('Si', 2, 's', '200.001 a 600.000'),
('Si', 3, '444', 'Menos de 200.000');

-- --------------------------------------------------------

--
-- Table structure for table `familiares`
--

CREATE TABLE IF NOT EXISTS `familiares` (
  `id_familia` int(11) NOT NULL,
  `id_familiar` int(11) NOT NULL,
  `parentesco` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `familias`
--

CREATE TABLE IF NOT EXISTS `familias` (
`id` int(11) NOT NULL,
  `id_jefe` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `familias`
--

INSERT INTO `familias` (`id`, `id_jefe`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `familia_vivienda`
--

CREATE TABLE IF NOT EXISTS `familia_vivienda` (
  `id_familia` int(11) NOT NULL,
  `id_vivienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `familia_vivienda`
--

INSERT INTO `familia_vivienda` (`id_familia`, `id_vivienda`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `habitantes`
--

CREATE TABLE IF NOT EXISTS `habitantes` (
`id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(30) NOT NULL,
  `cne` varchar(2) NOT NULL,
  `tiempo_comunidad` date DEFAULT NULL,
  `sexo` varchar(50) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `discapacidad` char(2) NOT NULL,
  `tipo_discapacidad` varchar(200) NOT NULL,
  `pension` char(2) NOT NULL,
  `institucion_nombre` varchar(200) NOT NULL,
  `celular` varchar(14) DEFAULT NULL,
  `telefono_habitacion` varchar(14) DEFAULT NULL,
  `telefono_oficina` varchar(14) DEFAULT NULL,
  `estado_civil` varchar(50) NOT NULL,
  `nivel_instruccion` varchar(50) NOT NULL,
  `oficio` varchar(200) NOT NULL,
  `trabaja` char(2) NOT NULL,
  `lugar_trabajo` varchar(200) NOT NULL,
  `ingreso_mensual` varchar(50) NOT NULL,
  `diario` varchar(50) NOT NULL,
  `semanal` varchar(50) NOT NULL,
  `quincenal` varchar(50) NOT NULL,
  `mensual` varchar(50) NOT NULL,
  `por_trabajo_realizado` varchar(50) NOT NULL,
  `cancer` varchar(20) NOT NULL,
  `diabetes` varchar(20) NOT NULL,
  `sida` varchar(20) NOT NULL,
  `tuberculosis` varchar(20) NOT NULL,
  `hipertension` varchar(20) NOT NULL,
  `asma` varchar(20) NOT NULL,
  `otra_enfermedad` text NOT NULL,
  `ayuda_enfermedad` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `habitantes`
--

INSERT INTO `habitantes` (`id`, `nombre`, `apellido`, `cedula`, `fecha_nacimiento`, `nacionalidad`, `cne`, `tiempo_comunidad`, `sexo`, `correo`, `discapacidad`, `tipo_discapacidad`, `pension`, `institucion_nombre`, `celular`, `telefono_habitacion`, `telefono_oficina`, `estado_civil`, `nivel_instruccion`, `oficio`, `trabaja`, `lugar_trabajo`, `ingreso_mensual`, `diario`, `semanal`, `quincenal`, `mensual`, `por_trabajo_realizado`, `cancer`, `diabetes`, `sida`, `tuberculosis`, `hipertension`, `asma`, `otra_enfermedad`, `ayuda_enfermedad`) VALUES
(1, 'Moises David', 'Urdaneta Barrios', '22449032', '1992-04-20', 'Venezolano', 'Si', '2015-03-13', 'Masculino', '', 'No', 'Ninguna Discapacidad', 'No', 'Ninguna institucion', '04267685388', '02617568889', '0261-7568889', 'Soltero(a)', 'Basica', 'Programador', 'Si', 'Zuliatec', '27.000', '', '', 'Quincenal', 'Mensual', '', '', '', '', '', '', '', '', ''),
(2, 'Gloria', 'Bastista', '1234567', '2016-03-10', 'Venezolano', '', '2016-02-01', 'Femenino', '', '', '', '', '', '04267685388', NULL, NULL, 'Casado(a)', 'Basica', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'Rosio', 'Zabala', '12345678', '2016-03-23', 'Venezolano', '', NULL, 'Femenino', '', '', '', '', '', '04267685388', NULL, NULL, 'Casado(a)', 'Basica', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `aguas_blancas` varchar(20) NOT NULL,
  `id_vivienda` int(11) NOT NULL,
  `tanque` varchar(2) NOT NULL,
  `pipotes` varchar(2) NOT NULL,
  `medidor_agua` varchar(2) NOT NULL,
  `domiciliaria_servicio` varchar(20) NOT NULL,
  `celular_servicio` varchar(20) NOT NULL,
  `prepago_servicio` varchar(20) NOT NULL,
  `centro_conexion` varchar(20) NOT NULL,
  `agua_servida` varchar(20) NOT NULL,
  `propio_transporte` varchar(15) NOT NULL,
  `publico_transporte` varchar(15) NOT NULL,
  `bestias_transporte` varchar(15) NOT NULL,
  `privado_transporte` varchar(15) NOT NULL,
  `otros_transporte` varchar(15) NOT NULL,
  `bombona` varchar(11) NOT NULL,
  `tuberia` varchar(11) NOT NULL,
  `no_posee` varchar(11) NOT NULL,
  `television` varchar(11) NOT NULL,
  `radio` varchar(11) NOT NULL,
  `prensa` varchar(11) NOT NULL,
  `internet` varchar(11) NOT NULL,
  `alternativo` varchar(35) NOT NULL,
  `otros_mecanismo` varchar(5) NOT NULL,
  `publico_electricidad` varchar(11) NOT NULL,
  `planta_electrica` varchar(25) NOT NULL,
  `medidor_electrico` varchar(2) NOT NULL,
  `bombillos_ahorradores` varchar(2) NOT NULL,
  `cantidad_bombillos_necesarios` int(11) NOT NULL,
  `aseo_urbano` varchar(15) NOT NULL,
  `contaner` varchar(15) NOT NULL,
  `bajante` varchar(15) NOT NULL,
  `camion` varchar(15) NOT NULL,
  `al_aire_libre` varchar(15) NOT NULL,
  `quemada` varchar(11) NOT NULL,
  `otros_recoleccion` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicios`
--

INSERT INTO `servicios` (`aguas_blancas`, `id_vivienda`, `tanque`, `pipotes`, `medidor_agua`, `domiciliaria_servicio`, `celular_servicio`, `prepago_servicio`, `centro_conexion`, `agua_servida`, `propio_transporte`, `publico_transporte`, `bestias_transporte`, `privado_transporte`, `otros_transporte`, `bombona`, `tuberia`, `no_posee`, `television`, `radio`, `prensa`, `internet`, `alternativo`, `otros_mecanismo`, `publico_electricidad`, `planta_electrica`, `medidor_electrico`, `bombillos_ahorradores`, `cantidad_bombillos_necesarios`, `aseo_urbano`, `contaner`, `bajante`, `camion`, `al_aire_libre`, `quemada`, `otros_recoleccion`) VALUES
('Acueducto', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Radio', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', ''),
('Acueducto', 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Otros', '', '', '', '', 0, '', '', '', '', '', '', ''),
('Acueducto', 3, 'Si', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Internet', '', '', '', '', '', '', 0, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `viviendas`
--

CREATE TABLE IF NOT EXISTS `viviendas` (
`id` int(11) NOT NULL,
  `numero_vivienda` varchar(100) NOT NULL,
  `condicion` varchar(50) NOT NULL,
  `tenencia` varchar(50) NOT NULL,
  `tipo_vivienda` varchar(50) NOT NULL,
  `sala_habitacion` varchar(10) NOT NULL,
  `comedor_habitacion` varchar(10) NOT NULL,
  `cocina_habitacion` varchar(10) NOT NULL,
  `bano_habitacion` varchar(10) NOT NULL,
  `cantidad_habitaciones` int(11) DEFAULT NULL,
  `OCV` varchar(2) NOT NULL,
  `terreno_propio` varchar(2) NOT NULL,
  `frisadas` varchar(20) NOT NULL,
  `sin_frisar` varchar(20) NOT NULL,
  `tablas` varchar(20) NOT NULL,
  `bahareque` varchar(20) NOT NULL,
  `zinc_paredes` varchar(20) NOT NULL,
  `carton_Piedra` varchar(20) NOT NULL,
  `platabanda` varchar(20) NOT NULL,
  `asbesto` varchar(20) NOT NULL,
  `teja` varchar(20) NOT NULL,
  `zinc_techo` varchar(20) NOT NULL,
  `machihembrado` varchar(20) NOT NULL,
  `techo_raso` varchar(20) NOT NULL,
  `SIVIH` varchar(2) NOT NULL,
  `constancia_inscripcion` varchar(200) NOT NULL,
  `cotiza_ley_habitacional` varchar(2) NOT NULL,
  `nevera` varchar(6) NOT NULL,
  `cocina` varchar(6) NOT NULL,
  `gabinete` varchar(10) NOT NULL,
  `camas` varchar(6) NOT NULL,
  `aire` varchar(19) NOT NULL,
  `ventilador` varchar(15) NOT NULL,
  `juego_comedor` varchar(20) NOT NULL,
  `muebles_sala` varchar(20) NOT NULL,
  `utensilios_cocina` varchar(25) NOT NULL,
  `tv` varchar(4) NOT NULL,
  `slubridad_vivienda` varchar(15) NOT NULL,
  `ayuda_mejora` varchar(20) NOT NULL,
  `moscas` varchar(10) NOT NULL,
  `hormigas` varchar(10) NOT NULL,
  `ratones` varchar(10) NOT NULL,
  `cucarachas` varchar(15) NOT NULL,
  `ciempies` varchar(10) NOT NULL,
  `perro` varchar(5) NOT NULL,
  `gato` varchar(4) NOT NULL,
  `pajaros` varchar(10) NOT NULL,
  `gallinas` varchar(10) NOT NULL,
  `patos` varchar(6) NOT NULL,
  `cochinos` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `viviendas`
--

INSERT INTO `viviendas` (`id`, `numero_vivienda`, `condicion`, `tenencia`, `tipo_vivienda`, `sala_habitacion`, `comedor_habitacion`, `cocina_habitacion`, `bano_habitacion`, `cantidad_habitaciones`, `OCV`, `terreno_propio`, `frisadas`, `sin_frisar`, `tablas`, `bahareque`, `zinc_paredes`, `carton_Piedra`, `platabanda`, `asbesto`, `teja`, `zinc_techo`, `machihembrado`, `techo_raso`, `SIVIH`, `constancia_inscripcion`, `cotiza_ley_habitacional`, `nevera`, `cocina`, `gabinete`, `camas`, `aire`, `ventilador`, `juego_comedor`, `muebles_sala`, `utensilios_cocina`, `tv`, `slubridad_vivienda`, `ayuda_mejora`, `moscas`, `hormigas`, `ratones`, `cucarachas`, `ciempies`, `perro`, `gato`, `pajaros`, `gallinas`, `patos`, `cochinos`) VALUES
(1, '15-63', 'Estable', 'Propia', 'Quinta', 'Sala', '', '', '', 14, 'Si', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Nevera', 'Cocina', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, '15', 'Alto Riesgo', 'Alquilada', 'Casa', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, '156', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Si', '', '', '', 'Cocina', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `economias`
--
ALTER TABLE `economias`
 ADD UNIQUE KEY `id_familia` (`id_familia`);

--
-- Indexes for table `familiares`
--
ALTER TABLE `familiares`
 ADD UNIQUE KEY `id_familia` (`id_familia`,`id_familiar`), ADD KEY `id_familiar` (`id_familiar`);

--
-- Indexes for table `familias`
--
ALTER TABLE `familias`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_jefe` (`id_jefe`);

--
-- Indexes for table `familia_vivienda`
--
ALTER TABLE `familia_vivienda`
 ADD UNIQUE KEY `id_familia` (`id_familia`,`id_vivienda`), ADD KEY `id_vivienda` (`id_vivienda`);

--
-- Indexes for table `habitantes`
--
ALTER TABLE `habitantes`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indexes for table `servicios`
--
ALTER TABLE `servicios`
 ADD UNIQUE KEY `id_vivienda` (`id_vivienda`);

--
-- Indexes for table `viviendas`
--
ALTER TABLE `viviendas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `numero_vivienda` (`numero_vivienda`), ADD UNIQUE KEY `numero_vivienda_2` (`numero_vivienda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `familias`
--
ALTER TABLE `familias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `habitantes`
--
ALTER TABLE `habitantes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `viviendas`
--
ALTER TABLE `viviendas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `economias`
--
ALTER TABLE `economias`
ADD CONSTRAINT `economias_ibfk_1` FOREIGN KEY (`id_familia`) REFERENCES `familias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `familiares`
--
ALTER TABLE `familiares`
ADD CONSTRAINT `familiares_ibfk_3` FOREIGN KEY (`id_familia`) REFERENCES `familias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `familiares_ibfk_4` FOREIGN KEY (`id_familiar`) REFERENCES `habitantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `familias`
--
ALTER TABLE `familias`
ADD CONSTRAINT `familias_ibfk_1` FOREIGN KEY (`id_jefe`) REFERENCES `habitantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `familia_vivienda`
--
ALTER TABLE `familia_vivienda`
ADD CONSTRAINT `familia_vivienda_ibfk_3` FOREIGN KEY (`id_familia`) REFERENCES `familias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `familia_vivienda_ibfk_4` FOREIGN KEY (`id_vivienda`) REFERENCES `viviendas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `servicios`
--
ALTER TABLE `servicios`
ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `viviendas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
