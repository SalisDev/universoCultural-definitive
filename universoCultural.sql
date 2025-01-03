-- Criação do banco de dados
CREATE DATABASE universo_cultural;
USE universo_cultural;

-- Tabela endereco
CREATE TABLE endereco (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    cidade varchar(30) DEFAULT NULL,
    bairro varchar(25) DEFAULT NULL,
    rua varchar(30) DEFAULT NULL,
    estado varchar(30) NOT NULL,
    cep int(8) NOT NULL,
    numero int(4) NOT NULL
);

-- Tabela estoque
CREATE TABLE estoque (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    quantidade INT,
    valorVenda DECIMAL(10,2),
    valorCompra DECIMAL(10,2),
    lote INT
);

-- Tabela cliente
CREATE TABLE usuario (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(35),
    email VARCHAR(45),
    senha VARCHAR(255),
    fone VARCHAR(15),
    obs VARCHAR(45),
    endereco INT,
    cpf VARCHAR(18),
    FOREIGN KEY (endereco) REFERENCES endereco(cod)
);

-- Tabela tbLivro
CREATE TABLE tbLivro (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    capa VARCHAR(15),
    autor VARCHAR(255),
    editora VARCHAR(255),
    ISBN VARCHAR(13),
    paginas INT,
    subtitulo VARCHAR(50),
    estoque VARCHAR(255),
    idioma VARCHAR(255),
    genero VARCHAR(255),
    anoLancamento DATE
);

-- Tabela tbCompra
CREATE TABLE tbCompra (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    entrega VARCHAR(500),
    hora TIME,
    dataCompra DATE,
    quantidade INT,
    livro INT,
    FOREIGN KEY (livro) REFERENCES tbLivro(cod),
    usuario INT,
    FOREIGN KEY (usuario) REFERENCES usuario(cod)
);