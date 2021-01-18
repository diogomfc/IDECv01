-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17-Set-2014 às 14:54
-- Versão do servidor: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistema_idec`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `idec_agendamentoprofessor`
--

CREATE TABLE IF NOT EXISTS `idec_agendamentoprofessor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_professor` varchar(255) DEFAULT NULL,
  `professor` varchar(255) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `disciplina` varchar(255) DEFAULT NULL,
  `polo` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `horario` varchar(255) DEFAULT NULL,
  `horario1` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'ON',
  `representante` varchar(255) DEFAULT NULL,
  `cel` varchar(255) DEFAULT NULL,
  `tel1` varchar(255) DEFAULT NULL,
  `tel2` varchar(255) DEFAULT NULL,
  `tel3` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Extraindo dados da tabela `idec_agendamentoprofessor`
--

INSERT INTO `idec_agendamentoprofessor` (`id`, `id_professor`, `professor`, `curso`, `disciplina`, `polo`, `data`, `obs`, `horario`, `horario1`, `endereco`, `status`, `representante`, `cel`, `tel1`, `tel2`, `tel3`, `numero`, `cep`, `cidade`, `bairro`, `estado`, `referencia`) VALUES
(31, NULL, '11', 'DOCÃŠNCIA DO ENSINO MÃ‰DIO, TÃ‰CNICO E SUPERIOR DA SAÃšDE', 'TESTES', '63', '2014-09-16', 'TESTES', '08:00', '12:00', 'Estrada do Capuava', 'ON', 'JEFERSON', '11-98798-6955', '11-98798-6955', '11-98798-6955', '11-98798-6955', '260', '06716-580', 'Cotia', 'Jardim SabiÃ¡', 'SP', 'ESC. DE ENFERMAGEM SÃƒO JOÃƒO BATISTA'),
(32, NULL, '11', 'DIOGO PEREIRA GOMES SILVA', 'DIOGO', '37', '2014-09-17', NULL, '08:00', '12:00', 'Rua do PaÃ§o', 'ON', 'DIOGO', NULL, NULL, NULL, NULL, '103', '06401-090', 'Barueri', 'Centro', 'SP', 'CENTRO');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
