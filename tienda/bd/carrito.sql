-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 20, 2021 at 06:24 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrito`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(200) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `imagen2` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `imagen`, `nombre`, `imagen2`) VALUES
(1, '1610753780.jpg', 'banner 1', '1610752820.jpg'),
(2, '1610752842.jpg', 'banner 2', '1610752842.jpg'),
(3, '1610752858.jpg', 'banner 3', '1610752858.jpg'),
(4, '1610752880.jpg', 'banner 4', '1610752880.jpg'),
(5, '1610752897.jpg', 'banner 5', '1610752897.jpg'),
(6, '1610752916.jpg', 'banner 6', '1610752916.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `imagen` varchar(400) NOT NULL,
  `detalle1` text NOT NULL,
  `detalle2` text NOT NULL,
  `detalle3` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `imagen`, `detalle1`, `detalle2`, `detalle3`) VALUES
(1, 'Boxers', 'Boxers para Hombres', 'azulmarino001.png', '', '', ''),
(2, 'Medias', 'Medias para Hombres', 'medias001.png', '', '', ''),
(3, 'Polos', 'Polos Unisex', 'polos001.png', '', '', ''),
(4, 'vividi', 'vividi hombres', '1607903369.png', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `colores`
--

DROP TABLE IF EXISTS `colores`;
CREATE TABLE IF NOT EXISTS `colores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(50) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colores`
--

INSERT INTO `colores` (`id`, `color`, `codigo`) VALUES
(2, 'Azul', '#00f'),
(4, 'Negro', '#000'),
(7, 'Verde/Botella', '#2a461e'),
(8, 'Blanco', '#ffffff'),
(9, 'vino', '#a74949'),
(10, 'Turquesa', '#67c6ee'),
(11, 'Gris', '#989898');

-- --------------------------------------------------------

--
-- Table structure for table `cupones`
--

DROP TABLE IF EXISTS `cupones`;
CREATE TABLE IF NOT EXISTS `cupones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `valor` varchar(50) NOT NULL,
  `fecha_vencimiento` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cupones`
--

INSERT INTO `cupones` (`id`, `codigo`, `status`, `tipo`, `valor`, `fecha_vencimiento`) VALUES
(1, '4469101648', 'usado', 'porcentaje', '50', '2020-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `envios`
--

DROP TABLE IF EXISTS `envios`;
CREATE TABLE IF NOT EXISTS `envios` (
  `id_envio` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `id_venta` int(11) NOT NULL,
  PRIMARY KEY (`id_envio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

DROP TABLE IF EXISTS `fotos`;
CREATE TABLE IF NOT EXISTS `fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(200) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fotos`
--

INSERT INTO `fotos` (`id`, `imagen`, `nombre`) VALUES
(1, '1610754241.jpg', 'Short 1'),
(2, '1610753864.jpg', 'Short 2'),
(3, '1610753874.jpg', 'Short 3'),
(4, '1610753890.jpg', 'Short 4'),
(5, '1610753899.jpg', 'Short 5'),
(6, '1610753913.jpg', 'Short 6'),
(7, '1610753926.jpg', 'Short 7'),
(8, '1610753955.jpg', 'Short 8'),
(9, '1610753968.jpg', 'Short 9');

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metodo` varchar(50) NOT NULL,
  `id_venta` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`id`, `metodo`, `id_venta`) VALUES
(1, 'paypal', 48),
(2, 'paypal', 110),
(3, 'paypal', 111),
(4, 'paypal', 114),
(5, 'transferencia', 117),
(6, 'transferencia', 118),
(7, 'transferencia', 118),
(8, 'transferencia', 119),
(9, 'transferencia', 120),
(10, 'transferencia', 121),
(11, 'transferencia', 122),
(12, 'transferencia', 123),
(13, 'transferencia', 124),
(14, 'transferencia', 125),
(15, 'transferencia', 126),
(16, 'transferencia', 127),
(17, 'transferencia', 128),
(18, 'transferencia', 129),
(19, 'transferencia', 130),
(20, 'transferencia', 131),
(21, 'transferencia', 132),
(22, 'transferencia', 350);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` double NOT NULL,
  `precio_oferta` double NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `inventario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `talla` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `imagen2` varchar(200) NOT NULL,
  `indice` int(11) NOT NULL,
  `nuevo` varchar(10) NOT NULL,
  `url` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `precio_oferta`, `imagen`, `inventario`, `id_categoria`, `talla`, `color`, `imagen2`, `indice`, `nuevo`, `url`) VALUES
(72, 'Medias ', 'Deportivas taloneras ', 20, 24, '1607890172.png', 49, 2, 'Medium', 'blanco', '1607890172.png', 2, '0', 'medias'),
(73, 'Medias ', 'Deportivas taloneras', 20, 24, '1607890427.png', 47, 2, 'Medium', 'Negro', '1607890427.png', 10, '0', 'medias'),
(74, 'Medias ', 'Deportivas taloneras', 20, 24, '1607890506.png', 48, 2, 'Medium', 'coral', '1607890506.png', 10, '0', 'medias'),
(75, 'Medias ', 'Deportivas taloneras', 20, 24, '1607890568.png', 50, 2, 'Medium', 'gris', '1607890568.png', 10, '0', 'medias'),
(76, 'Boxer Caritas', 'Boxers ', 18, 22, '1607900605.png', 50, 1, 'Small,Medium,Large', 'Azul, caritas', '1607900605.png', 10, '0', 'boxer-caritas'),
(77, 'Boxer Skull', 'Boxers ', 18, 22, '1607900718.png', 50, 1, 'Small,Medium,Large', 'azul', '1607900718.png', 10, '0', 'boxer-skull'),
(78, 'Boxer Calavera', 'Boxers ', 18, 22, '1607900933.png', 50, 1, 'Small,Medium,Large', 'azul calavera', '1607900933.png', 10, '0', 'boxer-calavera'),
(79, 'Boxer Botella', 'Boxers ', 18, 22, '1607900974.png', 50, 1, 'Small,Medium,Large', 'azul botella', '1607900974.png', 10, '0', 'boxer-botella'),
(80, 'Boxer Calavera', 'Boxers ', 18, 22, '1607901076.png', 50, 1, 'Small,Medium,Large', 'Blanco', '1607901076.png', 10, '0', 'boxer-calavera'),
(81, 'Boxer Calavera', 'Boxers ', 18, 22, '1607901079.png', 38, 1, 'Small,Medium,Large', 'Blanco', '1607901079.png', 1, '1', 'boxer-calavera'),
(82, 'Boxer Botella', 'Boxers ', 18, 22, '1607901154.png', 50, 1, 'Small,Medium,Large', 'blanco ', '1607901154.png', 10, '0', 'boxer-botella'),
(83, 'Boxer Caritas', 'Boxers ', 18, 22, '1607901228.png', 50, 1, 'Small,Medium,Large', 'blanco', '1607901228.png', 10, '0', 'boxer-caritas'),
(84, 'Boxer Skull', 'Boxers ', 18, 22, '1607901274.png', 50, 1, 'Small,Medium,Large', 'blanco', '1607901274.png', 10, '0', 'boxer-skull'),
(85, 'Boxer Skull', 'Boxers ', 18, 22, '1607901404.png', 50, 1, 'Small,Medium,Large', 'negro botella', '1607901404.png', 10, '0', 'boxer-skull'),
(86, 'Boxer Calavera', 'Boxers ', 18, 22, '1607901500.png', 50, 1, 'Small,Medium,Large', 'negro calavera', '1607901500.png', 10, '0', 'boxer-calavera'),
(88, 'Boxer Botella', 'Boxers ', 18, 22, '1607901572.png', 50, 1, 'Small,Medium,Large', 'negro botella', '1607901572.png', 10, '0', 'boxer-botella'),
(89, 'Boxer Caritas', 'Boxers ', 18, 22, '1607901708.png', 50, 1, 'Small,Medium,Large', 'negro caritas', '1607901708.png', 10, '0', 'boxer-caritas'),
(90, 'Boxer Calavera', 'Boxers ', 18, 22, '1607901787.png', 50, 1, 'Small,Medium,Large', 'vino/rojo/calavera', '1607901787.png', 10, '0', 'boxer-calavera'),
(91, 'Boxer Botella', 'Boxers ', 18, 22, '1607901835.png', 50, 1, 'Small,Medium,Large', 'vino/rojo/botella', '1607901835.png', 10, '0', 'boxer-botella'),
(92, 'Boxer Caritas', 'Boxers ', 18, 22, '1607901901.png', 50, 1, 'Small,Medium,Large', 'vino/rojo/caritas', '1607901901.png', 10, '0', 'boxer-caritas'),
(93, 'Boxer Skull', 'Boxers ', 18, 22, '1607901968.png', 50, 1, 'Small,Medium,Large', 'vino/rojo/skull', '1607901968.png', 10, '0', 'boxer-skull'),
(94, 'Boxer Skull', 'Boxers ', 18, 22, '1607902327.png', 50, 1, 'Small,Medium,Large', ' Turquesa skull', '1607902327.png', 10, '0', 'boxer-skull'),
(95, 'Boxer Botella', 'Boxers ', 18, 22, '1607902377.png', 50, 1, 'Small,Medium,Large', 'Turquesa botella', '1607902377.png', 10, '0', 'boxer-botella'),
(96, 'Boxer Calavera', 'Boxers ', 18, 22, '1607902448.png', 50, 1, 'Small,Medium,Large', 'Turquesa calavera', '1607902448.png', 10, '0', 'boxer-calavera'),
(97, 'Boxer Botella', 'Boxers ', 18, 22, '1607902573.png', 50, 1, 'Small,Medium,Large', 'Verde/Botella', '1607902573.png', 10, '0', 'boxer-botella'),
(98, 'Boxer Caritas', 'Boxers ', 18, 22, '1607902647.png', 50, 1, 'Small,Medium,Large', 'Verde/Caritas', '1607902647.png', 10, '0', 'boxer-caritas'),
(99, 'Boxer Calavera', 'Boxers ', 18, 22, '1607903007.png', 50, 1, 'Small,Medium,Large', 'verde/calavera', '1607903007.png', 10, '0', 'boxer-calavera'),
(100, 'Boxer Skull', 'Boxers ', 18, 22, '1607903047.png', 50, 1, 'Small,Medium,Large', 'verde/skull', '1607903047.png', 3, '0', 'boxer-skull'),
(101, 'Boxer Calavera', 'Boxers ', 18, 22, '1607903428.png', 50, 1, 'Small,Medium,Large', 'gris calavera', '1607903428.png', 10, '0', 'boxer-calavera'),
(102, 'Boxer Caritas', 'Boxers ', 18, 22, '1607903469.png', 50, 1, 'Small,Medium,Large', 'gris caritra', '1607903469.png', 10, '0', 'boxer-caritas'),
(103, 'Boxer Skull', 'Boxers ', 18, 22, '1607903512.png', 50, 1, 'Small,Medium,Large', 'gris skull', '1607903512.png', 10, '0', 'boxer-skull'),
(104, 'Boxer Botella', 'Boxers ', 18, 22, '1607903556.png', 50, 1, 'Small,Medium,Large', 'gris botella', '1607903556.png', 10, '0', 'boxer-botella'),
(105, 'Medias ', 'Deportivas Tobilleras', 20, 24, '1607968407.png', 50, 2, 'Medium', 'Blanco', '1607968407.png', 10, '0', 'medias'),
(106, 'Medias ', 'Deportivas Tobilleras', 20, 24, '1607968500.png', 50, 1, 'Medium', 'coral', '1607968500.png', 10, '0', 'medias'),
(107, 'Medias ', 'Deportivas Tobilleras', 20, 24, '1607968607.png', 50, 2, 'Medium', 'Gris', '1607968607.png', 10, '0', 'medias'),
(108, 'Medias ', 'Deportivas Tobilleras', 20, 24, '1607968638.png', 50, 2, 'Medium', 'Negro', '1607968638.png', 10, '0', 'medias');

-- --------------------------------------------------------

--
-- Table structure for table `productos_venta`
--

DROP TABLE IF EXISTS `productos_venta`;
CREATE TABLE IF NOT EXISTS `productos_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `talla` varchar(100) NOT NULL,
  `cantidad` double NOT NULL,
  `precio` double NOT NULL,
  `subtotal` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=350 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `redes`
--

DROP TABLE IF EXISTS `redes`;
CREATE TABLE IF NOT EXISTS `redes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `link` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redes`
--

INSERT INTO `redes` (`id`, `imagen`, `nombre`, `link`) VALUES
(1, '1610754946.jpg', 'diseÃ±o de medias', 'https://www.facebook.com/FresArtoficial/photos/a.1109530602781814/1154589471609260/'),
(2, '1610755145.jpg', 'face 2', 'https://www.facebook.com/FresArtoficial/photos/a.300179123716970/1154586511609556/'),
(3, '1610755170.jpg', 'insta1', 'https://www.instagram.com/p/CD44-OdFG-O/'),
(4, '1610755192.jpg', 'insta 2', 'https://www.instagram.com/p/CEXX5W3nR3B/'),
(5, '1610755226.jpg', 'instagram', 'https://www.instagram.com/p/CDfrBdoAzgV/'),
(6, '1610755263.jpg', 'face', 'https://www.facebook.com/FresArtoficial/photos/a.1205973619804178/1205973593137514/'),
(7, '1610755297.jpg', 'twit', 'https://twitter.com/fresssart');

-- --------------------------------------------------------

--
-- Table structure for table `tallas`
--

DROP TABLE IF EXISTS `tallas`;
CREATE TABLE IF NOT EXISTS `tallas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `talla` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tallas`
--

INSERT INTO `tallas` (`id`, `talla`) VALUES
(1, 'Extra-Large'),
(2, 'Large'),
(3, 'Medium'),
(4, 'Small');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img_perfil` varchar(300) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `telefono`, `email`, `password`, `img_perfil`, `nivel`) VALUES
(1, 'Jean', 'Cuadros', '940130484', 'bikersprop@gmail.com', 'PxyfhO4RInfUZmP6Z/kNMw==', 'default.jpg', 'admin'),
(2, 'Fredy', 'Cuadros', '989504797', 'fresssart@gmail.com', 'PxyfhO4RInfUZmP6Z/kNMw==', 'default.jpg', 'admin'),
(3, 'Jean ', 'Cuadros', '940130482', 'bikersprop@hotmail.com', 'PxyfhO4RInfUZmP6Z/kNMw==', 'default.jpg', 'cliente'),
(4, 'fres', 'costas', '989504797', 'fredds17@hotmail.com', 'PxyfhO4RInfUZmP6Z/kNMw==', 'default.jpg', 'cliente');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL,
  `id_cupon` int(11) NOT NULL,
  `delibery` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=350 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
