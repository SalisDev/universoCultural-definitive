-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Tempo de geração: 10/01/2025 às 20:54
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `universo_cultural`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `cod` int(11) NOT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `bairro` varchar(25) DEFAULT NULL,
  `rua` varchar(30) DEFAULT NULL,
  `estado` varchar(30) NOT NULL,
  `cep` int(8) NOT NULL,
  `numero` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`cod`, `cidade`, `bairro`, `rua`, `estado`, `cep`, `numero`) VALUES
(1, 'Sombrio', 'Raizera', 'Rua Mário Sant Helena ', '42', 88960000, 211),
(2, 'Cajueiro', 'centro', 'rua 6', '27', 88955000, 211);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `cod` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valorVenda` decimal(10,2) DEFAULT NULL,
  `valorCompra` decimal(10,2) DEFAULT NULL,
  `lote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcarrinho`
--

CREATE TABLE `tbcarrinho` (
  `cod` int(11) NOT NULL,
  `cod_livro` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbcarrinho`
--

INSERT INTO `tbcarrinho` (`cod`, `cod_livro`, `cod_usuario`) VALUES
(27, 20, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcompra`
--

CREATE TABLE `tbcompra` (
  `cod` int(11) NOT NULL,
  `entrega` varchar(500) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `dataCompra` date DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `livro` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbfavorito`
--

CREATE TABLE `tbfavorito` (
  `cod` int(11) NOT NULL,
  `cod_livro` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tblivro`
--

CREATE TABLE `tblivro` (
  `cod` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `capa` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `editora` varchar(255) DEFAULT NULL,
  `ISBN` varchar(13) DEFAULT NULL,
  `paginas` int(11) DEFAULT NULL,
  `subtitulo` varchar(200) NOT NULL,
  `estoque` varchar(255) DEFAULT NULL,
  `preco` decimal(10,0) NOT NULL,
  `idioma` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `anoLancamento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tblivro`
--

INSERT INTO `tblivro` (`cod`, `nome`, `capa`, `imagem`, `autor`, `editora`, `ISBN`, `paginas`, `subtitulo`, `estoque`, `preco`, `idioma`, `genero`, `anoLancamento`) VALUES
(20, 'A hora da estrela', 'dura', 'uploads/capas/capa_678110addcb564.63420466.jpg', '1', '1', '1111111111111', 113, 'resumo', '31', 20, '1', '1', '0000-00-00'),
(21, 'Alisson', 'dura', 'uploads/capas/capa_678110cea1b407.16375893.jpg', '1', '1', '1111111111111', 123, 'resumo', '12', 34, '1', '1', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(35) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `fone` varchar(15) DEFAULT NULL,
  `obs` varchar(45) DEFAULT NULL,
  `endereco` int(11) DEFAULT NULL,
  `cpf` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`cod`, `nome`, `email`, `senha`, `fone`, `obs`, `endereco`, `cpf`) VALUES
(1, 'alisson', 'alissongselau@gmail.com', '1234567', '48920027951', NULL, 1, '151.613.389-70'),
(2, 'Alisson', 'conradtsamuel@gmail.com', '323321', '489962015993', NULL, 0, '151.613.389-70');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `tbcarrinho`
--
ALTER TABLE `tbcarrinho`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `cod_livro` (`cod_livro`),
  ADD KEY `cod_usuario` (`cod_usuario`);

--
-- Índices de tabela `tbfavorito`
--
ALTER TABLE `tbfavorito`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `cod_livro` (`cod_livro`),
  ADD KEY `cod_usuario` (`cod_usuario`);

--
-- Índices de tabela `tblivro`
--
ALTER TABLE `tblivro`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbcarrinho`
--
ALTER TABLE `tbcarrinho`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tbfavorito`
--
ALTER TABLE `tbfavorito`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `tblivro`
--
ALTER TABLE `tblivro`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbcarrinho`
--
ALTER TABLE `tbcarrinho`
  ADD CONSTRAINT `tbcarrinho_ibfk_1` FOREIGN KEY (`cod_livro`) REFERENCES `tblivro` (`cod`),
  ADD CONSTRAINT `tbcarrinho_ibfk_2` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod`);

--
-- Restrições para tabelas `tbfavorito`
--
ALTER TABLE `tbfavorito`
  ADD CONSTRAINT `tbfavorito_ibfk_1` FOREIGN KEY (`cod_livro`) REFERENCES `tblivro` (`cod`),
  ADD CONSTRAINT `tbfavorito_ibfk_2` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
