-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30-Maio-2015 às 01:05
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aluno_sitedojogo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jogador` int(11) NOT NULL,
  `datacompra` datetime NOT NULL,
  `valortotal` decimal(7,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jogador` (`id_jogador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhescompra`
--

CREATE TABLE IF NOT EXISTS `detalhescompra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `id_dlc` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `valorunitario` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_compra` (`id_compra`,`id_dlc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dlc`
--

CREATE TABLE IF NOT EXISTS `dlc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `preco` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `dlc`
--

INSERT INTO `dlc` (`id`, `nome`, `preco`) VALUES
(1, 'Bife da Alegria Eterna', '10.00'),
(2, 'Batata Assada da Invisibilidade', '5.00'),
(3, 'Creme Verde da Vida Eterna', '100.00'),
(4, 'Escada para Sair dos Buracos', '20.00'),
(5, 'Tela Âmbar do Computador', '7.50'),
(6, 'Arco da Velha', '0.50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoquedlc`
--

CREATE TABLE IF NOT EXISTS `estoquedlc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jogador` int(11) NOT NULL,
  `id_dlc` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogadores`
--

CREATE TABLE IF NOT EXISTS `jogadores` (
  `id` int(11) NOT NULL,
  `apelido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pontuacao` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mailing`
--

CREATE TABLE IF NOT EXISTS `mailing` (
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `datanoticia` datetime NOT NULL,
  `textonoticia` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `datanascimento` date NOT NULL,
  `datacadastro` datetime NOT NULL,
  `mailing` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `sexo`, `datanascimento`, `datacadastro`, `mailing`, `status`) VALUES
(1, 'Administrador do Site', 'admin@caixascoloridas.com.br', '$1$d74.iH/.$fSOXLcmtDmdnvdBq4wsFg.', 'X', '2015-01-01', '2015-05-29 18:11:30', 'N', 'A');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
