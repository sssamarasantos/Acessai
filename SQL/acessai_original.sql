-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 12-Nov-2020 às 17:19
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id15054857_acessai`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ADMINISTRADOR`
--

CREATE TABLE `ADMINISTRADOR` (
  `ID_ADM` int(11) NOT NULL,
  `NOME_ADM` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_ADM` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SENHA_ADM` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `CONTATO`
--

CREATE TABLE `CONTATO` (
  `ID_CONTATO` int(11) NOT NULL,
  `NOME_CONTATO` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_CONTATO` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ASSUNTO_CONTATO` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `MSG_CONTATO` text COLLATE utf8_unicode_ci NOT NULL,
  `RESP_CONTATO` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_ALUNO`
--

CREATE TABLE `TB_ALUNO` (
  `ID_ALUNO` int(11) NOT NULL,
  `NOME_ALUNO` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_ALUNO` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `SENHA_ALUNO` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `ASSISTENCIA_ALUNO` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `TB_ALUNO`
--

INSERT INTO `TB_ALUNO` (`ID_ALUNO`, `NOME_ALUNO`, `EMAIL_ALUNO`, `SENHA_ALUNO`, `ASSISTENCIA_ALUNO`) VALUES
(1, 'Samarinha', 'samarassantos2015@gmail.com', '123456', 'Auditiva'),
(2, 'Emanuela', 'emanuela@gmail.com', '12345678', 'Auditiva'),
(7, 'Maíra ', 'maira.kamell@gmail.com', '123456', 'Nenhuma'),
(9, 'Ytditdtddt', 'emanuuela@gmail.com', '123456', 'Auditiva'),
(10, 'Josuela', 'emanuuela.costa11.mv@gmail.com', '123456', 'Nenhuma'),
(11, 'Josuela', 'emanuela.costa11.mc@gmail.com', '1234567', 'Nenhuma'),
(13, 'Samara', 'samara.souza2013@gmail.com', '123456', 'Nenhuma');

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_AULA`
--

CREATE TABLE `TB_AULA` (
  `ID_AULA` int(11) NOT NULL,
  `NOME_AULA` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `DTA_MODI_AULA` date NOT NULL,
  `ID_DISC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `TB_AULA`
--

INSERT INTO `TB_AULA` (`ID_AULA`, `NOME_AULA`, `DTA_MODI_AULA`, `ID_DISC`) VALUES
(1, 'Figuras de Linguagem', '2020-10-26', 1),
(2, 'Números primos', '2020-11-03', 2),
(3, 'Equações', '2020-11-03', 2),
(4, 'Verbos', '2020-11-03', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_CRONOGRAMA`
--

CREATE TABLE `TB_CRONOGRAMA` (
  `ID_CRONO` int(11) NOT NULL,
  `DTA_CRONO` date NOT NULL,
  `HORA_CRONO` time NOT NULL,
  `ID_ALUNO` int(11) DEFAULT NULL,
  `ID_VIDEOAULA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_DISCIPLINA`
--

CREATE TABLE `TB_DISCIPLINA` (
  `ID_DISC` int(11) NOT NULL,
  `NOME_DISC` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ID_PROF` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `TB_DISCIPLINA`
--

INSERT INTO `TB_DISCIPLINA` (`ID_DISC`, `NOME_DISC`, `ID_PROF`) VALUES
(1, 'Português', 1),
(2, 'Matemática', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_DUVIDA`
--

CREATE TABLE `TB_DUVIDA` (
  `ID_DUVIDA` int(11) NOT NULL,
  `MSG_DUVIDA` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `DTAHR_MSG_DUVIDA` datetime NOT NULL,
  `RESP_DUVIDA` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DTAHR_RESP_DUVIDA` datetime DEFAULT NULL,
  `ID_VIDEOAULA` int(11) DEFAULT NULL,
  `ID_ALUNO` int(11) DEFAULT NULL,
  `ID_PROF` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `TB_DUVIDA`
--

INSERT INTO `TB_DUVIDA` (`ID_DUVIDA`, `MSG_DUVIDA`, `DTAHR_MSG_DUVIDA`, `RESP_DUVIDA`, `DTAHR_RESP_DUVIDA`, `ID_VIDEOAULA`, `ID_ALUNO`, `ID_PROF`) VALUES
(1, 'Cade a aula???', '2020-11-10 16:19:06', NULL, NULL, 4, 1, 1),
(2, 'muito obrigada', '2020-11-10 21:46:49', NULL, NULL, 2, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_ITEM_AULA`
--

CREATE TABLE `TB_ITEM_AULA` (
  `ID_ITEM_AULA` int(11) NOT NULL,
  `STATUS_ITEM_AULA` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CLASSIFICAR_ITEM_AULA` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_ALUNO` int(11) DEFAULT NULL,
  `ID_VIDEOAULA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `TB_ITEM_AULA`
--

INSERT INTO `TB_ITEM_AULA` (`ID_ITEM_AULA`, `STATUS_ITEM_AULA`, `CLASSIFICAR_ITEM_AULA`, `ID_ALUNO`, `ID_VIDEOAULA`) VALUES
(1, 'Visto', '2.0', 1, 5),
(4, NULL, NULL, 11, 5),
(5, 'Rever', '2.0', 1, 4),
(11, 'Rever', '2.5', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_PROFESSOR`
--

CREATE TABLE `TB_PROFESSOR` (
  `ID_PROF` int(11) NOT NULL,
  `NOME_PROF` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_PROF` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `SENHA_PROF` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `ASSISTENCIA_PROF` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `TB_PROFESSOR`
--

INSERT INTO `TB_PROFESSOR` (`ID_PROF`, `NOME_PROF`, `EMAIL_PROF`, `SENHA_PROF`, `ASSISTENCIA_PROF`) VALUES
(1, 'Maria', 'maria@gmail.com', 'maria123', 'Nenhuma'),
(2, 'João', 'joao@gmail.com', '123', 'auditiva');

-- --------------------------------------------------------

--
-- Estrutura da tabela `TB_VIDEOAULA`
--

CREATE TABLE `TB_VIDEOAULA` (
  `ID_VIDEOAULA` int(11) NOT NULL,
  `NOME_VIDEOAULA` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `VIDEO_VIDEOAULA` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `DTA_POST_VIDEOAULA` date NOT NULL,
  `ASSISTENCIA_VIDEOAULA` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ARQUIVO_VIDEOAULA` binary(1) NOT NULL,
  `TEXTO_VIDEOAULA` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_AULA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `TB_VIDEOAULA`
--

INSERT INTO `TB_VIDEOAULA` (`ID_VIDEOAULA`, `NOME_VIDEOAULA`, `VIDEO_VIDEOAULA`, `DTA_POST_VIDEOAULA`, `ASSISTENCIA_VIDEOAULA`, `ARQUIVO_VIDEOAULA`, `TEXTO_VIDEOAULA`, `ID_AULA`) VALUES
(1, 'Quais são as figuras de liguagem?', '', '2020-10-26', 'Nenhuma', 0x00, NULL, 1),
(2, 'Como descobrir se um número é primo?', '', '2020-11-03', 'auditiva', 0x00, NULL, 2),
(3, 'Equações 2ºgrau', '', '2020-11-03', 'nenhuma', 0x00, NULL, 3),
(4, 'Verbos', '', '2020-11-03', 'auditiva', 0x00, NULL, 4),
(5, 'Verbos no imperativo', '', '2020-11-03', 'nenhuma', 0x00, NULL, 4),
(6, 'Números primos', '', '2020-02-02', 'auditiva', 0x00, NULL, 2),
(7, 'Números priminhos', '', '2020-08-02', 'nenhuma', 0x00, NULL, 2),
(8, 'Verbos', '', '2020-11-11', 'auditiva', 0x00, NULL, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `TRABALHE_CONOSCO`
--

CREATE TABLE `TRABALHE_CONOSCO` (
  `ID_TRABALHE` int(11) NOT NULL,
  `NOME_TRABALHE` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_TRABALHE` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `APRESENTACAO_TRABALHE` text COLLATE utf8_unicode_ci NOT NULL,
  `CURRICULO_TRABALHE` binary(30) NOT NULL,
  `RESP_TRABALHE` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ADMINISTRADOR`
--
ALTER TABLE `ADMINISTRADOR`
  ADD PRIMARY KEY (`ID_ADM`);

--
-- Índices para tabela `CONTATO`
--
ALTER TABLE `CONTATO`
  ADD PRIMARY KEY (`ID_CONTATO`),
  ADD UNIQUE KEY `EMAIL_CONTATO` (`EMAIL_CONTATO`);

--
-- Índices para tabela `TB_ALUNO`
--
ALTER TABLE `TB_ALUNO`
  ADD PRIMARY KEY (`ID_ALUNO`),
  ADD UNIQUE KEY `EMAIL_ALUNO` (`EMAIL_ALUNO`);

--
-- Índices para tabela `TB_AULA`
--
ALTER TABLE `TB_AULA`
  ADD PRIMARY KEY (`ID_AULA`),
  ADD KEY `ID_DISC` (`ID_DISC`);

--
-- Índices para tabela `TB_CRONOGRAMA`
--
ALTER TABLE `TB_CRONOGRAMA`
  ADD PRIMARY KEY (`ID_CRONO`),
  ADD KEY `ID_VIDEOAULA` (`ID_VIDEOAULA`),
  ADD KEY `ID_ALUNO` (`ID_ALUNO`);

--
-- Índices para tabela `TB_DISCIPLINA`
--
ALTER TABLE `TB_DISCIPLINA`
  ADD PRIMARY KEY (`ID_DISC`),
  ADD KEY `ID_PROF` (`ID_PROF`);

--
-- Índices para tabela `TB_DUVIDA`
--
ALTER TABLE `TB_DUVIDA`
  ADD PRIMARY KEY (`ID_DUVIDA`),
  ADD KEY `ID_VIDEOAULA` (`ID_VIDEOAULA`),
  ADD KEY `ID_ALUNO` (`ID_ALUNO`),
  ADD KEY `ID_PROF` (`ID_PROF`);

--
-- Índices para tabela `TB_ITEM_AULA`
--
ALTER TABLE `TB_ITEM_AULA`
  ADD PRIMARY KEY (`ID_ITEM_AULA`),
  ADD KEY `ID_ALUNO` (`ID_ALUNO`),
  ADD KEY `ID_VIDEOAULA` (`ID_VIDEOAULA`);

--
-- Índices para tabela `TB_PROFESSOR`
--
ALTER TABLE `TB_PROFESSOR`
  ADD PRIMARY KEY (`ID_PROF`),
  ADD UNIQUE KEY `EMAIL_PROF` (`EMAIL_PROF`);

--
-- Índices para tabela `TB_VIDEOAULA`
--
ALTER TABLE `TB_VIDEOAULA`
  ADD PRIMARY KEY (`ID_VIDEOAULA`),
  ADD KEY `ID_AULA` (`ID_AULA`);

--
-- Índices para tabela `TRABALHE_CONOSCO`
--
ALTER TABLE `TRABALHE_CONOSCO`
  ADD PRIMARY KEY (`ID_TRABALHE`),
  ADD UNIQUE KEY `EMAIL_TRABALHE` (`EMAIL_TRABALHE`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ADMINISTRADOR`
--
ALTER TABLE `ADMINISTRADOR`
  MODIFY `ID_ADM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `CONTATO`
--
ALTER TABLE `CONTATO`
  MODIFY `ID_CONTATO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `TB_ALUNO`
--
ALTER TABLE `TB_ALUNO`
  MODIFY `ID_ALUNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `TB_AULA`
--
ALTER TABLE `TB_AULA`
  MODIFY `ID_AULA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `TB_CRONOGRAMA`
--
ALTER TABLE `TB_CRONOGRAMA`
  MODIFY `ID_CRONO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `TB_DISCIPLINA`
--
ALTER TABLE `TB_DISCIPLINA`
  MODIFY `ID_DISC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `TB_DUVIDA`
--
ALTER TABLE `TB_DUVIDA`
  MODIFY `ID_DUVIDA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `TB_ITEM_AULA`
--
ALTER TABLE `TB_ITEM_AULA`
  MODIFY `ID_ITEM_AULA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `TB_PROFESSOR`
--
ALTER TABLE `TB_PROFESSOR`
  MODIFY `ID_PROF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `TB_VIDEOAULA`
--
ALTER TABLE `TB_VIDEOAULA`
  MODIFY `ID_VIDEOAULA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `TRABALHE_CONOSCO`
--
ALTER TABLE `TRABALHE_CONOSCO`
  MODIFY `ID_TRABALHE` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `TB_AULA`
--
ALTER TABLE `TB_AULA`
  ADD CONSTRAINT `TB_AULA_ibfk_1` FOREIGN KEY (`ID_DISC`) REFERENCES `TB_DISCIPLINA` (`ID_DISC`);

--
-- Limitadores para a tabela `TB_CRONOGRAMA`
--
ALTER TABLE `TB_CRONOGRAMA`
  ADD CONSTRAINT `TB_CRONOGRAMA_ibfk_1` FOREIGN KEY (`ID_VIDEOAULA`) REFERENCES `TB_VIDEOAULA` (`ID_VIDEOAULA`),
  ADD CONSTRAINT `TB_CRONOGRAMA_ibfk_2` FOREIGN KEY (`ID_ALUNO`) REFERENCES `TB_ALUNO` (`ID_ALUNO`);

--
-- Limitadores para a tabela `TB_DISCIPLINA`
--
ALTER TABLE `TB_DISCIPLINA`
  ADD CONSTRAINT `TB_DISCIPLINA_ibfk_1` FOREIGN KEY (`ID_PROF`) REFERENCES `TB_PROFESSOR` (`ID_PROF`);

--
-- Limitadores para a tabela `TB_DUVIDA`
--
ALTER TABLE `TB_DUVIDA`
  ADD CONSTRAINT `TB_DUVIDA_ibfk_1` FOREIGN KEY (`ID_VIDEOAULA`) REFERENCES `TB_VIDEOAULA` (`ID_VIDEOAULA`),
  ADD CONSTRAINT `TB_DUVIDA_ibfk_2` FOREIGN KEY (`ID_ALUNO`) REFERENCES `TB_ALUNO` (`ID_ALUNO`),
  ADD CONSTRAINT `TB_DUVIDA_ibfk_3` FOREIGN KEY (`ID_PROF`) REFERENCES `TB_PROFESSOR` (`ID_PROF`);

--
-- Limitadores para a tabela `TB_ITEM_AULA`
--
ALTER TABLE `TB_ITEM_AULA`
  ADD CONSTRAINT `TB_ITEM_AULA_ibfk_1` FOREIGN KEY (`ID_ALUNO`) REFERENCES `TB_ALUNO` (`ID_ALUNO`),
  ADD CONSTRAINT `TB_ITEM_AULA_ibfk_2` FOREIGN KEY (`ID_VIDEOAULA`) REFERENCES `TB_VIDEOAULA` (`ID_VIDEOAULA`);

--
-- Limitadores para a tabela `TB_VIDEOAULA`
--
ALTER TABLE `TB_VIDEOAULA`
  ADD CONSTRAINT `TB_VIDEOAULA_ibfk_1` FOREIGN KEY (`ID_AULA`) REFERENCES `TB_AULA` (`ID_AULA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
