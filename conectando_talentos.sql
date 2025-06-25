-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.42-0ubuntu0.22.04.1 - (Ubuntu)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para sistema_curriculo
CREATE DATABASE IF NOT EXISTS `sistema_curriculo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sistema_curriculo`;

-- Copiando estrutura para tabela sistema_curriculo.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.cargo: ~0 rows (aproximadamente)
DELETE FROM `cargo`;
INSERT INTO `cargo` (`id`, `descricao`, `statusRegistro`) VALUES
	(1, 'Técnico Administrativo', 1),
	(2, 'Atendente', 1),
	(3, 'Garçom', 1);

-- Copiando estrutura para tabela sistema_curriculo.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.categoria: ~0 rows (aproximadamente)
DELETE FROM `categoria`;
INSERT INTO `categoria` (`id`, `descricao`, `statusRegistro`) VALUES
	(1, 'Empresa Pública', 1),
	(2, 'Serviços de Engenharia', 1);

-- Copiando estrutura para tabela sistema_curriculo.categoria_estabelecimento
CREATE TABLE IF NOT EXISTS `categoria_estabelecimento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` int DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `categoria_estabelecimento_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`id`),
  CONSTRAINT `categoria_estabelecimento_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.categoria_estabelecimento: ~0 rows (aproximadamente)
DELETE FROM `categoria_estabelecimento`;
INSERT INTO `categoria_estabelecimento` (`id`, `estabelecimento_id`, `categoria_id`, `statusRegistro`) VALUES
	(1, NULL, 1, 1);

-- Copiando estrutura para tabela sistema_curriculo.cidade
CREATE TABLE IF NOT EXISTS `cidade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `uf_id` int NOT NULL,
  `codIBGE` varchar(7) NOT NULL,
  `wiki` mediumtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_uf_id` (`nome`,`uf_id`),
  KEY `FK1_cidade_uf_id` (`uf_id`),
  CONSTRAINT `FK1_cidade_uf_id` FOREIGN KEY (`uf_id`) REFERENCES `uf` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistema_curriculo.cidade: ~9 rows (aproximadamente)
DELETE FROM `cidade`;
INSERT INTO `cidade` (`id`, `nome`, `uf_id`, `codIBGE`, `wiki`) VALUES
	(1, 'Muriae', 1, '4648678', '<p>fsdasdfsad</p>');

-- Copiando estrutura para tabela sistema_curriculo.clique_celular
CREATE TABLE IF NOT EXISTS `clique_celular` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` int DEFAULT NULL,
  `visitante_id` int DEFAULT NULL,
  `celular` char(11) DEFAULT NULL,
  `telefone_id` int DEFAULT NULL,
  `data_clique` timestamp NULL DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `telefone_id` (`telefone_id`),
  CONSTRAINT `clique_celular_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`id`),
  CONSTRAINT `clique_celular_ibfk_2` FOREIGN KEY (`telefone_id`) REFERENCES `telefone` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.clique_celular: ~0 rows (aproximadamente)
DELETE FROM `clique_celular`;

-- Copiando estrutura para tabela sistema_curriculo.clique_telefone
CREATE TABLE IF NOT EXISTS `clique_telefone` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` int DEFAULT NULL,
  `visitante_id` int DEFAULT NULL,
  `telefone` char(11) DEFAULT NULL,
  `telefone_id` int DEFAULT NULL,
  `data_clique` timestamp NULL DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `telefone_id` (`telefone_id`),
  CONSTRAINT `clique_telefone_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`id`),
  CONSTRAINT `clique_telefone_ibfk_2` FOREIGN KEY (`telefone_id`) REFERENCES `telefone` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.clique_telefone: ~0 rows (aproximadamente)
DELETE FROM `clique_telefone`;

-- Copiando estrutura para tabela sistema_curriculo.curriculum
CREATE TABLE IF NOT EXISTS `curriculum` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pessoa_fisica_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `logradouro` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `numero` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `complemento` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bairro` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cep` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cidade_id` int NOT NULL,
  `celular` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nascimento` date NOT NULL,
  `sexo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apresentacaoPessoal` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `statusRegistro` int NOT NULL DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `pessoa_fisica_id` (`pessoa_fisica_id`),
  KEY `cidade_id` (`cidade_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `curriculum_ibfk_1` FOREIGN KEY (`pessoa_fisica_id`) REFERENCES `pessoa_fisica` (`id`),
  CONSTRAINT `curriculum_ibfk_2` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`id`),
  CONSTRAINT `curriculum_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.curriculum: ~3 rows (aproximadamente)
DELETE FROM `curriculum`;

-- Copiando estrutura para tabela sistema_curriculo.curriculum_escolaridade
CREATE TABLE IF NOT EXISTS `curriculum_escolaridade` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `curriculum_id` int DEFAULT NULL,
  `inicioAno` int DEFAULT NULL,
  `fimMes` int DEFAULT NULL,
  `fimAno` int DEFAULT NULL,
  `descricao` varchar(60) DEFAULT NULL,
  `instituicao` varchar(60) DEFAULT NULL,
  `cidade_id` int DEFAULT NULL,
  `escolaridade_id` int DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `curriculum_id` (`curriculum_id`),
  KEY `cidade_id` (`cidade_id`),
  KEY `escolaridade_id` (`escolaridade_id`),
  CONSTRAINT `curriculum_escolaridade_ibfk_1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`),
  CONSTRAINT `curriculum_escolaridade_ibfk_2` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`id`),
  CONSTRAINT `curriculum_escolaridade_ibfk_3` FOREIGN KEY (`escolaridade_id`) REFERENCES `escolaridade` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.curriculum_escolaridade: ~12 rows (aproximadamente)
DELETE FROM `curriculum_escolaridade`;
INSERT INTO `curriculum_escolaridade` (`id`, `curriculum_id`, `inicioAno`, `fimMes`, `fimAno`, `descricao`, `instituicao`, `cidade_id`, `escolaridade_id`, `statusRegistro`) VALUES
	(1, 1, 61, 73, 93, 'Nulla velit nemo sin', 'Mollit nemo vel quo ', 1, NULL, 1),
	(2, 2, 68, 48, 33, 'Rerum autem sunt ob', 'Laboris sit architec', 1, NULL, 1);

-- Copiando estrutura para tabela sistema_curriculo.curriculum_experiencia
CREATE TABLE IF NOT EXISTS `curriculum_experiencia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `curriculum_id` int DEFAULT NULL,
  `inicioAno` int DEFAULT NULL,
  `fimMes` int DEFAULT NULL,
  `fimAno` int DEFAULT NULL,
  `estabelecimento` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cargo_id` int DEFAULT NULL,
  `cargoDescricao` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `atividadeExercida` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `curriculum_id` (`curriculum_id`),
  KEY `cargo_id` (`cargo_id`),
  CONSTRAINT `curriculum_experiencia_ibfk_1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`),
  CONSTRAINT `curriculum_experiencia_ibfk_2` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.curriculum_experiencia: ~11 rows (aproximadamente)
DELETE FROM `curriculum_experiencia`;
INSERT INTO `curriculum_experiencia` (`id`, `curriculum_id`, `inicioAno`, `fimMes`, `fimAno`, `estabelecimento`, `cargo_id`, `cargoDescricao`, `atividadeExercida`, `statusRegistro`) VALUES
	(1, 1, 78, 52, 4, 'Impedit ex doloribu', NULL, 'Dolor culpa lorem m', 'Minim eligendi simil', 1),
	(2, 2, 79, 14, 8, 'Ex provident tempor', NULL, 'Sint quis ut verita', 'Et mollit et consect', 1);

-- Copiando estrutura para tabela sistema_curriculo.curriculum_qualificacao
CREATE TABLE IF NOT EXISTS `curriculum_qualificacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `curriculum_id` int DEFAULT NULL,
  `mes` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `cargaHoraria` int DEFAULT NULL,
  `descricao` varchar(60) DEFAULT NULL,
  `estabelecimento` varchar(60) DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `curriculum_id` (`curriculum_id`),
  CONSTRAINT `curriculum_qualificacao_ibfk_1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.curriculum_qualificacao: ~11 rows (aproximadamente)
DELETE FROM `curriculum_qualificacao`;
INSERT INTO `curriculum_qualificacao` (`id`, `curriculum_id`, `mes`, `ano`, `cargaHoraria`, `descricao`, `estabelecimento`, `statusRegistro`) VALUES
	(1, 1, 81, 100, 39, 'Enim sit quo dolorem', 'Ex quo autem nemo cu', 1),
	(2, 2, 29, 96, 90, 'Veniam non dignissi', 'Excepteur et in aper', 1);

-- Copiando estrutura para tabela sistema_curriculo.curriculum_vaga
CREATE TABLE IF NOT EXISTS `curriculum_vaga` (
  `id` int NOT NULL AUTO_INCREMENT,
  `curriculum_id` int NOT NULL,
  `vaga_id` int NOT NULL,
  `data_candidatura` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT '1' COMMENT '1 - Pendente | 2 - Aprovado | 3 - Rejeitado',
  `observacao` text,
  PRIMARY KEY (`id`),
  KEY `curriculum_id` (`curriculum_id`),
  KEY `vaga_id` (`vaga_id`),
  CONSTRAINT `curriculum_vaga_ibfk_1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`),
  CONSTRAINT `curriculum_vaga_ibfk_2` FOREIGN KEY (`vaga_id`) REFERENCES `vaga` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.curriculum_vaga: ~3 rows (aproximadamente)
DELETE FROM `curriculum_vaga`;

-- Copiando estrutura para tabela sistema_curriculo.escolaridade
CREATE TABLE IF NOT EXISTS `escolaridade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.escolaridade: ~0 rows (aproximadamente)
DELETE FROM `escolaridade`;
INSERT INTO `escolaridade` (`id`, `descricao`, `statusRegistro`) VALUES
	(1, 'Ensino Médio', 1),
	(2, 'Ensino superior', 1);

-- Copiando estrutura para tabela sistema_curriculo.estabelecimento
CREATE TABLE IF NOT EXISTS `estabelecimento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `cidade` char(12) DEFAULT NULL,
  `latitude` char(12) DEFAULT NULL,
  `longitude` char(12) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `fk_estabelecimento_usuario` (`usuario_id`),
  CONSTRAINT `fk_estabelecimento_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.estabelecimento: ~1 rows (aproximadamente)
DELETE FROM `estabelecimento`;
INSERT INTO `estabelecimento` (`id`, `nome`, `endereco`, `cidade`, `latitude`, `longitude`, `email`, `usuario_id`, `statusRegistro`) VALUES
	(1, 'Empresa A', 'Centro', 'Muriae', '123', '456', 'empresaA@gmail.com', NULL, 1);

-- Copiando estrutura para tabela sistema_curriculo.pessoa_fisica
CREATE TABLE IF NOT EXISTS `pessoa_fisica` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `cpf` char(11) DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.pessoa_fisica: ~14 rows (aproximadamente)
DELETE FROM `pessoa_fisica`;

-- Copiando estrutura para tabela sistema_curriculo.telefone
CREATE TABLE IF NOT EXISTS `telefone` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `numero` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tipo` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `statusRegistro` int NOT NULL DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`id`),
  CONSTRAINT `telefone_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.telefone: ~2 rows (aproximadamente)
DELETE FROM `telefone`;
INSERT INTO `telefone` (`id`, `estabelecimento_id`, `usuario_id`, `numero`, `tipo`, `statusRegistro`) VALUES
	(1, 1, NULL, '32984994411', '1', 1);

-- Copiando estrutura para tabela sistema_curriculo.termoaceite
CREATE TABLE IF NOT EXISTS `termoaceite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `dataHoraAceite` datetime DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `termoaceite_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.termoaceite: ~0 rows (aproximadamente)
DELETE FROM `termoaceite`;

-- Copiando estrutura para tabela sistema_curriculo.termodeuso
CREATE TABLE IF NOT EXISTS `termodeuso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `textoTermo` longtext,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  `rascunho` bit(1) DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `termodeuso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.termodeuso: ~0 rows (aproximadamente)
DELETE FROM `termodeuso`;

-- Copiando estrutura para tabela sistema_curriculo.uf
CREATE TABLE IF NOT EXISTS `uf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sigla` varchar(2) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `bandeira` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sigla` (`sigla`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistema_curriculo.uf: ~28 rows (aproximadamente)
DELETE FROM `uf`;
INSERT INTO `uf` (`id`, `sigla`, `descricao`, `bandeira`) VALUES
	(1, 'MG', 'Minas Gerais', NULL);

-- Copiando estrutura para tabela sistema_curriculo.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` int DEFAULT NULL,
  `nivel` int NOT NULL DEFAULT '2' COMMENT '1=Super Administrador; 11=Administrador; 21=Usuário',
  `nome` varchar(60) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `statusRegistro` int NOT NULL DEFAULT '1' COMMENT '1=Ativo; 2=Inativo; 3=Bloqueado',
  PRIMARY KEY (`id`),
  KEY `fk_usuario_estabelecimento` (`estabelecimento_id`),
  CONSTRAINT `fk_usuario_estabelecimento` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.usuario: ~0 rows (aproximadamente)
DELETE FROM `usuario`;

-- Copiando estrutura para tabela sistema_curriculo.usuariorecuperasenha
CREATE TABLE IF NOT EXISTS `usuariorecuperasenha` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `chave` varchar(250) NOT NULL,
  `statusRegistro` int NOT NULL DEFAULT '1' COMMENT '1=Ativo;2=Inativo',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chave` (`chave`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `usuariorecuperasenha_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.usuariorecuperasenha: ~0 rows (aproximadamente)
DELETE FROM `usuariorecuperasenha`;

-- Copiando estrutura para tabela sistema_curriculo.vaga
CREATE TABLE IF NOT EXISTS `vaga` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cargo_id` int DEFAULT NULL,
  `descricao` varchar(60) DEFAULT NULL,
  `observacao` text,
  `modalidade` int DEFAULT NULL,
  `vinculo` int DEFAULT NULL,
  `ofertaPublica` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  `estabelecimento_id` int DEFAULT NULL,
  `statusVaga` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cargo_id` (`cargo_id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  CONSTRAINT `vaga_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`),
  CONSTRAINT `vaga_ibfk_2` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela sistema_curriculo.vaga: ~2 rows (aproximadamente)
DELETE FROM `vaga`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
