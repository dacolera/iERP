-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 31, 2015 at 11:20 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `acme`
--

-- --------------------------------------------------------

--
-- Table structure for table `papeis`
--

CREATE TABLE `papeis` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `papeis`
--

INSERT INTO `papeis` (`codigo`, `nome`) VALUES
(1, 'convidado'),
(2, 'funcionario');

-- --------------------------------------------------------

--
-- Table structure for table `papeis_usuario`
--

CREATE TABLE `papeis_usuario` (
  `codigo_papel` int(11) NOT NULL,
  `codigo_usuario` int(11) NOT NULL,
  PRIMARY KEY (`codigo_papel`,`codigo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `papeis_usuario`
--

INSERT INTO `papeis_usuario` (`codigo_papel`, `codigo_usuario`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `recursos`
--

CREATE TABLE `recursos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `recursos`
--

INSERT INTO `recursos` (`codigo`, `nome`) VALUES
(1, 'Contato'),
(2, 'Evento'),
(3, 'Index');

-- --------------------------------------------------------

--
-- Table structure for table `recursos_papel`
--

CREATE TABLE `recursos_papel` (
  `codigo_recurso` int(11) NOT NULL,
  `codigo_papel` int(11) NOT NULL,
  PRIMARY KEY (`codigo_recurso`,`codigo_papel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recursos_papel`
--

INSERT INTO `recursos_papel` (`codigo_recurso`, `codigo_papel`) VALUES
(1, 1),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `nome`, `senha`) VALUES
(1, 'dacolera', '8038da89e49ac5eabb489cfc6cea9fc1'),
(2, 'gustavo', '3fde6bb0541387e4ebdadf7c2ff31123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
