CREATE TABLE pessoa_fisica (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150),
    cpf CHAR(11),
    visitante_id INT
);

CREATE TABLE termoaceite (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    dataHoraAceite DATETIME,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

CREATE TABLE termodeuso (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    textoTermo LONGTEXT,
    statusRegistro INT,
    rascunho BIT,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

CREATE TABLE telefone (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estabelecimento_id INT,
    usuario_id INT,
    numero CHAR(11),
    tipo ENUM('1', '2'),
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimento(id),
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

CREATE TABLE clique_telefone (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estabelecimento_id INT,
    visitante_id INT,
    telefone CHAR(11),
    telefone_id INT,
    data_clique TIMESTAMP,
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimento(id),
    FOREIGN KEY (telefone_id) REFERENCES telefone(id)
);

CREATE TABLE clique_celular (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estabelecimento_id INT,
    visitante_id INT,
    celular CHAR(11),
    telefone_id INT,
    data_clique TIMESTAMP,
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimento(id),
    FOREIGN KEY (telefone_id) REFERENCES telefone(id)
);

CREATE TABLE estabelecimento (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    endereco VARCHAR(200),
    cidade CHAR(12),
    latitude CHAR(12),
    longitude CHAR(12),
    email VARCHAR(150)
);

CREATE TABLE categoria (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50)
);

CREATE TABLE categoria_estabelecimento (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    estabelecimento_id INT,
    categoria_id INT,
    FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimento(id),
    FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);

CREATE TABLE curriculum (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pessoa_fisica_id INT,
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
    FOREIGN KEY (pessoa_fisica_id) REFERENCES pessoa_fisica(id),
    FOREIGN KEY (cidade_id) REFERENCES cidade(id)
);

CREATE TABLE escolaridade (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50)
);

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
    FOREIGN KEY (curriculum_id) REFERENCES curriculum(id),
    FOREIGN KEY (cidade_id) REFERENCES cidade(id),
    FOREIGN KEY (escolaridade_id) REFERENCES escolaridade(id)
);

CREATE TABLE cargo (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(50)
);

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
    FOREIGN KEY (curriculum_id) REFERENCES curriculum(id),
    FOREIGN KEY (cargo_id) REFERENCES cargo(id)
);

CREATE TABLE curriculum_qualificacao (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    curriculum_id INT,
    mes INT,
    ano INT,
    cargaHoraria INT,
    descricao VARCHAR(60),
    estabelecimento VARCHAR(60),
    FOREIGN KEY (curriculum_id) REFERENCES curriculum(id)
);

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

