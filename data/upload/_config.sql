/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.1.53-community : Database - jurandir
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jurandir` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `jur_configuracoes` */



CREATE TABLE `jur_configuracoes` (
  `conf_idConfiguracao` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conf_formaEnvioEmail` enum('SMTP','MAIL') COLLATE latin1_general_ci NOT NULL DEFAULT 'SMTP',
  `conf_servidorEmail` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `conf_portaEmail` int(10) DEFAULT NULL,
  `conf_nomeRemetente` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `conf_emailRemetente` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `conf_senhaEmail` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `conf_replyTo` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `conf_emailFaleConosco` text COLLATE latin1_general_ci NOT NULL,
  `conf_emailRepresentante` text COLLATE latin1_general_ci NOT NULL,
  `conf_emailMaisInformacoes` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`conf_idConfiguracao`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `jur_configuracoes` */

insert  into `jur_configuracoes`(`conf_idConfiguracao`,`conf_formaEnvioEmail`,`conf_servidorEmail`,`conf_portaEmail`,`conf_nomeRemetente`,`conf_emailRemetente`,`conf_senhaEmail`,`conf_replyTo`,`conf_emailFaleConosco`,`conf_emailRepresentante`,`conf_emailMaisInformacoes`) values (1,'SMTP','smtp.cadastroweb.com.br',587,'Teleatlantic','testedesenvolvimento@cadastroweb.com.br','teste123','testedesenvolvimento@cadastroweb.com.br','[{\"fale_id\":1,\"fale_departamento\":\"Teste\",\"fale_email\":\"jurandir.junior@vm2.com.br\"},{\"fale_id\":2,\"fale_departamento\":\"Teste 2\",\"fale_email\":\"rodri@vm2.com.br\"}]','[{\"representante_email\":\"tiago@vm2.com.br\"},{\"representante_email\":\"alexandre@vm2.com.br\"},{\"representante_email\":\"rodrigo.lacerda@vm2.com.br\"}]','[{\"maisinformacoes_id\":1,\"maisinformacoes_servicos\":\"Rastreamento de Veiculos\",\"maisinformacoes_email\":\"tiago@vm2.com.br\"},{\"maisinformacoes_id\":2,\"maisinformacoes_servicos\":\"Monitoramento de Alarme\",\"maisinformacoes_email\":\"tiago@vm2.com.br\"},{\"maisinformacoes_id\":3,\"maisinformacoes_servicos\":\"Monitoramento de câmera\",\"maisinformacoes_email\":\"tiago@vm2.com.br\"},{\"maisinformacoes_id\":4,\"maisinformacoes_servicos\":\"Projeto Especial\",\"maisinformacoes_email\":\"tiago@vm2.com.br\"}]');

/*Table structure for table `jur_fale` */


CREATE TABLE `jur_fale` (
  `fale_id` int(11) NOT NULL AUTO_INCREMENT,
  `fale_nome` varchar(50) DEFAULT NULL,
  `fale_email` varchar(40) DEFAULT NULL,
  `fale_telefone` varchar(20) DEFAULT NULL,
  `fale_cep` varchar(10) DEFAULT NULL,
  `fale_endereco` varchar(30) DEFAULT NULL,
  `fale_numero` varchar(10) DEFAULT NULL,
  `fale_bairro` varchar(30) DEFAULT NULL,
  `fale_uf` varchar(10) DEFAULT NULL,
  `fale_complemento` varchar(50) DEFAULT NULL,
  `fale_mensagem` text,
  `fale_empresa` varchar(20) DEFAULT NULL,
  `fale_departamento` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`fale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `jur_fale` */

insert  into `jur_fale`(`fale_id`,`fale_nome`,`fale_email`,`fale_telefone`,`fale_cep`,`fale_endereco`,`fale_numero`,`fale_bairro`,`fale_uf`,`fale_complemento`,`fale_mensagem`,`fale_empresa`,`fale_departamento`) values (1,'jura teste','dacol_era360@hotmail.com','(11) 3235346646','06455-000','alameda rio negro','22','alphaville','PE','centro comercial alphaville','sadvsadgbsdgbsdbg\r\nasdgfvasdghsdg\r\nsdagsdgsdgs\r\nsgsdgsdgsdg\r\n','vm2','Teste');

/*Table structure for table `jur_faq` */


CREATE TABLE `jur_faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_pergunta` varchar(100) DEFAULT NULL,
  `faq_resposta` varchar(100) DEFAULT NULL,
  `faq_ordem` int(11) DEFAULT NULL,
  `faq_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `jur_faq` */

insert  into `jur_faq`(`faq_id`,`faq_pergunta`,`faq_resposta`,`faq_ordem`,`faq_status`) values (1,'pergunta 1','resposta 1',1,1),(2,'pergunta 2','resposta 2',7,1),(3,'pergunta 3','resposta 3',12,1),(4,'nova pergunta feita','nova resposta editada',2,1),(6,'Porque o xtjs é tão dificil?','Porque nada facil vale a pena no final das contas!!!',2,1);

/*Table structure for table `jur_galerias` */



CREATE TABLE `jur_galerias` (
  `gal_idGaleria` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gal_idGaleriaPai` varchar(10) DEFAULT NULL,
  `gal_nome` varchar(60) NOT NULL,
  PRIMARY KEY (`gal_idGaleria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `jur_galerias` */

insert  into `jur_galerias`(`gal_idGaleria`,`gal_idGaleriaPai`,`gal_nome`) values (3,'noticias','antigas');

/*Table structure for table `jur_galerias_arquivos` */



CREATE TABLE `jur_galerias_arquivos` (
  `gal_arq_idArquivo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gal_arq_idGaleria` varchar(10) NOT NULL,
  `gal_arq_nome` varchar(60) NOT NULL DEFAULT '',
  `gal_arq_data` datetime NOT NULL,
  PRIMARY KEY (`gal_arq_idArquivo`),
  KEY `FK_sigvaris_gal_arq_idGaleria` (`gal_arq_idGaleria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `jur_galerias_arquivos` */

insert  into `jur_galerias_arquivos`(`gal_arq_idArquivo`,`gal_arq_idGaleria`,`gal_arq_nome`,`gal_arq_data`) values (8,'noticias','desert.jpg','2014-07-16 12:19:11'),(9,'noticias','jellyfish.jpg','2014-07-16 12:19:12'),(10,'3','tulips.jpg','2014-07-16 12:19:45'),(11,'noticias','koala.jpg','2014-07-16 12:27:02');

/*Table structure for table `jur_noticias` */


CREATE TABLE `jur_noticias` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `not_data` datetime DEFAULT NULL,
  `not_titulo` varchar(30) DEFAULT NULL,
  `not_texto` text,
  `not_status` tinyint(4) DEFAULT NULL,
  `not_idImagem` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`not_id`),
  KEY `FK_not_idImagem` (`not_idImagem`),
  CONSTRAINT `FK_not_idImagem` FOREIGN KEY (`not_idImagem`) REFERENCES `jur_galerias_arquivos` (`gal_arq_idArquivo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `jur_noticias` */

insert  into `jur_noticias`(`not_id`,`not_data`,`not_titulo`,`not_texto`,`not_status`,`not_idImagem`) values (4,'2014-07-16 00:00:00','agua viva','Água Viva é uma telenovela brasileira produzida pela Rede Globo e exibida de 4 de fevereiro a 8 de agosto de 1980',1,9),(5,'2014-07-16 00:00:00','coala','O coala é um mamífero marsupial da família Phascolarctidae endêmico da Austrália. Originalmente era encontrado do norte de Queensland até o extremo sudeste da Austrália Meridional.',1,11);

/*Table structure for table `jur_sis_modulos` */

CREATE TABLE `jur_sis_modulos` (
  `mod_idModulo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mod_nome` varchar(50) NOT NULL,
  `mod_rotulo` varchar(50) NOT NULL,
  PRIMARY KEY (`mod_idModulo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `jur_sis_modulos` */

insert  into `jur_sis_modulos`(`mod_idModulo`,`mod_nome`,`mod_rotulo`) values (1,'sistema_usuarios','Perfis e Usuários'),(2,'sistema_configuracoes','Configurações Gerais'),(3,'imprensas','Imprensa'),(5,'htmls','HTMLs');

/*Table structure for table `jur_sis_modulos_acoes` */


CREATE TABLE `jur_sis_modulos_acoes` (
  `mod_acao_idAcao` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mod_acao_idModulo` int(11) unsigned NOT NULL,
  `mod_acao_nome` varchar(60) NOT NULL,
  `mod_acao_rotulo` varchar(60) NOT NULL,
  PRIMARY KEY (`mod_acao_idAcao`),
  KEY `FK_mod_acao_idModulo` (`mod_acao_idModulo`),
  CONSTRAINT `CSC_mod_acao_idModulo` FOREIGN KEY (`mod_acao_idModulo`) REFERENCES `jur_sis_modulos` (`mod_idModulo`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `jur_sis_modulos_acoes` */

insert  into `jur_sis_modulos_acoes`(`mod_acao_idAcao`,`mod_acao_idModulo`,`mod_acao_nome`,`mod_acao_rotulo`) values (1,1,'index','Listar perfis e usuários'),(2,1,'perfil-insert','Inserir Perfil'),(3,1,'perfil-update','Editar Perfil'),(4,1,'perfil-delete','Remover Perfil'),(5,1,'usuario-insert','Inserir Usuário'),(6,1,'usuario-update','Editar Usuário'),(7,1,'usuario-delete','Remover Usuário'),(8,1,'perfil-grant-perms','Atribuir permissões ao Perfil'),(9,2,'index','Editar Configurações Gerais'),(10,3,'index','Listar Notícias'),(11,3,'insert','Inserir Notícia'),(12,3,'update','Editar Notícia'),(13,3,'delete','Remover Notícia'),(18,5,'index','Listar HTMLs'),(19,5,'update','Editar HTML'),(20,5,'update-config','Configurações da Página'),(21,5,'delete','Remover HTML');

/*Table structure for table `jur_sis_perfis` */



CREATE TABLE `jur_sis_perfis` (
  `per_idPerfil` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `per_nome` varchar(40) NOT NULL,
  PRIMARY KEY (`per_idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `jur_sis_perfis` */

insert  into `jur_sis_perfis`(`per_idPerfil`,`per_nome`) values (1,'Administrador');

/*Table structure for table `jur_sis_permissoes` */


CREATE TABLE `jur_sis_permissoes` (
  `perm_idPerfil` int(11) unsigned NOT NULL,
  `perm_idAcao` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_idPerfil`,`perm_idAcao`),
  KEY `FK_perm_idPerfil` (`perm_idPerfil`),
  KEY `FK_perm_idAcao` (`perm_idAcao`),
  CONSTRAINT `CSC_perm_idAcao` FOREIGN KEY (`perm_idAcao`) REFERENCES `jur_sis_modulos_acoes` (`mod_acao_idAcao`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `CSC_perm_idPerfil` FOREIGN KEY (`perm_idPerfil`) REFERENCES `jur_sis_perfis` (`per_idPerfil`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jur_sis_permissoes` */

insert  into `jur_sis_permissoes`(`perm_idPerfil`,`perm_idAcao`) values (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,18),(1,19),(1,20),(1,21);

/*Table structure for table `jur_sis_usuarios` */


CREATE TABLE `jur_sis_usuarios` (
  `usr_idUsuario` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usr_idPerfil` int(11) unsigned NOT NULL,
  `usr_login` varchar(15) NOT NULL,
  `usr_senha` varchar(32) NOT NULL,
  `usr_nome` varchar(60) NOT NULL,
  `usr_email` varchar(60) NOT NULL,
  `usr_status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`usr_idUsuario`),
  UNIQUE KEY `IDX_usr_login` (`usr_login`),
  KEY `FK_usr_idPerfil` (`usr_idPerfil`),
  CONSTRAINT `CSC_usr_idPerfil` FOREIGN KEY (`usr_idPerfil`) REFERENCES `jur_sis_perfis` (`per_idPerfil`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `jur_sis_usuarios` */

insert  into `jur_sis_usuarios`(`usr_idUsuario`,`usr_idPerfil`,`usr_login`,`usr_senha`,`usr_nome`,`usr_email`,`usr_status`) values (1,1,'teleatlantic','xtelevm2','Administrador','diordi.yamada@vm2.com.br',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
