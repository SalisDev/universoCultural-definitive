-- Criação do banco de dados
CREATE DATABASE universo_cultural;
USE universo_cultural;

-- Tabela endereco
CREATE TABLE endereco (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    uf CHAR(2),
    cidade VARCHAR(30),
    bairro VARCHAR(25),
    rua VARCHAR(30),
    referencial VARCHAR(40)
);

-- Tabela autor
CREATE TABLE autor (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(40)
);

-- Tabela editora
CREATE TABLE editora (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(40)
);

-- Tabela idioma
CREATE TABLE idioma (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(40)
);

-- Tabela genero
CREATE TABLE genero (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(40)
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
CREATE TABLE cliente (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(35),
    email VARCHAR(45),
    telefone VARCHAR(15),
    obs VARCHAR(45),
    endereco INT,
    CPF_CNPJ VARCHAR(18),
    FOREIGN KEY (endereco) REFERENCES endereco(cod)
);

-- Tabela tbLivro
CREATE TABLE tbLivro (
    cod INT PRIMARY KEY AUTO_INCREMENT,
    capa CHAR(15),
    autor INT,
    FOREIGN KEY (autor) REFERENCES autor(cod),
    editora INT,
    FOREIGN KEY (editora) REFERENCES editora(cod),
    ISBN VARCHAR(13),
    paginas INT,
    subtitulo VARCHAR(50),
    estoque INT,
    FOREIGN KEY (estoque) REFERENCES estoque(cod),
    idioma INT,
    FOREIGN KEY (idioma) REFERENCES idioma(cod),
    genero INT,
    FOREIGN KEY (genero) REFERENCES genero(cod),
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
    cliente INT,
    FOREIGN KEY (cliente) REFERENCES cliente(cod)
);
