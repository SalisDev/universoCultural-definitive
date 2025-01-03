-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/01/2025 às 22:23
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

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
(1, 'Sombrio', 'Raizera', 'Rua Mário Sant Helena ', '42', 88960000, 211);

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
-- Estrutura para tabela `tblivro`
--

CREATE TABLE `tblivro` (
  `cod` int(11) NOT NULL,
  `capa` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `editora` varchar(255) DEFAULT NULL,
  `ISBN` varchar(13) DEFAULT NULL,
  `paginas` int(11) DEFAULT NULL,
  `subtitulo` varchar(50) DEFAULT NULL,
  `estoque` varchar(255) DEFAULT NULL,
  `idioma` varchar(255) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `anoLancamento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Samuel Conradt', 'conradtsamuel@gmail.com', '1234567', '48999270576', NULL, 1, '004.857.840-17');

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
-- Índices de tabela `tbcompra`
--
ALTER TABLE `tbcompra`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `livro` (`livro`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices de tabela `tblivro`
--
ALTER TABLE `tblivro`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `endereco` (`endereco`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbcompra`
--
ALTER TABLE `tbcompra`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tblivro`
--
ALTER TABLE `tblivro`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbcompra`
--
ALTER TABLE `tbcompra`
  ADD CONSTRAINT `tbcompra_ibfk_1` FOREIGN KEY (`livro`) REFERENCES `tblivro` (`cod`),
  ADD CONSTRAINT `tbcompra_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`cod`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`endereco`) REFERENCES `endereco` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
