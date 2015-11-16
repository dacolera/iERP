-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2015 at 01:38 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

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

CREATE TABLE `emp` (
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
  `vencimento_honorarios` date DEFAULT NULL,
  `vencimento_procuracao_caixa` date DEFAULT NULL,
  `vencimento_procuracao_RFB` date DEFAULT NULL,
  `certificado_digital` varchar(255) DEFAULT NULL,
  `senha_web` varchar(255) DEFAULT NULL,
  `senha_fazenda` varchar(255) DEFAULT NULL,
  `tipo_empresa` enum('I','C','S') DEFAULT NULL,
  `contrato` varchar(255) DEFAULT NULL,
  `vencimento_contrato` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`id`, `usr_id`, `razao_social`, `nome_fantasia`, `end_id`, `cnpj`, `inscricao_municipal`, `inscricao_estadual`, `CNAE_principal`, `CNAE_secundario`, `regime_tributacao`, `valor_honorarios`, `vencimento_honorarios`, `vencimento_procuracao_caixa`, `vencimento_procuracao_RFB`, `certificado_digital`, `senha_web`, `senha_fazenda`, `tipo_empresa`, `contrato`, `vencimento_contrato`) VALUES
(22, 43, 'Contjet LTDA', 'contjet contabilidade e fiscal', 39, '13.124352.546346/0001-23', '3742375627356237', '23521312452718', '3574523842378', '23523478452', 'lucro real', 3457.00, '2015-11-10', '0000-00-00', '0000-00-00', '', '', '', '', '', '0000-00-00'),
(30, 52, 'Termac inc.+', 'Termac comercio de maquinas+', 47, '13.124352.546346/0001-23+', '23586235823658023+', '27461252164128+', '2356239562398+', '238562358263523+', 'lucro presumido+', 3500.01, '2016-03-19', '2015-10-09', '2017-01-09', '24761274ghgjhj947934n+', 'qwerty+', '1q2w3e+', 'C', 'anexo+', '2018-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE `endereco` (
  `end_id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(40) NOT NULL,
  `bairro` varchar(25) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `estado` varchar(10) NOT NULL,
  PRIMARY KEY (`end_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`end_id`, `logradouro`, `numero`, `complemento`, `bairro`, `municipio`, `cep`, `estado`) VALUES
(39, 'rua turiassu', '267', 'proximo a arena palmeiras', 'pompeia', 'São Paulo', '02235-127', 'SP'),
(47, 'avenida paulista+', '267+', 'complemento+', 'cerqueira cesar+', 'Barueri+', '06455-009', 'SP+'),
(50, 'wefggewgwe', 'egewweghwe', '', 'wegwegweg', 'wegwegweg', '13537-000', 'wqfqwt');

-- --------------------------------------------------------

--
-- Table structure for table `usr`
--

CREATE TABLE `usr` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `origem` enum('C','I') NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `usr`
--

INSERT INTO `usr` (`usr_id`, `data_cadastro`, `email`, `login`, `senha`, `origem`, `status`) VALUES
(43, '2015-08-30 02:42:12', 'joao@contjet.com.br', 'antunes', 'e5ceda9e578ccefb0844b51affc3826a', 'C', 'A'),
(52, '2015-08-30 16:19:06', 'clinton+@termac.com', 'jefereson+', '3404d6c0d94fb1faa51c2bdb9e8a293c', 'C', 'A'),
(55, '2015-08-30 04:36:07', 'jurandir.dacol@levitron.com.br', 'antunes', 'de828c9bb83a75d5f1a53b0c88592ad0', 'C', 'S');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
