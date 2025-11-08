/*parte 1 conectando_talentos
 */
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


-- Copiando estrutura do banco de dados para conectando_talentos
CREATE DATABASE IF NOT EXISTS `conectando_talentos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `conectando_talentos`;

-- Copiando estrutura para tabela conectando_talentos.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `statusRegistro` int NOT NULL DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.cargo: ~102 rows (aproximadamente)
DELETE FROM `cargo`;
INSERT INTO `cargo` (`id`, `descricao`, `statusRegistro`) VALUES
	(1, 'Administrador de Sistemas', 1),
	(2, 'Analista de Suporte', 1),
	(3, 'Analista de Dados', 1),
	(4, 'Analista de Recursos Humanos', 1),
	(5, 'Analista de Marketing', 1),
	(6, 'Analista Financeiro', 1),
	(7, 'Arquiteto de Software', 1),
	(8, 'Assistente Administrativo', 1),
	(9, 'Assistente de Compras', 1),
	(10, 'Assistente de Logística', 1),
	(11, 'Atendente de Telemarketing', 1),
	(12, 'Auxiliar Administrativo', 1),
	(13, 'Auxiliar de Almoxarifado', 1),
	(14, 'Auxiliar de Limpeza', 1),
	(15, 'Auxiliar de Produção', 1),
	(16, 'Auxiliar de RH', 1),
	(17, 'Coordenador de Projetos', 1),
	(18, 'Coordenador de Vendas', 1),
	(19, 'Desenvolvedor Back-End', 1),
	(20, 'Desenvolvedor Front-End', 1),
	(21, 'Desenvolvedor Full Stack', 1),
	(22, 'Designer Gráfico', 1),
	(23, 'Diretor de Operações', 1),
	(24, 'Diretor Financeiro', 1),
	(25, 'Engenheiro de Produção', 1),
	(26, 'Engenheiro de Software', 1),
	(27, 'Estagiário de Administração', 1),
	(28, 'Estagiário de Engenharia', 1),
	(29, 'Estagiário de Marketing', 1),
	(30, 'Estagiário de TI', 1),
	(31, 'Gerente Comercial', 1),
	(32, 'Gerente de Compras', 1),
	(33, 'Gerente de Marketing', 1),
	(34, 'Gerente de Projetos', 1),
	(35, 'Gerente de Recursos Humanos', 1),
	(36, 'Gerente Financeiro', 1),
	(37, 'Instrutor de Treinamento', 1),
	(38, 'Jardineiro', 1),
	(39, 'Motorista', 1),
	(40, 'Operador de Caixa', 1),
	(41, 'Operador de Empilhadeira', 1),
	(42, 'Operador de Máquinas', 1),
	(43, 'Pedreiro', 1),
	(44, 'Pintor Industrial', 1),
	(45, 'Programador PHP', 1),
	(46, 'Programador Python', 1),
	(47, 'Programador Java', 1),
	(48, 'Programador C#', 1),
	(49, 'Recepcionista', 1),
	(50, 'Secretária Executiva', 1),
	(51, 'Supervisor de Logística', 1),
	(52, 'Supervisor de Produção', 1),
	(53, 'Técnico de Enfermagem', 1),
	(54, 'Técnico de Informática', 1),
	(55, 'Técnico de Segurança do Trabalho', 1),
	(56, 'Vendedor Interno', 1),
	(57, 'Vendedor Externo', 1),
	(58, 'Web Designer', 1),
	(59, 'Zelador', 1),
	(60, 'Auxiliar de Estoque', 1),
	(61, 'Auxiliar de Manutenção', 1),
	(62, 'Barbeiro', 1),
	(63, 'Cabeleireiro', 1),
	(64, 'Camareira', 1),
	(65, 'Chef de Cozinha', 1),
	(66, 'Consultor de Vendas', 1),
	(67, 'Costureira', 1),
	(68, 'Eletricista', 1),
	(69, 'Enfermeiro', 1),
	(70, 'Engenheiro Civil', 1),
	(71, 'Farmacêutico', 1),
	(72, 'Fiscal de Loja', 1),
	(73, 'Garçom', 1),
	(74, 'Gestor de TI', 1),
	(75, 'Marceneiro', 1),
	(76, 'Mecânico de Automóveis', 1),
	(77, 'Médico Clínico Geral', 1),
	(78, 'Médico do Trabalho', 1),
	(79, 'Montador de Móveis', 1),
	(80, 'Nutricionista', 1),
	(81, 'Operador de Telemarketing', 1),
	(82, 'Padeiro', 1),
	(83, 'Porteiro', 1),
	(84, 'Professor de Educação Física', 1),
	(85, 'Psicólogo Organizacional', 1),
	(86, 'Representante Comercial', 1),
	(87, 'Segurança Patrimonial', 1),
	(88, 'Serralheiro', 1),
	(89, 'Soldador', 1),
	(90, 'Supervisor de Call Center', 1),
	(91, 'Técnico em Edificações', 1),
	(92, 'Técnico em Eletrotécnica', 1),
	(93, 'Técnico em Mecânica', 1),
	(94, 'Técnico em Meio Ambiente', 1),
	(95, 'Técnico em Química', 1),
	(96, 'Torneiro Mecânico', 1),
	(97, 'Tradutor', 1),
	(98, 'Vigia', 1),
	(99, 'Zootecnista', 1);

-- Copiando estrutura para tabela conectando_talentos.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `statusRegistro` int NOT NULL DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.categoria: ~2 rows (aproximadamente)
DELETE FROM `categoria`;
INSERT INTO `categoria` (`id`, `descricao`, `statusRegistro`) VALUES
	(1, 'Restaurante', 1),
	(2, 'Farmácia', 1),
	(3, 'Clínica Médica', 1),
	(4, 'Supermercado', 1),
	(5, 'Academia', 1),
	(6, 'Loja de Roupas', 1);

-- Copiando estrutura para tabela conectando_talentos.categoria_estabelecimento
CREATE TABLE IF NOT EXISTS `categoria_estabelecimento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` int DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `statusRegistro` int NOT NULL DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `categoria_estabelecimento_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`id`),
  CONSTRAINT `categoria_estabelecimento_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.categoria_estabelecimento: ~2 rows (aproximadamente)
DELETE FROM `categoria_estabelecimento`;

-- Copiando estrutura para tabela conectando_talentos.cidade
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela conectando_talentos.cidade: ~2 rows (aproximadamente)
DELETE FROM `cidade`;
INSERT INTO `cidade` (`id`, `nome`, `uf_id`, `codIBGE`, `wiki`) VALUES
	(1, 'São Paulo', 25, '3550308', NULL),
	(2, 'Campinas', 25, '3509502', NULL),
	(3, 'Rio de Janeiro', 19, '3304557', NULL),
	(4, 'Niterói', 19, '3303302', NULL),
	(5, 'Belo Horizonte', 13, '3106200', NULL),
	(6, 'Curitiba', 16, '4106902', NULL),
	(7, 'Porto Alegre', 21, '4314902', NULL),
	(8, 'Fortaleza', 6, '2304400', NULL),
	(9, 'Muriaé', 13, '3143906', NULL),
	(10, 'Ervália', 13, '3124104', NULL),
	(11, 'Rosário da Limeira', 13, '3156456', NULL),
	(12, 'Ubá', 13, '3170107', NULL),
	(13, 'Viçosa', 13, '3171303', NULL),
	(14, 'Cataguases', 13, '3115300', NULL),
	(15, 'Leopoldina', 13, '3138401', NULL),
	(16, 'Juiz de Fora', 13, '3136702', NULL),
	(17, 'São Geraldo', 13, '3160603', NULL);

-- Copiando estrutura para tabela conectando_talentos.curriculum
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.curriculum: ~1 rows (aproximadamente)
DELETE FROM `curriculum`;

-- Copiando estrutura para tabela conectando_talentos.curriculum_escolaridade
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.curriculum_escolaridade: ~1 rows (aproximadamente)
DELETE FROM `curriculum_escolaridade`;

-- Copiando estrutura para tabela conectando_talentos.curriculum_experiencia
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.curriculum_experiencia: ~1 rows (aproximadamente)
DELETE FROM `curriculum_experiencia`;

-- Copiando estrutura para tabela conectando_talentos.curriculum_qualificacao
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.curriculum_qualificacao: ~1 rows (aproximadamente)
DELETE FROM `curriculum_qualificacao`;

-- Copiando estrutura para tabela conectando_talentos.curriculum_vaga
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

-- Copiando dados para a tabela conectando_talentos.curriculum_vaga: ~1 rows (aproximadamente)
DELETE FROM `curriculum_vaga`;

-- Copiando estrutura para tabela conectando_talentos.escolaridade
CREATE TABLE IF NOT EXISTS `escolaridade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  `statusRegistro` int DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.escolaridade: ~2 rows (aproximadamente)
DELETE FROM `escolaridade`;
INSERT INTO `escolaridade` (`id`, `descricao`, `statusRegistro`) VALUES
	(1, 'Ensino Fundamental Incompleto', 1),
	(2, 'Ensino Fundamental Completo', 1),
	(3, 'Ensino Médio Incompleto', 1),
	(4, 'Ensino Médio Completo', 1),
	(5, 'Ensino Técnico', 1),
	(6, 'Graduação Incompleta', 1),
	(7, 'Graduação Completa', 1),
	(8, 'Pós-Graduação', 1),
	(9, 'Mestrado', 1),
	(10, 'Doutorado', 1);

-- Copiando estrutura para tabela conectando_talentos.estabelecimento
CREATE TABLE IF NOT EXISTS `estabelecimento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `endereco` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cidade_id` int DEFAULT NULL,
  `latitude` char(12) DEFAULT NULL,
  `longitude` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `statusRegistro` int NOT NULL DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`),
  KEY `fk_estabelecimento_usuario` (`usuario_id`),
  KEY `fk_estabelecimento_cidade` (`cidade_id`),
  CONSTRAINT `fk_estabelecimento_cidade` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_estabelecimento_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.estabelecimento: ~0 rows (aproximadamente)
DELETE FROM `estabelecimento`;

-- Copiando estrutura para tabela conectando_talentos.pessoa_fisica
CREATE TABLE IF NOT EXISTS `pessoa_fisica` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cpf` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `statusRegistro` int NOT NULL DEFAULT '1' COMMENT '1 - Ativo    2 - Inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.pessoa_fisica: ~1 rows (aproximadamente)
DELETE FROM `pessoa_fisica`;

-- Copiando estrutura para tabela conectando_talentos.telefone
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela conectando_talentos.telefone: ~2 rows (aproximadamente)
DELETE FROM `telefone`;

-- Copiando estrutura para tabela conectando_talentos.uf
CREATE TABLE IF NOT EXISTS `uf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sigla` varchar(2) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `bandeira` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sigla` (`sigla`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela conectando_talentos.uf: ~2 rows (aproximadamente)
DELETE FROM `uf`;
INSERT INTO `uf` (`id`, `sigla`, `descricao`, `bandeira`) VALUES
	(1, 'AC', 'Acre', NULL),
	(2, 'AL', 'Alagoas', NULL),
	(3, 'AP', 'Amapá', NULL),
	(4, 'AM', 'Amazonas', NULL),
	(5, 'BA', 'Bahia', NULL),
	(6, 'CE', 'Ceará', NULL),
	(7, 'DF', 'Distrito Federal', NULL),
	(8, 'ES', 'Espírito Santo', NULL),
	(9, 'GO', 'Goiás', NULL),
	(10, 'MA', 'Maranhão', NULL),
	(11, 'MT', 'Mato Grosso', NULL),
	(12, 'MS', 'Mato Grosso do Sul', NULL),
	(13, 'MG', 'Minas Gerais', NULL),
	(14, 'PA', 'Pará', NULL),
	(15, 'PB', 'Paraíba', NULL),
	(16, 'PR', 'Paraná', NULL),
	(17, 'PE', 'Pernambuco', NULL),
	(18, 'PI', 'Piauí', NULL),
	(19, 'RJ', 'Rio de Janeiro', NULL),
	(20, 'RN', 'Rio Grande do Norte', NULL),
	(21, 'RS', 'Rio Grande do Sul', NULL),
	(22, 'RO', 'Rondônia', NULL),
	(23, 'RR', 'Roraima', NULL),
	(24, 'SC', 'Santa Catarina', NULL),
	(25, 'SP', 'São Paulo', NULL),
	(26, 'SE', 'Sergipe', NULL),
	(27, 'TO', 'Tocantins', NULL);

-- Copiando estrutura para tabela conectando_talentos.usuario
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

-- Copiando dados para a tabela conectando_talentos.usuario: ~0 rows (aproximadamente)
DELETE FROM `usuario`;

-- Copiando estrutura para tabela conectando_talentos.usuariorecuperasenha
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

-- Copiando dados para a tabela conectando_talentos.usuariorecuperasenha: ~0 rows (aproximadamente)
DELETE FROM `usuariorecuperasenha`;

-- Copiando estrutura para tabela conectando_talentos.vaga
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

-- Copiando dados para a tabela conectando_talentos.vaga: ~3 rows (aproximadamente)
DELETE FROM `vaga`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
