-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2015 at 05:06 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ierp`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE IF NOT EXISTS `emp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) NOT NULL,
  `razao_social` varchar(100) DEFAULT NULL,
  `nome_fantasia` varchar(100) DEFAULT NULL,
  `end_id` int(11) NOT NULL,
  `cnpj` varchar(30) DEFAULT NULL,
  `inscricao_municipal` varchar(40) DEFAULT NULL,
  `inscricao_estadual` varchar(40) DEFAULT NULL,
  `CNAE_principal` varchar(50) DEFAULT NULL,
  `CNAE_secundario` varchar(50) DEFAULT NULL,
  `regime_tributacao` varchar(50) DEFAULT NULL,
  `valor_honorarios` decimal(8,2) DEFAULT NULL,
  `vencimento_honorarios` datetime DEFAULT NULL,
  `vencimento_procuracao_caixa` datetime DEFAULT NULL,
  `vencimento_procuracao_RFB` datetime DEFAULT NULL,
  `certificado_digital` varchar(255) DEFAULT NULL,
  `senha_web` varchar(255) DEFAULT NULL,
  `senha_fazenda` varchar(255) DEFAULT NULL,
  `tipo_empresa` enum('I','C','S') DEFAULT NULL,
  `contrato` varchar(255) DEFAULT NULL,
  `vencimento_contrato` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`id`, `usr_id`, `razao_social`, `nome_fantasia`, `end_id`, `cnpj`, `inscricao_municipal`, `inscricao_estadual`, `CNAE_principal`, `CNAE_secundario`, `regime_tributacao`, `valor_honorarios`, `vencimento_honorarios`, `vencimento_procuracao_caixa`, `vencimento_procuracao_RFB`, `certificado_digital`, `senha_web`, `senha_fazenda`, `tipo_empresa`, `contrato`, `vencimento_contrato`) VALUES
(12, 32, 'empresa teste Ltda', 'Emp teste', 0, '47364938423482308', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 33, 'empresa teste Ltda', 'Emp teste', 0, '47364938423482308', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 34, 'empresa teste Ltda', 'Emp teste', 31, '47364938423482308', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(40) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `estado` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`id`, `logradouro`, `numero`, `complemento`, `municipio`, `cep`, `estado`) VALUES
(29, 'Avenida Pompeia', '234', 'ao lado do estadio do palmeiras', 'são paulo', '12567-008', 'SP'),
(30, 'Avenida Pompeia', '234', 'ao lado do estadio do palmeiras', 'são paulo', '12567-008', 'SP'),
(31, 'Avenida Pompeia', '234', 'ao lado do estadio do palmeiras', 'são paulo', '12567-008', 'SP');

-- --------------------------------------------------------

--
-- Table structure for table `usr`
--

CREATE TABLE IF NOT EXISTS `usr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `origem` enum('C','I') NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `usr`
--

INSERT INTO `usr` (`id`, `data_cadastro`, `email`, `login`, `senha`, `origem`, `status`) VALUES
(32, '2015-08-28 17:23:13', 'joao@contjet.com.br', 'antunes', '3fde6bb0541387e4ebdadf7c2ff31123', 'C', 'A'),
(33, '2015-08-28 19:04:46', 'joao@contjet.com.br', 'antunes', '3fde6bb0541387e4ebdadf7c2ff31123', 'C', 'A'),
(34, '2015-08-28 19:50:05', 'joao@contjet.com.br', 'antunes', '3fde6bb0541387e4ebdadf7c2ff31123', 'C', 'A');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
