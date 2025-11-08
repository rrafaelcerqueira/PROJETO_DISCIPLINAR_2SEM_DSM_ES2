-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para tarefadb
CREATE DATABASE IF NOT EXISTS `tarefadb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `tarefadb`;

-- Copiando estrutura para tabela tarefadb.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `fk_usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categoria_usuario` (`fk_usuario_id`),
  CONSTRAINT `FK_categoria_usuario` FOREIGN KEY (`fk_usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela tarefadb.categoria: ~1 rows (aproximadamente)
INSERT INTO `categoria` (`id`, `nome`, `fk_usuario_id`) VALUES
	(10, 'Faculdade', 6);

-- Copiando estrutura para tabela tarefadb.estado
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela tarefadb.estado: ~2 rows (aproximadamente)
INSERT INTO `estado` (`id`, `estado`) VALUES
	(1, 'Pendente'),
	(2, 'Concluída');

-- Copiando estrutura para tabela tarefadb.tarefa
CREATE TABLE IF NOT EXISTS `tarefa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `data_expiracao` date DEFAULT NULL,
  `data_conclusao` date DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `fk_usuario_id` int(11) DEFAULT NULL,
  `fk_categoria_id` int(11) DEFAULT NULL,
  `fk_estado_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_tarefa_2` (`fk_usuario_id`),
  KEY `FK_tarefa_3` (`fk_categoria_id`),
  KEY `FK_tarefa_4` (`fk_estado_id`),
  CONSTRAINT `FK_tarefa_2` FOREIGN KEY (`fk_usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_tarefa_3` FOREIGN KEY (`fk_categoria_id`) REFERENCES `categoria` (`id`),
  CONSTRAINT `FK_tarefa_4` FOREIGN KEY (`fk_estado_id`) REFERENCES `estado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela tarefadb.tarefa: ~0 rows (aproximadamente)
INSERT INTO `tarefa` (`id`, `nome`, `data_expiracao`, `data_conclusao`, `descricao`, `fk_usuario_id`, `fk_categoria_id`, `fk_estado_id`) VALUES
	(26, 'Trabalho Bruno', '2025-11-11', NULL, 'Givanildo', 6, 10, 1),
	(27, 'Lista de exercicio C++', '2025-11-08', '2025-11-08', 'Lista de exercicios de pilhas e fila', 6, 10, 2);

-- Copiando estrutura para tabela tarefadb.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela tarefadb.usuario: ~1 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `nome`, `senha`, `email`) VALUES
	(6, 'John', '$2y$10$hXR.cKdzIcva9r7bKXu6Te4VKt6i0CYSFTK8WvF5Jg7IV/LhZ7PF2', 'john@gmail.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
