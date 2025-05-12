-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 12/05/2025 às 22h24min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` int(5) NOT NULL DEFAULT '0',
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`codigo`, `nome`) VALUES
(1, 'calcado'),
(2, 'bolsa'),
(3, 'roupa'),
(4, 'acessorio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `codigo` int(5) DEFAULT NULL,
  `senha` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`codigo`, `senha`) VALUES
(5698, 0),
(987666, 123564),
(0, 0),
(0, 0),
(0, 0),
(16, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `codigo` int(5) NOT NULL DEFAULT '0',
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`codigo`, `nome`) VALUES
(1, 'reversa'),
(2, 'killstar'),
(3, 'vans'),
(4, 'adidas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `codigo` int(5) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `tamanho` varchar(2) NOT NULL,
  `preco` float(8,2) NOT NULL,
  `codmarca` int(5) NOT NULL,
  `codcategoria` int(5) NOT NULL,
  `codtipo` int(5) NOT NULL,
  `foto1` varchar(100) NOT NULL,
  `foto2` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codtipo` (`codtipo`),
  KEY `codcategoria` (`codcategoria`),
  KEY `codmarca` (`codmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigo`, `descricao`, `cor`, `tamanho`, `preco`, `codmarca`, `codcategoria`, `codtipo`, `foto1`, `foto2`) VALUES
(1, 'Sapato Boneca Violet', 'preto', '36', 349.99, 1, 1, 2, '6f8f57468fce14622e4d27a375b32736', '0593de71f2171fd62a82e022a22e35a6'),
(2, 'Bermuda Biker Preta Meowtivation', 'preto', 'G', 99.90, 1, 3, 2, 'e67b6534373ba90da794ab77c8dd835a', '42b56cb8923f8e47b743cc2f1fd6ccf7'),
(3, 'Tenis Cano Medio Heart Wire', 'preto', '37', 219.90, 1, 1, 3, '9f922dc060d41dbe2732185212276322', 'c82a422d64103f2ec4fa62498c568905'),
(4, 'Bolsa Myth', 'preto', 'un', 200.00, 2, 2, 1, '8f8ebd5dde646792b2d4d6ef1e305019', '2b0ba8802ba201db88b49a712b2d6f80'),
(5, 'Mochila Field Trippin Rucksack Checkerboard', 'preto', 'un', 399.99, 3, 2, 3, 'b63c8f5e398721727d86225c69032b61', 'b1c01fe2b121918afbe5c93d890f40ad'),
(6, 'Camiseta Adidas X Korn Longsleeve Preto', 'preto', 'GG', 499.90, 4, 3, 3, 'be0318f682b7e975be9e4f6e412222b3', '88dd278145353372e5f31747188126b7'),
(7, 'Meia Gremlin Stripe', 'preto', 'un', 45.00, 2, 4, 3, '599541e5acd996789b5ceaf2de25a819', 'e05c179860f25c4c6ee5bc6f6f1d08cc'),
(8, 'Meia Vans Checkerboard CrewII', 'vermelho', 'un', 119.99, 3, 4, 3, '7c5acdb2c1459b44570b2903c7f49115', 'd0c8faa9e915885e7beafb22535163e7'),
(9, 'Jaqueta Crescent Dread ', 'preto', 'M', 350.99, 2, 3, 1, '43ed6deac3474c04513be560324caf64', '7a9e1894adae3e0d0fc31cf2c077f41c'),
(10, 'Top Fitness Dark Rage', 'preto', 'M', 99.90, 1, 3, 2, 'db9aee2a9aa465d0a396bf01501b2fa3', '31f6dafe47b2ce0d453e5c71da346d27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `codigo` int(5) NOT NULL DEFAULT '0',
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`codigo`, `nome`) VALUES
(1, 'masculino'),
(2, 'feminino'),
(3, 'unisex');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`codmarca`) REFERENCES `marca` (`codigo`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`codcategoria`) REFERENCES `categoria` (`codigo`),
  ADD CONSTRAINT `produto_ibfk_3` FOREIGN KEY (`codtipo`) REFERENCES `tipo` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
