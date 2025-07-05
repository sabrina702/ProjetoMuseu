
DROP DATABASE IF EXISTS `bdmuseu`;
CREATE DATABASE IF NOT EXISTS `bdmuseu`;
USE `bdmuseu`;

DROP TABLE IF EXISTS `membro`;
CREATE TABLE IF NOT EXISTS `membro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `perfil` enum('Monitor(a)','Professor(a)','Coordenador(a) do Museu') NOT NULL,
  `sobre` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `solicitacao`;
CREATE TABLE IF NOT EXISTS `solicitacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_acao` date NOT NULL,
  `hora_acao` time NOT NULL,
  `situacao` enum('Nova','Em análise','Agendado','Concluído','Recusado') NOT NULL DEFAULT 'Nova',
  `descricao` text DEFAULT NULL,
  `id_visitante` int(11) NOT NULL,
  `id_membro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_visitante` (`id_visitante`),
  KEY `id_membro` (`id_membro`),
  CONSTRAINT `solicitacao_ibfk_1` FOREIGN KEY (`id_visitante`) REFERENCES `visitante` (`id`),
  CONSTRAINT `solicitacao_ibfk_2` FOREIGN KEY (`id_membro`) REFERENCES `membro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `visitante`;
CREATE TABLE IF NOT EXISTS `visitante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefone_escola` varchar(20) NOT NULL,
  `nome_escola` varchar(200) NOT NULL,
  `nome_responsavel` varchar(200) NOT NULL,
  `telefone_responsavel` varchar(20) NOT NULL,
  `email_responsavel` varchar(150) NOT NULL,
  `quantidade_alunos` int(11) NOT NULL,
  `perfil_alunos` varchar(200) NOT NULL,
  `data_pretendida` date NOT NULL,
  `hora_pretendida` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
