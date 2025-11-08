-- parte 2 script_sql

-- Copiando estrutura para tabela atomphp.uf
CREATE TABLE IF NOT EXISTS `uf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sigla` varchar(2) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `bandeira` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sigla` (`sigla`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Copiando estrutura para tabela atomphp.cidade
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Tabela: usuario
CREATE TABLE IF NOT EXISTS usuario (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estabelecimento_id INT NULL,
    nivel INT NOT NULL DEFAULT 2 COMMENT '1=Super Administrador; 11=Administrador; 21=Usuário',
    nome VARCHAR(60) NOT NULL,
    email VARCHAR(150) NOT NULL,
    senha VARCHAR(250) NOT NULL,
    statusRegistro INT NOT NULL DEFAULT 1 COMMENT '1=Ativo; 2=Inativo; 3=Bloqueado',

    CONSTRAINT fk_usuario_estabelecimento FOREIGN KEY (estabelecimento_id)
        REFERENCES estabelecimento(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;

-- Tabela: pessoa_fisica
CREATE TABLE pessoa_fisica (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150),
    cpf CHAR(11),
    visitante_id INT,
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo'
);

CREATE TABLE estabelecimento (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    endereco VARCHAR(200),
    cidade CHAR(12),
    latitude CHAR(12),
    longitude CHAR(12),
    email VARCHAR(150),
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;


-- Tabela: telefone
CREATE TABLE telefone (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estabelecimento_id INT,
    usuario_id INT,
    numero CHAR(11),
    tipo ENUM('1', '2'),
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimento(id),
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

-- Tabela: clique_telefone
CREATE TABLE clique_telefone (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estabelecimento_id INT,
    visitante_id INT,
    telefone CHAR(11),
    telefone_id INT,
    data_clique TIMESTAMP,
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimento(id),
    FOREIGN KEY (telefone_id) REFERENCES telefone(id)
);

-- Tabela: clique_celular
CREATE TABLE clique_celular (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estabelecimento_id INT,
    visitante_id INT,
    celular CHAR(11),
    telefone_id INT,
    data_clique TIMESTAMP,
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimento(id),
    FOREIGN KEY (telefone_id) REFERENCES telefone(id)
);

-- Tabela: termoaceite
CREATE TABLE termoaceite (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    dataHoraAceite DATETIME,
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

-- Tabela: termodeuso
CREATE TABLE termodeuso (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    textoTermo LONGTEXT,
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    rascunho BIT,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

-- Tabela: categoria
CREATE TABLE categoria (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50),
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo'
);

-- Tabela: categoria_estabelecimento
CREATE TABLE categoria_estabelecimento (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estabelecimento_id INT,
    categoria_id INT,
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimento(id),
    FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);

CREATE TABLE curriculum (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pessoa_fisica_id INT,
    usuario_id INT,
    logradouro VARCHAR(60),
    numero VARCHAR(4),
    complemento VARCHAR(20),
    bairro VARCHAR(50),
    cep VARCHAR(8),
    cidade_id INT,
    celular VARCHAR(11),
    nascimento DATE,
    sexo CHAR(1),
    foto VARCHAR(255),
    email VARCHAR(120),
    apresentacaoPessoal TEXT,
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    
    FOREIGN KEY (pessoa_fisica_id) REFERENCES pessoa_fisica(id),
    FOREIGN KEY (cidade_id) REFERENCES cidade(id),
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);


-- Tabela: escolaridade
CREATE TABLE escolaridade (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50),
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo'
);

-- Tabela: curriculum_escolaridade
CREATE TABLE curriculum_escolaridade (
    cid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    curriculum_id INT,
    inicioAno INT,
    fimMes INT,
    fimAno INT,
    descricao VARCHAR(60),
    instituicao VARCHAR(60),
    cidade_id INT,
    escolaridade_id INT,
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    FOREIGN KEY (curriculum_id) REFERENCES curriculum(id),
    FOREIGN KEY (cidade_id) REFERENCES cidade(id),
    FOREIGN KEY (escolaridade_id) REFERENCES escolaridade(id)
);

-- Tabela: cargo
CREATE TABLE cargo (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50),
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo'
);

-- Tabela: curriculum_experiencia
CREATE TABLE curriculum_experiencia (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    curriculum_id INT,
    inicioAno INT,
    fimMes INT,
    fimAno INT,
    estabelecimento VARCHAR(60),
    cargo_id INT,
    cargoDescricao VARCHAR(60),
    atividadeExercida TEXT,
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    FOREIGN KEY (curriculum_id) REFERENCES curriculum(id),
    FOREIGN KEY (cargo_id) REFERENCES cargo(id)
);

-- Tabela: curriculum_qualificacao
CREATE TABLE curriculum_qualificacao (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    curriculum_id INT,
    mes INT,
    ano INT,
    cargaHoraria INT,
    descricao VARCHAR(60),
    estabelecimento VARCHAR(60),
    statusRegistro INT DEFAULT 1 COMMENT '1 - Ativo    2 - Inativo',
    FOREIGN KEY (curriculum_id) REFERENCES curriculum(id)
);

-- Tabela: vaga
CREATE TABLE vaga (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cargo_id INT,
    descricao VARCHAR(60),
    observacao TEXT,
    modalidade INT,
    vinculo INT,
    ofertaPublica BIT,
    data DATE,
    estabelecimento_id INT,
    statusVaga INT,
    FOREIGN KEY (cargo_id) REFERENCES cargo(id),
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimento(id)
);

-- Tabela: usuariorecuperasenha
CREATE TABLE IF NOT EXISTS usuariorecuperasenha (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  chave VARCHAR(250) NOT NULL UNIQUE,
  statusRegistro INT NOT NULL DEFAULT 1 COMMENT '1=Ativo;2=Inativo',
  created_at DATETIME NOT NULL,
  updated_at DATETIME DEFAULT NULL,
  FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);
        
CREATE TABLE curriculum_vaga (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    curriculum_id INT NOT NULL,
    vaga_id INT NOT NULL,
    data_candidatura DATETIME DEFAULT CURRENT_TIMESTAMP,
    status INT DEFAULT 1 COMMENT '1 - Pendente | 2 - Aprovado | 3 - Rejeitado',
    observacao TEXT,
    FOREIGN KEY (curriculum_id) REFERENCES curriculum(id),
    FOREIGN KEY (vaga_id) REFERENCES vaga(id)
);
