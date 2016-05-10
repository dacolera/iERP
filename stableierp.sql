-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2015 at 10:01 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`id`, `usr_id`, `razao_social`, `nome_fantasia`, `end_id`, `cnpj`, `inscricao_municipal`, `inscricao_estadual`, `CNAE_principal`, `CNAE_secundario`, `regime_tributacao`, `valor_honorarios`, `vencimento_honorarios`, `vencimento_procuracao_caixa`, `vencimento_procuracao_RFB`, `certificado_digital`, `senha_web`, `senha_fazenda`, `tipo_empresa`, `contrato`, `vencimento_contrato`) VALUES
(28, 49, 'Contjet LTDA', 'contjet contabilidade e fiscal', 45, '26.512.644/7476-12', '24218471298742104', '246128492184720854', '767237470569823985', '736492376497230895', 'lucro real', 23000.00, '2015-12-03', '2016-01-22', '2015-11-20', 'wfqwgwegwg.txt', '1q2w3e', 'qwerty', 'S', '3bff4_interessante!!!.docx', '2015-09-16'),
(39, 60, 'Coffee Digital inc', 'Coffee Digital Internet e Serviços', 56, '24.518.724/6187-26', '787487243-rf', '4r67126-334rf', '6262188-y', '1q63877737-t', 'lucro presumido', 2500.00, '2015-09-15', '2015-09-30', '2015-09-17', 'c89f4_curriculo.docx', '1q2w3e', '2w3e4r5t', 'I', 'c89f4_RImprensa_15-02-2014_sbado_EMBU.doc', '2015-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE `endereco` (
  `end_id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(40) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `estado` varchar(10) NOT NULL,
  PRIMARY KEY (`end_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`end_id`, `logradouro`, `numero`, `complemento`, `bairro`, `municipio`, `cep`, `estado`) VALUES
(45, 'rua turiassu', '267', '', 'pompeia', 'São Paulo', '03676-022', 'SP'),
(46, 'avenida paulista', '1254', 'Edifício Camaçari  Sala 12', 'cerqueira cesar', 'São Paulo', '10023-210', 'SP'),
(47, 'tgqe', 'ewyweyewy', 'weyweyewy', 'weyweywe', 'weyewyew', '02235-127', 'MA'),
(48, 'etwewtwet', 'eywywrywy', 'wryerueryrw', 'erurtueu', 'eruetrure', '12345-022', 'CE'),
(49, 'ewyhwhwyewey', 'weyweyweyw', '', 'weyweywe', 'weyweywey', '02235-127', 'AP'),
(50, 'avenida paulista', '1002', 'condominio Alphaview torre 3 ap 111', 'cerqueira cesar', 'São Paulo', '06414-000', 'SP'),
(51, 'safasgfa', 'assag', 'asgasg', 'asgasgsg', 'asgasasg', '23523-523', 'AM'),
(52, 'dvgwegegw', 'ewgwegwe', 'ewgwegweg', 'wegwegweg', 'wegwegweg', '21412-521', 'AP'),
(53, 'avenida paulista', '1276', '', 'cerqueira cesar', 'São Paulo', '06801-298', 'SP'),
(54, 'avenida paulista', '1276', '', 'cerqueira cesar', 'São Paulo', '06801-298', 'SP'),
(55, 'avenida paulista', '1002', '', 'cerqueira cesar', 'São Paulo', '07754-000', 'SP'),
(56, 'avenida paulista', '267', 'condominio Alphaview torre 3 ap 111', 'cerqueira cesar', 'São Paulo', '12345-678', 'SP');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `usr`
--

INSERT INTO `usr` (`usr_id`, `data_cadastro`, `email`, `login`, `senha`, `origem`, `status`) VALUES
(49, '2015-09-05 18:57:47', 'gustavo@contjet.com.br', 'gustavo', 'd41d8cd98f00b204e9800998ecf8427e', 'C', 'A'),
(50, '2015-09-04 23:29:33', 'dacolera360@gmail.com', 'dacolera', '9275ff1131e4af8d92dbf0af4ea66058', 'C', 'A'),
(51, '2015-09-04 23:55:04', 'clinton@termac.com', 'dsavgadsgasdh', 'e713554972dfc81cbba4ea0cd207f28b', 'C', 'A'),
(52, '2015-09-05 00:02:58', 'teste@teste.com', 'wegweyweyt', 'ee37603c2d61f65173922b13e673b969', 'C', 'A'),
(53, '2015-09-05 00:08:54', 'dacolera360@gmail.com', '34880243850', 'd41d8cd98f00b204e9800998ecf8427e', 'C', 'A'),
(54, '2015-09-05 00:27:58', 'dacolera360@gmail.com', 'dacolera', 'd41d8cd98f00b204e9800998ecf8427e', 'C', 'A'),
(55, '2015-09-05 02:23:47', 'egegee@shjvfbjd.com', 'wqfqwgqw', 'd41d8cd98f00b204e9800998ecf8427e', 'C', 'A'),
(56, '2015-09-05 02:33:00', 'clinton@termac.com', 'egafnshssbh', 'd41d8cd98f00b204e9800998ecf8427e', 'C', 'A'),
(57, '2015-09-05 13:51:31', 'dacolera@coffee.com', 'dacolera', '5bc8971a85d40656f7d17a2e8a9a782a', 'C', 'A'),
(58, '2015-09-05 13:53:04', 'dacolera@coffee.com', 'dacolera', '5bc8971a85d40656f7d17a2e8a9a782a', 'C', 'A'),
(59, '2015-09-05 14:08:45', 'dacolera@coffee.com', 'dacolera', 'd41d8cd98f00b204e9800998ecf8427e', 'C', 'A'),
(60, '2015-09-05 18:38:50', 'dacolera@coffee.com', 'dacolera', 'd41d8cd98f00b204e9800998ecf8427e', 'C', 'A');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
